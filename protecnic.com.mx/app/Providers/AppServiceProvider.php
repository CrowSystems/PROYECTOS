<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useTailwind();

        // Registramos el provider de Microsoft Azure para Socialite.
        // El paquete socialiteproviders/microsoft-azure expone un evento
        // SocialiteWasCalled que debe enlazarse a un handler para que
        // Socialite::driver('azure') esté disponible.
        if (class_exists(\SocialiteProviders\Manager\SocialiteWasCalled::class)) {
            Event::listen(
                \SocialiteProviders\Manager\SocialiteWasCalled::class,
                \SocialiteProviders\Azure\AzureExtendSocialite::class.'@handle'
            );
        }
    }
}
