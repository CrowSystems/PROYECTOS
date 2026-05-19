@extends('layouts.app')
@section('title', 'Editar marca')
@section('content')
<h1 class="text-2xl font-bold mb-6">Editar marca</h1>
<form method="POST" action="{{ route('content.brands.update', $brand) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow">
    @method('PUT')
    @include('content.brands._form')
</form>
@endsection
