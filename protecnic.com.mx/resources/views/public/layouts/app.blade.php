<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name').' · Soluciones CNC')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }

        /* HERO industrial: gradiente azul oscuro + foto opcional */
        .hero-bg {
            background:
                linear-gradient(135deg, rgba(8,15,30,.85) 0%, rgba(15,30,55,.75) 50%, rgba(8,15,30,.9) 100%),
                url('{{ asset('images/hero-bg.jpg') }}') center/cover no-repeat,
                linear-gradient(180deg, #0b1426 0%, #0f1c33 100%);
        }
        /* Cuadrícula del hero deshabilitada (a petición del usuario) */
        .hero-curves {
            position: absolute; bottom: -10%; left: -5%; right: -5%; height: 60%;
            background: radial-gradient(ellipse at center, rgba(255,255,255,.06) 0%, transparent 60%);
            transform: rotate(-3deg); pointer-events: none;
        }

        /* Carrusel marcas */
        @keyframes scroll-x {
            from { transform: translateX(0); }
            to   { transform: translateX(-50%); }
        }
        .marquee-track { animation: scroll-x 30s linear infinite; }
        .marquee:hover .marquee-track { animation-play-state: paused; }
        .brand-card { transition: transform .25s ease, box-shadow .25s ease; }
        .brand-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px -10px rgba(15,23,42,.25); }

        /* Mapa MX */
        .state-dot { transition: r .25s ease, fill .25s ease; cursor: pointer; }
        .state-dot:hover { r: 18; fill: #38bdf8; }
        .state-dot.active { fill: #38bdf8; }

        /* Búsqueda */
        .search-panel { transition: max-height .3s ease, opacity .3s ease; max-height: 0; opacity: 0; overflow: hidden; }
        .search-panel.open { max-height: 280px; opacity: 1; }
    </style>
</head>
<body class="bg-white text-slate-800">

@if(session('success'))
    <div id="flash-msg" class="fixed top-4 right-4 z-50 bg-emerald-600 text-white px-4 py-3 rounded-lg shadow-lg max-w-sm">
        {{ session('success') }}
    </div>
    <script>setTimeout(() => document.getElementById('flash-msg')?.remove(), 5000);</script>
@endif

@yield('content')

@include('public.partials.footer')

</body>
</html>
