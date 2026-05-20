<?php

namespace Database\Seeders;

use App\Models\AssetType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AssetTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Laptop',           'description' => 'Computadora portátil.'],
            ['name' => 'PC de escritorio', 'description' => 'Computadora de escritorio.'],
            ['name' => 'Celular',          'description' => 'Teléfono celular corporativo.'],
            ['name' => 'Tablet',           'description' => 'Tableta.'],
            ['name' => 'Monitor',          'description' => 'Monitor o pantalla.'],
            ['name' => 'Impresora',        'description' => 'Impresora o multifuncional.'],
            ['name' => 'Switch',           'description' => 'Switch de red.'],
            ['name' => 'Access Point',     'description' => 'Punto de acceso inalámbrico.'],
            ['name' => 'Servidor',         'description' => 'Servidor físico o NAS.'],
            ['name' => 'Otro',             'description' => 'Otro tipo de activo de TI.'],
        ];

        foreach ($types as $t) {
            AssetType::updateOrCreate(
                ['name' => $t['name']],
                [
                    'slug'        => Str::slug($t['name']),
                    'description' => $t['description'],
                    'active'      => true,
                ]
            );
        }
    }
}
