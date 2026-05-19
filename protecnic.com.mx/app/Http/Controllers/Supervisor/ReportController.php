<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $query = Report::with(['technician', 'client', 'machine', 'product', 'photos'])
            ->latest();

        if ($status && array_key_exists($status, Report::STATUS_LABELS)) {
            $query->where('status', $status);
        }

        $reports = $query->paginate(15)->withQueryString();
        return view('supervisor.reports.index', compact('reports', 'status'));
    }

    public function show(Report $report)
    {
        $report->load(['technician', 'client', 'machine', 'product', 'photos', 'supervisor']);
        return view('supervisor.reports.show', compact('report'));
    }

    public function approve(Request $request, Report $report)
    {
        $request->validate(['supervisor_notes' => ['nullable', 'string', 'max:1000']]);

        $report->update([
            'status' => Report::STATUS_SUPERVISOR_APPROVED,
            'supervisor_id' => $request->user()->id,
            'supervisor_reviewed_at' => now(),
            'supervisor_notes' => $request->input('supervisor_notes'),
        ]);

        return redirect()->route('supervisor.reports.index')->with('success', 'Reporte aprobado.');
    }

    public function reject(Request $request, Report $report)
    {
        $request->validate(['supervisor_notes' => ['required', 'string', 'max:1000']]);

        $report->update([
            'status' => Report::STATUS_REJECTED,
            'supervisor_id' => $request->user()->id,
            'supervisor_reviewed_at' => now(),
            'supervisor_notes' => $request->input('supervisor_notes'),
        ]);

        return redirect()->route('supervisor.reports.index')->with('success', 'Reporte rechazado.');
    }
}
