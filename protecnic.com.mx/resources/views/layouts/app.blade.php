<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        .sidebar-link.active { background-color: #1e293b; color: #fff; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
@auth
<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="w-64 bg-slate-900 text-slate-200 flex flex-col">
        <div class="p-6 border-b border-slate-800">
            <h1 class="text-xl font-bold text-white">Portal Reportes</h1>
            <p class="text-xs text-slate-400 mt-1">{{ auth()->user()->roleLabel() }}</p>
        </div>
        <nav class="flex-1 p-4 space-y-1 text-sm">
            <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }} block px-3 py-2 rounded hover:bg-slate-800">
                Dashboard
            </a>

            @if(auth()->user()->isAdmin())
                <div class="pt-4 pb-1 px-3 text-xs uppercase text-slate-500">Administración</div>
                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }} block px-3 py-2 rounded hover:bg-slate-800">Usuarios</a>
            @endif

            @if(auth()->user()->hasRole([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_CONTENT_EDITOR]))
                <div class="pt-4 pb-1 px-3 text-xs uppercase text-slate-500">Contenido</div>
                <a href="{{ route('content.brands.index') }}"   class="sidebar-link {{ request()->routeIs('content.brands.*') ? 'active' : '' }} block px-3 py-2 rounded hover:bg-slate-800">Marcas</a>
                <a href="{{ route('content.machines.index') }}" class="sidebar-link {{ request()->routeIs('content.machines.*') ? 'active' : '' }} block px-3 py-2 rounded hover:bg-slate-800">Máquinas</a>
                <a href="{{ route('content.products.index') }}" class="sidebar-link {{ request()->routeIs('content.products.*') ? 'active' : '' }} block px-3 py-2 rounded hover:bg-slate-800">Productos</a>
            @endif

            @if(auth()->user()->hasRole([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_SUPERVISOR]))
                <div class="pt-4 pb-1 px-3 text-xs uppercase text-slate-500">Supervisión</div>
                <a href="{{ route('supervisor.reports.index') }}" class="sidebar-link {{ request()->routeIs('supervisor.reports.*') ? 'active' : '' }} block px-3 py-2 rounded hover:bg-slate-800">Reportes a validar</a>
                <a href="{{ route('supervisor.technicians.index') }}" class="sidebar-link {{ request()->routeIs('supervisor.technicians.*') ? 'active' : '' }} block px-3 py-2 rounded hover:bg-slate-800">Técnicos</a>
            @endif

            @if(auth()->user()->hasRole([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_TECHNICIAN]))
                <div class="pt-4 pb-1 px-3 text-xs uppercase text-slate-500">Operación</div>
                <a href="{{ route('technician.reports.index') }}" class="sidebar-link {{ request()->routeIs('technician.reports.*') ? 'active' : '' }} block px-3 py-2 rounded hover:bg-slate-800">Mis reportes</a>
                <a href="{{ route('technician.reports.create') }}" class="block px-3 py-2 rounded bg-emerald-600 hover:bg-emerald-700 text-white mt-2">+ Nuevo reporte</a>
            @endif

            @if(auth()->user()->hasRole([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_IT_MANAGER]))
                <div class="pt-4 pb-1 px-3 text-xs uppercase text-slate-500">Activos / IT</div>
                <a href="{{ route('assets.index') }}"
                   class="sidebar-link {{ request()->routeIs('assets.index') || request()->routeIs('assets.create') || request()->routeIs('assets.edit') ? 'active' : '' }} block px-3 py-2 rounded hover:bg-slate-800">
                    Inventario de equipos
                </a>
                <a href="{{ route('assets.types.index') }}"
                   class="sidebar-link {{ request()->routeIs('assets.types.*') ? 'active' : '' }} block px-3 py-2 rounded hover:bg-slate-800">
                    Tipos de equipo
                </a>
            @endif
        </nav>
        <div class="p-4 border-t border-slate-800 text-sm">
            <div class="text-slate-300">{{ auth()->user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button class="mt-2 text-slate-400 hover:text-white text-xs">Cerrar sesión</button>
            </form>
        </div>
    </aside>

    {{-- Contenido --}}
    <main class="flex-1 p-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-emerald-100 text-emerald-800 rounded">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</div>
@else
    @yield('content')
@endauth
</body>
</html>
