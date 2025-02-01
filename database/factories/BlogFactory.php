<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'judul' => fake()->sentence(),
            'slug' => fake()->slug(),
            'subjudul' => fake()->sentence(10),
            'user_id' => 1,
            'konten' => fake()->text(10000),
            'status' => random_int(0, 1),
        ];
    }
}
