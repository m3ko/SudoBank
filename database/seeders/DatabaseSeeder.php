<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\CuentaBancaria;
use App\Models\Tarjeta;
use App\Models\Bizum;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear usuarios
        $usuarios = User::factory(10)->create();

        // Crear cuentas bancarias para cada usuario
        foreach ($usuarios as $usuario) {
            $cuentas = CuentaBancaria::factory(rand(1, 3))->create([
                'user_id' => $usuario->id,
            ]);

            // Crear tarjetas para cada cuenta bancaria
            foreach ($cuentas as $cuenta) {
                Tarjeta::factory(rand(1, 2))->create([
                    'cuenta_bancaria_id' => $cuenta->id,
                ]);
            }
        }

        // Crear transacciones Bizum entre usuarios
        $usuariosIds = $usuarios->pluck('id')->toArray();
        for ($i = 0; $i < 20; $i++) {
            $emisorId = $usuariosIds[array_rand($usuariosIds)];
            $receptorId = $usuariosIds[array_rand($usuariosIds)];

            // Evitar que el emisor y receptor sean el mismo usuario
            while ($emisorId === $receptorId) {
                $receptorId = $usuariosIds[array_rand($usuariosIds)];
            }

            $cuentaEmisor = CuentaBancaria::where('user_id', $emisorId)->inRandomOrder()->first();
            $cuentaReceptor = CuentaBancaria::where('user_id', $receptorId)->inRandomOrder()->first();

            if ($cuentaEmisor && $cuentaReceptor) {
                Bizum::create([
                    'id_emisor' => $emisorId,
                    'id_receptor' => $receptorId,
                    'cuenta_emisor' => $cuentaEmisor->num_cuenta,
                    'cuenta_receptor' => $cuentaReceptor->num_cuenta,
                    'fecha_hora' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}