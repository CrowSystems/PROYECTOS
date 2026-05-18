<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div style="display:flex;align-items:center;gap:.7rem;margin-bottom:.8rem;">
                    <img src="{{ asset('images/logo.png') }}" alt="CAF" style="height:60px;width:auto;background:#fff;padding:6px;border-radius:8px;">
                    <div>
                        <strong style="font-size:1rem;display:block;">{{ $institutional['name'] }}</strong>
                        <span style="font-size:.85rem;opacity:.85;">{{ $institutional['tagline'] }}</span>
                    </div>
                </div>
                <p style="font-size:.9rem;opacity:.9;">{{ $institutional['slogan'] ?? '' }}</p>

                @include('layouts.partials.social-icons')
            </div>

            <div>
                <h4>Navegación</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Inicio</a></li>
                    <li><a href="{{ route('about') }}">Nosotros</a></li>
                    <li><a href="{{ route('programs.index') }}">Servicios</a></li>
                    <li><a href="{{ route('contact') }}">Contacto</a></li>
                </ul>
            </div>

            <div>
                <h4>Nuestras sedes</h4>
                <ul>
                    @foreach($locations as $loc)
                        <li style="margin-bottom:.8rem;">
                            <strong style="color:#fff;">{{ $loc['name'] }}</strong><br>
                            <span style="font-size:.85rem;opacity:.9;">{{ $loc['address'] }}</span><br>
                            <a href="tel:{{ preg_replace('/\D+/','',$loc['phone']) }}" style="font-size:.85rem;">Tel: {{ $loc['phone'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4>Contacto</h4>
                <ul>
                    <li><a href="mailto:{{ $institutional['email'] }}">{{ $institutional['email'] }}</a></li>
                    <li style="font-size:.9rem;margin-top:.5rem;">{{ $institutional['schedule'] }}</li>
                </ul>
                <a href="{{ route('contact') }}" class="btn btn-primary btn-sm" style="margin-top:.8rem;">Agendar cita</a>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; {{ date('Y') }} {{ $institutional['name'] }}. Todos los derechos reservados.<br>
            <a href="{{ route('legal.privacy') }}">Aviso de Privacidad</a>
            &middot; <a href="{{ route('legal.cookies') }}">Política de Cookies</a>
            &middot; <a href="{{ route('login') }}">Acceso administrativo</a>
        </div>
    </div>
</footer>
