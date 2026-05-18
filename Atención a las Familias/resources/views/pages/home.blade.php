@extends('layouts.app')

@section('content')

<section class="hero">
    <div class="hero-overlay"></div>
    <div class="container">
        <small style="display:inline-block;background:var(--color-accent);color:#fff;padding:.35rem .9rem;border-radius:999px;font-weight:700;letter-spacing:1px;font-size:.78rem;margin-bottom:1rem;">FORTALECIENDO FAMILIAS</small>
        <h1>{{ $institutional['name'] }}</h1>
        <p class="lead">
            {{ $institutional['tagline'] }}. Acompañamos a las familias en sus retos
            jurídicos, emocionales y sociales con un equipo de profesionales comprometidos.
        </p>
        <div class="hero-actions">
            <a href="{{ route('programs.index') }}" class="btn btn-primary">Conoce nuestros servicios</a>
            <a href="{{ route('contact') }}" class="btn btn-secondary">Agendar una cita</a>
        </div>
    </div>
</section>

{{-- ====== Familias unidas, familias fuertes ====== --}}
<section class="section">
    <div class="container">
        <div class="grid cols-2" style="align-items:center;gap:3rem;">
            <div>
                <small style="color:var(--color-accent);font-weight:700;letter-spacing:1px;">FAMILIAS UNIDAS, FAMILIAS FUERTES</small>
                <h2 style="margin-top:.5rem;">La familia es el corazón de toda comunidad</h2>
                <p>
                    En el {{ $institutional['name'] }} creemos que cada familia tiene
                    el potencial de transformar su entorno. Por eso ofrecemos atención
                    integral, profesional y al alcance de quienes más lo necesitan.
                </p>
                <p>
                    Nuestro equipo de abogados, psicólogos y trabajadores sociales
                    acompaña con sensibilidad y confidencialidad a cada persona que se
                    acerca a CAF.
                </p>
                <a href="{{ route('about') }}" class="btn btn-primary">Conoce más sobre nosotros</a>
            </div>
            <div class="split-image">
                <img src="{{ asset('images/familia-multigeneracional.jpg') }}" alt="Familia multigeneracional unida">
            </div>
        </div>
    </div>
</section>

{{-- ====== Servicios ====== --}}
<section class="section alt">
    <div class="container">
        <div class="section-title">
            <h2>Nuestros servicios</h2>
            <p>Tres áreas de atención profesional para acompañar a cada familia.</p>
        </div>

        @include('layouts.partials.services')

        <p class="text-center mt-4">
            <a href="{{ route('programs.index') }}" class="btn btn-success">Ver todos los servicios</a>
        </p>
    </div>
</section>

{{-- ====== Valores ====== --}}
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Nuestros valores</h2>
            <p>Cuatro pilares que guían cada uno de nuestros servicios.</p>
        </div>

        <div class="grid cols-4">
            <div class="value-badge">
                <div class="icon">&#129505;</div>
                <h4>Amor</h4>
                <p>Cada persona que atendemos es tratada con dignidad y cariño.</p>
            </div>
            <div class="value-badge">
                <div class="icon">&#129309;</div>
                <h4>Solidaridad</h4>
                <p>Caminamos junto a las familias que más lo necesitan.</p>
            </div>
            <div class="value-badge">
                <div class="icon">&#9878;</div>
                <h4>Justicia</h4>
                <p>Defendemos los derechos de los grupos vulnerables.</p>
            </div>
            <div class="value-badge">
                <div class="icon">&#127968;</div>
                <h4>Familia</h4>
                <p>Creemos en la familia como el núcleo de la sociedad.</p>
            </div>
        </div>
    </div>
</section>

{{-- ====== CTA ====== --}}
<section class="cta-band">
    <div class="container">
        <h2>Tu familia merece apoyo profesional</h2>
        <p class="lead" style="color:#fff;opacity:.95;">
            Agenda una cita con nuestro equipo. Atención cálida, confidencial y accesible.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-primary mt-4">Agendar ahora</a>
    </div>
</section>

@endsection
