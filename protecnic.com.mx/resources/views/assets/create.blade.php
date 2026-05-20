@extends('layouts.app')
@section('title', 'Nuevo equipo')

@section('content')
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('assets.index') }}" class="text-slate-500 hover:text-slate-700">&larr; Volver</a>
    <h1 class="text-2xl font-bold text-slate-800">Registrar equipo</h1>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <form action="{{ route('assets.store') }}" method="POST">
        @include('assets._form')
    </form>
</div>
@endsection
