<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        // Las 7 marcas principales del documento de levantamiento.
        // Las dejamos activas y marcadas para aparecer en el carrusel público.
        $brands = [
            ['name' => 'Sodick',     'website_url' => 'https://www.sodick.com',     'order' => 1],
            ['name' => 'SMEC',       'website_url' => 'https://www.smec.com',       'order' => 2],
            ['name' => 'NOMURA DS',  'website_url' => null,                          'order' => 3],
            ['name' => 'AXILE',      'website_url' => 'https://www.axile.com.tw',    'order' => 4],
            ['name' => 'CHETO',      'website_url' => 'https://cheto.es',            'order' => 5],
            ['name' => 'KEN',        'website_url' => null,                          'order' => 6],
            ['name' => 'PROTH',      'website_url' => 'https://www.proth.com.tw',    'order' => 7],
        ];

        foreach ($brands as $b) {
            Brand::updateOrCreate(
                ['name' => $b['name']],
                [
                    'slug'             => Str::slug($b['name']),
                    'description'      => null,
                    'website_url'      => $b['website_url'],
                    'logo_path'        => null,   // se llenará cuando suban el logo
                    'active'           => true,
                    'show_in_carousel' => true,
                    'carousel_order'   => $b['order'],
                ]
            );
        }
    }
}
