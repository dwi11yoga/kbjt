<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Definisi>
 */
class DefinisiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kosakata_id' => random_int(1, 50),
            'user_id' => 1,
            'poin' => 10,
            'definisi' => fake()->text(300),
            'verifikasi' => random_int(0, 1) === 1 ? now() : NULL,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
