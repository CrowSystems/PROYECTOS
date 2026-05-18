@extends('admin.layout')
@section('title','Programas')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
    <p style="color:var(--color-muted);">Gestiona los programas que se muestran en el sitio público.</p>
    <a href="{{ route('admin.programs.create') }}" class="btn btn-primary">+ Nuevo programa</a>
</div>

<table class="table">
    <thead>
        <tr><th>Orden</th><th>Título</th><th>Activo</th><th>Destacado</th><th>Actualizado</th><th></th></tr>
    </thead>
    <tbody>
    @forelse($programs as $p)
        <tr>
            <td>{{ $p->order }}</td>
            <td><strong>{{ $p->title }}</strong><br><small style="color:var(--color-muted);">{{ $p->slug }}</small></td>
            <td>
                @if($p->is_active) <span class="badge badge-ok">Sí</span>
                @else <span class="badge badge-off">No</span> @endif
            </td>
            <td>
                @if($p->is_featured) <span class="badge badge-warn">Destacado</span>
                @else <span class="badge badge-off">—</span> @endif
            </td>
            <td>{{ $p->updated_at->format('d/m/Y') }}</td>
            <td style="display:flex;gap:.5rem;">
                <a href="{{ route('admin.programs.edit', $p) }}" class="btn btn-primary btn-sm">Editar</a>
                <form action="{{ route('admin.programs.destroy', $p) }}" method="POST" onsubmit="return confirm('¿Eliminar este programa?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6" style="text-align:center;padding:1.5rem;color:var(--color-muted);">No hay programas. Crea el primero.</td></tr>
    @endforelse
    </tbody>
</table>

<div class="mt-4">{{ $programs->links() }}</div>

@endsection
