<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarjeta>
 */
class TarjetaFactory extends Factory
{
    protected $model = \App\Models\Tarjeta::class;

    public function definition(): array
    {
        return [
            'cuenta_bancaria_id' => \App\Models\CuentaBancaria::factory(), // Relación con CuentaBancaria
            'tipo_tarjeta' => fake()->randomElement(['credito', 'debito']), // Tipo de tarjeta
            'fecha_expiracion' => fake()->dateTimeBetween('now', '+5 years'), // Fecha de expiración futura
        ];
    }
}