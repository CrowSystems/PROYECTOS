@extends('layouts.app')
@section('title', 'Nuevo reporte')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold">Nuevo reporte de servicio</h1>
    <p class="text-slate-500">Llena los datos, sube fotos y pide al cliente que firme con el dedo en la pantalla.</p>
</div>

<form method="POST" action="{{ route('technician.reports.store') }}" enctype="multipart/form-data" id="reportForm" class="space-y-6">
    @csrf

    {{-- Cliente --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4">Datos del cliente</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Cliente existente</label>
                <select name="client_id" id="clientSelect" class="w-full px-3 py-2 border rounded-lg">
                    <option value="">— Nuevo cliente (llenar abajo) —</option>
                    @foreach($clients as $c)
                        <option value="{{ $c->id }}"
                            data-name="{{ $c->name }}" data-email="{{ $c->email }}"
                            data-phone="{{ $c->phone }}" data-company="{{ $c->company }}">
                            {{ $c->name }} — {{ $c->email }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nombre del cliente</label>
                <input type="text" name="client_name" id="clientName" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email <span class="text-red-500">*</span></label>
                <input type="email" name="client_email" id="clientEmail" class="w-full px-3 py-2 border rounded-lg" placeholder="Para enviar copia y solicitar 2da aprobación">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Teléfono</label>
                <input type="text" name="client_phone" id="clientPhone" class="w-full px-3 py-2 border rounded-lg">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-1">Empresa</label>
                <input type="text" name="client_company" id="clientCompany" class="w-full px-3 py-2 border rounded-lg">
            </div>
        </div>
    </div>

    {{-- Servicio --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4">Datos del servicio</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Máquina</label>
                <select name="machine_id" class="w-full px-3 py-2 border rounded-lg">
                    <option value="">— sin máquina del catálogo —</option>
                    @foreach($machines as $m)
                        <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->brand?->name }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Nombre de máquina (texto libre)</label>
                <input type="text" name="machine_name_snapshot" class="w-full px-3 py-2 border rounded-lg" placeholder="Si no está en el catálogo">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Producto utilizado</label>
                <select name="product_id" class="w-full px-3 py-2 border rounded-lg">
                    <option value="">— sin producto —</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}" data-type="{{ $p->product_type }}">{{ $p->name }} ({{ $p->product_type }})</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Tipo de producto</label>
                <input type="text" name="product_type_snapshot" id="productType" class="w-full px-3 py-2 border rounded-lg" placeholder="Refacción / Consumible / etc.">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Fecha del servicio</label>
                <input type="date" name="service_date" value="{{ now()->toDateString() }}" class="w-full px-3 py-2 border rounded-lg">
            </div>
        </div>
        <div class="mt-4">
            <label class="block text-sm font-medium mb-1">Observaciones</label>
            <textarea name="observations" rows="4" class="w-full px-3 py-2 border rounded-lg" placeholder="Detalle del trabajo realizado, hallazgos, recomendaciones..."></textarea>
        </div>
    </div>

    {{-- Fotos --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg mb-4">Fotos del trabajo</h2>
        <p class="text-sm text-slate-500 mb-2">Puedes adjuntar varias fotos como evidencia.</p>
        <input type="file" name="photos[]" multiple accept="image/*" class="w-full">
    </div>

    {{-- Firma --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="font-semibold text-lg mb-2">Firma del cliente</h2>
        <p class="text-sm text-slate-500 mb-3">
            Pasa el dispositivo al cliente y pídele que firme con el dedo (o el mouse).
            Al guardar el reporte se enviará automáticamente una copia a su correo para la segunda confirmación.
        </p>

        <div>
            <label class="block text-sm font-medium mb-1">Nombre de quien firma</label>
            <input type="text" name="client_signed_name" class="w-full md:w-1/2 px-3 py-2 border rounded-lg" placeholder="Nombre completo">
        </div>

        <div class="mt-4">
            <div class="border-2 border-dashed border-slate-300 rounded-lg bg-slate-50">
                <canvas id="signaturePad" class="w-full" style="height:220px; touch-action:none; cursor:crosshair;"></canvas>
            </div>
            <div class="mt-2 flex gap-2">
                <button type="button" id="clearSignature" class="px-3 py-1.5 bg-gray-200 hover:bg-gray-300 rounded text-sm">Limpiar</button>
                <span id="signatureStatus" class="text-sm text-slate-500 self-center"></span>
            </div>
            <input type="hidden" name="signature" id="signatureData">
        </div>
    </div>

    <div class="flex gap-2">
        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded font-medium">
            Guardar reporte y enviar al cliente
        </button>
        <a href="{{ route('technician.reports.index') }}" class="bg-gray-200 px-6 py-3 rounded">Cancelar</a>
    </div>
</form>

<script>
// ---- Cliente: autocompletar al elegir uno existente ----
const clientSelect = document.getElementById('clientSelect');
const fields = ['Name', 'Email', 'Phone', 'Company'];
clientSelect.addEventListener('change', function () {
    const opt = this.options[this.selectedIndex];
    fields.forEach(f => {
        const el = document.getElementById('client' + f);
        if (el) el.value = opt.dataset[f.toLowerCase()] || '';
    });
});

// ---- Producto: autocompletar tipo de producto al elegir ----
document.querySelector('select[name="product_id"]').addEventListener('change', function () {
    const t = this.options[this.selectedIndex].dataset.type;
    if (t) document.getElementById('productType').value = t;
});

// ---- Canvas de firma digital ----
(function () {
    const canvas = document.getElementById('signaturePad');
    const ctx = canvas.getContext('2d');
    const status = document.getElementById('signatureStatus');
    const hiddenInput = document.getElementById('signatureData');
    let drawing = false, hasInk = false;

    function resize() {
        const ratio = window.devicePixelRatio || 1;
        const rect = canvas.getBoundingClientRect();
        const data = canvas.toDataURL();
        canvas.width = rect.width * ratio;
        canvas.height = rect.height * ratio;
        ctx.scale(ratio, ratio);
        ctx.fillStyle = '#fff';
        ctx.fillRect(0, 0, rect.width, rect.height);
        ctx.lineWidth = 2.2;
        ctx.lineCap = 'round';
        ctx.strokeStyle = '#0f172a';
        // re-pintar si había firma
        if (hasInk) {
            const img = new Image();
            img.onload = () => ctx.drawImage(img, 0, 0, rect.width, rect.height);
            img.src = data;
        }
    }
    window.addEventListener('resize', resize);
    resize();

    function pos(e) {
        const rect = canvas.getBoundingClientRect();
        const t = e.touches ? e.touches[0] : e;
        return { x: t.clientX - rect.left, y: t.clientY - rect.top };
    }

    function start(e) {
        e.preventDefault();
        drawing = true;
        const p = pos(e);
        ctx.beginPath();
        ctx.moveTo(p.x, p.y);
    }
    function move(e) {
        if (!drawing) return;
        e.preventDefault();
        const p = pos(e);
        ctx.lineTo(p.x, p.y);
        ctx.stroke();
        hasInk = true;
        status.textContent = '✓ Firma capturada';
        status.className = 'text-sm text-emerald-700 self-center';
    }
    function end() { drawing = false; }

    canvas.addEventListener('mousedown', start);
    canvas.addEventListener('mousemove', move);
    canvas.addEventListener('mouseup', end);
    canvas.addEventListener('mouseleave', end);
    canvas.addEventListener('touchstart', start);
    canvas.addEventListener('touchmove', move);
    canvas.addEventListener('touchend', end);

    document.getElementById('clearSignature').addEventListener('click', function () {
        const rect = canvas.getBoundingClientRect();
        ctx.fillStyle = '#fff';
        ctx.fillRect(0, 0, rect.width, rect.height);
        hasInk = false;
        status.textContent = '';
        hiddenInput.value = '';
    });

    document.getElementById('reportForm').addEventListener('submit', function () {
        if (hasInk) hiddenInput.value = canvas.toDataURL('image/png');
    });
})();
</script>
@endsection
