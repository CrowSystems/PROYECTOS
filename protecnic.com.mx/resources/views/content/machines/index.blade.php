@extends('layouts.app')
@section('title', 'Máquinas')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Máquinas</h1>
    <a href="{{ route('content.machines.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">+ Nueva máquina</a>
</div>
<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Imagen</th>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Marca</th>
                <th class="px-4 py-3">Modelo</th>
                <th class="px-4 py-3">Activa</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($machines as $m)
            <tr class="border-t">
                <td class="px-4 py-3">
                    @if($m->image_path)<img src="{{ asset('storage/'.$m->image_path) }}" class="w-12 h-12 object-cover rounded">@else <span class="text-slate-400">—</span> @endif
                </td>
                <td class="px-4 py-3 font-medium">{{ $m->name }}</td>
                <td class="px-4 py-3">{{ $m->brand?->name ?? '—' }}</td>
                <td class="px-4 py-3">{{ $m->model }}</td>
                <td class="px-4 py-3">{!! $m->active ? '<span class="text-emerald-600">●</span> Sí' : '<span class="text-red-500">●</span> No' !!}</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('content.machines.edit', $m) }}" class="text-blue-600 hover:underline">Editar</a>
                    <form action="{{ route('content.machines.destroy', $m) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline ml-2">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $machines->links() }}</div>
@endsection
