<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipios = [
            // Antioquia (id = 1)
            ['departamento_id' => 1, 'nombre' => 'Medellín'],
            ['departamento_id' => 1, 'nombre' => 'Envigado'],

            // Cundinamarca (id = 2)
            ['departamento_id' => 2, 'nombre' => 'Bogotá'],
            ['departamento_id' => 2, 'nombre' => 'Soacha'],

            // Valle del Cauca (id = 3)
            ['departamento_id' => 3, 'nombre' => 'Cali'],
            ['departamento_id' => 3, 'nombre' => 'Palmira'],

            // Santander (id = 4)
            ['departamento_id' => 4, 'nombre' => 'Bucaramanga'],
            ['departamento_id' => 4, 'nombre' => 'Floridablanca'],

            // Atlántico (id = 5)
            ['departamento_id' => 5, 'nombre' => 'Barranquilla'],
            ['departamento_id' => 5, 'nombre' => 'Soledad'],
        ];

        DB::table('municipios')->insert($municipios);
    }
}
