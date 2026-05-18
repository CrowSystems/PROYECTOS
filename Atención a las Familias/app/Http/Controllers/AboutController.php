<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        $seo = [
            'title' => 'Nosotros | Asociación Valores en Familia A.C.',
            'description' => 'Conoce nuestra misión, visión y los valores que guían a nuestra asociación civil en favor de la familia.',
            'keywords' => 'misión, visión, valores, asociación civil, ONG, familia',
            'og_image' => asset('images/about.jpg'),
        ];

        return view('pages.about', compact('seo'));
    }
}
