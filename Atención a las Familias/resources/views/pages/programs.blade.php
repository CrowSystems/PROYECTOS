@extends('layouts.app')

@section('content')

<section class="hero-simple">
    <div class="container">
        <h1>Nuestros servicios</h1>
        <p class="lead">Atención integral y profesional para tu familia.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        @if($programs->isEmpty())
            <p class="text-center">Pronto compartiremos información sobre nuestros servicios.</p>
        @else
            @include('layouts.partials.services', ['servicesList' => $programs])
        @endif
    </div>
</section>

<section class="cta-band">
    <div class="container">
        <h2>¿Necesitas alguno de estos servicios?</h2>
        <p class="lead" style="color:#fff;opacity:.95;">Estamos a una llamada o un mensaje de distancia.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary mt-4">Agendar una cita</a>
    </div>
</section>

@endsection
