<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CuentaBancaria>
 */
class CuentaBancariaFactory extends Factory
{
    protected $model = \App\Models\CuentaBancaria::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(), // Relación con User
            'saldo' => fake()->randomFloat(2, 100, 10000), // Saldo entre 100 y 10,000
            'num_cuenta' => 'ES' . fake()->unique(true, 10000)->numerify('####################'), // Número de cuenta único
            'tipo_moneda' => 'EUR', // Moneda fija
        ];
    }
}