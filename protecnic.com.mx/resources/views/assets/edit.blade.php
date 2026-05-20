@extends('layouts.app')
@section('title', 'Editar equipo')

@section('content')
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('assets.index') }}" class="text-slate-500 hover:text-slate-700">&larr; Volver</a>
    <h1 class="text-2xl font-bold text-slate-800">Editar equipo {{ $asset->code }}</h1>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <form action="{{ route('assets.update', $asset) }}" method="POST">
        @method('PUT')
        @include('assets._form')
    </form>
</div>

@if($asset->assignments->count())
<div class="bg-white rounded-xl shadow p-6 mt-6">
    <h2 class="text-lg font-bold text-slate-800 mb-3">Historial de asignaciones</h2>
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left text-xs uppercase tracking-wider text-slate-600">
            <tr>
                <th class="px-3 py-2">Colaborador</th>
                <th class="px-3 py-2">Asignado</th>
                <th class="px-3 py-2">Liberado</th>
                <th class="px-3 py-2">Notas</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asset->assignments as $h)
                <tr class="border-t">
                    <td class="px-3 py-2">{{ $h->user->name }}</td>
                    <td class="px-3 py-2 text-slate-600">{{ $h->assigned_at?->format('d/m/Y H:i') }}</td>
                    <td class="px-3 py-2 text-slate-600">
                        {{ $h->released_at ? $h->released_at->format('d/m/Y H:i') : '— vigente —' }}
                    </td>
                    <td class="px-3 py-2 text-slate-600">
                        {{ $h->assignment_notes }}
                        @if($h->release_notes)<div class="text-xs text-slate-500">Baja: {{ $h->release_notes }}</div>@endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
