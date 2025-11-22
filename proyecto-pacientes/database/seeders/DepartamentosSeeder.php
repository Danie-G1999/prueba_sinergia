<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('departamentos')->insert([
            ['nombre' => 'Antioquia'],
            ['nombre' => 'Cundinamarca'],
            ['nombre' => 'Valle del Cauca'],
            ['nombre' => 'Santander'],
            ['nombre' => 'Bogotá D.C.']
        ]);
    }
}
