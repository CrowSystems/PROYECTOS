@extends('layouts.app')

@section('content')

<section class="hero">
    <div class="container">
        <h1>Promovemos los valores, fortalecemos a la familia</h1>
        <p class="lead">
            Somos una asociación civil sin fines de lucro que implementa programas de atención
            integral para los grupos vulnerables y en riesgo, con énfasis en la familia.
        </p>
        <div class="hero-actions">
            <a href="{{ route('programs.index') }}" class="btn btn-primary">Conoce nuestros programas</a>
            <a href="{{ route('contact') }}" class="btn btn-secondary">Quiero colaborar</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Nuestros valores</h2>
            <p>Cuatro pilares que guían cada uno de nuestros programas y acciones.</p>
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

@if($featuredPrograms->count() > 0)
<section class="section alt">
    <div class="container">
        <div class="section-title">
            <h2>Programas destacados</h2>
            <p>Conoce algunas de las iniciativas con las que estamos transformando vidas.</p>
        </div>

        <div class="grid cols-3">
            @foreach($featuredPrograms as $program)
                <div class="card">
                    <div class="card-image">
                        @if($program->image)
                            <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->title }}">
                        @else
                            <span>&#127757;</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h3>{{ $program->title }}</h3>
                        <p>{{ $program->summary }}</p>
                        <a href="{{ route('programs.show', $program->slug) }}" class="btn btn-primary btn-sm">Ver más</a>
                    </div>
                </div>
            @endforeach
        </div>

        <p class="text-center mt-4">
            <a href="{{ route('programs.index') }}" class="btn btn-success">Ver todos los programas</a>
        </p>
    </div>
</section>
@endif

<section class="cta-band">
    <div class="container">
        <h2>Tu apoyo transforma vidas</h2>
        <p class="lead" style="color:#f3f3f3;">
            Cada donación, cada hora de voluntariado, cada gesto cuenta. Súmate hoy.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-primary mt-4">Quiero ayudar</a>
    </div>
</section>

@endsection
