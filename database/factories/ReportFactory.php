<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'definisi_id' => random_int(1, 100),
            'status' => random_int(0, 1) === 1 ? now() : NULL,
            'jenis' => 'SPAM',
            'keterangan' => fake()->sentence(15),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
