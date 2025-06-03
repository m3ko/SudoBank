<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\CuentaBancaria;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bizum>
 */
class BizumFactory extends Factory
{
    protected $model = \App\Models\Bizum::class;

    public function definition(): array
    {
        // Obtener un emisor y un receptor diferentes
        $emisor = User::inRandomOrder()->first();
        $receptor = User::where('id', '!=', $emisor->id)->inRandomOrder()->first();

        // Obtener cuentas bancarias asociadas al emisor y receptor
        $cuentaEmisor = CuentaBancaria::where('user_id', $emisor->id)->inRandomOrder()->first();
        $cuentaReceptor = CuentaBancaria::where('user_id', $receptor->id)->inRandomOrder()->first();

        return [
            'id_emisor' => $emisor->id, // ID del emisor
            'id_receptor' => $receptor->id, // ID del receptor
            'cuenta_emisor' => $cuentaEmisor->num_cuenta, // Número de cuenta del emisor
            'cuenta_receptor' => $cuentaReceptor->num_cuenta, // Número de cuenta del receptor
            'monto' => fake()->randomFloat(2, 10, 500), // Monto aleatorio entre 10 y 500
            'fecha_hora' => fake()->dateTimeBetween('-1 month', 'now'), // Fecha y hora reciente
        ];
    }
}