@extends('layouts.app')
@section('title', 'Editar técnico')
@section('content')
<h1 class="text-2xl font-bold mb-6">Editar técnico</h1>
<form method="POST" action="{{ route('supervisor.technicians.update', $technician) }}" class="bg-white p-6 rounded-xl shadow">
    @method('PUT')
    @include('supervisor.technicians._form')
</form>
@endsection
