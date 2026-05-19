@extends('layouts.app')
@section('title', 'Nuevo producto')
@section('content')
<h1 class="text-2xl font-bold mb-6">Nuevo producto</h1>
<form method="POST" action="{{ route('content.products.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow">
    @include('content.products._form')
</form>
@endsection
