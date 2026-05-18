<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <h4>{{ $institutional['name'] }}</h4>
                <p style="font-size:.95rem;">{{ $institutional['tagline'] }}</p>

                @include('layouts.partials.social-icons')
            </div>

            <div>
                <h4>Navegación</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Inicio</a></li>
                    <li><a href="{{ route('about') }}">Nosotros</a></li>
                    <li><a href="{{ route('programs.index') }}">Programas</a></li>
                    <li><a href="{{ route('contact') }}">Contacto</a></li>
                </ul>
            </div>

            <div>
                <h4>Contacto</h4>
                <ul>
                    <li>{{ $institutional['address'] }}</li>
                    <li><a href="tel:{{ preg_replace('/\s+/', '', $institutional['phone']) }}">{{ $institutional['phone'] }}</a></li>
                    <li><a href="mailto:{{ $institutional['email'] }}">{{ $institutional['email'] }}</a></li>
                </ul>
            </div>

            <div>
                <h4>Donaciones</h4>
                <p style="font-size:.95rem;">Tu apoyo transforma vidas. Suma a nuestra causa.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-sm">Cómo donar</a>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; {{ date('Y') }} {{ $institutional['name'] }}. Todos los derechos reservados.
            &middot; <a href="{{ route('login') }}">Acceso administrativo</a>
        </div>
    </div>
</footer>
