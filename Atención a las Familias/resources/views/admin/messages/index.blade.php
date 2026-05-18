@extends('admin.layout')
@section('title','Mensajes de contacto')

@section('content')

<table class="table">
    <thead>
        <tr><th>Fecha</th><th>Nombre</th><th>Email</th><th>Asunto</th><th>Estatus</th><th></th></tr>
    </thead>
    <tbody>
    @forelse($messages as $m)
        <tr style="{{ $m->is_read ? '' : 'font-weight:600;' }}">
            <td>{{ $m->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ $m->name }}</td>
            <td><a href="mailto:{{ $m->email }}">{{ $m->email }}</a></td>
            <td>{{ $m->subject }}</td>
            <td>
                @if($m->is_read) <span class="badge badge-ok">Leído</span>
                @else <span class="badge badge-warn">Nuevo</span> @endif
            </td>
            <td style="display:flex;gap:.5rem;">
                <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-primary btn-sm">Ver</a>
                <form action="{{ route('admin.messages.destroy', $m) }}" method="POST" onsubmit="return confirm('¿Eliminar este mensaje?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Borrar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6" style="text-align:center;padding:1.5rem;color:var(--color-muted);">Sin mensajes.</td></tr>
    @endforelse
    </tbody>
</table>

<div class="mt-4">{{ $messages->links() }}</div>

@endsection
