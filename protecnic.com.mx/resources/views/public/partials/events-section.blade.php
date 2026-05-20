@php
    // Si no hay eventos en BD, mostramos placeholders demostrativos (3 imágenes referenciadas en el documento)
    $eventsToShow = $events ?? collect();
    if (! $eventsToShow->count()) {
        $eventsToShow = collect([
            (object)['title' => 'Expo Maq 2024', 'subtitle' => 'Expo',         'slug' => null, 'main_image_path' => null, 'event_date' => null],
            (object)['title' => 'Seminario Técnico', 'subtitle' => 'Seminario','slug' => null, 'main_image_path' => null, 'event_date' => null],
            (object)['title' => 'Open House Protecnic', 'subtitle' => 'Open',  'slug' => null, 'main_image_path' => null, 'event_date' => null],
            (object)['title' => 'Mexitec 2025',  'subtitle' => 'Expo',         'slug' => null, 'main_image_path' => null, 'event_date' => null],
        ]);
    }
    $first  = $eventsToShow->get(0);
    $second = $eventsToShow->get(1);
    $third  = $eventsToShow->get(2);
    $fourth = $eventsToShow->get(3);

    $eventUrl = function ($e) {
        return $e?->slug ? route('public.events.show', $e->slug) : route('public.events.index');
    };
@endphp

<section id="eventos" class="bg-white pb-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-end justify-between mb-6">
            <div>
                <p class="text-sky-600 font-semibold text-sm tracking-wider uppercase">Comunidad</p>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 mt-1">Eventos</h2>
            </div>
            <a href="{{ route('public.events.index') }}" class="text-sky-600 hover:text-sky-700 font-medium text-sm">
                Ver todos →
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-3 h-[420px]">

            {{-- Evento 1 - grande izquierda --}}
            @if($first)
                <a href="{{ $eventUrl($first) }}"
                   class="relative md:col-span-1 md:row-span-2 rounded-xl overflow-hidden group bg-slate-300">
                    @if($first->main_image_path ?? null)
                        <img src="{{ asset('storage/'.$first->main_image_path) }}" alt="{{ $first->title }}"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-700 to-slate-900"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/10"></div>
                    <span class="absolute top-4 left-4 text-white text-xs uppercase tracking-widest font-bold bg-sky-600 px-2 py-1 rounded">EVENTOS</span>
                    <span class="absolute bottom-4 left-4 text-white text-2xl font-extrabold">{{ $first->title }}</span>
                </a>
            @endif

            {{-- Eventos 2 y 3 - dos mitades centrales --}}
            <div class="md:col-span-2 grid grid-rows-2 gap-3">
                @foreach([$second, $third] as $e)
                    @if($e)
                        <a href="{{ $eventUrl($e) }}"
                           class="relative rounded-xl overflow-hidden group bg-slate-300">
                            @if($e->main_image_path ?? null)
                                <img src="{{ asset('storage/'.$e->main_image_path) }}" alt="{{ $e->title }}"
                                     class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-slate-600 to-slate-800"></div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/10"></div>
                            <span class="absolute bottom-3 left-4 text-white text-xl font-bold">{{ $e->title }}</span>
                        </a>
                    @endif
                @endforeach
            </div>

            {{-- Evento 4 - grande derecha --}}
            @if($fourth)
                <a href="{{ $eventUrl($fourth) }}"
                   class="relative md:col-span-1 md:row-span-2 rounded-xl overflow-hidden group bg-slate-300">
                    @if($fourth->main_image_path ?? null)
                        <img src="{{ asset('storage/'.$fourth->main_image_path) }}" alt="{{ $fourth->title }}"
                             class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="absolute inset-0 bg-gradient-to-br from-slate-700 to-slate-900"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/10"></div>
                    <span class="absolute bottom-4 left-4 text-white text-2xl font-extrabold">{{ $fourth->title }}</span>
                </a>
            @endif
        </div>
    </div>
</section>
