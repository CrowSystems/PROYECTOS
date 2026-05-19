@extends('layouts.app')
@section('title', 'Editar máquina')
@section('content')
<h1 class="text-2xl font-bold mb-6">Editar máquina</h1>
<form method="POST" action="{{ route('content.machines.update', $machine) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow">
    @method('PUT')
    @include('content.machines._form')
</form>
@endsection
