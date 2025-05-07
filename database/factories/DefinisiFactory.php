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
        $date = fake()->dateTimeBetween('-1 year', 'now');
        $verifikasi = random_int(0, 1) === 1 ? now() : NULL;
        return [
            'kosakata_id' => random_int(1, 50),
            'user_id' => random_int(1, 100),
            'poin_kontributor' => 20,
            'poin_verifikasi' => $verifikasi == null ? 0 : 30,
            'poin_pengurus' => $verifikasi == null ? 0 : 30,
            'definisi' => fake()->text(300),
            'bahasa' => random_int(0, 1) == 1 ? 'jawa' : 'indonesia',
            'verifikasi' => $verifikasi,
            'verifikasi_oleh' => $verifikasi == null ? null : random_int(1, 100),
            'created_at' => $date,
            'updated_at' => $date
        ];
    }
}
