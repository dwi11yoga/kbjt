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
        // $indonesia = ['Saya', 'Kamu', 'Kami', 'Dia', 'Ini', 'Itu', 'Apa', 'Di mana', 'Yang Mana', 'Siapa', 'Mengapa', 'Bagaimana', 'Ya', 'Tidak', 'Barangkali', 'Satu', 'Tiga', 'Empat', 'Lima', 'Sepuluh', 'Seratus', 'Seribu', 'Orang', 'Laki-Laki', 'Perempuan', 'Ayah', 'Ibu', 'Anak', 'Nama', 'Uang', 'Kamar Kecil', 'Air', 'Jalan', 'Kira-Kira', 'Semua', 'Lebih', 'Sangat', 'Dari', 'Ke', 'Sekarang', 'Baru', 'Tua', 'Panjang', 'Pendek', 'Murah', 'Mahal', 'Panas', 'Dingin', 'Kemarin', 'Besok', 'Atas', 'Bawah', 'Lapar', 'Sakit', 'Maaf', 'Pagi', 'Siang', 'Malam', 'Apa Kabar', 'Berapa', 'Silahkan', 'Terima Kasih', 'Belum', 'Karena', 'Di sini', 'Baik', 'Jelek', 'Betul', 'Besar', 'Kecil', 'Banyak', 'Sedikit', 'Sama', 'Bisa', 'Punya', 'Ada', 'Mau', 'Jangan', 'Pergi', 'Datang', 'Berjalan', 'Bicara', 'Bilang', 'Lihat', 'Makan', 'Minum', 'Dengar', 'Tahu', 'Kasi', 'Cinta', 'Pikir', 'Membuat', 'Duduk', 'Potong', 'Beli', 'Berhenti', 'Jauh', 'Dekat'];
        // $ngoko = ['Kula', 'Kowe', 'Awake dhewe', 'Dheweke', 'Iki', 'Kuwi', 'Apa', 'Ngendhi', 'Sing endhi', 'Sapa', 'Ngapa', 'Piye', 'Yoh', 'Ora', 'Menawa', 'Siji', 'Telu', 'Papat', 'Lima', 'Sepuluh', 'Satus', 'Sewu', 'Uwong', 'Lanang', 'Wedok', 'Bapak', 'Mbok', 'Lare', 'Jeneng', 'Duwit', 'Mburi', 'Banyu', 'Dalan', 'Kira-Kira', 'Kabeh', 'Luwih', 'Banget', 'Seka', 'Saling', 'Saiki', 'Anyar', 'Tuwa', 'Dawa', 'Cendhek', 'Murah', 'Larang', 'Panas', 'Adem', 'Wingi', 'Sesuk', 'Ndhuwur', 'Ngisar', 'Ngelih', 'Lara', 'Ngapunten', 'Esuk', 'Awan', 'Bengi', 'Piye kabare', 'Pira', 'Mangga', 'Muwun', 'Durung', 'Sebabe', 'Nangkene', 'Apik', 'Elek', 'Bener', 'Gedhe', 'Cilik', 'Akeh', 'Sithik', 'Padha', 'Isa', 'Duwe', 'Ana', 'Gelem', 'Aja', 'Lunga', 'Teka', 'Mlaku', 'Omong', 'Ngomong', 'Ndelok', 'Mangan', 'Ngombe', 'Krungu', 'Ngerti', 'Wenehi', 'Seneng', 'Pikir', 'Nggawe', 'Lungguh', 'Tugel', 'Tuku', 'Mangdheg', 'Adoh', 'Cedhak'];
        // $krama = ['Dalem', 'Panjenengan', 'Kita', 'Piyambakipun', 'Menika', 'Niku', 'Menapa', 'Wonten Pundhi', 'Ingkang pundhi', 'Sinten', 'Kadhasmenapa', 'Kadhospundi', 'Inggih', 'Mboten', 'Menawi', 'Setunggal', 'Tiga', 'Sekawan', 'Gangsal', 'Sedasa', 'Setunggalatus', 'Setunggalewu', 'Tiyang', 'Kakung', 'Estri', 'Rama', 'Ibu', 'Putra', 'Asma', 'Arta', 'Wingking', 'Toya', 'Mergi', 'Kinten-Kinten', 'Sedanten', 'Langkung', 'Sanget', 'Saking', 'Dateng', 'Sakmenika', 'Enggal', 'Sepuh', 'Panjang', 'Cendhak', 'Mirah', 'Awis', 'Benther', 'Asrep', 'Kalawingi', 'Mbenjang', 'Nginggil', 'Ngandhap', 'Luwe', 'Gerah', 'Ngapura', 'Enjing-Injing', 'Siang', 'Dalu', 'Pripun kabaripun', 'Pinten', 'Manggapunaturi', 'Maturnuwun', 'Dereng', 'Amargi', 'Wonten mriki', 'Sae', 'Kirang sae', 'Leres', 'Ageng', 'Alit', 'Kathah', 'Sakedhik', 'Sami', 'Saget', 'Kagungan', 'Wonten', 'Kersa', 'Ampun', 'Tindak', 'Rawuh', 'Mlampah', 'Ngendika', 'Dhawuh', 'Mrisani', 'Dhahar', 'Ngunjuk', 'Mireng', 'Ngertos', 'Paringi', 'Tresna', 'Penggalih', 'Nadamel', 'Pinarak', 'Potong', 'Tumbas', 'Kendhel', 'Tebih', 'Cerak'];

        // // masukkan ke dalam array yang akan disimpan
        // // ngoko
        // for ($i = 0; $i < count($ngoko); $i++) {
        //     $waktu = fake()->dateTimeBetween('-1 year', 'now');
        //     $kosakataNgoko[$i] = [
        //         'kosakata' => $ngoko[$i],
        //         'slug' => strtolower(str_replace(' ', '-', $ngoko[$i])),
        //         'ragam' => 'Ngoko',
        //         'poin' => 50,
        //         'user_id' => random_int(1, 100),
        //         'arti_indo' => $indonesia[$i],
        //         'serupa' => json_encode([$krama[$i]]),
        //         // 'serupa' => json_encode($krama[$i]),
        //         'created_at' => $waktu,
        //         'updated_at' => $waktu
        //     ];
        // }
        // // krama
        // for ($i = 0; $i < count($krama); $i++) {
        //     $waktu = fake()->dateTimeBetween('-1 year', 'now');
        //     $kosakataKrama[$i] = [
        //         'kosakata' => $krama[$i],
        //         'slug' => strtolower(str_replace(' ', '-', $krama[$i])),
        //         'ragam' => 'Krama',
        //         'poin' => 50,
        //         'user_id' => random_int(1, 100),
        //         'arti_indo' => $indonesia[$i],
        //         'serupa' => json_encode([$ngoko[$i]]),
        //         // 'serupa' => json_encode($ngoko[$i]),
        //         'created_at' => $waktu,
        //         'updated_at' => $waktu
        //     ];
        // }

        // tambah kosakata madaran
        Kosakata::create([
            'kosakata' => 'Madharan',
            'slug' => 'madharan',
            'ragam' => 'Krama',
            'aksara' => 'ꦩꦢꦫꦤ꧀',
            'jenis' => 'Tembung aran',
            'notasi_fonetik' => 'ma-da-ran',
            'arti_indo' => 'Perut',
            'etimologi' => ['Asli'],
            'poin' => 50,
            'user_id' => random_int(2, 3),
            'serupa' => ['Weteng'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // // kombinasikan kosakata
        // $kosakata = array_merge($kosakataNgoko, $kosakataKrama);
        // Kosakata::insert($kosakata);

        // data kosakata
        // sumber: https://id.wiktionary.org/wiki/Lampiran:Kamus_bahasa_Jawa_%E2%80%93_bahasa_Indonesia#D
        $data = [
            [
                'kosakata' => 'aba-aba',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'abab',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'aban',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'aban-aban',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'abang',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'abar',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'abdi',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ables',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'aboh',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'abot',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'abrit',
                'jenis' => 'Tembung kaanan',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'abuh',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'abyor',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'acung',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ada-ada',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'adang',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'adas',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'adhang',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ngadhang',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'adhem',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'adhep',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ngadhep',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'adhi',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'adi',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'adil',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'adoh',
                'jenis' => 'Tembung katrangan',
            ],
            [
                'kosakata' => 'adol',
            ],
            [
                'kosakata' => 'ngedol',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'dodolan',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'adreng',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'adu-adu',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'adu',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'adus',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'agama',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'agem',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ageman',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ageng',
                'jenis' => 'Tembung kaanan',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'agni',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'agul-agul',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'agung',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'agèk',
            ],
            [
                'kosakata' => 'aja',
                'jenis' => 'Tembung panguwuh',
            ],
            [
                'kosakata' => 'ajag',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ajak',
            ],
            [
                'kosakata' => 'ngajak',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ajang',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ajar',
            ],
            [
                'kosakata' => 'ngajar',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ajeg',
                'jenis' => 'Tembung katrangan',
            ],
            [
                'kosakata' => 'ajeng',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'aji',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ngajeni',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ajur',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'akas',
            ],
            [
                'kosakata' => 'akil',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'aking',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'akon',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'akèh',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'ala',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'alang-alang',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'alangan',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'alas',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'alem',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'aleman',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'alesan',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ali-ali',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'aling',
            ],
            [
                'kosakata' => 'aling-aling',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'alis',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'alit',
                'jenis' => 'Tembung kaanan',
                'ragam'=>'Krama'
            ],
            [
                'kosakata' => 'alok',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'alon',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'alot',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'alu',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'alum',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'alun-alun',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'alus',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'aluwung',
            ],
            [
                'kosakata' => 'ama',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'aman',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'amarga',
                'jenis' => 'Tembung panggandheng',
            ],
            [
                'kosakata' => 'amargi',
                'jenis' => 'Tembung panggandheng',
            ],
            [
                'kosakata' => 'amba',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'ambah',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ambal',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ambar',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ambyar',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ambeg',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'ambegan',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'amburat',
                'jenis' => 'Tembung kriya',
                'ragam'=>'Krama'
            ],
            [
                'kosakata' => 'ambet',
                'jenis' => 'Tembung aran',
                'ragam'=>'Krama'
            ],
            [
                'kosakata' => 'amblas',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'ambleg',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'ambles',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ambrol',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ambruk',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ambu',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ambung',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ambus',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ambyuk',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ambyur',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ambèn',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ambèr',
                'jenis' => 'Tembung katrangan',
            ],
            [
                'kosakata' => 'ambèr-ambèr',
            ],
            [
                'kosakata' => 'amem',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'amis',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'amit',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'amor',
            ],
            [
                'kosakata' => 'amot',
            ],
            [
                'kosakata' => 'ngemot',
            ],
            [
                'kosakata' => 'ampak-ampak',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ampas',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ampek',
                'jenis' => 'Tembung katrangan',
            ],
            [
                'kosakata' => 'ampil',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'amping-amping',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ampo',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ampung',
            ],
            [
                'kosakata' => 'ngampung',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'amrih',
                'jenis' => 'Tembung panggandheng',
            ],
            [
                'kosakata' => 'amung',
            ],
            [
                'kosakata' => 'namung',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'amèk',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ana',
            ],
            [
                'kosakata' => 'anane',
            ],
            [
                'kosakata' => 'nganak-nganaké',
            ],
            [
                'kosakata' => 'anak',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'anak mas',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'nganakké',
            ],
            [
                'kosakata' => 'anakan',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ancang-ancang',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ancas',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ancer-ancer',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ancik',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ancur',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'anda',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'andaka',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'andha',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'andhang',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'andhap',
                'jenis' => 'Tembung aran',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'andheng-andheng',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'andhok',
            ],
            [
                'kosakata' => 'andhong',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'andika',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'andum',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'angen-angen',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'anget',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'angga',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'anggak',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'anggara',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'anggarbini',
            ],
            [
                'kosakata' => 'anggas',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'anggep',
            ],
            [
                'kosakata' => 'nganggep',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'angger-angger',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'angger',
            ],
            [
                'kosakata' => 'anggit',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'anggon',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'manggon',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'anggur',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'angin',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'angin-angin',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'angkah',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'angkara',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'angker',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'angler',
                'jenis' => 'Tembung katrangan',
            ],
            [
                'kosakata' => 'angluh',
                'jenis' => 'Tembung katrangan',
            ],
            [
                'kosakata' => 'angon',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'angop',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'angsal',
                'jenis' => 'Tembung kriya',
                'ragam'=>'Krama',
            ],
            [
                'kosakata' => 'angslup',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'angslé',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'angsul',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'angsul-angsul',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'angur',
            ],
            [
                'kosakata' => 'angus',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'angèl',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'kangèlan',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'anjlog',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'anjlok',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'anjok',
                'jenis' => 'Tembung ancer-ancer',
            ],
            [
                'kosakata' => 'anom',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'anta',
            ],
            [
                'kosakata' => 'antawacana',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'antawis',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'antem',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'anteng',
            ],
            [
                'kosakata' => 'antep',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'anthuk',
            ],
            [
                'kosakata' => 'anting',
            ],
            [
                'kosakata' => 'antop',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'antu',
            ],
            [
                'kosakata' => 'antuk',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'pikantuk',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'anut',
            ],
            [
                'kosakata' => 'anut-grubyuk',
            ],
            [
                'kosakata' => 'anyang-anyangen',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'anyang',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'anyar',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'nganyari',
            ],
            [
                'kosakata' => 'anyel',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'anyep',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'anyes',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'anyir',
            ],
            [
                'kosakata' => 'anèh',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'anèm',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'apa',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'apal',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'apek',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'apem',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'apes',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'api-api',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'apik',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'apu',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'apura',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'apus',
            ],
            [
                'kosakata' => 'kapusan',
            ],
            [
                'kosakata' => 'ngapusi',
            ],
            [
                'kosakata' => 'ara-ara',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'arah',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'aran',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'arang-arang',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'arang',
                'jenis' => 'Tembung katrangan',
            ],
            [
                'kosakata' => 'aras',
            ],
            [
                'kosakata' => 'aren',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'areng',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'arep',
            ],
            [
                'kosakata' => 'ngarepaké',
            ],
            [
                'kosakata' => 'ngarep-arep',
            ],
            [
                'kosakata' => 'arga',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ari-ari',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ari',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'arip',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'karipan',
            ],
            [
                'kosakata' => 'aris',
                'jenis' => 'Tembung katrangan',
            ],
            [
                'kosakata' => 'arit',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'arsa',
            ],
            [
                'kosakata' => 'pangarsa',
            ],
            [
                'kosakata' => 'arta',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'aruh-aruh',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'arum',
            ],
            [
                'kosakata' => 'arus',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'arwah',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'asah',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'asal',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'asat',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'asem',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'asih',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'asin',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'asma',
                'jenis' => 'Tembung aran',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'asmara',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'asmarandana',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'asor',
            ],
            [
                'kosakata' => 'asrep',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'asri',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'asta',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'ngasta',
                'ragam' => 'krama',
            ],
            [
                'kosakata' => 'asu',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'asuh',
            ],
            [
                'kosakata' => 'asung',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ati-ati',
                'jenis' => 'Tembung katrangan',
            ],
            [
                'kosakata' => 'ati',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ngati-ati',
            ],
            [
                'kosakata' => 'atis',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'atos',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'atur',
            ],
            [
                'kosakata' => 'aturi',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'atus',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'atut',
            ],
            [
                'kosakata' => 'awak',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'awan',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'awang-awang',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'awang',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'awas',
            ],
            [
                'kosakata' => 'awis-awis',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'awis',
                'jenis' => 'Tembung katrangan',
            ],
            [
                'kosakata' => 'awit',
                'jenis' => 'Tembung panggandheng',
            ],
            [
                'kosakata' => 'awoh',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'awon-awon',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'awor',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'awrat',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'awu',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'awu-awu',
            ],
            [
                'kosakata' => 'awur',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'awut',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'awèh',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'awèt',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'ayahan',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ayam',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'ayem',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'ayo',
                'jenis' => 'Tembung panguwuh',
            ],
            [
                'kosakata' => 'ayom',
                'jenis' => 'Tembung kriya',
            ],
            [
                'kosakata' => 'ayu',
                'jenis' => 'Tembung kaanan',
            ],
            [
                'kosakata' => 'aywa',
                'jenis' => 'Tembung panguwuh',
            ],
            [
                'kosakata' => 'bab',
                'jenis' => 'Tembung aran',
            ],
            [
                'kosakata' => 'babad',
                'jenis' => 'Tembung aran',
            ],
        
            [
                'kosakata'=>'babagan',
        
            ],
        [
            'kosakata'=>'babah',
        ],
        [
            'kosakata'=>'babal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'babar',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'babaran',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'babat',
        ],
        [
            'kosakata'=>'babi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'babit',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bablas',
        ],
        [
            'kosakata'=>'kebablasen',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'babon',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'babu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'babut',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bacem',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bacin',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bacok',
        ],
        [
            'kosakata'=>'bacokan',
        ],
        [
            'kosakata'=>'bacut',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'kebacut',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'badan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'badhé',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'badhèk',
        ],
        [
            'kosakata'=>'badhèk-badhèkan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'badheg',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'badhug',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bagaskara',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bagus',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bahu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bahureksa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bajang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bajigur',
        ],
        [
            'kosakata'=>'bajing',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bajingan',
        ],
        [
            'kosakata'=>'bajul',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bakal',
        ],
        [
            'kosakata'=>'bakar',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bakda',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'bakul',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bal',
        ],
        [
            'kosakata'=>'bal-balan',
        ],
        [
            'kosakata'=>'bala',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'balak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'balang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bali',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'balung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'balèn',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'balé',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bamban',
        ],
        [
            'kosakata'=>'ban',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'banaspati',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'banci',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'banda',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bandan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bebandan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bandar',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bandayuda',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bandha',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bandhang',
        ],
        [
            'kosakata'=>'bandhem',
        ],
        [
            'kosakata'=>'bandhil',
        ],
        [
            'kosakata'=>'bandhit',
        ],
        [
            'kosakata'=>'bandhot',
        ],
        [
            'kosakata'=>'bandhul',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'banger',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'banget',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'bangga',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bangir',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bangka',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bangku',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bangkèkan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bangkèlan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bangké',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bangsa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'banjar',
        ],
        [
            'kosakata'=>'banjir',
        ],
        [
            'kosakata'=>'banjur',
        ],
        [
            'kosakata'=>'banon',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bantah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bantal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bantala',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bantaran',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bantat',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'banting',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'banyak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'banyu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bapa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bapak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bapang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bar',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'barang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'barat',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'barep',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'baris',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'baruna',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'barung',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'barès',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'baskara',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'baskom',
        ],
        [
            'kosakata'=>'bata',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'batang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bathang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'mbathang',
        ],
        [
            'kosakata'=>'bathara',
            'jenis'=>'Tembung panyilah',
        ],
        [
            'kosakata'=>'bathari',
            'jenis'=>'Tembung panyilah',
        ],
        [
            'kosakata'=>'bathi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'mbathi',
        ],
        [
            'kosakata'=>'bathok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bathuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'batih',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'batur',
        ],
        [
            'kosakata'=>'baut',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bawa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bawang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bawang lanang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bawera',
        ],
        [
            'kosakata'=>'bawèl',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'baya',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bayan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bayar',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bayaran',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bayem',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bayi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bayu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bayèn',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bebana',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bebasan',
        ],
        [
            'kosakata'=>'bebaya',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bebayu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bebed',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bebedhag',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bebendhu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bebet',
        ],
        [
            'kosakata'=>'bebrayan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bebucal',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bebudhen',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bebungah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bebuwang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'becik',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'becus',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bedaya',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bedhal',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bedhat',
        ],
        [
            'kosakata'=>'bedhidhing',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bedhigasan',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bedhil',
        ],
        [
            'kosakata'=>'mbedhil',
        ],
        [
            'kosakata'=>'begawan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'begundhal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'beja',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bejat',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bekasakan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'beksa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'beksan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bekti',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'belang',
        ],
        [
            'kosakata'=>'belik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'beling',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'belek',
        ],
        [
            'kosakata'=>'bena',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bendara',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bendha',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bendhel',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bendho',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bendhol',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bendhé',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bener',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bebener',
        ],
        [
            'kosakata'=>'kebeneran',
        ],
        [
            'kosakata'=>'bengawan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bengep',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bengi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bengkah',
        ],
        [
            'kosakata'=>'bengkak',
        ],
        [
            'kosakata'=>'bengkok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bengkong',
        ],
        [
            'kosakata'=>'bengèk',
        ],
        [
            'kosakata'=>'benik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bening',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'benjut',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'benthik',
        ],
        [
            'kosakata'=>'benthèt',
        ],
        [
            'kosakata'=>'bentur',
        ],
        [
            'kosakata'=>'bentus',
        ],
        [
            'kosakata'=>'berak',
        ],
        [
            'kosakata'=>'beras',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'berèt',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'besar',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'besaran',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'besmi',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'besus',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'besèt',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'beta',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'betah',
        ],
        [
            'kosakata'=>'bethèk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'beton',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'beya',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'binarung',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'bindheng',
        ],
        [
            'kosakata'=>'bingar',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'binggel',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bingget',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bintul',
        ],
        [
            'kosakata'=>'biyèn',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'biyung',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'blaka',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'blakrak',
        ],
        [
            'kosakata'=>'blalak-blalak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'blanak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'blandhong',
        ],
        [
            'kosakata'=>'blangkemen',
        ],
        [
            'kosakata'=>'blarak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'blasuk',
        ],
        [
            'kosakata'=>'blatèr',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bledhèg',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bledhèh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'blereng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'blesek',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'blirik',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bloloken',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'blondho',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'blorok',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bludak',
        ],
        [
            'kosakata'=>'bluluk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'blumbang',
        ],
        [
            'kosakata'=>'blusuk',
        ],
        [
            'kosakata'=>'blusukan',
        ],
        [
            'kosakata'=>'blèdru',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'bléncong',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bléndrang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bobok',
        ],
        [
            'kosakata'=>'bocah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bodho',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bodong',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'boga',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bojo',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bokong',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bokor',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bolong',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bolot',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'mbolot',
        ],
        [
            'kosakata'=>'bonang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bong',
        ],
        [
            'kosakata'=>'borok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'mborok',
        ],
        [
            'kosakata'=>'bosen',
        ],
        [
            'kosakata'=>'mboseni',
        ],
        [
            'kosakata'=>'bosok',
        ],
        [
            'kosakata'=>'bothak',
        ],
        [
            'kosakata'=>'bothok',
        ],
        [
            'kosakata'=>'boyong',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'brabak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'brahala',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'brahmana',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bramantya',
        ],
        [
            'kosakata'=>'brambang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'brangas',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'brangkang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'branta',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'brastha',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'brengkal',
        ],
        [
            'kosakata'=>'brengos',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'brindhil',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'brobos',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'brodhol',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'brojol',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bronggal',
        ],
        [
            'kosakata'=>'bronggalan',
        ],
        [
            'kosakata'=>'brongkos',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'brongsong',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'brudhul',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'brukut',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'brutu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'brèwok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bubar',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bubrah',
        ],
        [
            'kosakata'=>'bubuk',
        ],
        [
            'kosakata'=>'bubul',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bubur',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bubut',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bubuti',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'buda',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'budeg',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'budeng',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'budhal',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'budheg',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'budhug',
        ],
        [
            'kosakata'=>'bujana',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bujel',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bulak',
        ],
        [
            'kosakata'=>'bulan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'buluken',
        ],
        [
            'kosakata'=>'bumbu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bumbung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bumpet',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bunder',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bundhas',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'babak-bundhas',
        ],
        [
            'kosakata'=>'bundhel',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bundhet',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bungah',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'mbungahi',
        ],
        [
            'kosakata'=>'bungkem',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'bungkik',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bungkil',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bungkuk',
        ],
        [
            'kosakata'=>'bungkus',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bunglon',
        ],
        [
            'kosakata'=>'bungur',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'buntel',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'buntet',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'buntil',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'buntu',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'buntung',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'buntut',
        ],
        [
            'kosakata'=>'burek',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bureng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'buri',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'burik',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'buru',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'buruh',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'busana',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'buthak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'buthek',
        ],
        [
            'kosakata'=>'buthuk',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'butut',
        ],
        [
            'kosakata'=>'buwang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'buyut',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'buyuten',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'bèbèk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bèn',
        ],
        [
            'kosakata'=>'bènten',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'bèrèng',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'bèsèr',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'béda',
        ],
        [
            'kosakata'=>'bédhah',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'béka',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'béncong',
        ],
        [
            'kosakata'=>'bésan',
        ],
        
        [
            'kosakata'=>'cabar',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cabé',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cacah',
        ],
        [
            'kosakata'=>'cacat',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cadhong',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cagak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cakalan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cakar',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cakepan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cakot',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cakra',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cakup',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cambah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'camilan',
        ],
        [
            'kosakata'=>'campur',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cancut',
        ],
        [
            'kosakata'=>'candala',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'candhak',
        ],
        [
            'kosakata'=>'candhet',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'candhik kala',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'candra',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'candramawa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cangak',
        ],
        [
            'kosakata'=>'canggah',
        ],
        [
            'kosakata'=>'cangkem',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cangking',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cangkir',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cangklong',
        ],
        [
            'kosakata'=>'cangkol',
        ],
        [
            'kosakata'=>'cangkriman',
        ],
        [
            'kosakata'=>'cangkruk',
        ],
        [
            'kosakata'=>'canthas',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cantheng',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'canthing',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'canthol',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'canthèl',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cantrik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'caos',
        ],
        [
            'kosakata'=>'capil',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'caping',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'caplak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'caplok',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cara',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'caraka',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'carang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'carita',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'carup',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cathet',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cathok',
        ],
        [
            'kosakata'=>'cathèk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'catur',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'caturan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cawang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cawet',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cawik',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cawis',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cawuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cawé-cawé',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ceblok',
        ],
        [
            'kosakata'=>'ciblok',
        ],
        [
            'kosakata'=>'cecak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cecep',
        ],
        [
            'kosakata'=>'cedhak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cegat',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cekak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cekakak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cekakakan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cekakik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cekap',
        ],
        [
            'kosakata'=>'cekel',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ceket',
        ],
        [
            'kosakata'=>'cekikik',
        ],
        [
            'kosakata'=>'ceking',
        ],
        [
            'kosakata'=>'cekot/cekot-cekot',
        ],
        [
            'kosakata'=>'celak',
        ],
        [
            'kosakata'=>'clathu',
        ],
        [
            'kosakata'=>'celathu',
        ],
        [
            'kosakata'=>'celempung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'celuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'celup',
        ],
        [
            'kosakata'=>'cemani',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cemawis',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cemeng',
        ],
        [
            'kosakata'=>'cempeh',
        ],
        [
            'kosakata'=>'cemplang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cemplon',
        ],
        [
            'kosakata'=>'cemplung',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cempé',
        ],
        [
            'kosakata'=>'cemèt',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cendhak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cendhèk',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cengkah',
        ],
        [
            'kosakata'=>'cengkar',
        ],
        [
            'kosakata'=>'cengkiling',
        ],
        [
            'kosakata'=>'cengkir',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cengkorongan',
        ],
        [
            'kosakata'=>'cengèngèsan',
        ],
        [
            'kosakata'=>'cepak-cepak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cepak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cepeng',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ceplus',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cepuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cepèr',
        ],
        [
            'kosakata'=>'cerek',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ceriwis',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cetha',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'cethak',
        ],
        [
            'kosakata'=>'cethèk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cethik',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cethil',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cethot',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cèkèr',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cèrèt',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cédhal',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cékat-cèket',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'céngkok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'céthul',
        ],
        [
            'kosakata'=>'cèthok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ciblon',
        ],
        [
            'kosakata'=>'ciblèk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cicil',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cicip',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cidhuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'nyiduk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cidra',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cikal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cikat',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cikrak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cilaka',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cilik',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cimit-cimit',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cindhil',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cingak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cingkrang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'ciprat',
        ],
        [
            'kosakata'=>'nyiprat',
        ],
        [
            'kosakata'=>'clandhakan',
        ],
        [
            'kosakata'=>'clekit',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'nyelekit',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'climèn',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'clingus',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'clomètan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cluluk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'clurut',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cluthak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cocot',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'codhot',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cokot',
        ],
        [
            'kosakata'=>'nyokot',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'colok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'colong',
        ],
        [
            'kosakata'=>'nyolongan',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'comot',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'congkrah',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'congor',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'conthèng',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'coplok',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'nyoplok',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'copot',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'nyopot',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'coro',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cotho',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'crah',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'craki',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'crita',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'nyritakake',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>"nyrita'aken",
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'criwis',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cubles',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cubluk',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cucakrawa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cucuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'nyucuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cukil',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cul-culan',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'culek',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'culik',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'cumplung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cumpèn',
        ],
        [
            'kosakata'=>'cundhuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cundrik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cunduk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cungkup',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cupar',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cupet',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cupu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'curek',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cures',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'curiga',
        ],
        [
            'kosakata'=>'curut',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cuthik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'cuwa',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'cuwil',
        ],
        
        [
            'kosakata'=>'dadak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dadakan',
        ],
        [
            'kosakata'=>'dadar',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dadi',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'ndadi',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'dadèn-dadèn',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'dados',
            'ragam'=>'Krama',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'dagang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dahana',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dahuru',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dahwèn',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dalah',
            'jenis'=>'Tembung panggandheng',
        ],
        [
            'kosakata'=>'dalan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dalem',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dalu',
        ],
        [
            'kosakata'=>'damar',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'damel',
            'ragam'=>'Krama',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dami',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'damu',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'damèn',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'danawa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dandan-dandan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dandan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dandang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dandos',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dara',
        ],
        [
            'kosakata'=>'darbé',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'darma',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dasa',
            'jenis'=> 'Tembung wilangan',
        ],
        [
            'kosakata'=>'dawa',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'dawakake',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dawet',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'daya',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'daya-daya',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'degan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'deling',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'delok',
        ],
        [
            'kosakata'=>'deleng',
        ],
        [
            'kosakata'=>'demèk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dengkul',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dika',
        ],
        [
            'kosakata'=>'dingkik',
        ],
        [
            'kosakata'=>'dingklik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'disik',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'dluwang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dodol',
        ],
        [
            'kosakata'=>'dolan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dolanan',
        ],
        [
            'kosakata'=>'donga/dunga',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'donya',
        ],
        [
            'kosakata'=>'dora',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'doso',
            'ragam'=>'Krama',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'dosa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'doyan',
        ],
        [
            'kosakata'=>'driji',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'drèngès',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dubang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dudu',
        ],
        [
            'kosakata'=>'duduh',
        ],
        [
            'kosakata'=>'dugang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'duku',
        ],
        [
            'kosakata'=>'dulit',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dulur',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dumuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dumunung',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dumèh',
        ],
        [
            'kosakata'=>'dungarèn',
        ],
        [
            'kosakata'=>'dungkap',
        ],
        [
            'kosakata'=>'dunung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'duratmaka',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'durèn',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'durung',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'dustha',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'duwa',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'duwé',
        ],
        [
            'kosakata'=>'dwi',
            'jenis'=>'Tembung wilangan',
        ],
        [
            'kosakata'=>'dédé',
            'ragam'=>'Krama',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'déning',
        ],
        [
            'kosakata'=>'déné',
            'jenis'=>'Tembung panggandheng',
        ],
        [
            'kosakata'=>'désa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'déwa',
            'jenis'=>'Tembung aran',
        ],
        
        [
            'kosakata'=>'dhadha',
        ],
        [
            'kosakata'=>'dhadhak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhadhakmerak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhadhal',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'dhadhu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhadhung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhagelan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhahar',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'dhalan',
        ],
        [
            'kosakata'=>'dhalu',
        ],
        [
            'kosakata'=>'dhalem',
        ],
        [
            'kosakata'=>'dhalang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhangka',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhapur',
        ],
        [
            'kosakata'=>'dhawah',
            'ragam'=>'Krama',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dhawuh',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'dhayoh',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhedhes',
        ],
        [
            'kosakata'=>'dhemen',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dhemit',
        ],
        [
            'kosakata'=>'dhidhis',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dhimas',
        ],
        [
            'kosakata'=>'dhingklang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'dhingklik',
        ],
        [
            'kosakata'=>'dhingkluk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dhodhog',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dhodhok',
        ],
        [
            'kosakata'=>'dhodhol',
        ],
        [
            'kosakata'=>'dhodhos',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dhom',
        ],
        [
            'kosakata'=>'dhompol',
            'jenis'=>'Tembung wilangan',
        ],
        [
            'kosakata'=>'dhondhong',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhongkol',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhoyong',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'dhudha',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhuku',
        ],
        [
            'kosakata'=>'dhupak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'dhusun',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'dhuwit',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhuwur',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'dhèdhèl',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'dhèmpèt',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'dhèndhèng',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'dhédhé',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'dhéwé',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'eden',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'elar',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'eluk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'embah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'embuh',
            'jenis'=>'Tembung panguwuh',
        ],
        [
            'kosakata'=>'emoh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'emplok',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'empuk',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'emut',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'enak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'endas',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'endi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'endog',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'enek',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'enem',
            'jenis'=>'Tembung wilangan',
        ],
        [
            'kosakata'=>'enep',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ener',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'enggon',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'enggèlèk',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'enjing',
        ],
        [
            'kosakata'=>'entas',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'entup',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'entut',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'enték',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'entén-entén',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'entén',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'enyang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'epang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'epek-epek',
        ],
        [
            'kosakata'=>'erah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'eri',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'esthi',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'estu',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'ésuk',
        ],
        [
            'kosakata'=>'èdi',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'èlèk',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'èncèr',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'éca',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'édan',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'édhum',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'éka',
            'jenis'=>'Tembung wilangan',
        ],
        [
            'kosakata'=>'éling',
        ],
        [
            'kosakata'=>'élok',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'éman',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'éndah',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'éndha',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'éndhang',
        ],
        [
            'kosakata'=>'énggal',
        ],
        [
            'kosakata'=>'énggar',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'énggok',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'énthong',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'énthéng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'éntuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'éram',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'éthok-éthok',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'éwa',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'éwadéné',
            'jenis'=>'Tembung panggandheng',
        ],
        [
            'kosakata'=>'éwah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'éwuh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'éyang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'éyup',
            'jenis'=>'Tembung kaanan',
        ],

        [
            'kosakata'=>'gabah',
            'jenis'=>'Tembung aran',
        ],
        
        [
            'kosakata'=>'gada',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gadhah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gaduk',
        ],
        [
            'kosakata'=>'gagah',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gagak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gagang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gagas',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gagasan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gagé',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'gajah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gajih',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'galak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'galar',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'galengan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gali',
        ],
        [
            'kosakata'=>'galih',
        ],
        [
            'kosakata'=>'gaman',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gambang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gambar',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gambas',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gambir anom',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gambir',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gambyong',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gamel',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gamelan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gampang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gampil',
            'jenis'=>'Tembung kaanan',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'gampar',
        ],
        [
            'kosakata'=>'gamping',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gampèng',
        ],
        [
            'kosakata'=>'ganda',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gandarwa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gandhen',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gandheng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gandhes',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gandhol',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'gandhul',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'gandrik',
        ],
        [
            'kosakata'=>'gandrung',
        ],
        [
            'kosakata'=>'ganep',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gangsal',
            'jenis'=>'Tembung wilangan',
        ],
        [
            'kosakata'=>'gangsar',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'gangsir',
        ],
        [
            'kosakata'=>'ganjar',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ganjaran',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ganjel',
        ],
        [
            'kosakata'=>'ganjil',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gantung',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gapit',
        ],
        [
            'kosakata'=>'gaplek',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gapuk',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gapyuk',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'garan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'garangan',
        ],
        [
            'kosakata'=>'garing',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'garu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'garudha',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'garwa',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'gasik',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'gatel',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gathot',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gathuk',
        ],
        [
            'kosakata'=>'gati',
        ],
        [
            'kosakata'=>'gawa',
        ],
        [
            'kosakata'=>'nggawa',
        ],
        [
            'kosakata'=>'gawan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gawang-gawang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gawat',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gawé',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gayuh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gayok',
        ],
        [
            'kosakata'=>'geber',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gebug',
        ],
        [
            'kosakata'=>'gedhang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gedhèk',
        ],
        [
            'kosakata'=>'gedhé',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gegana',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gegayuhan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gegedhug',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'geger',
        ],
        [
            'kosakata'=>'gela',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gelak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gelang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gelap',
        ],
        [
            'kosakata'=>'gelar',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gelas',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gelem',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gelis',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'gelut',
        ],
        [
            'kosakata'=>'gem lethak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gem lundung',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gemah',
        ],
        [
            'kosakata'=>'gemak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gemang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gembili',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gemblak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gemblung',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gembok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gembor',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gembul',
        ],
        [
            'kosakata'=>'gemes',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gemlethak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gemlundung',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gempur',
        ],
        [
            'kosakata'=>'gemrubug',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'gemrudug',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'gemré gah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gemrégah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gemuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'genah',
        ],
        [
            'kosakata'=>'gendhakan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gendheng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gendhing',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gendhis',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'gendhuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gendruwo',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gendul',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gendèr',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gendéra',
        ],
        [
            'kosakata'=>'geni',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'genjot',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'genthong',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'genthèng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'genuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'geplak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gepuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gerah',
            'ragam'=>'Krama',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gerang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gering',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'germo',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gero-gero',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gerèh',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gesang',
        ],
        [
            'kosakata'=>'geseng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'getak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'getap',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'getas',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gething',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gethuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'getih',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'getir',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'getun',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gibeng',
        ],
        [
            'kosakata'=>'gila',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gilani',
        ],
        [
            'kosakata'=>'giles',
        ],
        [
            'kosakata'=>'gilig',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gimbal',
        ],
        [
            'kosakata'=>'ginanjar',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'giris',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gisik',
        ],
        [
            'kosakata'=>'gita',
        ],
        [
            'kosakata'=>'githok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gitik',
        ],
        [
            'kosakata'=>'glagah',
        ],
        [
            'kosakata'=>'glagar',
        ],
        [
            'kosakata'=>'glagepan',
        ],
        [
            'kosakata'=>'glandhang',
        ],
        [
            'kosakata'=>'glandhangan',
        ],
        [
            'kosakata'=>'glangsaran',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'glathik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'glenik',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'glethak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'glindhing',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'glondhang',
        ],
        [
            'kosakata'=>'gludhug',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'glugu',
        ],
        [
            'kosakata'=>'glundhung',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gobang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'goblog',
        ],
        [
            'kosakata'=>'gocèk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'godhag',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'godhog',
        ],
        [
            'kosakata'=>'godhong',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gogor',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gogrok',
        ],
        [
            'kosakata'=>'gojek',
        ],
        [
            'kosakata'=>'gombak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gombal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gombong',
        ],
        [
            'kosakata'=>'gondhal-gandhul',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gondhangen',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gondhelan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gondhok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gondhol',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gondhong',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gongso',
        ],
        [
            'kosakata'=>'gori',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gosong',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gothot',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gotong',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gowang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'grabah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gragal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gragapan',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'grahana',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'grana',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'grapyak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'grasak',
        ],
        [
            'kosakata'=>'grayang',
        ],
        [
            'kosakata'=>'greget',
        ],
        [
            'kosakata'=>'gregeten',
        ],
        [
            'kosakata'=>'grenengan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gribik',
        ],
        [
            'kosakata'=>'grimis',
        ],
        [
            'kosakata'=>'gringgingen',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gringsing',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'griya',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'grojogan',
        ],
        [
            'kosakata'=>'gronjalan',
        ],
        [
            'kosakata'=>'gropyok',
        ],
        [
            'kosakata'=>'growah',
        ],
        [
            'kosakata'=>'growong',
        ],
        [
            'kosakata'=>'grudhal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'grudug',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gruwung',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'grèsèk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gubuk',
        ],
        [
            'kosakata'=>'gudheg',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gudig',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gudir',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gudèl',
        ],
        [
            'kosakata'=>'gugah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gugu',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gugur',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'guling',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gulu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gulung',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gumpil',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gumuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gumyak',
        ],
        [
            'kosakata'=>'gundhul',
        ],
        [
            'kosakata'=>'gupuh',
        ],
        [
            'kosakata'=>'gurah',
        ],
        [
            'kosakata'=>'gusah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'gutuk',
        ],
        [
            'kosakata'=>'guwa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'guyang',
        ],
        [
            'kosakata'=>'guyu',
        ],
        [
            'kosakata'=>'guyon',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'guyub',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gya',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'gèdhèg',
        ],
        [
            'kosakata'=>'gènjèr',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gèntèr',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'gèpèng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gèsèh',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'gèthèk',
            'jenis'=>'Tembung aran',
        ],
        
        [
            'kosakata'=>'haldhoko',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'handhoko',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'hangasto',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'hangganiro',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'hapsoro',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'hara',
            'jenis'=>'Tembung panguwuh',
        ],
        [
            'kosakata'=>'harja',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'harsaya',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'hasta',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'hastha',
            'jenis'=>'Tembung wilangan',
        ],
        [
            'kosakata'=>'hastho',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'hasti',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'hayo',
            'jenis'=>'Tembung panguwuh',
        ],
        [
            'kosakata'=>'himalaya',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'himawan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'hyang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ibal',
        ],
        [
            'kosakata'=>'iberé',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ibu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ical',
            'jenis'=>'Tembung kaanan',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'idep',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ider',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'idhep-idhep',
        ],
        [
            'kosakata'=>'idhi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'idu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'iga',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'iguh',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ijem',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'ijir',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ijo',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'ijol',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'iket',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'iki',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'iku',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ila-ila',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ilat',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'iler',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ili',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'mili',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ilir',
        ],
        [
            'kosakata'=>'imbal',
        ],
        [
            'kosakata'=>'imbu',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'imbuh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'iming-iming',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'impèn',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ina',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'incer',
        ],
        [
            'kosakata'=>'ngincer',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ing',
            'jenis'=>'Tembung ancer-ancer'
        ],
        [
            'kosakata'=>'inger',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ingklik',
        ],
        [
            'kosakata'=>'ingkung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ingon-ingon',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ingsun',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ingu',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'inthil',
        ],
        [
            'kosakata'=>'intip',
        ],
        [
            'kosakata'=>'inuman',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ipat-ipat',
        ],
        [
            'kosakata'=>'ireng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'iring',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'iring-iring',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'iringan',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'isep',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'isih',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'isin',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'ngisin-ngisini',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'kisinan',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'isis',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'iwak',
            'jenis'=>'Tembung aran',
        ],

        [
            'kosakata'=>'jabang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jabel',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jabut',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jadah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jaga',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jagabaya',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jagad',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jagal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jagang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jail',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jajah',
        ],
        [
            'kosakata'=>'jajal',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jajan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jaka',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jala',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jaladri',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jalak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jalaran',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jaler',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jalma',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jalu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jaluk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jaman',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jamas',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jambak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jambal',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jamban',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jambu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jambul',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jambé',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jamu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jan',
            'jenis'=>'Tembung panguwuh',
        ],
        [
            'kosakata'=>'jancuk',
        ],
        [
            'kosakata'=>'jangan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jangan bening',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'njangan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jangar',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jangga',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'janggel',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'janggut',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jangka',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jangkar',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jangkung',
        ],
        [
            'kosakata'=>'janma',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'japa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jarak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jaran',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jarang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jaratan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jarem',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jarik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jarit',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jarké',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jarwa',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jaré',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jaréné',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jatah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jathilan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jatukrama',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jawa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jawah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jawat',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jawata',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jawi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jawil',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jaya',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jaé',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jegog',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jegur',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jejeg',
        ],
        [
            'kosakata'=>'jejer',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jejuluk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jelih',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jelèh',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jembar',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jembrak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jembut',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jempalik',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jempol',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jemuwah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jemèk',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jenang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jenar',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jenaté',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jeneng',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jenengan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jenggong',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jenggèlèk',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'jengkar',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'jengking',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jengkol',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jenthik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jené',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jepit',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jeplak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jeram',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jerit',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jero',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jerohan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jeruk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jethungan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jimat',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jimpit',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jimpitan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jirih',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jiwa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jiwit',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jlèntrèh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jodhang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jodho',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'joglo',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jojoh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jomplang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jorjoran',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jorok',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jothak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jugruk',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'juju',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jujug',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jujul',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jujur',
        ],
        [
            'kosakata'=>'julungpujut',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'julungwangi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jumadilakir',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jumadilawal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jumantara',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jumawa',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jumbuh',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jempalitan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jungkat',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jupuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'juragan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'juwèh',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jèbèng',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jèjèran',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jèmbrèng',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'jèngkèl',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'jèrèng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'jèwèr',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'kabèh',
            'jenis'=>'Tembung wilangan',
        ],
        [
            'kosakata'=>'kabul',
        ],
        [
            'kosakata'=>'kaca',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kacu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kacuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kacung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kadang',
        ],
        [
            'kosakata'=>'kadhung',
        ],
        [
            'kosakata'=>'kademen',
        ],
        [
            'kosakata'=>'kadhang',
        ],
        [
            'kosakata'=>'kadingaren',
        ],
        [
            'kosakata'=>'kadipaten',
        ],
        [
            'kosakata'=>'kadohan',
        ],
        [
            'kosakata'=>'kagèt',
        ],
        [
            'kosakata'=>'kahanan',
        ],
        [
            'kosakata'=>'kakang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kakehan',
        ],
        [
            'kosakata'=>'kampleng',
        ],
        [
            'kosakata'=>'kampul-kampul',
        ],
        [
            'kosakata'=>'kampung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kana',
        ],
        [
            'kosakata'=>'kanca',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kancrit',
        ],
        [
            'kosakata'=>'kanda',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'kandhang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kandheg',
        ],
        [
            'kosakata'=>'kandhel',
        ],
        [
            'kosakata'=>'kandhutan',
        ],
        [
            'kosakata'=>'kanggo',
        ],
        [
            'kosakata'=>'kapok',
        ],
        [
            'kosakata'=>'kapuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kasèp',
        ],
        [
            'kosakata'=>'kasur',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kathok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'katrek',
        ],
        [
            'kosakata'=>'kawat',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kebak',
        ],
        [
            'kosakata'=>'kecelék',
        ],
        [
            'kosakata'=>'kecik',
        ],
        [
            'kosakata'=>'keduwung',
        ],
        [
            'kosakata'=>'kajeng',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'kekep',
        ],
        [
            'kosakata'=>'kemaki',
        ],
        [
            'kosakata'=>'kemayu',
        ],
        [
            'kosakata'=>'kembang',
        ],
        [
            'kosakata'=>'kembar',
        ],
        [
            'kosakata'=>'kembung',
        ],
        [
            'kosakata'=>'kemingkel',
        ],
        [
            'kosakata'=>'kemlakaren',
        ],
        [
            'kosakata'=>'kempès',
        ],
        [
            'kosakata'=>'kemplu',
        ],
        [
            'kosakata'=>'kemproh',
        ],
        [
            'kosakata'=>'kemu',
        ],
        [
            'kosakata'=>'kena',
        ],
        [
            'kosakata'=>'kenceng',
        ],
        [
            'kosakata'=>'kendel',
        ],
        [
            'kosakata'=>'kendi',
        ],
        [
            'kosakata'=>'kendil',
        ],
        [
            'kosakata'=>'kendo',
        ],
        [
            'kosakata'=>'kene',
        ],
        [
            'kosakata'=>'kenthir',
        ],
        [
            'kosakata'=>'kenthongan',
        ],
        [
            'kosakata'=>'kepencut',
        ],
        [
            'kosakata'=>'kaplok',
        ],
        [
            'kosakata'=>'keplok',
        ],
        [
            'kosakata'=>'keplèsèt',
        ],
        [
            'kosakata'=>'karso',
        ],
        [
            'kosakata'=>'kerso',
        ],
        [
            'kosakata'=>'kerdus',
        ],
        [
            'kosakata'=>'kere',
        ],
        [
            'kosakata'=>'kerek',
        ],
        [
            'kosakata'=>'keri',
        ],
        [
            'kosakata'=>'kesel',
        ],
        [
            'kosakata'=>'keselak',
        ],
        [
            'kosakata'=>'kesengsem',
        ],
        [
            'kosakata'=>'kètèk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kethak',
        ],
        [
            'kosakata'=>'kethèk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kidang',
        ],
        [
            'kosakata'=>'kikir',
        ],
        [
            'kosakata'=>'kirik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kisruh',
        ],
        [
            'kosakata'=>'kitir',
        ],
        [
            'kosakata'=>'kiwa',
        ],
        [
            'kosakata'=>'kimpul',
        ],
        [
            'kosakata'=>'klabakan',
        ],
        [
            'kosakata'=>'klakep',
        ],
        [
            'kosakata'=>'klambi',
        ],
        [
            'kosakata'=>'klambi hem',
        ],
        [
            'kosakata'=>'klambu',
        ],
        [
            'kosakata'=>'klangopan',
        ],
        [
            'kosakata'=>'klanthung',
        ],
        [
            'kosakata'=>'klapa',
        ],
        [
            'kosakata'=>'klebon',
        ],
        [
            'kosakata'=>'klebu',
        ],
        [
            'kosakata'=>'klelep',
        ],
        [
            'kosakata'=>'klenger',
        ],
        [
            'kosakata'=>'klèntang',
        ],
        [
            'kosakata'=>'klentheng',
        ],
        [
            'kosakata'=>'klethak',
        ],
        [
            'kosakata'=>'klilip',
        ],
        [
            'kosakata'=>'klilipen',
        ],
        [
            'kosakata'=>'klincutan',
        ],
        [
            'kosakata'=>'klingihan',
        ],
        [
            'kosakata'=>'klisikan',
        ],
        [
            'kosakata'=>'klompen',
        ],
        [
            'kosakata'=>'kloyongan',
        ],
        [
            'kosakata'=>'klumah',
        ],
        [
            'kosakata'=>'kluruk',
        ],
        [
            'kosakata'=>'kluthuk',
        ],
        [
            'kosakata'=>'kluwih',
        ],
        [
            'kosakata'=>'klèsètan',
        ],
        [
            'kosakata'=>'klébat',
        ],
        [
            'kosakata'=>'klékaran',
        ],
        [
            'kosakata'=>'kléndran',
        ],
        [
            'kosakata'=>'kléyang',
        ],
        [
            'kosakata'=>'kobong',
        ],
        [
            'kosakata'=>'kocak',
        ],
        [
            'kosakata'=>'kodok',
        ],
        [
            'kosakata'=>'kolak',
        ],
        [
            'kosakata'=>'kombor',
        ],
        [
            'kosakata'=>'konangan',
        ],
        [
            'kosakata'=>'koncatan',
        ],
        [
            'kosakata'=>'kondhang',
        ],
        [
            'kosakata'=>'koplok',
        ],
        [
            'kosakata'=>'kopong',
        ],
        [
            'kosakata'=>'kopros',
        ],
        [
            'kosakata'=>'kora-kora',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'korting',
        ],
        [
            'kosakata'=>'kosok',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'kosok balen',
        ],
        [
            'kosakata'=>'kosokan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kothak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kowé',
        ],
        [
            'kosakata'=>'krakal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'krama',
        ],
        [
            'kosakata'=>'kramas',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'kramat',
        ],
        [
            'kosakata'=>'krambil',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kranggèhan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'krikil',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kroco',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kroncalan',
        ],
        [
            'kosakata'=>'kroto',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kruntelan',
        ],
        [
            'kosakata'=>'kucing',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kudu',
        ],
        [
            'kosakata'=>'kudung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kulit',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kulu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kumat',
        ],
        [
            'kosakata'=>'kumu',
        ],
        [
            'kosakata'=>'kuna',
        ],
        [
            'kosakata'=>'kuncara',
        ],
        [
            'kosakata'=>'kura',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kutha',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kuthang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'kuwat',
        ],
        [
            'kosakata'=>'kuwi',
        ],
        [
            'kosakata'=>'kèpèt',
        ],
        [
            'kosakata'=>'kéntér',
        ],
        
        
        [
            'kosakata'=>'labuh',
        ],
        [
            'kosakata'=>'ladak',
        ],
        [
            'kosakata'=>'ladrang',
        ],
        [
            'kosakata'=>'ladéng',
        ],
        [
            'kosakata'=>'laki',
        ],
        [
            'kosakata'=>'laku',
        ],
        [
            'kosakata'=>'lalèn',
        ],
        [
            'kosakata'=>'laler',
        ],
        [
            'kosakata'=>'lali',
        ],
        [
            'kosakata'=>'lamat',
        ],
        [
            'kosakata'=>'lambaran',
        ],
        [
            'kosakata'=>'lambé',
        ],
        [
            'kosakata'=>'lambéyan',
        ],
        [
            'kosakata'=>'lamur',
        ],
        [
            'kosakata'=>'lanang',
        ],
        [
            'kosakata'=>'lancang',
        ],
        [
            'kosakata'=>'landep',
        ],
        [
            'kosakata'=>'landhep',
        ],
        [
            'kosakata'=>'landhesan',
        ],
        [
            'kosakata'=>'langka',
        ],
        [
            'kosakata'=>'lapangan',
        ],
        [
            'kosakata'=>'lara',
        ],
        [
            'kosakata'=>'larahan',
        ],
        [
            'kosakata'=>'larah',
        ],
        [
            'kosakata'=>'larang',
        ],
        [
            'kosakata'=>'laras',
        ],
        [
            'kosakata'=>'larik',
        ],
        [
            'kosakata'=>'laris',
        ],
        [
            'kosakata'=>'larung',
        ],
        [
            'kosakata'=>'latar',
        ],
        [
            'kosakata'=>'lawa',
        ],
        [
            'kosakata'=>'lawang',
        ],
        [
            'kosakata'=>'lebet',
        ],
        [
            'kosakata'=>'ledhok',
        ],
        [
            'kosakata'=>'legi',
        ],
        [
            'kosakata'=>'legok',
        ],
        [
            'kosakata'=>'lelakon',
        ],
        [
            'kosakata'=>'lelayu',
        ],
        [
            'kosakata'=>'lemah',
        ],
        [
            'kosakata'=>'lembah (manah)',
        ],
        [
            'kosakata'=>'lemes',
        ],
        [
            'kosakata'=>'lemit',
        ],
        [
            'kosakata'=>'lempeng',
        ],
        [
            'kosakata'=>'lempung',
        ],
        [
            'kosakata'=>'lemu',
        ],
        [
            'kosakata'=>'lemut',
        ],
        [
            'kosakata'=>'lenga',
        ],
        [
            'kosakata'=>'lengen',
        ],
        [
            'kosakata'=>'lenggah',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'lesung',
        ],
        [
            'kosakata'=>'lethek',
        ],
        [
            'kosakata'=>'lèsehan',
        ],
        [
            'kosakata'=>'lésus',
        ],
        [
            'kosakata'=>'lima',
        ],
        [
            'kosakata'=>'liman',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'limit',
        ],
        [
            'kosakata'=>'limpung',
        ],
        [
            'kosakata'=>'lindu',
        ],
        [
            'kosakata'=>'linggih',
        ],
        [
            'kosakata'=>'lingsa',
        ],
        [
            'kosakata'=>'lintang',
        ],
        [
            'kosakata'=>'lintu',
        ],
        [
            'kosakata'=>'lirih',
        ],
        [
            'kosakata'=>'lisah',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'liya',
        ],
        [
            'kosakata'=>'liyane',
        ],
        [
            'kosakata'=>'lobok',
        ],
        [
            'kosakata'=>'lobot/klobot',
        ],
        [
            'kosakata'=>'lodhok',
        ],
        [
            'kosakata'=>'lodhong',
        ],
        [
            'kosakata'=>'loji',
        ],
        [
            'kosakata'=>'loloh',
        ],
        [
            'kosakata'=>'loma',
        ],
        [
            'kosakata'=>'lombok',
        ],
        [
            'kosakata'=>'londo',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'lonyot',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lor',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'loro',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lowèr',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'loyo',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'luber',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'ludhes',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lugu',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'luh',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'lumah',
        ],
        [
            'kosakata'=>'lumantar',
        ],
        [
            'kosakata'=>'lumet',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lumèr',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lumrah',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lumuh',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lunga',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'lungguh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'lungkrah',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lungset',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lunyu',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lurah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'lurik',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'luruh',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lusuh',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'lutung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'luwe',
        ],
        [
            'kosakata'=>'keluwen',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'luwih',
        ],
        [
            'kosakata'=>'lèmbèng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'léndhéyan',
        ],

        [
            'kosakata'=>'mabur',
        ],
        [
            'kosakata'=>'macak',
        ],
        [
            'kosakata'=>'madheb',
        ],
        [
            'kosakata'=>'madya',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'magèl',
        ],
        [
            'kosakata'=>'majinggo',
        ],
        [
            'kosakata'=>'malangkerik',
        ],
        [
            'kosakata'=>'maléh',
        ],
        [
            'kosakata'=>'mamah',
        ],
        [
            'kosakata'=>'mas',
        ],
        [
            'kosakata'=>'manah',
        ],
        [
            'kosakata'=>'madhang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'mandhap',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'mandheg',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'mangan',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'mangap',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'mangkrak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'mantep',
        ],
        [
            'kosakata'=>'manuk',
        ],
        [
            'kosakata'=>'marai',
        ],
        [
            'kosakata'=>'maras',
        ],
        [
            'kosakata'=>'mari',
        ],
        [
            'kosakata'=>'margo',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'marunan',
        ],
        [
            'kosakata'=>'maruto',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'matur',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'mbah',
        ],
        [
            'kosakata'=>'mbah kakung',
        ],
        [
            'kosakata'=>'mbah putri',
        ],
        [
            'kosakata'=>'mboh',
        ],
        [
            'kosakata'=>'mbok',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'medal',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'medheni',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'medhit',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'mekrok',
        ],
        [
            'kosakata'=>'melar',
        ],
        [
            'kosakata'=>'melas',
        ],
        [
            'kosakata'=>'memelas',
        ],
        [
            'kosakata'=>'meneng',
        ],
        [
            'kosakata'=>'mèlih',
        ],
        [
            'kosakata'=>'mèlu',
        ],
        [
            'kosakata'=>'mènclok',
        ],
        [
            'kosakata'=>'mindhak-mindhik',
        ],
        [
            'kosakata'=>'minger',
        ],
        [
            'kosakata'=>'mingkem',
        ],
        [
            'kosakata'=>'mingsek-mingsek',
        ],
        [
            'kosakata'=>'mingset',
        ],
        [
            'kosakata'=>'minulyo',
        ],
        [
            'kosakata'=>'miris',
        ],
        [
            'kosakata'=>'misuwur',
        ],
        [
            'kosakata'=>'mlajar',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'mlaku',
        ],
        [
            'kosakata'=>'mlampah',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'mlangkring',
        ],
        [
            'kosakata'=>'mlayu',
        ],
        [
            'kosakata'=>'mlayu sipat kuping',
        ],
        [
            'kosakata'=>'mlebet',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'mlebu',
        ],
        [
            'kosakata'=>'mleruk',
        ],
        [
            'kosakata'=>'mlesat',
        ],
        [
            'kosakata'=>'mlèrok',
        ],
        [
            'kosakata'=>'mlèsèt',
        ],
        [
            'kosakata'=>'mlémbang',
        ],
        [
            'kosakata'=>'mléngak',
        ],
        [
            'kosakata'=>'mléngos',
        ],
        [
            'kosakata'=>'mléngsé',
        ],
        [
            'kosakata'=>'mligi',
        ],
        [
            'kosakata'=>'mlinjo',
        ],
        [
            'kosakata'=>'mlintir',
        ],
        [
            'kosakata'=>'mlipir',
        ],
        [
            'kosakata'=>'mlirik',
        ],
        [
            'kosakata'=>'mliwis',
        ],
        [
            'kosakata'=>'mlongo',
        ],
        [
            'kosakata'=>'mlorok',
        ],
        [
            'kosakata'=>'mlorot',
        ],
        [
            'kosakata'=>'mlumah',
        ],
        [
            'kosakata'=>'mlumpat',
        ],
        [
            'kosakata'=>'mlunthu',
        ],
        [
            'kosakata'=>'mrambat',
        ],
        [
            'kosakata'=>'mrantak/mratak',
        ],
        [
            'kosakata'=>'mrèmbèt',
        ],
        [
            'kosakata'=>'mréné',
        ],
        [
            'kosakata'=>'mriki',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'mriku',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'mringis',
        ],
        [
            'kosakata'=>'mripat',
        ],
        [
            'kosakata'=>'mriko',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'mrônô',
        ],
        [
            'kosakata'=>'mrutu',
        ],
        [
            'kosakata'=>'mruntus',
        ],
        [
            'kosakata'=>'moh',
        ],
        [
            'kosakata'=>'molèt',
        ],
        [
            'kosakata'=>'monggo',
        ],
        [
            'kosakata'=>'morong',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'mpun',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'mulat',
        ],
        [
            'kosakata'=>'muléh',
        ],
        [
            'kosakata'=>'mulur',
        ],
        [
            'kosakata'=>'munggah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'muntap',
        ],
        [
            'kosakata'=>'murup',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'murus',
        ],
        [
            'kosakata'=>'mustaka',
        ],
        [
            'kosakata'=>'nadyan',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'nalar',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'nalendro',
            'jenis'=>'Tembung kaanan',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'nalika',
        ],
        [
            'kosakata'=>'nandhang',
            'jenis'=>'Tembung kaanan',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'nandur',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'nanging',
            'jenis'=>'Tembung panggandheng',
        ],
        [
            'kosakata'=>'napuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'nata',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'naté',
            'jenis'=>'Tembung kaanan',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>"nawak'aken",
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'nawakno',
        ],
        [
            'kosakata'=>'nawani',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ndhèngèr',
        ],
        [
            'kosakata'=>'ndhiko',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'ndhoro',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'ndungkap',
        ],
        [
            'kosakata'=>'nedha',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'nedhi',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'nelangsa',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'nemu',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'nendro',
            'jenis'=>'Tembung kaanan',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'nèk ngono',
        ],
        [
            'kosakata'=>'nétra',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'niki',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'niku',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'ning',
        ],
        [
            'kosakata'=>"ninggal'aken",
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'ninggali',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'nodhi',
            'ragam'=>'Tembung kaanan',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'nolo',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'nopo',
            'jenis'=>'Tembung kaanan',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'noto',
            'jenis'=>'Tembung kaanan',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'nowo',
            'jenis'=>'Tembung kaanan',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'nuku',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'nurut',
            'jenis'=>'Tembung kaanan',
        
        ],
        [
            'kosakata'=>'ngaboti',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngajeng',
            'jenis'=>'Tembung katrangan',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'ngakon',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngakoni',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngakoso',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'ngamuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngantem',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngaos',
        ],
        [
            'kosakata'=>'ngapunten',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'ngapura',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngarep',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'ngarsa',
            'jenis'=>'Tembung katrangan',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'ngasah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngasak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngaso',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngemat',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngemit',
        ],
        [
            'kosakata'=>'ngemut',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngentup',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>"ngemik'i",
        ],
        [
            'kosakata'=>'ngewohi',
        ],
        [
            'kosakata'=>'ngintik',
        ],
        [
            'kosakata'=>'nglakoni',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'nglamak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'nglambrang',
        ],
        [
            'kosakata'=>'nglanggati',
        ],
        [
            'kosakata'=>'nglangsemi',
        ],
        [
            'kosakata'=>'nglantur',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'nglarani',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'nglimpé',
        ],
        [
            'kosakata'=>'nglindur',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'nglintek',
        ],
        [
            'kosakata'=>'ngrebyong',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'ngobati',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngobong',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngorok',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngowahi',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngowéh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngowoh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngudhari',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ngudhi',
        ],
        [
            'kosakata'=>'ngulu',
        ],
        [
            'kosakata'=>'ngunjali',
        ],
        [
            'kosakata'=>'ngunjuk',
        ],
        [
            'kosakata'=>"nyagak'i",
        ],
        [
            'kosakata'=>'nyambat',
        ],
        [
            'kosakata'=>'nyambel',
        ],
        [
            'kosakata'=>'nyambut',
        ],
        [
            'kosakata'=>'nyandhak',
        ],
        [
            'kosakata'=>'nyandhang',
        ],
        [
            'kosakata'=>'nyandhing',
        ],
        [
            'kosakata'=>'nyandhung',
        ],
        [
            'kosakata'=>'nyang',
        ],
        [
            'kosakata'=>'nyang-nyangan',
        ],
        [
            'kosakata'=>'nyangking',
        ],
        [
            'kosakata'=>'nyangklak',
        ],
        [
            'kosakata'=>'nyangkruk',
        ],
        [
            'kosakata'=>'nyaplok',
        ],
        [
            'kosakata'=>'nyawang',
        ],
        [
            'kosakata'=>'nyemak',
        ],
        [
            'kosakata'=>'nyeleneh',
        ],
        [
            'kosakata'=>'nyelehke',
        ],
        [
            'kosakata'=>'nyilah',
        ],
        [
            'kosakata'=>'nyilahi',
        ],
        [
            'kosakata'=>'nyilahno',
        ],
        [
            'kosakata'=>'nyoba',
        ],
        [
            'kosakata'=>'nyogok',
        ],
        [
            'kosakata'=>'nyoh',
        ],
        [
            'kosakata'=>'nyolong',
        ],
        [
            'kosakata'=>'nyomot',
        ],
        [
            'kosakata'=>'nyonggo',
        ],
        [
            'kosakata'=>'nyrawung',
        ],
        [
            'kosakata'=>'nyuguhi',
        ],
        [
            'kosakata'=>'nyulohi',
        ],
        [
            'kosakata'=>'nyukani',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'nyunggi',
        ],
        
        
        [
            'kosakata'=>'obah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'obok-obok',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'obong',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'obor',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'obrak',
        ],
        [
            'kosakata'=>'oceh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ogak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'okèh',
        ],
        [
            'kosakata'=>'olo',
        ],
        [
            'kosakata'=>'olah-olah',
        ],
        [
            'kosakata'=>'olah',
        ],
        [
            'kosakata'=>'olèh',
        ],
        [
            'kosakata'=>'omah',
        ],
        [
            'kosakata'=>'ombak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ombe',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'omben-omben',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'omber',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'ombyok',
            'jenis'=>'Tembung wilangan',
        ],
        [
            'kosakata'=>'omong',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ompol',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ompong',
        ],
        [
            'kosakata'=>'oncor',
        ],
        [
            'kosakata'=>'onjokolo',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'ondhé-ondhé',
        ],
        [
            'kosakata'=>'ontong',
        ],
        [
            'kosakata'=>'ontran-ontran',
        ],
        [
            'kosakata'=>'opak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ora',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'orak-arik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'orat-arit',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'osik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'owah',
        ],
        [
            'kosakata'=>'oyak',
        ],
        [
            'kosakata'=>'oyok',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'oyot',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'olěh opo',
        ],
        [
            'kosakata'=>'opo olěh',
        ],

        [
            'kosakata'=>'padang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'padu',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'paido',
        ],
        [
            'kosakata'=>'dipaido',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'maido',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'paidon',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pait',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'pajeng',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'panjenengan',
        ],
        [
            'kosakata'=>'pakan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pamer',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'pamor',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pancagati',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pancer',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'pandhan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pandhawa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pandhum',
        ],
        [
            'kosakata'=>'pange',
        ],
        [
            'kosakata'=>'pangkur',
        ],
        [
            'kosakata'=>'panti',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'papat',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pasa',
        ],
        [
            'kosakata'=>'pathi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pathok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pati',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'patih',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'patrap',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'paraga',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pari',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'paro',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'diparoh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'payu',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'payung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pedhang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pedhet',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pelem',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pelok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pencit',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pesing',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'pethak',
            'jenis'=>'Tembung kaanan',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'petheng',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'pethit',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pethok',
        ],
        [
            'kosakata'=>'pelo',
        ],
        [
            'kosakata'=>'péthét',
        ],
        [
            'kosakata'=>'pinarak',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'pindang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pinten',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'pinter',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'pipa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pipi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'piranti',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'piring',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pisuh',
        ],
        [
            'kosakata'=>'misuh',
        ],
        [
            'kosakata'=>'pithek',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pitu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'piyik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pocung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'poh',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pohung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'polah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'polong',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ponco',
        ],
        [
            'kosakata'=>'pongge',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'prau',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pring',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'prigel',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'pucung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pundhi',
        ],
        [
            'kosakata'=>'pupoh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'pupu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'pupur',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'purun',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'purwo',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'putu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'rabi',
        ],
        [
            'kosakata'=>'rada',
        ],
        [
            'kosakata'=>'rah',
        ],
        [
            'kosakata'=>'rahap',
        ],
        [
            'kosakata'=>'rahayu',
        ],
        [
            'kosakata'=>'rama',
        ],
        [
            'kosakata'=>'rampal',
        ],
        [
            'kosakata'=>'randha',
        ],
        [
            'kosakata'=>'randhu',
        ],
        [
            'kosakata'=>'raos',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'raseksa',
        ],
        [
            'kosakata'=>'rebab',
        ],
        [
            'kosakata'=>'rebah',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'rebat',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'rebyek',
        ],
        [
            'kosakata'=>'rega',
        ],
        [
            'kosakata'=>'reged',
        ],
        [
            'kosakata'=>'regejegan',
        ],
        [
            'kosakata'=>'regudug',
        ],
        [
            'kosakata'=>'rekadaya',
        ],
        [
            'kosakata'=>'rekaos',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'rekasa',
        ],
        [
            'kosakata'=>'reksa',
        ],
        [
            'kosakata'=>'rembug',
            'ragam'=>'Ngoko'
        ],
        [
            'kosakata'=>'rembag',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'remeng-remeng',
        ],
        [
            'kosakata'=>'remes',
        ],
        [
            'kosakata'=>'rena',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'rencang',
        ],
        [
            'kosakata'=>'rene',
        ],
        [
            'kosakata'=>'renggang',
        ],
        [
            'kosakata'=>'rengka',
        ],
        [
            'kosakata'=>'rengkuh',
        ],
        [
            'kosakata'=>'rese',
        ],
        [
            'kosakata'=>'resek',
        ],
        [
            'kosakata'=>'restu',
        ],
        [
            'kosakata'=>'ribet',
        ],
        [
            'kosakata'=>'ridhu',
        ],
        [
            'kosakata'=>'rikat',
        ],
        [
            'kosakata'=>'rikma',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'rikuh',
        ],
        [
            'kosakata'=>'rimbang',
        ],
        [
            'kosakata'=>'rina',
        ],
        [
            'kosakata'=>'rindhik',
        ],
        [
            'kosakata'=>'ringkes',
        ],
        [
            'kosakata'=>'ringkih',
        ],
        [
            'kosakata'=>'risak',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'rondhé',
        ],
        [
            'kosakata'=>'rosan',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'rucuh',
        ],
        [
            'kosakata'=>'ruda peksa',
        ],
        [
            'kosakata'=>'rudatin',
            'ragam'=>'Ngoko'
        ],
        [
            'kosakata'=>'rudatos',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'rugi',
        ],
        [
            'kosakata'=>'rujak',
        ],
        [
            'kosakata'=>'rujuk',
        ],
        [
            'kosakata'=>'rukuh',
        ],
        [
            'kosakata'=>'rukun',
        ],
        [
            'kosakata'=>'rumangsa',
        ],
        [
            'kosakata'=>'rumaos',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'rumat',
        ],
        [
            'kosakata'=>'rundhuk',
        ],
        [
            'kosakata'=>'rungkat',
        ],
        [
            'kosakata'=>'runut',
        ],
        [
            'kosakata'=>'rupak',
        ],
        [
            'kosakata'=>'rusak',
        ],
        [
            'kosakata'=>'ruwat',
        ],
        [
            'kosakata'=>'rèmèh',
        ],
        [
            'kosakata'=>'remen',
        ],
        [
            'kosakata'=>'resik',
        ],
        [
            'kosakata'=>'rèncèk',
        ],
        [
            'kosakata'=>'régol',
        ],
        [
            'kosakata'=>'saka',
        ],
        [
            'kosakata'=>'sak upomo',
        ],
        [
            'kosakata'=>'sak upo mo',
        ],
        [
            'kosakata'=>'sambang',
        ],
        [
            'kosakata'=>'sambat',
        ],
        [
            'kosakata'=>'sampyuh',
        ],
        [
            'kosakata'=>'sampeyan',
        ],
        [
            'kosakata'=>'sanget',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'sangit',
        ],
        [
            'kosakata'=>'sarira',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'saru',
        ],
        [
            'kosakata'=>'saré',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'sebab',
        ],
        [
            'kosakata'=>'sedhah',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'sedheng',
        ],
        [
            'kosakata'=>'sega',
        ],
        [
            'kosakata'=>'segawon',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'seger',
        ],
        [
            'kosakata'=>'sekar',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'sela',
        ],
        [
            'kosakata'=>'semar',
        ],
        [
            'kosakata'=>'semrawut',
        ],
        [
            'kosakata'=>'sembogo',
        ],
        [
            'kosakata'=>'semrinthil',
        ],
        [
            'kosakata'=>'sendhang',
        ],
        [
            'kosakata'=>'sendhat',
        ],
        [
            'kosakata'=>'seneng',
        ],
        [
            'kosakata'=>'sengak',
        ],
        [
            'kosakata'=>'sengit',
        ],
        [
            'kosakata'=>'senthir',
        ],
        [
            'kosakata'=>'senthong',
        ],
        [
            'kosakata'=>'sepa',
        ],
        [
            'kosakata'=>'sepat',
        ],
        [
            'kosakata'=>'sepet',
        ],
        [
            'kosakata'=>'sibén',
        ],
        [
            'kosakata'=>'sida',
        ],
        [
            'kosakata'=>'sidhat',
        ],
        [
            'kosakata'=>'sidhem',
        ],
        [
            'kosakata'=>'sigar',
        ],
        [
            'kosakata'=>'sikil',
        ],
        [
            'kosakata'=>'sikut',
        ],
        [
            'kosakata'=>'silit',
        ],
        [
            'kosakata'=>'simbah',
        ],
        [
            'kosakata'=>'sinubo',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'sinukarto',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'sinau',
        ],
        [
            'kosakata'=>'sing',
        ],
        [
            'kosakata'=>'sirah',
        ],
        [
            'kosakata'=>'sithik',
        ],
        [
            'kosakata'=>'slamet',
        ],
        [
            'kosakata'=>'slilit',
        ],
        [
            'kosakata'=>'slintru',
        ],
        [
            'kosakata'=>'slomot',
        ],
        [
            'kosakata'=>'slonjor',
        ],
        [
            'kosakata'=>'songo',
        ],
        [
            'kosakata'=>'sonten',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'srei',
        ],
        [
            'kosakata'=>'sruduk',
        ],
        [
            'kosakata'=>'subyung',
        ],
        [
            'kosakata'=>'sugeng',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'sumerap',
        ],
        [
            'kosakata'=>'sumet',
        ],
        [
            'kosakata'=>'sumringah',
        ],
        [
            'kosakata'=>'supit',
        ],
        [
            'kosakata'=>'suruh',
        ],
        [
            'kosakata'=>'surup',
        ],
        [
            'kosakata'=>'surya',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'sudhó',
        ],
        [
            'kosakata'=>'sundhél',
        ],
        [
            'kosakata'=>'sungu',
        ],
        [
            'kosakata'=>'sunggar',
        ],
        [
            'kosakata'=>'séda',
        ],
        [
            'kosakata'=>'sémah',
        ],
        [
            'kosakata'=>'tamba',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tambak',
        ],
        [
            'kosakata'=>'tandang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'tanem',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'tandur',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'tanpa',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'tansah',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'taplak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tebas',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'tebón',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tedhas',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'teken',
        ],
        [
            'kosakata'=>'tekak',
        ],
        [
            'kosakata'=>'tekan',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'tekuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'telak',
        ],
        [
            'kosakata'=>'teluk',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'telukan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'telo bosok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tempe',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'temah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'tembung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tembang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tembelek',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'telek',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tengara',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tenger',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tengik',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'tengu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tentrem',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'tepak',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'tetes',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'thukul',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'tiba',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'tilas',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'tilem',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama',
        ],
        [
            'kosakata'=>'tilik',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'tinimbang',
            'jenis'=>'Tembung panggandheng',
        ],
        [
            'kosakata'=>'timbel',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tingal',
        ],
        [
            'kosakata'=>'tingkep',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tirta',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tinular',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'titis',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'trantanan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'tratapan',
        ],
        [
            'kosakata'=>'tresna',
        ],
        [
            'kosakata'=>'trimah/nrimah',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'tritis/tritisan',
        ],
        [
            'kosakata'=>'trubus',
        ],
        [
            'kosakata'=>'tulada',
        ],
        [
            'kosakata'=>'tumbal',
        ],
        [
            'kosakata'=>'tumbas',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'tuku',
            'ragam'=>'Ngoko'
        ],
        [
            'kosakata'=>'tumben',
        ],
        [
            'kosakata'=>'tumimbal',
        ],
        [
            'kosakata'=>'tumon',
        ],
        [
            'kosakata'=>'tumpak',
        ],
        [
            'kosakata'=>'tumpes',
        ],
        [
            'kosakata'=>'tumplek',
        ],
        [
            'kosakata'=>'tumrap',
        ],
        [
            'kosakata'=>'tungka',
        ],
        [
            'kosakata'=>'tungkak',
        ],
        [
            'kosakata'=>'tutur',
        ],
        [
            'kosakata'=>'tuturi',
        ],
        [
            'kosakata'=>'turangga',
        ],
        [
            'kosakata'=>'turu',
            'ragam'=>'Ngoko'
        ],
        [
            'kosakata'=>'turuk',
        ],
        [
            'kosakata'=>'téplok',
        ],
        
        [
            'kosakata'=>'uber',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ubarampé',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ucap',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ucek',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'uceng',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ucul',
        ],
        [
            'kosakata'=>'udakara',
            'jenis'=>'Tembung panggandheng',
        ],
        [
            'kosakata'=>'udal-udal',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'udan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'udani',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'udel',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'udheng',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'udi',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'udik',
        ],
        [
            'kosakata'=>'udu',
        ],
        [
            'kosakata'=>'udud',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'udun',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'udur',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'uga',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'ugal-ugalan',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'ugel-ugel',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ugeran',
        ],
        [
            'kosakata'=>'uger-uger',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'uget-uget',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ugi',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'ugungan',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'ugung',
        ],
        [
            'kosakata'=>'ugunganipun',
        ],
        [
            'kosakata'=>'uja',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ujar',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ujaripun',
        ],
        [
            'kosakata'=>'ujub',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ujur',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ukara',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ukil',
        ],
        [
            'kosakata'=>'ukir',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ula',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ulap',
        ],
        [
            'kosakata'=>'ular-ular',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ulam',
        ],
        [
            'kosakata'=>'ulem',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ulatipun',
        ],
        [
            'kosakata'=>'uler',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ules',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ulet',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'uleten',
        ],
        [
            'kosakata'=>'ulu',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ulung',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'uman',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'umbar',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'umbel',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'umbul-umbul',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'umbul',
        ],
        [
            'kosakata'=>'diumbul',
        ],
        [
            'kosakata'=>'umek',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'umik-umik',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'umob',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'umpak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'umplung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'umum',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'umur',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'umyek',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'undamana',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'undang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'under',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'undha-undhi',
        ],
        [
            'kosakata'=>'undha',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'undhuh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'undur-undur',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'undur',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'unggah-ungguh',
        ],
        [
            'kosakata'=>'unggul',
        ],
        [
            'kosakata'=>'uni',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'unjuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'unta',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'untab',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'untal',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'untel-untel',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'unthuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'unting',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'untir',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'untu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'untup-untup',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'upah',
        ],
        [
            'kosakata'=>'upama',
            'jenis'=>'Tembung panggandheng',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'upas',
        ],
        [
            'kosakata'=>'upaya',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'ura-ura',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'urap-urap',
        ],
        [
            'kosakata'=>'urik',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'urip',
        ],
        [
            'kosakata'=>'urut',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'usada',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'usap',
        ],
        [
            'kosakata'=>'ngusapi',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'usik',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'usir',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'usus-usus',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'usus',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'utami',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'utang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'utawa',
        ],
        [
            'kosakata'=>'uthis',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'uwa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'uwal',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'uwan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'uwang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'uwi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'uwis',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'uwos',
        ],
        [
            'kosakata'=>'uwos-uwos',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'uyah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'uyuh',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'uyup',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'ujug-ujug',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'waca',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wacana',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wadad',
        ],
        [
            'kosakata'=>'wadag',
        ],
        [
            'kosakata'=>'wadal',
        ],
        [
            'kosakata'=>'wadanan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wadas',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wadat',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'wadhag',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wadhah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wadhang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wadhuk',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wadi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wadon',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wadul',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wadung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wagu',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wagé',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'waja',
        ],
        [
            'kosakata'=>'wajan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wajik',
        ],
        [
            'kosakata'=>'wakul',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'walanda',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'walang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wales',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'walesan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wali',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'walik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'waluh',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'waluya',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'walèh',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'wana',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wanadri',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wanara',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wanci',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wanda',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wandu',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wandé',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wangi',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wangkal',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'wangsit',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wangsul',
            'jenis'=>'Tembung kriya',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'wangsulan',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'wangun',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wangwung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wani',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wanita',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wanodya',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wantah',
        ],
        [
            'kosakata'=>'wanti-wanti',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wanuh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'waos',
        ],
        [
            'kosakata'=>'wara-wara',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'warah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'warak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'warangan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'waranggana',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'warangka',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'waras',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wareg',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'warga',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wargi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'warih',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'waringuten',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'waris',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'warisan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'warna',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'warok',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'warsa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'warta',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'warung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'warèng',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wasis',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'waskitha',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'waspa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'waspada',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wasta',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wastani',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wastra',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'watak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'watara',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'watek',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wates',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'waton',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'watu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'watuk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wau',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'waung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wawacan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wawansabda',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wawas',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wawasan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wayah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wayang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wayu',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wayuh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wedhak',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wedhar',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wedhi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wedhon',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wedhus',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wedi',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wegah',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>"wek'e",
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'wekas',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wekasi',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wekasan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wekdal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'welas',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'weling',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'welèh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wenang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wengi',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'sewengi',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'wengku',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wening',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wentis',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'werdi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'werna',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'weruh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wesi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wetah',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'weteng',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'weton',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wetu',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wewaler',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wewengkon',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'widada',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'widadara',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'widadari',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wigati',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wibi',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'wiji',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wijik',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wilah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wilang',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wilangan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wilujeng',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'winarah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'winengku',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wingi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wingit',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wingking',
            'jenis'=>'Tembung katrangan',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'wingènané',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'winih',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'winisuda',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wirama',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wirang',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wirid',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wiridan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wiring galih',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wiron',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wiru',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wis',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'wisa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wisik',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wisma',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wisuda',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wisuh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wit',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'witikna',
            'jenis'=>'Tembung panggandheng',
        ],
        [
            'kosakata'=>'wiwit',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wiyak',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wiyosan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'woh',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wolu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wondho',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'wong',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wonten',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'wos',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wot',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wrangka',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wré',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wréda',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wucal',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wuda',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'wudel',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wudhar',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wudun',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wukir',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wulan',
            'jenis'=>'Tembung aran',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'wulang',
        ],
        [
            'kosakata'=>'wulangan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wulu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wuluh',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wulung',
        ],
        [
            'kosakata'=>'wungkuk',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wungu',
        ],
        [
            'kosakata'=>'wuninga',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wuri',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'wuru',
        ],
        [
            'kosakata'=>'wuruk',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wurung',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'wus',
            'jenis'=>'Tembung katrangan',
        ],
        [
            'kosakata'=>'wusana',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wuta',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wutah',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wutuh',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wuwuh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wuwung',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wuwus',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wuyung',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wèt',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wèwèh',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'wé',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wédang',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wédhok',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'wétan',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wéwé',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'wruhaniró',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'werdhi',
            'ragam'=>'Krama'
        ],
        [
            'kosakata'=>'yaiku',
        ],
        [
            'kosakata'=>'yaksa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'yamadipati',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'yasa',
            'jenis'=>'Tembung kriya',
        ],
        [
            'kosakata'=>'yatra',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'yayah',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'yayi',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'yekti',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'yuswa',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'yuta',
            'jenis'=>'Tembung wilangan',
        ],
        [
            'kosakata'=>'yuwana',
            'jenis'=>'Tembung kaanan',
        ],
        [
            'kosakata'=>'yuyu',
            'jenis'=>'Tembung aran',
        ],
        [
            'kosakata'=>'yèn',
            'jenis'=>'Tembung panggandheng',
        ],
        
        ];

        // kelola data
        $i=1;
        foreach($data as $d){
            $waktu = fake()->dateTimeBetween('-1 year', 'now');
            $kosakata[$i] = [
                'kosakata' => $d['kosakata'],
                'slug' => strtolower(str_replace(' ', '-', $d['kosakata'])),
                'jenis'=>$d['jenis'] ?? NULL,
                'ragam' => $d['ragam'] ?? NULL,
                'poin' => 50,
                'user_id' => random_int(2, 100),
                // 'arti_indo' => $indonesia[$i],
                // 'serupa' => json_encode([$krama[$i]]),
                // 'serupa' => json_encode($krama[$i]),
                'created_at' => $waktu,
                'updated_at' => $waktu
            ];
            $i=$i+1;
        }

        // simpan kosakata
        Kosakata::insert($kosakata);


        // factory
        // Kosakata::factory(50)->create();
    }
}
