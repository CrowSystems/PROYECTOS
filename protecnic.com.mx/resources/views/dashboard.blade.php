@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-slate-800">Hola, {{ auth()->user()->name }}</h1>
    <p class="text-slate-500">Resumen general del sistema</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-sm text-slate-500">Usuarios</p>
        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $stats['users'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-sm text-slate-500">Marcas</p>
        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $stats['brands'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-sm text-slate-500">Máquinas</p>
        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $stats['machines'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-sm text-slate-500">Productos</p>
        <p class="text-3xl font-bold text-slate-800 mt-1">{{ $stats['products'] }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-sm text-slate-500">Reportes totales</p>
        <p class="text-3xl font-bold text-emerald-600 mt-1">{{ $stats['reports_total'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-sm text-slate-500">Pendientes cliente</p>
        <p class="text-3xl font-bold text-yellow-600 mt-1">{{ $stats['reports_pending'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-sm text-slate-500">Aprobados</p>
        <p class="text-3xl font-bold text-green-700 mt-1">{{ $stats['reports_approved'] }}</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-sm text-slate-500">Mis reportes</p>
        <p class="text-3xl font-bold text-blue-600 mt-1">{{ $stats['my_reports'] }}</p>
    </div>
</div>

<div class="mt-8 bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-semibold text-slate-800 mb-3">Accesos rápidos</h2>
    <div class="flex flex-wrap gap-2">
        @if(auth()->user()->hasRole([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_TECHNICIAN]))
            <a href="{{ route('technician.reports.create') }}" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded">+ Nuevo reporte</a>
        @endif
        @if(auth()->user()->hasRole([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_SUPERVISOR]))
            <a href="{{ route('supervisor.reports.index') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Validar reportes</a>
        @endif
        @if(auth()->user()->hasRole([\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_CONTENT_EDITOR]))
            <a href="{{ route('content.brands.index') }}" class="px-4 py-2 bg-slate-700 hover:bg-slate-800 text-white rounded">Gestionar marcas</a>
        @endif
        <a href="{{ url('/') }}" target="_blank" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-slate-800 rounded">Ver página pública</a>
    </div>
</div>
@endsection
