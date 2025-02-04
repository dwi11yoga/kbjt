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
        $date = fake()->dateTimeBetween('-1 year', 'now');
        return [
            'user_id' => random_int(1, 100),
            'poin' => 20,
            'kosakata' => fake()->word(),
            'slug' => fake()->unique()->word,
            'ragam' => random_int(1, 2) === '1' ? 'Krama' : 'Ngoko',
            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}
