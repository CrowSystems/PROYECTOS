@extends('layouts.app')

@section('content')

<section class="hero">
    <div class="container">
        <h1>Contáctanos</h1>
        <p class="lead">Estamos para escucharte. Súmate como voluntario, donante o aliado.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid cols-2" style="align-items:flex-start;">
            {{-- Datos de contacto --}}
            <div>
                <h2>Información de contacto</h2>
                <p style="margin-bottom:1.5rem;">
                    Nuestro equipo te responderá lo antes posible. Si prefieres llamarnos
                    o escribirnos por WhatsApp, también puedes hacerlo.
                </p>

                <p><strong>Dirección:</strong><br>{{ $institutional['address'] }}</p>
                <p><strong>Teléfono:</strong> <a href="tel:{{ preg_replace('/\s+/', '', $institutional['phone']) }}">{{ $institutional['phone'] }}</a></p>
                <p><strong>Correo:</strong> <a href="mailto:{{ $institutional['email'] }}">{{ $institutional['email'] }}</a></p>

                <h3 class="mt-4">Síguenos</h3>
                @include('layouts.partials.social-icons')
            </div>

            {{-- Formulario --}}
            <div>
                <h2>Envíanos un mensaje</h2>

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

                    {{-- Honeypot anti-spam --}}
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
