<?php

namespace Database\Factories;

use App\Models\Definisi;
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
        // tanggal
        $date = fake()->dateTimeBetween('-1 year', 'now');

        // alasan & catatan
        $alasanCatatanDipilih = random_int(0, 7);
        $alasan = [
            'SPAM',
            'Definisi tidak akurat',
            'Kategori bahasa salah',
            'Mengandung unsur SARA',
            'Scam/penipuan',
            'Mempromosikan barang/jasa',
            'Melanggar hukum',
            'Lain-lain'
        ];
        $catatan = [
            'Akun ini ngirim entri yang sama berulang-ulang tanpa arti yang jelas. Sepertinya cuma nyepam doang.',
            'Penjelasan arti kata ini nggak sesuai. Saya rasa harusnya artinya "rumah"',
            'Kosakata ini dimasukkan ke kategori Krama, padahal ini jelas-jelas ngoko.',
            'Ada kata-kata yang menyinggung suku dan agama tertentu. Nggak pantas ada di kamus umum.',
            'User ini kasih tautan yang mengarah ke situs pinjaman online ilegal. Bisa-bisa orang ketipu.',
            'Kelihatannya dia pakai kamus ini buat promosi jasa translate berbayar.',
            'Ada referensi ke aktivitas ilegal di entri ini. Harap segera ditinjau.',
            'Tolong periksa entri ini. Ada banyak huruf acak dan nggak masuk akal sama sekali. Sepertinya iseng.'
        ];

        // status (untuk status dan pengurus)
        $status = random_int(0, 1);

        // definisi yang dilaporkan
        $definisi = Definisi::find(random_int(1, 100));

        $data = [
            'user_id' => random_int(4, 100),
            'definisi_id' => random_int(4, 100),
            'alasan' => $alasan[$alasanCatatanDipilih],
            'catatan' => $catatan[$alasanCatatanDipilih],
            'status' => $status === 1 ? now() : NULL,
            'pengurus_id' => $status === 1 ? random_int(2, 3) : NULL,
            'catatan_pengurus' => $status === 1 ? 'Jangan diulangi lagi ya' : NULL,
            'poin_pelapor' => $status === 1 ? 20 : null,
            'poin_pengurus' => $status === 1 ? 20 : null,
            'def_dilaporkan' => $definisi->definisi,
            'waktu_definisi' => $definisi->updated_at,
            'created_at' => $date,
            'updated_at' => $date
        ];

        return $data;
    }
}
