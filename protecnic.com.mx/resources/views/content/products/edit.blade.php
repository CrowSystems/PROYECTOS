@extends('layouts.app')
@section('title', 'Editar producto')
@section('content')
<h1 class="text-2xl font-bold mb-6">Editar producto</h1>
<form method="POST" action="{{ route('content.products.update', $product) }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow">
    @method('PUT')
    @include('content.products._form')
</form>
@endsection
