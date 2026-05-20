@extends('public.layouts.app')
@section('title', 'Accesorios · Protecnic')

@section('content')
<section class="relative hero-bg text-white py-20 overflow-hidden">
    @include('public.partials.navbar')
    <div class="relative z-10 max-w-7xl mx-auto px-6 mt-12">
        <h1 class="text-4xl md:text-5xl font-extrabold">Accesorios</h1>
        <p class="text-slate-200 mt-2">Complementos para tu máquina CNC.</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        @if($items->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($items as $p)
                    <article class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
                        @if($p->image_path)
                            <img src="{{ asset('storage/'.$p->image_path) }}" alt="{{ $p->name }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="p-5">
                            <h3 class="font-bold text-slate-900">{{ $p->name }}</h3>
                            <p class="text-xs text-slate-500">{{ $p->brand?->name }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-8">{{ $items->links() }}</div>
        @else
            <p class="text-center text-slate-500 py-20">Sin accesorios registrados aún.</p>
        @endif
    </div>
</section>
@endsection
