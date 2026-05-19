<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use App\Mail\ReportClientApprovalMail;
use App\Models\Client;
use App\Models\Machine;
use App\Models\Product;
use App\Models\Report;
use App\Models\ReportPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = Report::where('technician_id', $request->user()->id)
            ->with(['client', 'machine', 'product'])
            ->latest()->paginate(15);
        return view('technician.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('technician.reports.create', [
            'machines' => Machine::where('active', true)->orderBy('name')->get(),
            'products' => Product::where('active', true)->orderBy('name')->get(),
            'clients'  => Client::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'     => ['nullable', 'exists:clients,id'],
            'client_name'   => ['nullable', 'string', 'max:255'],
            'client_email'  => ['nullable', 'email'],
            'client_phone'  => ['nullable', 'string', 'max:30'],
            'client_company'=> ['nullable', 'string', 'max:255'],
            'machine_id'    => ['nullable', 'exists:machines,id'],
            'machine_name_snapshot' => ['nullable', 'string', 'max:255'],
            'product_id'    => ['nullable', 'exists:products,id'],
            'product_type_snapshot' => ['nullable', 'string', 'max:255'],
            'service_date'  => ['nullable', 'date'],
            'observations'  => ['nullable', 'string', 'max:2000'],
            'photos.*'      => ['nullable', 'image', 'max:4096'],
            'signature'     => ['nullable', 'string'], // base64 PNG
            'client_signed_name' => ['nullable', 'string', 'max:255'],
        ]);

        // Cliente: usa existente o crea uno nuevo a partir de los datos
        $clientId = $data['client_id'] ?? null;
        if (! $clientId && ! empty($data['client_email'])) {
            $client = Client::firstOrCreate(
                ['email' => $data['client_email']],
                [
                    'name'    => $data['client_name'] ?? $data['client_email'],
                    'phone'   => $data['client_phone'] ?? null,
                    'company' => $data['client_company'] ?? null,
                ]
            );
            $clientId = $client->id;
        }

        $machine = $data['machine_id'] ? Machine::find($data['machine_id']) : null;
        $product = $data['product_id'] ? Product::find($data['product_id']) : null;

        $report = Report::create([
            'technician_id' => $request->user()->id,
            'client_id'     => $clientId,
            'machine_id'    => $data['machine_id'] ?? null,
            'product_id'    => $data['product_id'] ?? null,
            'machine_name_snapshot' => $data['machine_name_snapshot'] ?? $machine?->name,
            'product_type_snapshot' => $data['product_type_snapshot'] ?? $product?->product_type,
            'service_date'  => $data['service_date'] ?? now()->toDateString(),
            'observations'  => $data['observations'] ?? null,
            'status'        => Report::STATUS_DRAFT,
        ]);

        // Subir fotos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store("reports/{$report->id}/photos", 'public');
                ReportPhoto::create(['report_id' => $report->id, 'path' => $path]);
            }
        }

        // Procesar firma (base64 → archivo PNG)
        if (! empty($data['signature']) && Str::startsWith($data['signature'], 'data:image')) {
            $this->saveSignature($report, $data['signature'], $data['client_signed_name'] ?? null);

            // Disparar email de segunda aprobación
            if ($report->client?->email) {
                $report->update([
                    'client_approval_token' => Str::random(48),
                    'status' => Report::STATUS_PENDING_CLIENT_APPROVAL,
                    'client_email_sent_at' => now(),
                ]);
                $report->refresh();

                try {
                    Mail::to($report->client->email)->send(new ReportClientApprovalMail($report));
                } catch (\Throwable $e) {
                    report($e); // queda en logs pero no rompe el flujo
                }
            }
        }

        return redirect()->route('technician.reports.show', $report)
            ->with('success', 'Reporte guardado correctamente.');
    }

    public function show(Report $report, Request $request)
    {
        abort_if(! $request->user()->isAdmin() && $report->technician_id !== $request->user()->id, 403);
        $report->load(['client', 'machine', 'product', 'photos', 'supervisor']);
        return view('technician.reports.show', compact('report'));
    }

    /**
     * Endpoint adicional: si el técnico abrió el reporte sin firma, puede capturarla aquí.
     */
    public function storeSignature(Request $request, Report $report)
    {
        abort_if($report->technician_id !== $request->user()->id && ! $request->user()->isAdmin(), 403);

        $data = $request->validate([
            'signature' => ['required', 'string'],
            'client_signed_name' => ['nullable', 'string', 'max:255'],
        ]);

        if (! Str::startsWith($data['signature'], 'data:image')) {
            throw ValidationException::withMessages(['signature' => 'Formato de firma inválido.']);
        }

        $this->saveSignature($report, $data['signature'], $data['client_signed_name'] ?? null);

        if ($report->client?->email) {
            $report->update([
                'client_approval_token' => Str::random(48),
                'status' => Report::STATUS_PENDING_CLIENT_APPROVAL,
                'client_email_sent_at' => now(),
            ]);
            $report->refresh();
            try {
                Mail::to($report->client->email)->send(new ReportClientApprovalMail($report));
            } catch (\Throwable $e) { report($e); }
        }

        return back()->with('success', 'Firma guardada. Se envió copia al cliente para confirmación.');
    }

    private function saveSignature(Report $report, string $base64, ?string $clientName): void
    {
        [, $payload] = explode(',', $base64, 2);
        $binary = base64_decode($payload);
        $path = "reports/{$report->id}/signature_".time().".png";
        Storage::disk('public')->put($path, $binary);

        $report->update([
            'client_signature_path' => $path,
            'client_signed_name' => $clientName,
            'client_signed_at' => now(),
            'status' => Report::STATUS_SIGNED_IN_SITE,
        ]);
    }
}
