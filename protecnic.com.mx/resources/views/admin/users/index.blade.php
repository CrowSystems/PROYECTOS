@extends('layouts.app')
@section('title', 'Usuarios')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Usuarios</h1>
    <a href="{{ route('admin.users.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">+ Nuevo usuario</a>
</div>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Rol</th>
                <th class="px-4 py-3">Activo</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
                <tr class="border-t">
                    <td class="px-4 py-3 font-medium">{{ $u->name }}</td>
                    <td class="px-4 py-3 text-slate-600">{{ $u->email }}</td>
                    <td class="px-4 py-3"><span class="px-2 py-1 rounded text-xs bg-slate-100">{{ $u->roleLabel() }}</span></td>
                    <td class="px-4 py-3">
                        @if($u->active)<span class="text-emerald-600">●</span> Activo
                        @else<span class="text-red-500">●</span> Inactivo
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.users.edit', $u) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar usuario?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $users->links() }}</div>
@endsection
