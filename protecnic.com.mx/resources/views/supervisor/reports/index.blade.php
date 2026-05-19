@extends('layouts.app')
@section('title', 'Reportes a validar')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold">Reportes a validar</h1>
    <p class="text-slate-500">Revisa, aprueba o rechaza los reportes generados por los técnicos.</p>
</div>

<div class="mb-4 flex flex-wrap gap-2">
    <a href="{{ route('supervisor.reports.index') }}" class="px-3 py-1.5 rounded {{ !$status ? 'bg-slate-800 text-white' : 'bg-white border' }}">Todos</a>
    @foreach(\App\Models\Report::STATUS_LABELS as $val => $label)
        <a href="{{ route('supervisor.reports.index', ['status' => $val]) }}"
           class="px-3 py-1.5 rounded {{ $status === $val ? 'bg-slate-800 text-white' : 'bg-white border' }}">
            {{ $label }}
        </a>
    @endforeach
</div>

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Código</th>
                <th class="px-4 py-3">Técnico</th>
                <th class="px-4 py-3">Cliente</th>
                <th class="px-4 py-3">Máquina</th>
                <th class="px-4 py-3">Fecha</th>
                <th class="px-4 py-3">Estado</th>
                <th class="px-4 py-3 text-right">Acción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reports as $r)
            <tr class="border-t">
                <td class="px-4 py-3 font-mono text-xs">{{ $r->code }}</td>
                <td class="px-4 py-3">{{ $r->technician?->name }}</td>
                <td class="px-4 py-3">{{ $r->client?->name ?? '—' }}</td>
                <td class="px-4 py-3">{{ $r->machine?->name ?? $r->machine_name_snapshot }}</td>
                <td class="px-4 py-3 text-slate-600">{{ optional($r->service_date)->format('d/m/Y') ?? $r->created_at->format('d/m/Y') }}</td>
                <td class="px-4 py-3"><span class="text-xs px-2 py-1 rounded {{ $r->statusColor() }}">{{ $r->statusLabel() }}</span></td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('supervisor.reports.show', $r) }}" class="text-blue-600 hover:underline">Ver</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-4 py-8 text-center text-slate-500">No hay reportes.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $reports->links() }}</div>
@endsection
