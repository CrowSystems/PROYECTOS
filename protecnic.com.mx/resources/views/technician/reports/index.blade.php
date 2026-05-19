@extends('layouts.app')
@section('title', 'Mis reportes')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Mis reportes</h1>
    <a href="{{ route('technician.reports.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded">+ Nuevo reporte</a>
</div>
<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-slate-100 text-left">
            <tr>
                <th class="px-4 py-3">Código</th>
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
            <td class="px-4 py-3">{{ $r->client?->name ?? '—' }}</td>
            <td class="px-4 py-3">{{ $r->machine?->name ?? $r->machine_name_snapshot }}</td>
            <td class="px-4 py-3">{{ optional($r->service_date)->format('d/m/Y') ?? $r->created_at->format('d/m/Y') }}</td>
            <td class="px-4 py-3"><span class="text-xs px-2 py-1 rounded {{ $r->statusColor() }}">{{ $r->statusLabel() }}</span></td>
            <td class="px-4 py-3 text-right">
                <a href="{{ route('technician.reports.show', $r) }}" class="text-blue-600 hover:underline">Ver</a>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" class="px-4 py-8 text-center text-slate-500">Aún no has creado reportes. <a href="{{ route('technician.reports.create') }}" class="text-emerald-600">Crear el primero →</a></td></tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $reports->links() }}</div>
@endsection
