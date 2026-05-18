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
            ['email' => 'admin@valoresfamilia.org'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('AdminSegura2026!'),
                'is_admin' => true,
            ]
        );

        // Programas iniciales
        $programs = [
            [
                'title'   => 'Familias en Crecimiento',
                'summary' => 'Talleres y acompañamiento para fortalecer la convivencia y la comunicación en el hogar.',
                'description' => 'Acompañamos a familias en situación de vulnerabilidad a través de talleres mensuales, terapia familiar y orientación psicológica gratuita. Nuestro objetivo es restaurar los vínculos y promover los valores que sostienen el bienestar del hogar.',
                'order' => 1, 'is_featured' => true,
            ],
            [
                'title'   => 'Niñez con Valores',
                'summary' => 'Actividades formativas para niñas y niños en contextos de riesgo social.',
                'description' => 'A través de espacios lúdicos, deportivos y formativos, brindamos a la infancia un entorno seguro donde aprender el valor del respeto, la responsabilidad y la solidaridad. Trabajamos con escuelas y comunidades de zonas marginadas.',
                'order' => 2, 'is_featured' => true,
            ],
            [
                'title'   => 'Adulto Mayor con Dignidad',
                'summary' => 'Atención, compañía y servicios médicos básicos para personas adultas mayores.',
                'description' => 'Visitamos asilos y casas de adultos mayores en abandono, ofreciendo compañía, talleres ocupacionales, atención médica básica y apoyo nutricional. Cada persona mayor merece vivir con dignidad y rodeada de afecto.',
                'order' => 3, 'is_featured' => true,
            ],
            [
                'title'   => 'Mujer y Maternidad',
                'summary' => 'Apoyo integral a madres en situación vulnerable, especialmente jóvenes y solas.',
                'description' => 'Brindamos asesoría legal, psicológica y nutricional a madres jefas de familia, así como capacitación laboral para que puedan generar ingresos sin descuidar a sus hijos.',
                'order' => 4, 'is_featured' => false,
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
