@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Nombre *</label>
        <input type="text" name="name" value="{{ old('name', $type->name) }}" required
               placeholder="Laptop, Celular, Switch..."
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Ícono (clase CSS opcional)</label>
        <input type="text" name="icon" value="{{ old('icon', $type->icon) }}"
               placeholder="ti-device-laptop"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Descripción</label>
        <textarea name="description" rows="2" class="w-full px-3 py-2 border rounded-lg">{{ old('description', $type->description) }}</textarea>
    </div>
    <div class="flex items-center">
        <label class="flex items-center">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="mr-2" @checked(old('active', $type->active ?? 1))>
            Tipo activo (visible al crear equipos)
        </label>
    </div>
</div>
<div class="mt-6 flex gap-2">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Guardar</button>
    <a href="{{ route('assets.types.index') }}" class="bg-gray-200 px-4 py-2 rounded">Cancelar</a>
</div>
