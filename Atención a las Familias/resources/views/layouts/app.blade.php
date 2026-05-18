<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ============================ SEO ============================ --}}
    <title>{{ $seo['title'] ?? config('app.name') }}</title>
    <meta name="description" content="{{ $seo['description'] ?? 'Asociación civil sin fines de lucro que promueve los valores y la familia.' }}">
    <meta name="keywords" content="{{ $seo['keywords'] ?? 'asociación, valores, familia, ONG' }}">
    <meta name="author" content="{{ $institutional['name'] }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $seo['title'] ?? config('app.name') }}">
    <meta property="og:description" content="{{ $seo['description'] ?? '' }}">
    <meta property="og:image" content="{{ $seo['og_image'] ?? asset('images/hero.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:locale" content="es_MX">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo['title'] ?? config('app.name') }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? '' }}">
    <meta name="twitter:image" content="{{ $seo['og_image'] ?? asset('images/hero.jpg') }}">

    {{-- Datos estructurados (JSON-LD) --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "NGO",
        "name": "{{ $institutional['name'] }}",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "email": "{{ $institutional['email'] }}",
        "telephone": "{{ $institutional['phone'] }}",
        "address": "{{ $institutional['address'] }}",
        "sameAs": [
            "{{ $social['facebook'] ?? '' }}",
            "{{ $social['instagram'] ?? '' }}",
            "{{ $social['twitter'] ?? '' }}",
            "{{ $social['youtube'] ?? '' }}"
        ]
    }
    </script>

    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    @include('layouts.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
