@extends('public.layouts.app')
@section('title', 'Productos · Protecnic')

@section('content')
<section class="relative hero-bg text-white py-20 overflow-hidden">
    @include('public.partials.navbar')
    <div class="relative z-10 max-w-7xl mx-auto px-6 mt-12">
        <h1 class="text-4xl md:text-5xl font-extrabold">Productos</h1>
        <p class="text-slate-200 mt-2">Catálogo de máquinas y soluciones CNC.</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        @if($items->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($items as $p)
                    <article class="bg-white border border-slate-200 rounded-2xl overflow-hidden hover:shadow-xl transition">
                        @if($p->image_path)
                            <img src="{{ asset('storage/'.$p->image_path) }}" alt="{{ $p->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-slate-100 flex items-center justify-center text-slate-300">Sin imagen</div>
                        @endif
                        <div class="p-5">
                            <p class="text-xs text-sky-600 font-semibold uppercase">{{ $p->brand?->name }} · {{ $p->product_type }}</p>
                            <h3 class="font-bold text-slate-900 mt-1">{{ $p->name }}</h3>
                            @if($p->price)
                                <p class="text-emerald-600 font-extrabold mt-2 text-lg">${{ number_format((float)$p->price, 2) }}</p>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-8">{{ $items->links() }}</div>
        @else
            <p class="text-center text-slate-500 py-20">Aún no hay productos publicados.</p>
        @endif
    </div>
</section>
@endsection
