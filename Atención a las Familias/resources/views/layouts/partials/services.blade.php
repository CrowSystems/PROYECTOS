@php
    // Ícono SVG y nombre de imagen opcional por servicio (según el título)
    $serviceMeta = [
        'Asesoría Legal' => [
            'image' => 'servicio-asesoria-legal.jpg',
            'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2 4 5v6c0 5 3.5 9.7 8 11 4.5-1.3 8-6 8-11V5l-8-3zm0 2.18 6 2.25V11c0 4.13-2.8 8.06-6 9.18-3.2-1.12-6-5.05-6-9.18V6.43l6-2.25z"/><path d="M11 14h2v2h-2zm0-6h2v5h-2z"/></svg>',
        ],
        'Apoyo Psicológico' => [
            'image' => 'servicio-apoyo-psicologico.jpg',
            'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M13.5 2C9.4 2 6 5.4 6 9.5V11h-.5C3.6 11 2 12.6 2 14.5S3.6 18 5.5 18H6v2c0 1.1.9 2 2 2h2v-4h2v4h6v-7h2.5c.8 0 1.5-.7 1.5-1.5v-3C22 5.4 18.6 2 14.5 2h-1zm1 2C17.5 4 20 6.5 20 9.5v3h-2v7h-2v-4h-6v4H8v-4H5.5c-.8 0-1.5-.7-1.5-1.5S4.7 13 5.5 13H8V9.5C8 6.5 10.5 4 13.5 4h1zm-1 4c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>',
        ],
        'Asistencia Social' => [
            'image' => 'servicio-asistencia-social.jpg',
            'icon'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>',
        ],
    ];
@endphp

<div class="grid cols-3">
    @foreach($servicesList ?? $featuredPrograms ?? collect() as $program)
        @php
            $meta = $serviceMeta[$program->title] ?? null;
            $imgPath = $meta['image'] ?? null;
            $hasUploadedImg = $program->image ?? false;
        @endphp
        <div class="service-card">
            <div class="service-media">
                @if($hasUploadedImg)
                    <img src="{{ asset('storage/'.$program->image) }}" alt="{{ $program->title }}">
                @elseif($imgPath)
                    <img src="{{ asset('images/'.$imgPath) }}"
                         alt="{{ $program->title }}"
                         onerror="this.style.display='none';this.parentNode.querySelector('.service-icon').style.display='flex';">
                    <div class="service-icon" style="display:none;">{!! $meta['icon'] ?? '' !!}</div>
                @else
                    <div class="service-icon">{!! $meta['icon'] ?? '' !!}</div>
                @endif
            </div>
            <div class="service-body">
                <h3>{{ $program->title }}</h3>
                <p>{{ $program->summary }}</p>
                <a href="{{ route('programs.show', $program->slug) }}" class="btn btn-primary btn-sm">Más información</a>
            </div>
        </div>
    @endforeach
</div>
