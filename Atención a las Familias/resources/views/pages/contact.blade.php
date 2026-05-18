@extends('layouts.app')

@section('content')

<section class="hero-simple">
    <div class="container">
        <h1>Contáctanos</h1>
        <p class="lead">Estamos para escucharte. Atención cálida, confidencial y profesional.</p>
    </div>
</section>

{{-- ====== Sedes ====== --}}
<section class="section">
    <div class="container">
        <div class="section-title">
            <h2>Nuestras sedes</h2>
            <p>Cuentas con dos puntos de atención. Acude al que te quede más cerca.</p>
        </div>

        <div class="grid cols-2">
            @foreach($locations as $loc)
                <div class="location-card">
                    <h4>{{ $loc['name'] }}</h4>
                    <p><strong>Dirección:</strong> {{ $loc['address'] }}</p>
                    <p><strong>Teléfono:</strong>
                        <a href="tel:{{ preg_replace('/\D+/','',$loc['phone']) }}">{{ $loc['phone'] }}</a>
                    </p>
                    <p><strong>Celular / WhatsApp:</strong>
                        <a href="https://wa.me/52{{ preg_replace('/\D+/','',$loc['mobile']) }}" target="_blank" rel="noopener">{{ $loc['mobile'] }}</a>
                    </p>
                </div>
            @endforeach
        </div>

        {{-- Información general --}}
        <div class="grid cols-2 mt-4" style="margin-top:1.5rem;">
            <div class="location-card" style="border-left-color: var(--color-accent);">
                <h4 style="display:flex;align-items:center;gap:.5rem;">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    Correo electrónico
                </h4>
                <p><a href="mailto:{{ $institutional['email'] }}">{{ $institutional['email'] }}</a></p>
            </div>
            <div class="location-card" style="border-left-color: var(--color-accent);">
                <h4 style="display:flex;align-items:center;gap:.5rem;">
                    <svg viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
                    Horario de atención
                </h4>
                <p>{{ $institutional['schedule'] }}</p>
            </div>
        </div>
    </div>
</section>

{{-- ====== Formulario ====== --}}
<section class="section alt">
    <div class="container">
        <div class="grid cols-2" style="align-items:flex-start;gap:3rem;">
            <div>
                <h2>Envíanos un mensaje</h2>
                <p>Cuéntanos brevemente cómo podemos ayudarte. Te responderemos a la brevedad por la vía que prefieras.</p>

                <h3 class="mt-4">Síguenos</h3>
                @include('layouts.partials.social-icons')
            </div>

            <div>
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any() && !$errors->has('website'))
                    <div class="alert alert-error">Revisa los campos marcados.</div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="name">Nombre completo *</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                        @error('name') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="grid cols-2">
                        <div class="form-group">
                            <label for="email">Correo electrónico *</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email') <div class="form-error">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Teléfono (opcional)</label>
                            <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone') }}">
                            @error('phone') <div class="form-error">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject">Asunto *</label>
                        <input type="text" id="subject" name="subject" class="form-control" value="{{ old('subject') }}" required>
                        @error('subject') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Mensaje *</label>
                        <textarea id="message" name="message" class="form-control" rows="6" required>{{ old('message') }}</textarea>
                        @error('message') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    {{-- ============ CAPTCHA matemático ============ --}}
                    <div class="form-group">
                        <label for="captcha">Verificación anti-bots *</label>
                        <div class="captcha-box">
                            <span class="captcha-question" aria-label="Operación de verificación">
                                {{ $captchaA }} + {{ $captchaB }} = ?
                            </span>
                            <input type="number" id="captcha" name="captcha" class="form-control" placeholder="Escribe el resultado" required>
                        </div>
                        @error('captcha') <div class="form-error">{{ $message }}</div> @enderror
                    </div>

                    {{-- Honeypot anti-spam invisible --}}
                    <div class="honeypot" aria-hidden="true">
                        <label>No llenes este campo</label>
                        <input type="text" name="website" tabindex="-1" autocomplete="off">
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar mensaje</button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
