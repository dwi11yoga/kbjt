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
        $data = [
            'user_id' => random_int(1, 100),
            'definisi_id' => random_int(1, 100),
            'alasan' => 'SPAM',
            // 'status' => random_int(0, 1) === 1 ? now() : NULL,
            'catatan' => fake()->sentence(15),
            'def_dilaporkan' => fake()->text(100),
            'waktu_definisi' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ];
        // $random = random_int(0, 1);
        // if ($random == 1) {
        //     $data['pengurus_id'] = 1;
        //     $data['status'] = now();
        // }
        return $data;
    }
}
