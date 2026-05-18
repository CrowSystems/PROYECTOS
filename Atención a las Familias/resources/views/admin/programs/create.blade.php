@extends('admin.layout')
@section('title','Nuevo programa')

@section('content')
<form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" style="background:#fff;padding:2rem;border-radius:12px;box-shadow:var(--shadow-sm);">
    @include('admin.programs._form')
</form>
@endsection
