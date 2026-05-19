@extends('layouts.app')
@section('title', 'Nueva marca')
@section('content')
<h1 class="text-2xl font-bold mb-6">Nueva marca</h1>
<form method="POST" action="{{ route('content.brands.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow">
    @include('content.brands._form')
</form>
@endsection
