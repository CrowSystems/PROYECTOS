<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class MicrosoftAuthController extends Controller
{
    /**
     * Redirige al usuario al portal de login de Microsoft.
     */
    public function redirect()
    {
        if (! $this->isConfigured()) {
            return redirect()->route('login')->withErrors([
                'email' => 'El inicio de sesión con Office 365 aún no está configurado. Contacta a un administrador.',
            ]);
        }

        return Socialite::driver('azure')
            ->scopes(['openid', 'profile', 'email', 'User.Read'])
            ->redirect();
    }

    /**
     * Maneja la respuesta de Microsoft tras autenticar al usuario.
     */
    public function callback(Request $request)
    {
        if (! $this->isConfigured()) {
            return redirect()->route('login')->withErrors([
                'email' => 'El inicio de sesión con Office 365 no está configurado.',
            ]);
        }

        try {
            $msUser = Socialite::driver('azure')->stateless()->user();
        } catch (\Throwable $e) {
            Log::warning('Microsoft SSO falló en callback', ['msg' => $e->getMessage()]);
            return redirect()->route('login')->withErrors([
                'email' => 'No se pudo autenticar con Microsoft. Reintenta o usa el formulario.',
            ]);
        }

        $email = strtolower((string) $msUser->getEmail());
        if (empty($email)) {
            return redirect()->route('login')->withErrors([
                'email' => 'Microsoft no devolvió un correo válido.',
            ]);
        }

        // Bloqueo por dominio: sólo @protecnic.com.mx (configurable)
        $allowedDomain = strtolower(config('services.azure.allowed_domain', 'protecnic.com.mx'));
        $emailDomain   = Str::after($email, '@');
        if ($emailDomain !== $allowedDomain) {
            Log::warning('Intento de SSO de dominio externo', ['email' => $email]);
            return redirect()->route('login')->withErrors([
                'email' => "Acceso restringido. Solo se permiten cuentas @{$allowedDomain}.",
            ]);
        }

        // 1) Buscamos por microsoft_id; 2) por correo; 3) lo creamos.
        $user = User::where('microsoft_id', $msUser->getId())->first()
             ?? User::where('email', $email)->first();

        if (! $user) {
            $user = $this->createSsoUser($msUser, $email);
        } else {
            // Si el usuario existía pero aún no tenía microsoft_id (cuenta local
            // creada por admin antes), lo vinculamos ahora.
            $user->fill([
                'microsoft_id'             => $msUser->getId(),
                'microsoft_data'           => $this->extractProfile($msUser),
                'last_microsoft_login_at'  => now(),
            ]);
            if (empty($user->name) && $msUser->getName()) {
                $user->name = $msUser->getName();
            }
            $user->save();
        }

        if (! $user->active) {
            return redirect()->route('login')->withErrors([
                'email' => 'Tu cuenta está desactivada. Pide a un administrador que la reactive.',
            ]);
        }

        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Crea un nuevo usuario desde una identidad de Microsoft.
     * Rol por defecto: técnico (el más restrictivo).
     */
    protected function createSsoUser($msUser, string $email): User
    {
        return User::create([
            'name'                     => $msUser->getName() ?: Str::before($email, '@'),
            'email'                    => $email,
            'password'                 => Hash::make(Str::random(64)),  // password aleatoria; el usuario nunca la usa
            'role'                     => User::ROLE_TECHNICIAN,
            'active'                   => true,
            'microsoft_id'             => $msUser->getId(),
            'microsoft_data'           => $this->extractProfile($msUser),
            'created_via_sso'          => true,
            'last_microsoft_login_at'  => now(),
            'email_verified_at'        => now(),  // Microsoft ya validó el correo
        ]);
    }

    /**
     * Extrae sólo los campos útiles del objeto Socialite para guardarlos en JSON.
     */
    protected function extractProfile($msUser): array
    {
        return [
            'id'         => $msUser->getId(),
            'name'       => $msUser->getName(),
            'email'      => $msUser->getEmail(),
            'avatar'     => $msUser->getAvatar(),
            'nickname'   => $msUser->getNickname(),
        ];
    }

    protected function isConfigured(): bool
    {
        return ! empty(config('services.azure.client_id'))
            && ! empty(config('services.azure.client_secret'))
            && ! empty(config('services.azure.tenant'))
            && ! empty(config('services.azure.redirect'));
    }
}
