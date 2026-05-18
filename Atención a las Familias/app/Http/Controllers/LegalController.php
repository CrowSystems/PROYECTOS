<?php

namespace App\Http\Controllers;

class LegalController extends Controller
{
    public function cookies()
    {
        $seo = [
            'title' => 'Política de Cookies | ' . config('app.name'),
            'description' => 'Información sobre el uso de cookies en el sitio del Centro de Apoyo para la Familia A.C., conforme a la LFPDPPP.',
            'keywords' => 'cookies, política de cookies, LFPDPPP, privacidad, CAF',
        ];
        return view('pages.cookies', compact('seo'));
    }

    public function privacy()
    {
        $seo = [
            'title' => 'Aviso de Privacidad | ' . config('app.name'),
            'description' => 'Aviso de privacidad integral del Centro de Apoyo para la Familia A.C., conforme a la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.',
            'keywords' => 'aviso de privacidad, LFPDPPP, derechos ARCO, datos personales, CAF',
        ];
        return view('pages.privacy', compact('seo'));
    }
}
