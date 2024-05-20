<?php

namespace Database\Factories;

use App\Models\HistoricoLocalizacao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistoricoLocalizacao>
 */
class HistoricoLocalizacaoFactory extends Factory
{
    protected $model = HistoricoLocalizacao::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'created_at' => now(),
            'explorador_id' => null,
        ];
    }
}
