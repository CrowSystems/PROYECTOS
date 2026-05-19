@extends('layouts.app')
@section('title', 'Editar usuario')
@section('content')
<h1 class="text-2xl font-bold mb-6">Editar usuario</h1>
<form method="POST" action="{{ route('admin.users.update', $user) }}" class="bg-white p-6 rounded-xl shadow">
    @method('PUT')
    @include('admin.users._form')
</form>
@endsection
