@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium mb-1">Nombre</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Teléfono</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Rol</label>
        <select name="role" required class="w-full px-3 py-2 border rounded-lg">
            @foreach($roles as $value => $label)
                <option value="{{ $value }}" @selected(old('role', $user->role) === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">
            {{ $user->exists ? 'Nueva contraseña (dejar vacío para no cambiar)' : 'Contraseña' }}
        </label>
        <input type="password" name="password" {{ $user->exists ? '' : 'required' }}
               class="w-full px-3 py-2 border rounded-lg">
    </div>
    <div class="flex items-end">
        <label class="flex items-center">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="mr-2" @checked(old('active', $user->active ?? 1))>
            Usuario activo
        </label>
    </div>
</div>
<div class="mt-6 flex gap-2">
    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">Guardar</button>
    <a href="{{ route('admin.users.index') }}" class="bg-gray-200 px-4 py-2 rounded">Cancelar</a>
</div>
