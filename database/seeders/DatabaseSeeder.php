<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tripulantes;
use App\Models\Medicos;
use App\Models\Viajes;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illumuniate;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Tripulantes::create([
        //     'nombre' => 'Juan',
        //     'apellido' => 'Alberto',
        //     'Rol' => 'capitan',
        //     'fecha_incorporacion' => '2024/12/12',
        //     'fecha_baja' => '2024/12/12'
        // ]);
        // Medicos::create([
        //     'nombre' => 'Juan',
        //     'apellido' => 'Alberto',
        //     'fecha_incorporacion' => '2024/12/12',
        //     'fecha_baja' => '2024/12/12'
        // ]);
        // Viajes::create([
        //     'origen'=>'España',
        //     'destino'=>'Tanzania',
        //     'fecha_hora'=>'2022/02/02'
        // ]);

        $this->call([
            PermisosSeeder::class
        ]);




    }
}
