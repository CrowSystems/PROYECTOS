@extends('layouts.app')

@section('content')

<section class="hero-simple">
    <div class="container">
        <h1>Quiénes somos</h1>
        <p class="lead">{{ $institutional['name'] }} — {{ $institutional['tagline'] }}.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid cols-2" style="align-items:center;gap:3rem;">
            <div class="split-image">
                <img src="{{ asset('images/familia-feliz.jpg') }}" alt="Familia feliz">
            </div>
            <div>
                <small style="color:var(--color-accent);font-weight:700;letter-spacing:1px;">NUESTRA HISTORIA</small>
                <h2 style="margin-top:.5rem;">Más de una década fortaleciendo familias</h2>
                <p>
                    El Centro de Atención a las Familias A.C. (CAF) nace del compromiso de un grupo de ciudadanos
                    convencidos de que la familia es la base de toda sociedad sana. Desde nuestros
                    inicios, hemos trabajado de la mano con comunidades para responder a las
                    necesidades de quienes más lo requieren.
                </p>
                <p>
                    Operamos con total transparencia y orientamos cada uno de nuestros esfuerzos al
                    bienestar de niños, jóvenes, mujeres, adultos mayores y familias en situación
                    de vulnerabilidad.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="section alt">
    <div class="container">
        <div class="section-title">
            <h2>Misión, Visión y Valores</h2>
        </div>

        <div class="grid cols-3">
            <div class="value-badge">
                <div class="icon">&#127919;</div>
                <h4>Misión</h4>
                <p>Promover los valores en la sociedad con énfasis en la familia, mediante programas que respondan a las necesidades reales de los grupos vulnerables o en riesgo.</p>
            </div>
            <div class="value-badge">
                <div class="icon">&#128064;</div>
                <h4>Visión</h4>
                <p>Ser un referente nacional de transformación social, donde las familias mexicanas vivan plenamente sus valores y construyan comunidades sanas.</p>
            </div>
            <div class="value-badge">
                <div class="icon">&#10024;</div>
                <h4>Valores</h4>
                <p>Honestidad, respeto, solidaridad, responsabilidad, transparencia, compromiso y amor a la familia.</p>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Comunidades que atendemos</h2>
            <p>Cada rostro, cada historia, cada familia importa.</p>
        </div>
        <div class="grid cols-3">
            <div class="split-image" style="height:280px;">
                <img src="{{ asset('images/comunidad-1.jpg') }}" alt="Atención comunitaria">
            </div>
            <div class="split-image" style="height:280px;">
                <img src="{{ asset('images/familia-indigena.jpg') }}" alt="Comunidades indígenas">
            </div>
            <div class="split-image" style="height:280px;">
                <img src="{{ asset('images/talleres-1.jpg') }}" alt="Talleres formativos">
            </div>
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container">
        <h2>¿Compartes nuestra causa?</h2>
        <a href="{{ route('contact') }}" class="btn btn-primary mt-4">Contáctanos</a>
    </div>
</section>

@endsection
