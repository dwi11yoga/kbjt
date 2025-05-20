<?php

namespace Database\Seeders;

use App\Models\Definisi;
use App\Models\Kosakata;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefinisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // data kosakata
        for ($i = 1; $i <= 500; $i++) {
            // dapatkan data kosakata
            $kosakata = Kosakata::find(random_int(1, 197));
            // dandomisasi bahasa yang digunakan
            $bahasa = random_int(0, 1) === 1 ? 'indonesia' : 'jawa';

            // definisi yang ditulis user
            $indonesia = [
                $kosakata->kosakata . ' merupakan kalimat ' . $kosakata->ragam . ' yang berarti ' . $kosakata->arti_indo . '.',
                $kosakata->kosakata . ' termasuk dalam ragam bahasa ' . $kosakata->ragam . ' dan memiliki arti ' . $kosakata->arti_indo . '.',
                'Dalam bahasa Jawa ' . $kosakata->ragam . ', ' . $kosakata->kosakata . ' berarti ' . $kosakata->arti_indo . '.',
                'Kata ' . $kosakata->kosakata . ' digunakan dalam konteks ' . $kosakata->ragam . ' dan artinya adalah ' . $kosakata->arti_indo . '.',
                'Secara umum, ' . $kosakata->kosakata . ' merupakan bentuk ' . $kosakata->ragam . ' yang mengandung makna ' . $kosakata->arti_indo . '.',
                'Ragam ' . $kosakata->ragam . ' mengenal kata ' . $kosakata->kosakata . ', yang bermakna ' . $kosakata->arti_indo . '.',
                'Jika kamu mendengar kata ' . $kosakata->kosakata . ' dalam ragam ' . $kosakata->ragam . ', itu berarti ' . $kosakata->arti_indo . '.',
                $kosakata->kosakata . ' adalah kosakata dari ragam ' . $kosakata->ragam . ' dengan arti ' . $kosakata->arti_indo . '.',
                'Dalam percakapan sehari-hari berbahasa Jawa ' . $kosakata->ragam . ', ' . $kosakata->kosakata . ' berarti ' . $kosakata->arti_indo . '.',
                'Makna dari ' . $kosakata->kosakata . ' dalam ragam ' . $kosakata->ragam . ' adalah ' . $kosakata->arti_indo . '.',
                'Kata ' . $kosakata->kosakata . ', yang termasuk ragam ' . $kosakata->ragam . ', diterjemahkan sebagai ' . $kosakata->arti_indo . '.',
                'Istilah ' . $kosakata->kosakata . ' muncul dalam ragam ' . $kosakata->ragam . ' dan merujuk pada arti ' . $kosakata->arti_indo . '.',
                'Dalam struktur bahasa Jawa ' . $kosakata->ragam . ', kata ' . $kosakata->kosakata . ' memiliki makna ' . $kosakata->arti_indo . '.',
                'Contoh kata dari ragam ' . $kosakata->ragam . ' adalah ' . $kosakata->kosakata . ', yang artinya ' . $kosakata->arti_indo . '.',
                'Kamu akan menemukan ' . $kosakata->kosakata . ' dalam ragam ' . $kosakata->ragam . ', yang berarti ' . $kosakata->arti_indo . '.',
                'Bahasa Jawa ragam ' . $kosakata->ragam . ' mengenal ' . $kosakata->kosakata . ' sebagai kata yang berarti ' . $kosakata->arti_indo . '.',
            ];

            $jawa = [
                $kosakata->kosakata . ' kalebu tembung ' . $kosakata->ragam . ' sing tegese ' . $kosakata->arti_indo . '.',
                'Ing basa Jawa ' . $kosakata->ragam . ', tembung ' . $kosakata->kosakata . ' artine ' . $kosakata->arti_indo . '.',
                'Tembung ' . $kosakata->kosakata . ' digunakaké ing konteks ' . $kosakata->ragam . ' lan nduwèni teges ' . $kosakata->arti_indo . '.',
                'Biasane ' . $kosakata->kosakata . ' iku kalebu ' . $kosakata->ragam . ' lan tegese ' . $kosakata->arti_indo . '.',
                'Ragam ' . $kosakata->ragam . ' nganggo tembung ' . $kosakata->kosakata . ' sing artine ' . $kosakata->arti_indo . '.',
                'Yèn krungu tembung ' . $kosakata->kosakata . ', iku asalé saka ragam ' . $kosakata->ragam . ' lan maknane ' . $kosakata->arti_indo . '.',
                'Tembung ' . $kosakata->kosakata . ' ing basa ' . $kosakata->ragam . ' duwé arti ' . $kosakata->arti_indo . '.',
                $kosakata->kosakata . ' iku sawijining tembung ' . $kosakata->ragam . ' sing tegese ' . $kosakata->arti_indo . '.',
                'Ing paguneman saben dina nganggo basa ' . $kosakata->ragam . ', ' . $kosakata->kosakata . ' nduwèni arti ' . $kosakata->arti_indo . '.',
                'Tembung ' . $kosakata->kosakata . ' kerep dijumpai ing ragam ' . $kosakata->ragam . ' lan tegese ' . $kosakata->arti_indo . '.',
                $kosakata->kosakata . ' ya iku tembung ing ragam ' . $kosakata->ragam . ', maknané ' . $kosakata->arti_indo . '.',
                'Ing basa ' . $kosakata->ragam . ', tembung ' . $kosakata->kosakata . ' digunaaké kanggo nyebut ' . $kosakata->arti_indo . '.',
                $kosakata->kosakata . ' asalé saka ragam ' . $kosakata->ragam . ' lan nduwèni teges ' . $kosakata->arti_indo . '.',
                'Ana ing basa ' . $kosakata->ragam . ', tembung ' . $kosakata->kosakata . ' dianggep tegesé ' . $kosakata->arti_indo . '.',
                'Tembung ' . $kosakata->kosakata . ' punika kalebet tembung ' . $kosakata->ragam . ' ingkang tegesipun ' . $kosakata->arti_indo . '.',
                'Ing basa Jawa ' . $kosakata->ragam . ', tembung ' . $kosakata->kosakata . ' ngandhut teges ' . $kosakata->arti_indo . '.',
                'Tembung ' . $kosakata->kosakata . ' ingkang dipun-ginakaken ing ragam ' . $kosakata->ragam . ', tegesipun ' . $kosakata->arti_indo . '.',
                'Punika salah satunggaling tembung ' . $kosakata->kosakata . ' ing basa ' . $kosakata->ragam . ', ingkang maknanipun ' . $kosakata->arti_indo . '.',
                'Ragam ' . $kosakata->ragam . ' ngginakaken tembung ' . $kosakata->kosakata . ' ingkang tegesipun ' . $kosakata->arti_indo . '.',
                'Yen panjenengan mireng tembung ' . $kosakata->kosakata . ', punika asalipun saking ragam ' . $kosakata->ragam . ' lan maknanipun ' . $kosakata->arti_indo . '.',
                'Tembung ' . $kosakata->kosakata . ' punika kalebet tembung ing basa ' . $kosakata->ragam . ', lan tegesipun ' . $kosakata->arti_indo . '.',
                'Tembung ' . $kosakata->kosakata . ' ingkang asring dipun-ginakaken punika kalebet ragam ' . $kosakata->ragam . ', ingkang maknanipun ' . $kosakata->arti_indo . '.',
                $kosakata->kosakata . ' inggih punika tembung saking ragam ' . $kosakata->ragam . ', ingkang tegesipun ' . $kosakata->arti_indo . '.',
                'Ing basa ' . $kosakata->ragam . ', tembung ' . $kosakata->kosakata . ' asring dipun-ginakaken lan tegesipun ' . $kosakata->arti_indo . '.',
                'Tembung ' . $kosakata->kosakata . ' ingkang dipun-ginakaken ing basa ' . $kosakata->ragam . ', duwé makna ' . $kosakata->arti_indo . '.',
                'Tembung ' . $kosakata->kosakata . ' inggih punika tembung ing ragam ' . $kosakata->ragam . ', ingkang tegesipun ' . $kosakata->arti_indo . '.',
                'Punika tembung ' . $kosakata->kosakata . ' saking ragam ' . $kosakata->ragam . ', ingkang maknanipun ' . $kosakata->arti_indo . '.',
                $kosakata->kosakata . ' punika tembung ing ragam ' . $kosakata->ragam . ', tegesipun ' . $kosakata->arti_indo . '.',
            ];
            $definisiDitulis = $bahasa == 'indonesia' ? $indonesia[random_int(0, count($indonesia) - 1)] : $jawa[random_int(0, count($jawa) - 1)];

            // referensi
            $referensi = [
                'https://www.detik.com/jateng/berita/d-6489784/110-kosakata-bahasa-jawa-dan-artinya-sering-dipakai-sehari-hari',
                'Poerwadarminta, W.J.S. 1939. Baoesastra Djawa. Batavia: J.B. Wolters',
                'Sudarmanto. 2008. Kamus lengkap bahasa Jawa. Semarang: Widya Karya',
                'https://budiarto.id/bausastra/',
                'https://www.kamusjawa.net/',
                'https://kosakatajawa.com/',
            ];

            // definisi terverifikasi
            $verifikasi = random_int(0, 1);
            $verifikasiTanggal = $verifikasi == 1 ? now() : NULL;
            $verifikasiOleh = $verifikasi == 1 ? random_int(2, 3) : NULL;

            // poin
            $poin_kontributor = 20;
            $poin_verifikasi = $verifikasi == 1 ? 30 : 0;
            $poin_pengurus = $verifikasi == 1 ? 30 : 0;


            // buat waktu random
            $waktu = fake()->dateTimeBetween('-1 year', 'now');

            $definisi[$i] = [
                'kosakata_id' => $kosakata->id,
                'user_id' => random_int(2, 100),
                'definisi' => $definisiDitulis,
                'bahasa' => $bahasa,
                'referensi' => random_int(0, 1) === 1 ? json_encode([$referensi[random_int(0, 5)]]) : null,
                'verifikasi' => $verifikasiTanggal,
                'verifikasi_oleh' => $verifikasiOleh,
                'poin_kontributor' => $poin_kontributor,
                'poin_verifikasi' => $poin_verifikasi,
                'poin_pengurus' => $poin_pengurus,
                'created_at' => $waktu,
                'updated_at' => $waktu
            ];
        }

        Definisi::insert($definisi);







        // Definisi
        // Definisi::insert([
        //     'kosakata_id' => 1,
        //     'user_id' => 1,
        //     'definisi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore assumenda iure quasi vero architecto voluptas repellendus ad? Iste, vero voluptas.',
        //     'created_at' => now(),
        //     'bahasa' => 'indonesia',
        //     'updated_at' => now()
        // ]);

        // Definisi::insert([
        //     'kosakata_id' => 1,
        //     'user_id' => random_int(2, 100),
        //     'definisi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores ipsum, tenetur ipsa praesentium ut dignissimos.',
        //     'created_at' => now(),
        //     'bahasa' => 'indonesia',
        //     'updated_at' => now()
        // ]);

        // Definisi::insert([
        //     'kosakata_id' => 1,
        //     'user_id' => random_int(2, 100),
        //     'definisi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Inventore assumenda iure quasi vero architecto voluptas repellendus ad? Iste, vero voluptas.',
        //     'referensi' => json_encode(['https://google.com/images']),
        //     'bahasa' => 'indonesia',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // Factory
        // Definisi::factory(100)->create();
    }
}
