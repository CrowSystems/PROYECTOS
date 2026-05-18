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
        // Compartir datos institucionales y redes sociales con TODAS las vistas
        View::composer('*', function ($view) {
            $view->with([
                'institutional' => config('app.institutional'),
                'social' => config('app.social'),
            ]);
        });
    }
}
