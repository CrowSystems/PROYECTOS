<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador por defecto
        User::updateOrCreate(
            ['email' => 'admin@cafamilias.org'],
            [
                'name'     => 'Administrador CAF',
                'password' => Hash::make('AdminCAF2026!'),
                'is_admin' => true,
            ]
        );

        // Servicios CAF
        $programs = [
            [
                'title'   => 'Asesoría Legal',
                'summary' => 'Orientación y apoyo profesional para su familia.',
                'description' => "Brindamos orientación jurídica gratuita y acompañamiento legal en temas familiares: divorcios, pensión alimenticia, custodia de menores, violencia familiar, regularización de documentos y trámites civiles. Nuestro equipo de abogados acompaña a cada familia con sensibilidad, confidencialidad y profesionalismo.",
                'order' => 1, 'is_featured' => true,
            ],
            [
                'title'   => 'Apoyo Psicológico',
                'summary' => 'Orientación y apoyo profesional para su familia.',
                'description' => "Atención psicológica individual, de pareja y familiar a precios accesibles. Trabajamos terapia para niñas, niños, adolescentes y adultos en temas de duelo, ansiedad, depresión, manejo de emociones, comunicación familiar y violencia. Nuestro equipo de psicólogos cuenta con cédula profesional.",
                'order' => 2, 'is_featured' => true,
            ],
            [
                'title'   => 'Asistencia Social',
                'summary' => 'Orientación y apoyo profesional para tu familia.',
                'description' => "Acompañamiento en la gestión de apoyos sociales, canalización a instituciones públicas y privadas, talleres de desarrollo humano y orientación para familias en situación de vulnerabilidad. Te ayudamos a encontrar los recursos que necesitas para salir adelante.",
                'order' => 3, 'is_featured' => true,
            ],
        ];

        foreach ($programs as $data) {
            Program::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                array_merge($data, ['slug' => Str::slug($data['title']), 'is_active' => true])
            );
        }
    }
}
