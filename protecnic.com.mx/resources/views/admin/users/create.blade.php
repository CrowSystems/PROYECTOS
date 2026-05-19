@extends('layouts.app')
@section('title', 'Nuevo usuario')
@section('content')
<h1 class="text-2xl font-bold mb-6">Nuevo usuario</h1>
<form method="POST" action="{{ route('admin.users.store') }}" class="bg-white p-6 rounded-xl shadow">
    @include('admin.users._form')
</form>
@endsection
