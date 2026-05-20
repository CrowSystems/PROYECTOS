<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Client;
use App\Models\Machine;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---------- Usuarios por rol ----------
        User::updateOrCreate(
            ['email' => 'admin@portal.test'],
            [
                'name' => 'Administrador General',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
                'phone' => '555-1000',
            ]
        );

        User::updateOrCreate(
            ['email' => 'contenido@portal.test'],
            [
                'name' => 'Editor de Contenido',
                'password' => Hash::make('password'),
                'role' => User::ROLE_CONTENT_EDITOR,
                'phone' => '555-2000',
            ]
        );

        User::updateOrCreate(
            ['email' => 'supervisor@portal.test'],
            [
                'name' => 'Supervisor Reportes',
                'password' => Hash::make('password'),
                'role' => User::ROLE_SUPERVISOR,
                'phone' => '555-3000',
            ]
        );

        User::updateOrCreate(
            ['email' => 'tecnico@portal.test'],
            [
                'name' => 'Técnico Demo',
                'password' => Hash::make('password'),
                'role' => User::ROLE_TECHNICIAN,
                'phone' => '555-4000',
            ]
        );

        User::updateOrCreate(
            ['email' => 'it@portal.test'],
            [
                'name' => 'Administrador IT',
                'password' => Hash::make('password'),
                'role' => User::ROLE_IT_MANAGER,
                'phone' => '555-5000',
            ]
        );

        // Tipos de equipo iniciales
        $this->call(AssetTypeSeeder::class);

        // ---------- Catálogo base ----------
        $marcas = [
            ['name' => 'Industrial Pro',  'description' => 'Equipos industriales de alta resistencia.'],
            ['name' => 'TechPower',       'description' => 'Sistemas eléctricos y electrónicos.'],
            ['name' => 'EcoMaq',          'description' => 'Maquinaria sustentable.'],
        ];
        foreach ($marcas as $m) {
            Brand::updateOrCreate(['name' => $m['name']], $m);
        }

        $brandIP = Brand::where('name', 'Industrial Pro')->first();
        $brandTP = Brand::where('name', 'TechPower')->first();

        Machine::updateOrCreate(
            ['name' => 'Compresor IP-3000'],
            ['brand_id' => $brandIP->id, 'model' => 'IP-3000', 'description' => 'Compresor industrial 3HP.']
        );
        Machine::updateOrCreate(
            ['name' => 'Generador TP-500'],
            ['brand_id' => $brandTP->id, 'model' => 'TP-500', 'description' => 'Generador eléctrico 500W.']
        );

        Product::updateOrCreate(
            ['name' => 'Filtro de aceite premium'],
            ['brand_id' => $brandIP->id, 'product_type' => 'Refacción', 'price' => 250.00,
             'description' => 'Filtro de aceite de larga duración.']
        );
        Product::updateOrCreate(
            ['name' => 'Aceite sintético 5W30'],
            ['brand_id' => $brandTP->id, 'product_type' => 'Consumible', 'price' => 450.00,
             'description' => 'Aceite sintético 1 litro.']
        );

        // ---------- Cliente demo ----------
        Client::updateOrCreate(
            ['email' => 'cliente@demo.test'],
            ['name' => 'Cliente Demo', 'company' => 'Industrias Demo S.A.', 'phone' => '555-9999']
        );
    }
}
