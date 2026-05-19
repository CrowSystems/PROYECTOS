@extends('layouts.app')
@section('title', 'Reporte '.$report->code)

@section('content')
<div class="flex justify-between items-start mb-6">
    <div>
        <h1 class="text-2xl font-bold">Reporte {{ $report->code }}</h1>
        <p class="text-slate-500">{{ $report->created_at->format('d/m/Y H:i') }}</p>
    </div>
    <span class="px-3 py-1 rounded {{ $report->statusColor() }}">{{ $report->statusLabel() }}</span>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-semibold text-slate-800 mb-3">Servicio</h2>
            <dl class="grid grid-cols-2 gap-3 text-sm">
                <div><dt class="text-slate-500">Cliente</dt><dd class="font-medium">{{ $report->client?->name ?? '—' }}</dd></div>
                <div><dt class="text-slate-500">Empresa</dt><dd>{{ $report->client?->company ?? '—' }}</dd></div>
                <div><dt class="text-slate-500">Email</dt><dd>{{ $report->client?->email ?? '—' }}</dd></div>
                <div><dt class="text-slate-500">Máquina</dt><dd>{{ $report->machine?->name ?? $report->machine_name_snapshot }}</dd></div>
                <div><dt class="text-slate-500">Tipo de producto</dt><dd>{{ $report->product_type_snapshot ?? $report->product?->product_type }}</dd></div>
                <div><dt class="text-slate-500">Fecha</dt><dd>{{ optional($report->service_date)->format('d/m/Y') }}</dd></div>
            </dl>
            @if($report->observations)
                <div class="mt-4">
                    <dt class="text-slate-500 text-sm mb-1">Observaciones</dt>
                    <dd class="bg-slate-50 p-3 rounded text-sm">{{ $report->observations }}</dd>
                </div>
            @endif
        </div>

        @if($report->photos->count())
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-semibold text-slate-800 mb-3">Fotos</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @foreach($report->photos as $photo)
                    <a href="{{ asset('storage/'.$photo->path) }}" target="_blank">
                        <img src="{{ asset('storage/'.$photo->path) }}" class="w-full h-32 object-cover rounded">
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <div class="space-y-4">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-semibold text-slate-800 mb-3">Firma</h2>
            @if($report->client_signature_path)
                <img src="{{ asset('storage/'.$report->client_signature_path) }}" class="border rounded bg-white max-h-32">
                <p class="text-sm mt-2"><strong>{{ $report->client_signed_name }}</strong></p>
                <p class="text-xs text-slate-500">{{ optional($report->client_signed_at)->format('d/m/Y H:i') }}</p>

                @if($report->client_approved_at)
                    <p class="mt-3 text-sm text-emerald-700">✓ Aprobado por email el {{ $report->client_approved_at->format('d/m/Y H:i') }}</p>
                @elseif($report->client_email_sent_at)
                    <p class="mt-3 text-sm text-yellow-700">⏳ Email enviado — pendiente confirmación del cliente</p>
                @endif
            @else
                <p class="text-sm text-slate-500 mb-3">Aún sin firma. Captúrala ahora:</p>
                <form method="POST" action="{{ route('technician.reports.signature', $report) }}" id="sigForm">
                    @csrf
                    <input type="text" name="client_signed_name" placeholder="Nombre del firmante" class="w-full px-3 py-2 border rounded mb-2">
                    <div class="border-2 border-dashed rounded bg-slate-50">
                        <canvas id="pad" class="w-full" style="height:160px; touch-action:none;"></canvas>
                    </div>
                    <input type="hidden" name="signature" id="sigData">
                    <div class="mt-2 flex gap-2">
                        <button type="button" id="clearPad" class="text-xs px-2 py-1 bg-gray-200 rounded">Limpiar</button>
                        <button type="submit" class="text-sm px-3 py-1 bg-emerald-600 text-white rounded ml-auto">Guardar firma</button>
                    </div>
                </form>
                <script>
                (function(){
                    const c = document.getElementById('pad'), x = c.getContext('2d');
                    let draw=false, hasInk=false;
                    const resize=()=>{const r=window.devicePixelRatio||1, b=c.getBoundingClientRect();
                        c.width=b.width*r; c.height=b.height*r; x.scale(r,r);
                        x.fillStyle='#fff'; x.fillRect(0,0,b.width,b.height);
                        x.lineWidth=2.2; x.lineCap='round'; x.strokeStyle='#0f172a';};
                    window.addEventListener('resize',resize); resize();
                    const pos=e=>{const b=c.getBoundingClientRect(),t=e.touches?e.touches[0]:e;return{x:t.clientX-b.left,y:t.clientY-b.top}};
                    c.addEventListener('mousedown',e=>{e.preventDefault();draw=true;const p=pos(e);x.beginPath();x.moveTo(p.x,p.y);});
                    c.addEventListener('mousemove',e=>{if(!draw)return;const p=pos(e);x.lineTo(p.x,p.y);x.stroke();hasInk=true;});
                    c.addEventListener('mouseup',()=>draw=false); c.addEventListener('mouseleave',()=>draw=false);
                    c.addEventListener('touchstart',e=>{e.preventDefault();draw=true;const p=pos(e);x.beginPath();x.moveTo(p.x,p.y);});
                    c.addEventListener('touchmove',e=>{e.preventDefault();if(!draw)return;const p=pos(e);x.lineTo(p.x,p.y);x.stroke();hasInk=true;});
                    c.addEventListener('touchend',()=>draw=false);
                    document.getElementById('clearPad').onclick=()=>{const b=c.getBoundingClientRect();x.fillStyle='#fff';x.fillRect(0,0,b.width,b.height);hasInk=false;document.getElementById('sigData').value='';};
                    document.getElementById('sigForm').onsubmit=function(e){if(!hasInk){e.preventDefault();alert('Firma requerida');return false;}document.getElementById('sigData').value=c.toDataURL('image/png');};
                })();
                </script>
            @endif
        </div>

        <a href="{{ route('technician.reports.index') }}" class="block text-center bg-gray-200 px-4 py-2 rounded">← Volver</a>
    </div>
</div>
@endsection
