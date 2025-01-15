<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\tripulantes;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        tripulantes::create([
            'nombre' => 'Juan',
            'apellido' => 'Alberto',
            'Rol' => 'capitan',
            'fecha_incorporacion' => '2024/12/12',
            'fecha_baja' => '2024/12/12'
        ]);


    }
}
