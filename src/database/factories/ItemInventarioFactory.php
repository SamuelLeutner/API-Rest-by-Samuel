<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemInventario>
 */
class ItemInventarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomesPadroes = ['Espada', 'Poção de Cura', 'Mapa do Tesouro', 'Tocha', 'Gema Preciosa'];
        $nome = $nomesPadroes[array_rand($nomesPadroes)];

        return [
            'nome' => $nome,
            'valor' => $this->faker->numberBetween(1, 1000),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}
