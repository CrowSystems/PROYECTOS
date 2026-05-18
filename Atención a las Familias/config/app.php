<?php

return [
    'name' => env('APP_NAME', 'Valores en Familia'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),
    'url' => env('APP_URL', 'http://localhost'),
    'timezone' => env('APP_TIMEZONE', 'America/Mexico_City'),
    'locale' => env('APP_LOCALE', 'es'),
    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),
    'faker_locale' => 'es_MX',
    'cipher' => 'AES-256-CBC',
    'key' => env('APP_KEY'),
    'previous_keys' => [],
    'maintenance' => [
        'driver' => 'file',
    ],

    // Datos institucionales y de redes sociales accesibles vía config('app.*')
    'institutional' => [
        'name' => env('APP_NAME', 'Asociación Valores en Familia A.C.'),
        'tagline' => 'Promovemos los valores y fortalecemos a la familia mexicana',
        'phone' => '+52 55 1234 5678',
        'email' => env('MAIL_FROM_ADDRESS', 'contacto@valoresfamilia.org'),
        'address' => 'Av. Reforma 123, CDMX, México',
    ],
    'social' => [
        'facebook' => env('SOCIAL_FACEBOOK'),
        'instagram' => env('SOCIAL_INSTAGRAM'),
        'twitter' => env('SOCIAL_TWITTER'),
        'youtube' => env('SOCIAL_YOUTUBE'),
        'whatsapp' => env('SOCIAL_WHATSAPP'),
    ],
];
