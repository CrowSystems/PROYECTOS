@extends('layouts.app')
@section('title', 'Reporte '.$report->code)

@section('content')
<div class="flex justify-between items-start mb-6">
    <div>
        <h1 class="text-2xl font-bold">Reporte {{ $report->code }}</h1>
        <p class="text-slate-500">Generado por {{ $report->technician?->name }} · {{ $report->created_at->format('d/m/Y H:i') }}</p>
    </div>
    <span class="px-3 py-1 rounded {{ $report->statusColor() }}">{{ $report->statusLabel() }}</span>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-semibold text-slate-800 mb-3">Datos del servicio</h2>
            <dl class="grid grid-cols-2 gap-3 text-sm">
                <div><dt class="text-slate-500">Cliente</dt><dd class="font-medium">{{ $report->client?->name ?? '—' }}</dd></div>
                <div><dt class="text-slate-500">Empresa</dt><dd>{{ $report->client?->company ?? '—' }}</dd></div>
                <div><dt class="text-slate-500">Email</dt><dd>{{ $report->client?->email ?? '—' }}</dd></div>
                <div><dt class="text-slate-500">Fecha de servicio</dt><dd>{{ optional($report->service_date)->format('d/m/Y') ?? '—' }}</dd></div>
                <div><dt class="text-slate-500">Máquina</dt><dd>{{ $report->machine?->name ?? $report->machine_name_snapshot }}</dd></div>
                <div><dt class="text-slate-500">Tipo de producto</dt><dd>{{ $report->product?->product_type ?? $report->product_type_snapshot }}</dd></div>
                <div><dt class="text-slate-500">Producto</dt><dd>{{ $report->product?->name ?? '—' }}</dd></div>
            </dl>
            @if($report->observations)
                <div class="mt-4">
                    <dt class="text-slate-500 text-sm mb-1">Observaciones</dt>
                    <dd class="bg-slate-50 p-3 rounded">{{ $report->observations }}</dd>
                </div>
            @endif
        </div>

        @if($report->photos->count())
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-semibold text-slate-800 mb-3">Fotos del trabajo</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($report->photos as $photo)
                    <div>
                        <a href="{{ asset('storage/'.$photo->path) }}" target="_blank">
                            <img src="{{ asset('storage/'.$photo->path) }}" class="w-full h-32 object-cover rounded">
                        </a>
                        @if($photo->caption)<p class="text-xs text-slate-500 mt-1">{{ $photo->caption }}</p>@endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-semibold text-slate-800 mb-3">Firma del cliente</h2>
            @if($report->client_signature_path)
                <img src="{{ asset('storage/'.$report->client_signature_path) }}" class="border rounded bg-white max-h-40">
                <p class="text-sm text-slate-500 mt-2">
                    Firmado por <strong>{{ $report->client_signed_name }}</strong>
                    el {{ optional($report->client_signed_at)->format('d/m/Y H:i') }}
                </p>
                @if($report->client_approved_at)
                    <p class="text-sm text-emerald-700 mt-1">
                        ✓ Cliente confirmó por correo el {{ $report->client_approved_at->format('d/m/Y H:i') }}
                    </p>
                @elseif($report->client_email_sent_at)
                    <p class="text-sm text-yellow-700 mt-1">
                        ⏳ Correo enviado el {{ $report->client_email_sent_at->format('d/m/Y H:i') }} — pendiente segunda confirmación
                    </p>
                @endif
            @else
                <p class="text-slate-500">Aún sin firma.</p>
            @endif
        </div>
    </div>

    <div class="space-y-4">
        @if(in_array($report->status, [
            \App\Models\Report::STATUS_SIGNED_IN_SITE,
            \App\Models\Report::STATUS_PENDING_CLIENT_APPROVAL,
            \App\Models\Report::STATUS_CLIENT_APPROVED,
        ]))
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-semibold text-slate-800 mb-3">Validar reporte</h2>
            <form method="POST" action="{{ route('supervisor.reports.approve', $report) }}" class="space-y-3">
                @csrf
                <textarea name="supervisor_notes" rows="3" placeholder="Notas (opcional)" class="w-full border rounded p-2"></textarea>
                <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2 rounded">Aprobar</button>
            </form>
            <form method="POST" action="{{ route('supervisor.reports.reject', $report) }}" class="space-y-3 mt-3" onsubmit="return confirm('¿Rechazar reporte?')">
                @csrf
                <textarea name="supervisor_notes" rows="2" required placeholder="Motivo de rechazo (requerido)" class="w-full border rounded p-2"></textarea>
                <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded">Rechazar</button>
            </form>
        </div>
        @endif

        @if($report->supervisor_reviewed_at)
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-semibold text-slate-800 mb-3">Resolución</h2>
            <p class="text-sm">Por <strong>{{ $report->supervisor?->name }}</strong></p>
            <p class="text-sm text-slate-500">{{ $report->supervisor_reviewed_at->format('d/m/Y H:i') }}</p>
            @if($report->supervisor_notes)
                <p class="mt-2 bg-slate-50 p-3 rounded text-sm">{{ $report->supervisor_notes }}</p>
            @endif
        </div>
        @endif

        <a href="{{ route('supervisor.reports.index') }}" class="block text-center bg-gray-200 px-4 py-2 rounded">← Volver</a>
    </div>
</div>
@endsection
