<?php

return [
    'name' => env('APP_NAME', 'Centro de Apoyo para la Familia A.C.'),
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
        'name'     => env('APP_NAME', 'Centro de Apoyo para la Familia A.C.'),
        'short'    => 'CAF',
        'tagline'  => 'Atención integral y profesional',
        'slogan'   => 'Familias unidas, familias fuertes',
        'email'    => 'mujer_familia@hotmail.com',
        'schedule' => 'Lunes a viernes: 8:00 am – 6:00 pm',
    ],

    // Sedes / oficinas
    'locations' => [
        [
            'name'    => 'CAF San Francisco',
            'address' => 'C. Soneto 156, Carlos Castillo Peraza 951, Col. Chihuahua, México',
            'phone'   => '(656) 634 7031',
            'mobile'  => '(656) 275 5776',
        ],
        [
            'name'    => 'CAF Zaragoza',
            'address' => 'C. Aguascalientes 107 Oriente, Zaragoza, 32590 Juárez, Chih., México',
            'phone'   => '(656) 639 5874',
            'mobile'  => '(656) 843 7143',
        ],
    ],
    'social' => [
        'facebook' => env('SOCIAL_FACEBOOK'),
        'instagram' => env('SOCIAL_INSTAGRAM'),
        'twitter' => env('SOCIAL_TWITTER'),
        'youtube' => env('SOCIAL_YOUTUBE'),
        'whatsapp' => env('SOCIAL_WHATSAPP'),
    ],
];
