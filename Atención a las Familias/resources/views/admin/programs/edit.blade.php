@extends('admin.layout')
@section('title','Editar programa')

@section('content')
<form action="{{ route('admin.programs.update', $program) }}" method="POST" enctype="multipart/form-data" style="background:#fff;padding:2rem;border-radius:12px;box-shadow:var(--shadow-sm);">
    @method('PUT')
    @include('admin.programs._form')
</form>
@endsection
