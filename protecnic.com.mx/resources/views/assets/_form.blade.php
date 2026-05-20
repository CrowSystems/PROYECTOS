@csrf
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    {{-- Identificación --}}
    <div>
        <label class="block text-sm font-medium mb-1">Código / Nombre del equipo *</label>
        <input type="text" name="code" value="{{ old('code', $asset->code) }}" required
               placeholder="PROTECNIC-1"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Tipo *</label>
        <select name="asset_type_id" required class="w-full px-3 py-2 border rounded-lg">
            <option value="">Selecciona…</option>
            @foreach($types as $t)
                <option value="{{ $t->id }}" @selected(old('asset_type_id', $asset->asset_type_id) == $t->id)>
                    {{ $t->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Estatus *</label>
        <select name="status" required class="w-full px-3 py-2 border rounded-lg">
            @foreach($statuses as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $asset->status ?? 'available') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Marca</label>
        <input type="text" name="brand" value="{{ old('brand', $asset->brand) }}"
               placeholder="LENOVO"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Modelo</label>
        <input type="text" name="model" value="{{ old('model', $asset->model) }}"
               placeholder="THINKPAD"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Costo</label>
        <input type="number" step="0.01" min="0" name="cost" value="{{ old('cost', $asset->cost) }}"
               class="w-full px-3 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">N.º de serie</label>
        <input type="text" name="serial_number" value="{{ old('serial_number', $asset->serial_number) }}"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Service Tag</label>
        <input type="text" name="service_tag" value="{{ old('service_tag', $asset->service_tag) }}"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Ubicación</label>
        <input type="text" name="location" value="{{ old('location', $asset->location) }}"
               placeholder="Oficina Querétaro, piso 2"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
</div>

<h3 class="font-semibold text-slate-700 mt-6 mb-3">Especificaciones técnicas</h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Procesador</label>
        <input type="text" name="processor" value="{{ old('processor', $asset->processor) }}"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">RAM</label>
        <input type="text" name="ram" value="{{ old('ram', $asset->ram) }}"
               placeholder="16 GB DDR4"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Disco duro</label>
        <input type="text" name="disk" value="{{ old('disk', $asset->disk) }}"
               placeholder="512 GB SSD"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sistema operativo</label>
        <input type="text" name="operating_system" value="{{ old('operating_system', $asset->operating_system) }}"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">MAC Ethernet</label>
        <input type="text" name="mac_ethernet" value="{{ old('mac_ethernet', $asset->mac_ethernet) }}"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">MAC Wi-Fi</label>
        <input type="text" name="mac_wifi" value="{{ old('mac_wifi', $asset->mac_wifi) }}"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
</div>

<h3 class="font-semibold text-slate-700 mt-6 mb-3">Fechas</h3>
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Fecha de registro</label>
        <input type="date" name="registered_at"
               value="{{ old('registered_at', optional($asset->registered_at)->format('Y-m-d')) }}"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Último mantenimiento</label>
        <input type="date" name="last_maintenance_at"
               value="{{ old('last_maintenance_at', optional($asset->last_maintenance_at)->format('Y-m-d')) }}"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
</div>

<div class="mt-4">
    <label class="block text-sm font-medium mb-1">Notas / observaciones</label>
    <textarea name="notes" rows="3" class="w-full px-3 py-2 border rounded-lg">{{ old('notes', $asset->notes) }}</textarea>
</div>

<div class="mt-6 flex gap-2">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Guardar</button>
    <a href="{{ route('assets.index') }}" class="bg-gray-200 px-4 py-2 rounded">Cancelar</a>
</div>
