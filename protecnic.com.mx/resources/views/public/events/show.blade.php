@extends('public.layouts.app')
@section('title', $event->title.' · Protecnic')

@section('content')
<section class="relative hero-bg text-white py-20 overflow-hidden">
    @include('public.partials.navbar')
    <div class="relative z-10 max-w-7xl mx-auto px-6 mt-12">
        <a href="{{ route('public.events.index') }}" class="text-sky-300 hover:text-white text-sm">&larr; Volver a eventos</a>
        <h1 class="text-4xl md:text-5xl font-extrabold mt-4">{{ $event->title }}</h1>
        @if($event->subtitle)
            <p class="text-slate-200 mt-2 text-lg">{{ $event->subtitle }}</p>
        @endif
        <div class="text-xs text-sky-300 uppercase tracking-widest mt-2">
            {{ $event->event_date?->format('d M Y') }} {{ $event->location ? '· '.$event->location : '' }}
        </div>
    </div>
</section>

@if($event->main_image_path)
    <div class="bg-black">
        <img src="{{ asset('storage/'.$event->main_image_path) }}" alt="{{ $event->title }}"
             class="w-full max-h-[500px] object-cover">
    </div>
@endif

<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-6 prose prose-slate">
        {!! nl2br(e($event->body)) !!}
    </div>
</section>

@if($event->images->count())
<section class="py-10 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Galería</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($event->images as $img)
                <a href="{{ asset('storage/'.$img->image_path) }}" target="_blank"
                   class="block aspect-square rounded-lg overflow-hidden bg-slate-200">
                    <img src="{{ asset('storage/'.$img->image_path) }}" alt="{{ $img->caption }}"
                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($event->brands->count())
<section class="py-10 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-extrabold text-slate-800 mb-6">Proveedores que participaron</h2>
        <div class="flex flex-wrap gap-4 items-center">
            @foreach($event->brands as $b)
                <div class="bg-white border border-slate-200 rounded-xl p-4 w-40 h-24 flex items-center justify-center shadow-sm">
                    @if($b->logo_path)
                        <img src="{{ asset('storage/'.$b->logo_path) }}" alt="{{ $b->name }}" class="max-h-12 object-contain">
                    @else
                        <span class="font-bold text-slate-700">{{ $b->name }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
