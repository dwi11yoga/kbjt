<?php

namespace Database\Seeders;

use App\Models\Kosakata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KosakataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // KOSAKATA
        // sumber detik.com
        $indonesia = ['Saya', 'Kamu', 'Kami', 'Dia', 'Ini', 'Itu', 'Apa', 'Di mana', 'Yang Mana', 'Siapa', 'Mengapa', 'Bagaimana', 'Ya', 'Tidak', 'Barangkali', 'Satu', 'Tiga', 'Empat', 'Lima', 'Sepuluh', 'Seratus', 'Seribu', 'Orang', 'Laki-Laki', 'Perempuan', 'Ayah', 'Ibu', 'Anak', 'Nama', 'Uang', 'Kamar Kecil', 'Air', 'Jalan', 'Kira-Kira', 'Semua', 'Lebih', 'Sangat', 'Dari', 'Ke', 'Sekarang', 'Baru', 'Tua', 'Panjang', 'Pendek', 'Murah', 'Mahal', 'Panas', 'Dingin', 'Kemarin', 'Besok', 'Atas', 'Bawah', 'Lapar', 'Sakit', 'Maaf', 'Pagi', 'Siang', 'Malam', 'Apa Kabar', 'Berapa', 'Silahkan', 'Terima Kasih', 'Belum', 'Karena', 'Di sini', 'Baik', 'Jelek', 'Betul', 'Besar', 'Kecil', 'Banyak', 'Sedikit', 'Sama', 'Bisa', 'Punya', 'Ada', 'Mau', 'Jangan', 'Pergi', 'Datang', 'Berjalan', 'Bicara', 'Bilang', 'Lihat', 'Makan', 'Minum', 'Dengar', 'Tahu', 'Kasi', 'Cinta', 'Pikir', 'Membuat', 'Duduk', 'Potong', 'Beli', 'Berhenti', 'Jauh', 'Dekat'];
        $ngoko = ['Kula', 'Kowe', 'Awake dhewe', 'Dheweke', 'Iki', 'Kuwi', 'Apa', 'Ngendhi', 'Sing endhi', 'Sapa', 'Ngapa', 'Piye', 'Yoh', 'Ora', 'Menawa', 'Siji', 'Telu', 'Papat', 'Lima', 'Sepuluh', 'Satus', 'Sewu', 'Uwong', 'Lanang', 'Wedok', 'Bapak', 'Mbok', 'Lare', 'Jeneng', 'Duwit', 'Mburi', 'Banyu', 'Dalan', 'Kira-Kira', 'Kabeh', 'Luwih', 'Banget', 'Seka', 'Saling', 'Saiki', 'Anyar', 'Tuwa', 'Dawa', 'Cendhek', 'Murah', 'Larang', 'Panas', 'Adem', 'Wingi', 'Sesuk', 'Ndhuwur', 'Ngisar', 'Ngelih', 'Lara', 'Ngapunten', 'Esuk', 'Awan', 'Bengi', 'Piye kabare', 'Pira', 'Mangga', 'Muwun', 'Durung', 'Sebabe', 'Nangkene', 'Apik', 'Elek', 'Bener', 'Gedhe', 'Cilik', 'Akeh', 'Sithik', 'Padha', 'Isa', 'Duwe', 'Ana', 'Gelem', 'Aja', 'Lunga', 'Teka', 'Mlaku', 'Omong', 'Ngomong', 'Ndelok', 'Mangan', 'Ngombe', 'Krungu', 'Ngerti', 'Wenehi', 'Seneng', 'Pikir', 'Nggawe', 'Lungguh', 'Tugel', 'Tuku', 'Mangdheg', 'Adoh', 'Cedhak'];
        $krama = ['Dalem', 'Panjenengan', 'Kita', 'Piyambakipun', 'Menika', 'Niku', 'Menapa', 'Wonten Pundhi', 'Ingkang pundhi', 'Sinten', 'Kadhasmenapa', 'Kadhospundi', 'Inggih', 'Mboten', 'Menawi', 'Setunggal', 'Tiga', 'Sekawan', 'Gangsal', 'Sedasa', 'Setunggalatus', 'Setunggalewu', 'Tiyang', 'Kakung', 'Estri', 'Rama', 'Ibu', 'Putra', 'Asma', 'Arta', '(Kamar) Wingking', 'Toya', 'Mergi', 'Kinten-Kinten', 'Sedanten', 'Langkung', 'Sanget', 'Saking', 'Dateng', 'Sakmenika', 'Enggal', 'Sepuh', 'Panjang', 'Cendhak', 'Mirah', 'Awis', 'Benther', 'Asrep', 'Kalawingi', 'Mbenjang', 'Nginggil', 'Ngandhap', 'Luwe', 'Gerah', 'Ngapura', 'Enjing-Injing', 'Siang', 'Dalu', 'Pripun kabaripun', 'Pinten', 'Manggapunaturi', 'Maturnuwun', 'Dereng', 'Amargi', 'Wonten mriki', 'Sae', 'Kirang sae', 'Leres', 'Ageng', 'Alit', 'Kathah', 'Sakedhik', 'Sami', 'Saget', 'Kagungan', 'Wonten', 'Kersa', 'Ampun', 'Tindak', 'Rawuh', 'Mlampah', 'Ngendika', 'Dhawuh', 'Mrisani', 'Dhahar', 'Ngunjuk', 'Mireng', 'Ngertos', 'Paringi', 'Tresna', 'Penggalih', 'Nadamel', 'Pinarak', 'Potong', 'Tumbas', 'Kendhel', 'Tebih', 'Cerak'];

        // masukkan ke dalam array yang akan disimpan
        // ngoko
        for ($i = 0; $i < count($ngoko); $i++) {
            $waktu = fake()->dateTimeBetween('-1 year', 'now');
            $kosakataNgoko[$i] = [
                'kosakata' => $ngoko[$i],
                'slug' => strtolower(str_replace(' ', '-', $ngoko[$i])),
                'ragam' => 'Ngoko',
                'user_id' => random_int(1, 100),
                'arti_indo' => $indonesia[$i],
                'serupa' => json_encode([$krama[$i]]),
                // 'serupa' => json_encode($krama[$i]),
                'created_at' => $waktu,
                'updated_at' => $waktu
            ];
        }
        // krama
        for ($i = 0; $i < count($krama); $i++) {
            $waktu = fake()->dateTimeBetween('-1 year', 'now');
            $kosakataKrama[$i] = [
                'kosakata' => $krama[$i],
                'slug' => strtolower(str_replace(' ', '-', $krama[$i])),
                'ragam' => 'Krama',
                'user_id' => random_int(1, 100),
                'arti_indo' => $indonesia[$i],
                'serupa' => json_encode([$ngoko[$i]]),
                // 'serupa' => json_encode($ngoko[$i]),
                'created_at' => $waktu,
                'updated_at' => $waktu
            ];
        }

        // tambah kosakata madaran
        Kosakata::create([
            'kosakata' => 'Madaran',
            'slug' => 'madaran',
            'ragam' => 'Krama',
            'aksara' => 'ꦩꦢꦫꦤ꧀',
            'jenis' => 'Tembung aran',
            'notasi_fonetik' => 'ma-da-ran',
            'arti_indo' => 'Perut',
            'etimologi' => ['Asli'],
            'user_id' => random_int(2, 3),
            'serupa' => ['Weteng'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // kombinasikan kosakata
        $kosakata = array_merge($kosakataNgoko, $kosakataKrama);
        Kosakata::insert($kosakata);

        // factory
        // Kosakata::factory(50)->create();
    }
}
