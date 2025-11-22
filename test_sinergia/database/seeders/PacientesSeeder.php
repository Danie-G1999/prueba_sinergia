<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pacientes')->insert([
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '10000001',
                'nombre1' => 'Carlos',
                'nombre2' => 'Andrés',
                'apellido1' => 'Pérez',
                'apellido2' => 'Gómez',
                'genero_id' => 1,
                'departamento_id' => 1,
                'municipio_id' => 1,
                'correo' => 'carlos@example.com',
            ],
            [
                'tipo_documento_id' => 2,
                'numero_documento' => '20000002',
                'nombre1' => 'Laura',
                'nombre2' => 'María',
                'apellido1' => 'Rodríguez',
                'apellido2' => 'López',
                'genero_id' => 2,
                'departamento_id' => 2,
                'municipio_id' => 3,
                'correo' => 'laura@example.com',
            ],
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '30000003',
                'nombre1' => 'Miguel',
                'nombre2' => null,
                'apellido1' => 'Ramírez',
                'apellido2' => 'Torres',
                'genero_id' => 1,
                'departamento_id' => 3,
                'municipio_id' => 5,
                'correo' => 'miguel@example.com',
            ],
            [
                'tipo_documento_id' => 2,
                'numero_documento' => '40000004',
                'nombre1' => 'Ana',
                'nombre2' => 'Lucía',
                'apellido1' => 'Martínez',
                'apellido2' => 'Santos',
                'genero_id' => 2,
                'departamento_id' => 4,
                'municipio_id' => 7,
                'correo' => 'ana@example.com',
            ],
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '50000005',
                'nombre1' => 'Jorge',
                'nombre2' => 'Luis',
                'apellido1' => 'Hernández',
                'apellido2' => 'Mora',
                'genero_id' => 1,
                'departamento_id' => 5,
                'municipio_id' => 9,
                'correo' => 'jorge@example.com',
            ],
        ]);
    }
}
