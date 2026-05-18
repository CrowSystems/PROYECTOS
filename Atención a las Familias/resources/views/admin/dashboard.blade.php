@extends('admin.layout')
@section('title','Dashboard')

@section('content')

<div class="grid cols-4 mb-4">
    <div class="stat-card">
        <div class="lbl">Programas totales</div>
        <div class="num">{{ $stats['programs_total'] }}</div>
    </div>
    <div class="stat-card">
        <div class="lbl">Activos</div>
        <div class="num">{{ $stats['programs_active'] }}</div>
    </div>
    <div class="stat-card">
        <div class="lbl">Mensajes</div>
        <div class="num">{{ $stats['messages_total'] }}</div>
    </div>
    <div class="stat-card">
        <div class="lbl">Sin leer</div>
        <div class="num">{{ $stats['messages_unread'] }}</div>
    </div>
</div>

<h3 class="mb-3">Últimos mensajes</h3>

<table class="table">
    <thead>
        <tr><th>Fecha</th><th>Nombre</th><th>Asunto</th><th>Estatus</th><th></th></tr>
    </thead>
    <tbody>
    @forelse($latestMessages as $m)
        <tr>
            <td>{{ $m->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ $m->name }}</td>
            <td>{{ $m->subject }}</td>
            <td>
                @if($m->is_read)
                    <span class="badge badge-ok">Leído</span>
                @else
                    <span class="badge badge-warn">Nuevo</span>
                @endif
            </td>
            <td><a href="{{ route('admin.messages.show', $m) }}" class="btn btn-primary btn-sm">Ver</a></td>
        </tr>
    @empty
        <tr><td colspan="5" style="text-align:center;color:var(--color-muted);padding:1.5rem;">Aún no hay mensajes.</td></tr>
    @endforelse
    </tbody>
</table>

@endsection
