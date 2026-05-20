@extends('public.layouts.app')
@section('title', 'Blog · Protecnic')

@section('content')
<section class="relative hero-bg text-white py-20 overflow-hidden">
    @include('public.partials.navbar')
    <div class="relative z-10 max-w-7xl mx-auto px-6 mt-12">
        <h1 class="text-4xl md:text-5xl font-extrabold">Blog</h1>
        <p class="text-slate-200 mt-2">Artículos y novedades del mundo CNC.</p>
    </div>
</section>
<section class="py-16 bg-white">
    <div class="max-w-5xl mx-auto px-6">
        <p class="text-slate-700">Próximamente: artículos técnicos y casos de éxito.</p>
    </div>
</section>
@endsection
