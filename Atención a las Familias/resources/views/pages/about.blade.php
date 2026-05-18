@extends('layouts.app')

@section('content')

<section class="hero">
    <div class="container">
        <h1>Quiénes somos</h1>
        <p class="lead">Una asociación civil al servicio de las familias mexicanas.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid cols-2" style="align-items:center;">
            <div>
                <h2>Nuestra historia</h2>
                <p>
                    {{ $institutional['name'] }} nace del compromiso de un grupo de ciudadanos
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
            <div class="card">
                <div class="card-image"><span>&#127968;</span></div>
                <div class="card-body">
                    <h3>Más de 10 años</h3>
                    <p>Sirviendo con valores a miles de familias en distintas comunidades.</p>
                </div>
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

<section class="cta-band">
    <div class="container">
        <h2>¿Compartes nuestra causa?</h2>
        <a href="{{ route('contact') }}" class="btn btn-primary mt-4">Contáctanos</a>
    </div>
</section>

@endsection
