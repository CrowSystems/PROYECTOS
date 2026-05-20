@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Nombre *</label>
        <input type="text" name="name" value="{{ old('name', $brand->name) }}" required
               class="w-full px-3 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Logo</label>
        <input type="file" name="logo" accept="image/jpeg,image/png,image/gif,image/svg+xml,image/webp"
               class="w-full text-sm">
        <p class="text-xs text-slate-500 mt-1">JPG, PNG, GIF, SVG o WebP. Máximo 5 MB.</p>
        @if($brand->hasLogo())
            <img src="{{ $brand->logoUrl() }}" class="mt-2 h-16 border rounded p-1 bg-white">
        @endif
    </div>

    <div class="md:col-span-2">
        <label class="block text-sm font-medium mb-1">Descripción</label>
        <textarea name="description" rows="3" class="w-full px-3 py-2 border rounded-lg">{{ old('description', $brand->description) }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Sitio web (opcional)</label>
        <input type="url" name="website_url" value="{{ old('website_url', $brand->website_url) }}"
               placeholder="https://..."
               class="w-full px-3 py-2 border rounded-lg">
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Orden en el carrusel</label>
        <input type="number" name="carousel_order" min="0" max="9999"
               value="{{ old('carousel_order', $brand->carousel_order ?? 0) }}"
               class="w-full px-3 py-2 border rounded-lg">
        <p class="text-xs text-slate-500 mt-1">Las marcas con número menor aparecen primero.</p>
    </div>

    <div>
        <label class="flex items-center">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="mr-2" @checked(old('active', $brand->active ?? 1))>
            Marca activa
        </label>
    </div>

    <div>
        <label class="flex items-center">
            <input type="hidden" name="show_in_carousel" value="0">
            <input type="checkbox" name="show_in_carousel" value="1" class="mr-2"
                   @checked(old('show_in_carousel', $brand->show_in_carousel ?? false))>
            Mostrar en el carrusel de la home
        </label>
    </div>
</div>

<div class="mt-6 flex gap-2">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Guardar</button>
    <a href="{{ route('content.brands.index') }}" class="bg-gray-200 px-4 py-2 rounded">Cancelar</a>
</div>
