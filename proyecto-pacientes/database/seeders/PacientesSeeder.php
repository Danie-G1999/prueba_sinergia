<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacientesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pacientes')->insert([
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '12345678',
                'nombre1' => 'Juan',
                'nombre2' => 'Carlos',
                'apellido1' => 'Pérez',
                'apellido2' => 'Gómez',
                'genero_id' => 1,
                'departamento_id' => 1,
                'municipio_id' => 1,
                'correo' => 'juan.perez@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_documento_id' => 2,
                'numero_documento' => '87654321',
                'nombre1' => 'María',
                'nombre2' => 'Elena',
                'apellido1' => 'Rodríguez',
                'apellido2' => 'López',
                'genero_id' => 2,
                'departamento_id' => 2,
                'municipio_id' => 3,
                'correo' => 'maria.rodriguez@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '11223344',
                'nombre1' => 'Pedro',
                'nombre2' => 'José',
                'apellido1' => 'Martínez',
                'apellido2' => 'Ramírez',
                'genero_id' => 1,
                'departamento_id' => 3,
                'municipio_id' => 5,
                'correo' => 'pedro.martinez@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_documento_id' => 2,
                'numero_documento' => '44332211',
                'nombre1' => 'Laura',
                'nombre2' => 'Paola',
                'apellido1' => 'García',
                'apellido2' => 'Sánchez',
                'genero_id' => 2,
                'departamento_id' => 4,
                'municipio_id' => 7,
                'correo' => 'laura.garcia@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tipo_documento_id' => 1,
                'numero_documento' => '55667788',
                'nombre1' => 'Andrés',
                'nombre2' => 'Fabián',
                'apellido1' => 'Vargas',
                'apellido2' => 'Hernández',
                'genero_id' => 1,
                'departamento_id' => 5,
                'municipio_id' => 9,
                'correo' => 'andres.vargas@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
