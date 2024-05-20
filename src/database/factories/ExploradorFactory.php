<?php

namespace Database\Factories;

use App\Models\Explorador;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Explorador>
 */
class ExploradorFactory extends Factory
{
    protected $model = Explorador::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'idade' => $this->faker->numberBetween(18, 60),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'usuario' => $this->faker->unique()->userName,
            'senha' => fake()->password,
        ];
    }
}
