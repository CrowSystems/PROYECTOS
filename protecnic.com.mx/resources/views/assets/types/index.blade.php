@extends('layouts.app')
@section('title', 'Tipos de equipo')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Tipos de equipo</h1>
        <p class="text-sm text-slate-500">Catálogo editable: laptop, celular, switch, AP, etc.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('assets.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-800 px-4 py-2 rounded">
            ← Inventario
        </a>
        <a href="{{ route('assets.types.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">
            + Nuevo tipo
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left text-xs uppercase tracking-wider text-slate-600">
            <tr>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Slug</th>
                <th class="px-4 py-3">Equipos</th>
                <th class="px-4 py-3">Activo</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($types as $t)
                <tr class="border-t">
                    <td class="px-4 py-3 font-medium">{{ $t->name }}</td>
                    <td class="px-4 py-3 text-slate-500 text-xs">{{ $t->slug }}</td>
                    <td class="px-4 py-3">{{ $t->assets_count }}</td>
                    <td class="px-4 py-3">
                        @if($t->active)<span class="text-emerald-600">●</span> Activo
                        @else<span class="text-slate-400">●</span> Inactivo
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('assets.types.edit', $t) }}" class="text-blue-600 hover:underline">Editar</a>
                        <form action="{{ route('assets.types.destroy', $t) }}" method="POST" class="inline"
                              onsubmit="return confirm('¿Eliminar este tipo?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-10 text-center text-slate-500">No hay tipos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">{{ $types->links() }}</div>
@endsection
