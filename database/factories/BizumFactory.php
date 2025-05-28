<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bizum>
 */
class BizumFactory extends Factory
{
    protected $model = \App\Models\Bizum::class;

    public function definition(): array
    {
        return [
            'id_emisor' => \App\Models\User::factory(), // Relación con User (emisor)
            'id_receptor' => \App\Models\User::factory(), // Relación con User (receptor)
            'cuenta_emisor' => \App\Models\CuentaBancaria::factory()->create()->num_cuenta, // Número de cuenta del emisor
            'cuenta_receptor' => \App\Models\CuentaBancaria::factory()->create()->num_cuenta, // Número de cuenta del receptor
            'fecha_hora' => fake()->dateTimeBetween('-1 month', 'now'), // Fecha y hora reciente
        ];
    }
}