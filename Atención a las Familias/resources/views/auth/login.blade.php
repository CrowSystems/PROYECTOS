<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso administrativo | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>
<body style="display:flex;align-items:center;justify-content:center;min-height:100vh;
            background:linear-gradient(135deg,var(--color-primary),var(--color-secondary));">
    <div style="background:#fff;padding:2.5rem;border-radius:12px;max-width:420px;width:90%;box-shadow:var(--shadow-lg);">
        <h2 style="text-align:center;margin-bottom:1.5rem;">Acceso administrativo</h2>

        @if($errors->any())
            <div class="alert alert-error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}">
            @csrf

            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label><input type="checkbox" name="remember"> Recuérdame</label>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">Entrar</button>
        </form>

        <p style="text-align:center;margin-top:1.5rem;font-size:0.9rem;">
            <a href="{{ route('home') }}">&larr; Volver al sitio</a>
        </p>
    </div>
</body>
</html>
