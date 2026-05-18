@extends('layouts.app')

@section('content')

<section class="hero">
    <div class="container">
        <h1>Nuestros programas</h1>
        <p class="lead">Iniciativas que atienden integralmente a los grupos vulnerables y a sus familias.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        @if($programs->isEmpty())
            <p class="text-center">Pronto compartiremos información sobre nuestros programas.</p>
        @else
            <div class="grid cols-3">
                @foreach($programs as $program)
                    <div class="card">
                        <div class="card-image">
                            @if($program->image)
                                <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->title }}">
                            @else
                                <span>&#127881;</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h3>{{ $program->title }}</h3>
                            <p>{{ $program->summary }}</p>
                            <a href="{{ route('programs.show', $program->slug) }}" class="btn btn-primary btn-sm">Conocer más</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

@endsection
