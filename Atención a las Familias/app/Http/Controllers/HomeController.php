<?php

namespace App\Http\Controllers;

use App\Models\Program;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPrograms = Program::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->take(3)
            ->get();

        $seo = [
            'title' => 'Inicio | Asociación Valores en Familia A.C.',
            'description' => 'Somos una asociación civil sin fines de lucro que promueve los valores en la sociedad con énfasis en la familia.',
            'keywords' => 'asociación civil, ONG, valores, familia, grupos vulnerables, México',
            'og_image' => asset('images/hero.jpg'),
        ];

        return view('pages.home', compact('featuredPrograms', 'seo'));
    }
}
