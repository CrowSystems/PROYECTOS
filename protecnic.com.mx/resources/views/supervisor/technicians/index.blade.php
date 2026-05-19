@extends('layouts.app')
@section('title', 'Técnicos')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Técnicos generadores de reportes</h1>
    <a href="{{ route('supervisor.technicians.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">+ Nuevo técnico</a>
</div>
<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Nombre</th>
                <th class="px-4 py-3">Email</th>
                <th class="px-4 py-3">Tel.</th>
                <th class="px-4 py-3">Reportes</th>
                <th class="px-4 py-3">Activo</th>
                <th class="px-4 py-3 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($technicians as $t)
        <tr class="border-t">
            <td class="px-4 py-3 font-medium">{{ $t->name }}</td>
            <td class="px-4 py-3">{{ $t->email }}</td>
            <td class="px-4 py-3">{{ $t->phone }}</td>
            <td class="px-4 py-3">{{ $t->reports_count }}</td>
            <td class="px-4 py-3">{!! $t->active ? '<span class="text-emerald-600">●</span> Sí' : '<span class="text-red-500">●</span> No' !!}</td>
            <td class="px-4 py-3 text-right">
                <a href="{{ route('supervisor.technicians.edit', $t) }}" class="text-blue-600 hover:underline">Editar</a>
                <form action="{{ route('supervisor.technicians.destroy', $t) }}" method="POST" class="inline" onsubmit="return confirm('¿Desactivar?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600 hover:underline ml-2">Desactivar</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $technicians->links() }}</div>
@endsection
