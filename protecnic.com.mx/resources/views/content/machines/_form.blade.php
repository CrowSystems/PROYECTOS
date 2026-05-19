@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Nombre</label>
        <input type="text" name="name" value="{{ old('name', $machine->name) }}" required class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Marca</label>
        <select name="brand_id" class="w-full px-3 py-2 border rounded-lg">
            <option value="">— sin marca —</option>
            @foreach($brands as $b)
                <option value="{{ $b->id }}" @selected(old('brand_id', $machine->brand_id) == $b->id)>{{ $b->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Modelo</label>
        <input type="text" name="model" value="{{ old('model', $machine->model) }}" class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Serie</label>
        <input type="text" name="serial" value="{{ old('serial', $machine->serial) }}" class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Descripción</label>
        <textarea name="description" rows="3" class="w-full px-3 py-2 border rounded-lg">{{ old('description', $machine->description) }}</textarea>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Imagen</label>
        <input type="file" name="image" accept="image/*">
        @if($machine->image_path)<img src="{{ asset('storage/'.$machine->image_path) }}" class="mt-2 h-20">@endif
    </div>
    <div class="flex items-end">
        <label class="flex items-center">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="mr-2" @checked(old('active', $machine->active ?? 1))>
            Activa
        </label>
    </div>
</div>
<div class="mt-6 flex gap-2">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Guardar</button>
    <a href="{{ route('content.machines.index') }}" class="bg-gray-200 px-4 py-2 rounded">Cancelar</a>
</div>
