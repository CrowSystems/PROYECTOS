@extends('layouts.app')
@section('title', 'Marcas')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Marcas</h1>
    <a href="{{ route('content.brands.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">+ Nueva marca</a>
</div>
<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Logo</th>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Descripción</th>
                <th class="px-4 py-3 text-center">Activa</th>
                <th class="px-4 py-3 text-center">En carrusel</th>
                <th class="px-4 py-3 text-center">Orden</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $b)
            <tr class="border-t">
                <td class="px-4 py-3">
                    @if($b->logo_path)
                        <img src="{{ asset('storage/'.$b->logo_path) }}" class="w-12 h-12 object-contain rounded">
                    @else <span class="text-slate-400">—</span> @endif
                </td>
                <td class="px-4 py-3 font-medium">{{ $b->name }}</td>
                <td class="px-4 py-3 text-slate-600">{{ Str::limit($b->description, 60) }}</td>
                <td class="px-4 py-3 text-center">{!! $b->active ? '<span class="text-emerald-600">●</span> Sí' : '<span class="text-red-500">●</span> No' !!}</td>
                <td class="px-4 py-3 text-center">
                    @if($b->show_in_carousel)
                        <span class="inline-block px-2 py-0.5 text-xs rounded bg-sky-100 text-sky-700 font-semibold">Sí</span>
                    @else
                        <span class="text-slate-400 text-xs">No</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-center text-slate-600">{{ $b->carousel_order }}</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('content.brands.edit', $b) }}" class="text-blue-600 hover:underline">Editar</a>
                    <form action="{{ route('content.brands.destroy', $b) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar?')">
                        @csrf @method('DELETE')
                        <button class="text-red-600 hover:underline ml-2">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $brands->links() }}</div>
@endsection
