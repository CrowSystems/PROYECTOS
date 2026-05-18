@extends('layouts.app')

@section('content')

<section class="hero-simple">
    <div class="container">
        <h1>{{ $program->title }}</h1>
        <p class="lead">{{ $program->summary }}</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid cols-2" style="align-items:flex-start;">
            <div>
                <div class="card-image" style="height:340px; border-radius:12px;">
                    @if($program->image)
                        <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->title }}">
                    @else
                        <span>&#127881;</span>
                    @endif
                </div>
            </div>
            <div>
                <h2>Sobre este programa</h2>
                <div style="white-space: pre-line;">{!! e($program->description) !!}</div>
                <a href="{{ route('contact') }}" class="btn btn-primary mt-4">Colaborar con este programa</a>
                <a href="{{ route('programs.index') }}" class="btn btn-secondary mt-4" style="color: var(--color-primary); border-color: var(--color-primary);">Ver otros programas</a>
            </div>
        </div>
    </div>
</section>

@endsection
