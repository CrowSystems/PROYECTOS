@extends('public.layouts.app')
@section('title', 'Eventos · Protecnic')

@section('content')
<section class="relative hero-bg text-white py-20 overflow-hidden">
    @include('public.partials.navbar')
    <div class="relative z-10 max-w-7xl mx-auto px-6 mt-12">
        <h1 class="text-4xl md:text-5xl font-extrabold">Eventos</h1>
        <p class="text-slate-200 mt-2">Ferias, seminarios y open house de Protecnic.</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        @if($events->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $e)
                    <a href="{{ route('public.events.show', $e) }}"
                       class="relative block rounded-xl overflow-hidden bg-slate-200 h-64 group">
                        @if($e->main_image_path)
                            <img src="{{ asset('storage/'.$e->main_image_path) }}" alt="{{ $e->title }}"
                                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/10"></div>
                        <div class="absolute bottom-4 left-4 right-4 text-white">
                            <div class="text-xs uppercase font-bold tracking-wider text-sky-300">
                                {{ $e->event_date?->format('M Y') }}
                            </div>
                            <div class="text-xl font-extrabold mt-1">{{ $e->title }}</div>
                            @if($e->subtitle)
                                <div class="text-sm text-slate-200">{{ $e->subtitle }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-10">{{ $events->links() }}</div>
        @else
            <p class="text-center text-slate-500 py-20">Aún no hay eventos publicados.</p>
        @endif
    </div>
</section>
@endsection
