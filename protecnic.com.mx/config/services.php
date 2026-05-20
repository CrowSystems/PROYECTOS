<?php

/*
|--------------------------------------------------------------------------
| Third Party Services
|--------------------------------------------------------------------------
|
| Credenciales para servicios externos (Mailgun, Slack, Microsoft, etc.).
| Los valores reales se leen desde el archivo .env.
|
*/

return [

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Microsoft Entra ID (Office 365) — SSO para empleados internos
    |--------------------------------------------------------------------------
    | El driver "azure" lo provee socialiteproviders/microsoft-azure.
    | Estos valores los entrega tu administrador de Microsoft 365 desde el
    | portal de Azure (Microsoft Entra ID → Registros de aplicaciones).
    */
    'azure' => [
        'client_id'     => env('AZURE_CLIENT_ID'),
        'client_secret' => env('AZURE_CLIENT_SECRET'),
        'redirect'      => env('AZURE_REDIRECT_URI'),
        'tenant'        => env('AZURE_TENANT_ID'),
        // Dominio único permitido. Cualquier correo fuera de este dominio será rechazado.
        'allowed_domain' => env('AZURE_ALLOWED_DOMAIN', 'protecnic.com.mx'),
    ],

];
