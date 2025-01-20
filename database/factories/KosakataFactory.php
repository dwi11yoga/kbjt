<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kosakata>
 */
class KosakataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => random_int(1, 100),
            'poin' => 20,
            'kosakata' => fake()->word(),
            'slug' => fake()->word(),
            'ragam' => random_int(1, 2) === '1' ? 'Krama' : 'Ngoko',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
