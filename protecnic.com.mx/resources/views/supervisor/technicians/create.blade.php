@extends('layouts.app')
@section('title', 'Nuevo técnico')
@section('content')
<h1 class="text-2xl font-bold mb-6">Nuevo técnico</h1>
<form method="POST" action="{{ route('supervisor.technicians.store') }}" class="bg-white p-6 rounded-xl shadow">
    @include('supervisor.technicians._form')
</form>
@endsection
