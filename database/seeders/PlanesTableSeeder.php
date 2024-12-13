<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('planes')->insert([
            [
                'nombre' => 'Plan Basico',
                'dias_duracion' => 30,
                'precio' => 29.99,
                'descripcion' => 'Plan de entrada para nuevos usuarios',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nombre' => 'Plan Premium',
                'dias_duracion' => 90,
                'precio' => 79.99,
                'descripcion' => 'Plan completo con todos los beneficios',
                'activo' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
