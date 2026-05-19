<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aprobación de reporte {{ $report->code }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen p-4">
<div class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl p-6 md:p-8 mt-6">
    <h1 class="text-2xl font-bold text-slate-800">Reporte de servicio {{ $report->code }}</h1>
    <p class="text-slate-500 mb-6">Por favor revisa el contenido y confirma tu aprobación.</p>

    @if(session('info'))
        <div class="mb-4 p-3 bg-blue-100 text-blue-800 rounded text-sm">{{ session('info') }}</div>
    @endif

    <dl class="grid grid-cols-2 gap-3 text-sm mb-6">
        <div><dt class="text-slate-500">Cliente</dt><dd class="font-medium">{{ $report->client?->name }}</dd></div>
        <div><dt class="text-slate-500">Empresa</dt><dd>{{ $report->client?->company ?? '—' }}</dd></div>
        <div><dt class="text-slate-500">Técnico</dt><dd>{{ $report->technician?->name }}</dd></div>
        <div><dt class="text-slate-500">Fecha</dt><dd>{{ optional($report->service_date)->format('d/m/Y') }}</dd></div>
        <div><dt class="text-slate-500">Máquina</dt><dd>{{ $report->machine?->name ?? $report->machine_name_snapshot }}</dd></div>
        <div><dt class="text-slate-500">Tipo de producto</dt><dd>{{ $report->product_type_snapshot ?? $report->product?->product_type }}</dd></div>
    </dl>

    @if($report->observations)
        <h2 class="font-semibold mb-2">Observaciones</h2>
        <p class="bg-slate-50 p-3 rounded mb-6 text-sm">{{ $report->observations }}</p>
    @endif

    @if($report->photos->count())
        <h2 class="font-semibold mb-2">Fotos del trabajo</h2>
        <div class="grid grid-cols-3 gap-2 mb-6">
            @foreach($report->photos as $p)
                <a href="{{ asset('storage/'.$p->path) }}" target="_blank">
                    <img src="{{ asset('storage/'.$p->path) }}" class="w-full h-24 object-cover rounded">
                </a>
            @endforeach
        </div>
    @endif

    @if($report->client_signature_path)
        <h2 class="font-semibold mb-2">Firma capturada en sitio</h2>
        <img src="{{ asset('storage/'.$report->client_signature_path) }}" class="border rounded bg-white max-h-32 mb-2">
        <p class="text-sm text-slate-600">Firmado por <strong>{{ $report->client_signed_name }}</strong> el {{ optional($report->client_signed_at)->format('d/m/Y H:i') }}</p>
    @endif

    <div class="mt-8 pt-6 border-t">
        @if($report->client_approved_at)
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded">
                <p class="font-semibold">✓ Ya confirmaste este reporte</p>
                <p class="text-sm">El {{ $report->client_approved_at->format('d/m/Y H:i') }}</p>
            </div>
        @else
            <p class="text-slate-700 mb-3">Si todo es correcto, confirma tu aprobación:</p>
            <form method="POST" action="{{ route('client.approval.approve', $report->client_approval_token) }}">
                @csrf
                <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-3 rounded-lg font-medium">
                    ✓ Confirmo y apruebo este reporte
                </button>
            </form>
        @endif
    </div>
</div>
</body>
</html>
