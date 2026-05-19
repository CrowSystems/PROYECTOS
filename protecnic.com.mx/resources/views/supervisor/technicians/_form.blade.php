@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Nombre</label>
        <input type="text" name="name" value="{{ old('name', $technician->name) }}" required class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $technician->email) }}" required class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Teléfono</label>
        <input type="text" name="phone" value="{{ old('phone', $technician->phone) }}" class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">{{ $technician->exists ? 'Nueva contraseña (opcional)' : 'Contraseña' }}</label>
        <input type="password" name="password" {{ $technician->exists ? '' : 'required' }} class="w-full px-3 py-2 border rounded-lg">
    </div>
    @if($technician->exists)
    <div class="flex items-end">
        <label class="flex items-center">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="mr-2" @checked(old('active', $technician->active))>
            Activo
        </label>
    </div>
    @endif
</div>
<div class="mt-6 flex gap-2">
    <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Guardar</button>
    <a href="{{ route('supervisor.technicians.index') }}" class="bg-gray-200 px-4 py-2 rounded">Cancelar</a>
</div>
