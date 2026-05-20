@extends('public.layouts.app')
@section('title', 'Protecnic · Soluciones CNC')

@section('content')

{{-- ============== HERO + NAVBAR ============== --}}
<section class="relative hero-bg text-white overflow-hidden min-h-screen flex flex-col">
    <div class="hero-curves"></div>

    @include('public.partials.navbar')

    {{-- Contenido central del hero --}}
    <div class="relative z-10 flex-1 flex items-center justify-center px-6 text-center">
        <div class="max-w-5xl">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight drop-shadow-lg">
                Nuestra tecnología CNC <br class="hidden sm:block">
                <span class="font-extrabold">se adapta a tus necesidades</span>
            </h1>
            <div class="mt-10">
                <a href="#presentacion"
                   class="inline-block bg-slate-700/80 hover:bg-slate-600 backdrop-blur-sm border border-slate-500/40
                          px-8 py-3 rounded-md text-white font-medium transition shadow-lg">
                    Ver Presentación
                </a>
            </div>
        </div>
    </div>

    <div class="relative z-10 pb-8 flex justify-center">
        <a href="#marcas"
           class="w-12 h-12 rounded-full bg-white/90 hover:bg-white flex items-center justify-center shadow-md transition animate-bounce">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path d="M19 9l-7 7-7-7"/>
            </svg>
        </a>
    </div>
</section>

{{-- ============== CARRUSEL DE MARCAS ============== --}}
<section id="marcas" class="relative bg-gradient-to-b from-slate-50 to-white py-14">
    <div class="max-w-7xl mx-auto px-4">
        @php
            $brandsToShow = $brands->count() ? $brands : collect([
                (object)['name' => 'Sodick',     'logo_path' => null, 'website_url' => null],
                (object)['name' => 'SMEC',       'logo_path' => null, 'website_url' => null],
                (object)['name' => 'NOMURA DS',  'logo_path' => null, 'website_url' => null],
                (object)['name' => 'AXILE',      'logo_path' => null, 'website_url' => null],
                (object)['name' => 'CHETO',      'logo_path' => null, 'website_url' => null],
                (object)['name' => 'KEN',        'logo_path' => null, 'website_url' => null],
                (object)['name' => 'PROTH',      'logo_path' => null, 'website_url' => null],
            ]);
            $carouselBrands = $brandsToShow->concat($brandsToShow);
        @endphp

        <div class="marquee overflow-hidden">
            <div class="marquee-track flex gap-6 w-max">
                @foreach($carouselBrands as $b)
                    <div class="brand-card flex-shrink-0 w-56 h-40 bg-white rounded-2xl shadow-md
                                flex items-center justify-center p-4 border border-slate-100">
                        @if($b instanceof \App\Models\Brand && $b->hasLogo())
                            <img src="{{ $b->logoUrl() }}" alt="{{ $b->name }}"
                                 class="max-h-32 max-w-[90%] object-contain">
                        @else
                            <span class="text-2xl font-extrabold text-slate-700 tracking-wide">
                                {{ $b->name }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        @if(!$brands->count())
            <p class="text-center text-xs text-slate-400 mt-6">
                * Marcas de ejemplo. Cuando activen "Mostrar en carrusel" en una marca, aparecerán aquí con su logo.
            </p>
        @endif
    </div>
</section>

{{-- ============== TRANSFORMAMOS DESAFÍOS + MAPA MX ============== --}}
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">
            Transformamos desafíos en soluciones,
        </h2>
        <p class="text-lg md:text-xl text-slate-600 mt-2">
            impulsando tu productividad a otro nivel.
        </p>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-10">
        <div class="bg-[#102a43] text-white rounded-2xl overflow-hidden grid md:grid-cols-2">
            <div class="p-10 md:p-14 flex flex-col justify-center">
                <p class="text-lg text-slate-200">Fusionamos: <span class="font-bold">Precisión</span></p>
                <h3 class="text-4xl md:text-5xl font-extrabold mt-2 leading-tight">
                    Tecnología y<br>Experiencia
                </h3>
                <p class="mt-4 text-slate-200">
                    para redefinir la manufactura en
                    <span class="font-bold text-white">cuatro estados</span> de la república.
                </p>
            </div>

            {{-- Mapa interactivo --}}
            @include('public.partials.mexico-map')
        </div>
    </div>
</section>

{{-- ============== ENCUENTRA TU SOLUCIÓN CNC ============== --}}
<section class="relative py-16 bg-slate-50 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">
                Encuentra tu <span class="text-sky-600">solución CNC</span>
            </h2>
            <p class="text-slate-600 mt-1">
                Contamos con soluciones para cualquier situación que necesites.
            </p>
        </div>

        @php
            $solutionCards = [
                ['title' => 'SERVICIO',     'image' => 'images/solutions/servicio.jpg',     'url' => route('public.services')],
                ['title' => 'LABORATORIO',  'image' => 'images/solutions/laboratorio.jpg',  'url' => route('public.laboratory')],
                ['title' => 'CONSUMIBLES',  'image' => 'images/solutions/consumibles.jpg',  'url' => route('public.consumables')],
                ['title' => 'APLICACIONES', 'image' => 'images/solutions/aplicaciones.jpg', 'url' => route('public.products')],
            ];
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($solutionCards as $card)
                <a href="{{ $card['url'] }}"
                   class="group relative block rounded-xl overflow-hidden bg-slate-200 h-56 shadow-md hover:shadow-xl transition">
                    <img src="{{ asset($card['image']) }}"
                         onerror="this.style.display='none';this.nextElementSibling.style.display='flex';"
                         alt="{{ $card['title'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute inset-0 hidden items-center justify-center bg-slate-300 text-slate-500 text-sm">
                        {{ $card['title'] }}
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 bg-[#0e2540]/90 text-white text-center py-3 font-bold tracking-wider">
                        {{ $card['title'] }}
                    </div>
                </a>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('public.products') }}"
               class="inline-block bg-[#0e2540] hover:bg-[#143052] text-white px-6 py-2.5 rounded-md font-medium shadow">
                Checar todas
            </a>
        </div>
    </div>
</section>

{{-- ============== EVENTOS ============== --}}
@include('public.partials.events-section')

{{-- ============== CONTÁCTANOS ============== --}}
@include('public.partials.contact-section')

@endsection
