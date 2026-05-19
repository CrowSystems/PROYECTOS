@extends('layouts.app')
@section('title', 'Nueva máquina')
@section('content')
<h1 class="text-2xl font-bold mb-6">Nueva máquina</h1>
<form method="POST" action="{{ route('content.machines.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow">
    @include('content.machines._form')
</form>
@endsection
