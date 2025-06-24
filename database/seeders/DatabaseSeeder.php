<?php

namespace Database\Seeders;

use App\Models\Achievement;
use App\Models\EditKosakata;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Edit kosakata
        EditKosakata::insert([
            [
                'user_id' => random_int(4, 100),
                'kosakata_id' => 1,
                'ragam' => 'Krama',
                'jenis' => 'Verba',
                'notasi_fonetik' => 'ma-da-ra-n',
                'arti_indo' => 'Malam',
                'etimologi' => json_encode(['Asli']),
                'serupa' => json_encode(['bengi']),
                'poin_user' => 30,
                'pengurus_id' => random_int(2, 3),
                'status' => now(),
                'poin_pengurus' => 20,
                'catatan' => 'Cuando calienta el sol aqui en la playa siento tu cuerpo vibrar cerca de mi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => random_int(4, 100),
                'kosakata_id' => 1,
                'ragam' => 'Krama',
                'aksara' => 'ꦩꦢꦫꦤ꧀',
                'jenis' => 'Nomina',
                'notasi_fonetik' => 'ma-da-ran',
                'arti_indo' => 'Perut',
                'etimologi' => json_encode(['Asli']),
                'serupa' => json_encode(['weteng']),
                'poin_user' => 30,
                'pengurus_id' => random_int(2, 3),
                'status' => now(),
                'poin_pengurus' => 20,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
        // Edit kosakata
        // EditKosakata::insert([
        //     'user_id' => 29,
        //     'kosakata_id' => 1,
        //     'ragam' => 'Ngoko',
        //     'jenis' => 'Verba',
        //     'notasi_fonetik' => 'ma-da-ra-n',
        //     'arti_indo' => 'Malam',
        //     'etimologi' => json_encode(['Asli']),
        //     'serupa' => json_encode(['bengi']),
        //     'catatan' => 'Cuando calienta el sol aqui en la playa siento tu cuerpo vibrar cerca de mi',
        //     'created_at' => now(),
        //     'updated_at' => now()
        // ]);

        // panggil file seeder yang akan dijalankan
        $this->call([
            AchievementSeeder::class,
            BannerSeeder::class,
            BlogSeeder::class,
            KosakataSeeder::class,
            DefinisiSeeder::class,
            ReportSeeder::class,
            LevelSeeder::class,
            PoinKontribusiSeeder::class,
            SertifikatSeeder::class,
            UserSeeder::class,
            StatistikSeeder::class,
        ]);
    }

}
