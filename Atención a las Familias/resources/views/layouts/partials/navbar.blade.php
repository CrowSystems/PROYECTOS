<nav class="navbar">
    <div class="container navbar-inner">
        <a href="{{ route('home') }}" class="brand">
            <span class="brand-icon">
                <img src="{{ asset('images/logo.png') }}" alt="CAF" onerror="this.parentNode.classList.add('fallback');this.remove();this.parentNode.textContent='CAF';">
            </span>
            <span class="brand-text">
                <strong>{{ $institutional['name'] }}</strong>
                <small>{{ $institutional['tagline'] }}</small>
            </span>
        </a>

        <button class="menu-toggle" aria-label="Abrir menú">&#9776;</button>

        <ul class="nav-links">
            <li><a href="{{ route('home') }}"           class="{{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a></li>
            <li><a href="{{ route('about') }}"          class="{{ request()->routeIs('about') ? 'active' : '' }}">Nosotros</a></li>
            <li><a href="{{ route('programs.index') }}" class="{{ request()->routeIs('programs.*') ? 'active' : '' }}">Servicios</a></li>
            <li><a href="{{ route('contact') }}"        class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contacto</a></li>
            <li><a href="{{ route('contact') }}" class="nav-cta">Agendar cita</a></li>
        </ul>
    </div>
</nav>
