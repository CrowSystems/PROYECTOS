@extends('admin.layout')
@section('title','Mensaje')

@section('content')

<div style="background:#fff;padding:2rem;border-radius:12px;box-shadow:var(--shadow-sm);">
    <p><strong>De:</strong> {{ $message->name }} ({{ $message->email }})</p>
    @if($message->phone) <p><strong>Teléfono:</strong> {{ $message->phone }}</p> @endif
    <p><strong>Asunto:</strong> {{ $message->subject }}</p>
    <p><strong>Fecha:</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>
    <hr>
    <p style="white-space:pre-line;background:#F4F6F9;padding:1rem;border-radius:6px;">{{ $message->message }}</p>

    <div style="display:flex;gap:.5rem;margin-top:1.5rem;">
        <a href="mailto:{{ $message->email }}?subject=Re: {{ urlencode($message->subject) }}" class="btn btn-success">Responder por correo</a>

        <form action="{{ route('admin.messages.toggle', $message) }}" method="POST">
            @csrf @method('PATCH')
            <button class="btn btn-primary">{{ $message->is_read ? 'Marcar como no leído' : 'Marcar como leído' }}</button>
        </form>

        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
            @csrf @method('DELETE')
            <button class="btn btn-danger">Eliminar</button>
        </form>

        <a href="{{ route('admin.messages.index') }}" class="btn" style="background:#777;color:#fff;">Volver</a>
    </div>
</div>

@endsection
