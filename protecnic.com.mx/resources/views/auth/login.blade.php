@extends('layouts.app')
@section('title', 'Iniciar sesión')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-700 py-8">
    <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-slate-800 mb-1">Portal Protecnic</h1>
        <p class="text-slate-500 mb-6">Inicia sesión para continuar</p>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Botón Microsoft 365 (empleados internos) --}}
        <a href="{{ route('auth.microsoft.redirect') }}"
           class="flex items-center justify-center gap-3 w-full border-2 border-slate-300 hover:border-slate-500 hover:bg-slate-50 text-slate-800 py-3 rounded-lg font-medium transition mb-4">
            <svg width="20" height="20" viewBox="0 0 23 23" xmlns="http://www.w3.org/2000/svg">
                <path fill="#f25022" d="M1 1h10v10H1z"/>
                <path fill="#7fba00" d="M12 1h10v10H12z"/>
                <path fill="#00a4ef" d="M1 12h10v10H1z"/>
                <path fill="#ffb900" d="M12 12h10v10H12z"/>
            </svg>
            <span>Iniciar sesión con Office 365</span>
        </a>

        <div class="flex items-center my-5">
            <hr class="flex-1 border-slate-200">
            <span class="px-3 text-xs text-slate-400 uppercase">o con credenciales</span>
            <hr class="flex-1 border-slate-200">
        </div>

        <p class="text-xs text-slate-500 mb-3">
            Sólo para <strong>clientes externos</strong>. Si eres empleado de Protecnic, usa el botón de Office 365.
        </p>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
            </div>
            <label class="flex items-center text-sm text-slate-600">
                <input type="checkbox" name="remember" class="mr-2"> Recordarme
            </label>
            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-lg font-medium">
                Entrar
            </button>
        </form>

        @if(app()->environment('local'))
            <div class="mt-6 p-3 bg-slate-50 rounded text-xs text-slate-600">
                <p class="font-semibold mb-1">Cuentas de prueba (password: <code>password</code>):</p>
                <ul class="space-y-0.5">
                    <li>admin@portal.test</li>
                    <li>contenido@portal.test</li>
                    <li>supervisor@portal.test</li>
                    <li>tecnico@portal.test</li>
                    <li>it@portal.test</li>
                </ul>
            </div>
        @endif
    </div>
</div>
@endsection
