<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title'    => 'Expo Maq 2024',
                'subtitle' => 'Feria internacional de manufactura',
                'body'     => "Participamos en Expo Maq 2024 mostrando lo último en tecnología CNC, demostraciones en vivo y atención personalizada con nuestros principales proveedores. Un espacio para compartir experiencias y encontrar la mejor solución para tu proceso.",
                'location' => 'Guadalajara, Jalisco',
                'date'     => '2024-11-12',
            ],
            [
                'title'    => 'Seminario Técnico Protecnic',
                'subtitle' => 'Capacitación y demostraciones en piso',
                'body'     => "Seminario técnico con la participación de fabricantes internacionales. Conferencias, demostraciones de máquinas en vivo y networking con la industria.",
                'location' => 'Querétaro, Qro',
                'date'     => '2024-09-20',
            ],
            [
                'title'    => 'Open House Showroom',
                'subtitle' => 'Visita guiada a nuestro showroom',
                'body'     => "Abrimos las puertas de nuestro showroom para presentar nuestras nuevas líneas de máquinas y soluciones. Recorrido técnico y atención uno a uno.",
                'location' => 'Santa Catarina, Nuevo León',
                'date'     => '2024-06-15',
            ],
            [
                'title'    => 'Mexitec 2025',
                'subtitle' => 'Tecnología de manufactura avanzada',
                'body'     => "Asistencia a Mexitec 2025, presentando nuestras soluciones integrales para la industria de manufactura mexicana.",
                'location' => 'CDMX',
                'date'     => '2025-03-05',
            ],
        ];

        foreach ($events as $e) {
            $event = Event::updateOrCreate(
                ['slug' => Str::slug($e['title'])],
                [
                    'title'           => $e['title'],
                    'subtitle'        => $e['subtitle'],
                    'body'            => $e['body'],
                    'location'        => $e['location'],
                    'event_date'      => $e['date'],
                    'main_image_path' => null,
                    'published'       => true,
                ]
            );

            // Asignamos algunas marcas de ejemplo (las del carrusel) a cada evento
            $brandIds = Brand::whereIn('name', ['Sodick', 'AXILE', 'CHETO'])->pluck('id');
            if ($brandIds->count()) {
                $event->brands()->sync($brandIds);
            }
        }
    }
}
