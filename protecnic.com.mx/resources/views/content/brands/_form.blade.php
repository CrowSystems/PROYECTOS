@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Nombre</label>
        <input type="text" name="name" value="{{ old('name', $brand->name) }}" required class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Logo</label>
        <input type="file" name="logo" accept="image/*" class="w-full">
        @if($brand->logo_path)
            <img src="{{ asset('storage/'.$brand->logo_path) }}" class="mt-2 h-16">
        @endif
    </div>
    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Descripción</label>
        <textarea name="description" rows="3" class="w-full px-3 py-2 border rounded-lg">{{ old('description', $brand->description) }}</textarea>
    </div>
    <div>
        <label class="flex items-center">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="mr-2" @checked(old('active', $brand->active ?? 1))>
            Marca activa
        </label>
    </div>
</div>
<div class="mt-6 flex gap-2">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Guardar</button>
    <a href="{{ route('content.brands.index') }}" class="bg-gray-200 px-4 py-2 rounded">Cancelar</a>
</div>
