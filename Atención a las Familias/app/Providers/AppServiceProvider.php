<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Compartir datos institucionales, sedes y redes sociales con TODAS las vistas
        View::composer('*', function ($view) {
            $view->with([
                'institutional' => config('app.institutional'),
                'locations'     => config('app.locations', []),
                'social'        => config('app.social'),
            ]);
        });
    }
}
