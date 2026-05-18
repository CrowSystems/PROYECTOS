<?php

namespace App\Http\Controllers;

use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::where('is_active', true)
            ->orderBy('order')
            ->orderBy('title')
            ->get();

        $seo = [
            'title' => 'Programas | Asociación Valores en Familia A.C.',
            'description' => 'Conoce los programas sociales que implementamos para responder a las necesidades de los grupos vulnerables y en riesgo.',
            'keywords' => 'programas, ayuda social, vulnerables, familia, niños, adultos mayores',
            'og_image' => asset('images/programs.jpg'),
        ];

        return view('pages.programs', compact('programs', 'seo'));
    }

    public function show(Program $program)
    {
        abort_unless($program->is_active, 404);

        $seo = [
            'title' => $program->title . ' | Programas',
            'description' => \Illuminate\Support\Str::limit(strip_tags($program->description), 160),
            'keywords' => 'programa, ' . $program->title,
            'og_image' => $program->image ? asset('storage/' . $program->image) : asset('images/programs.jpg'),
        ];

        return view('pages.program-show', compact('program', 'seo'));
    }
}
