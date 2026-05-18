<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel') | Admin</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="admin-layout">
    <aside class="admin-sidebar">
        <div class="brand">
            <span class="brand-icon">V</span>
            <span>Admin</span>
        </div>

        <ul>
            <li><a href="{{ route('admin.dashboard') }}"      class="{{ request()->routeIs('admin.dashboard') ? 'active':'' }}">Dashboard</a></li>
            <li><a href="{{ route('admin.programs.index') }}" class="{{ request()->routeIs('admin.programs.*') ? 'active':'' }}">Programas</a></li>
            <li><a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active':'' }}">Mensajes</a></li>
            <li><a href="{{ route('home') }}" target="_blank">Ver sitio &#8599;</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="margin-top:1rem;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" style="width:100%;">Cerrar sesión</button>
                </form>
            </li>
        </ul>
    </aside>

    <main class="admin-main">
        <div class="admin-topbar">
            <h2>@yield('title', 'Panel administrativo')</h2>
            <span style="color:var(--color-muted)">Hola, {{ auth()->user()->name ?? 'admin' }}</span>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        @yield('content')
    </main>
</div>
<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
