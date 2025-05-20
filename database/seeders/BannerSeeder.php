<?php

namespace Database\Seeders;

use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Banner::insert([
            [
                'name' => 'Banner 1: Sidebar',
                'status' => 1,
                'img' => 'banner/RYwUTp28YiYa8L0New2lgLjcMowCFnOP65bttGCB.jpg',
                'url' => 'https://www.freepik.com/free-psd/digital-marketing-agency-corporate-social-media-banner-instagram-post-template_151597830.htm#fromView=search&page=1&position=18&uuid=071dfc79-1515-4fff-84d5-2b204d847081&query=web+ad',
                'catatan' => 'Banner ini ditampilkan di bagian sidebar. Disarankan menggunakan gambar berorientasi kotak atau portrait',
                'hover_title' => 'Iklan Digital Marketing Agency',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Banner 2: Sidebar',
                'status' => 1,
                'img' => 'banner/6ZugYjmB4g41VvrERFcK0Vc7bK89zGK9Z9F2r6MY.jpg',
                'url' => 'https://www.freepik.com/free-psd/digital-marketing-agency-corporate-facebook-instagram-story-template_299417008.htm#fromView=search&page=1&position=31&uuid=071dfc79-1515-4fff-84d5-2b204d847081&query=web+ad',
                'catatan' => 'Banner ini ditampilkan di bagian sidebar. Disarankan menggunakan gambar berorientasi kotak atau portrait',
                'hover_title' => 'Iklan Digital Marketing Agency',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Banner 3: Artikel',
                'status' => 1,
                'img' => 'banner/tZswhoKVJeeRTfTcdvGpzXpBGFEeigGQ5dg8DClQ.jpg',
                'url' => 'https://www.freepik.com/free-vector/beauty-product-line-with-cream-smear-brush-strokes-marble_5467361.htm#fromView=search&page=2&position=11&uuid=aae432e4-7423-4a7e-998b-60f18dc924d1&query=product+ad',
                'catatan' => 'Banner ini ditampilkan pada halaman artikel. Disarankan menggunakan gambar berorientasi landscape',
                'hover_title' => 'Iklan Skin Care',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Banner 4: Artikel',
                'status' => 1,
                'img' => 'banner/yvLc282mHGFuKRSFpwowVodQaUd9CBG9oUN00Njo.jpg',
                'url' => 'https://www.freepik.com/free-vector/green-glass-jar-with-natural-cream_4188889.htm#fromView=search&page=1&position=11&uuid=aae432e4-7423-4a7e-998b-60f18dc924d1&query=product+ad',
                'catatan' => 'Banner ini ditampilkan pada halaman artikel. Disarankan menggunakan gambar berorientasi landscape',
                'hover_title' => 'Iklan Skin Care',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Banner 5: Definisi',
                'status' => 1,
                'img' => 'banner/PzrK8a5cs7T5ZNyfPamJMzRqi6mLup5jXhdLXkWT.jpg',
                'url' => 'https://www.freepik.com/free-vector/beauty-product-line-with-cream-smear-brush-strokes-marble_5467361.htm#fromView=search&page=2&position=11&uuid=aae432e4-7423-4a7e-998b-60f18dc924d1&query=product+ad',
                'catatan' => 'Banner ini ditampilkan pada halaman definisi kosakata. Disarankan menggunakan gambar berorientasi landscape',
                'hover_title' => 'Iklan Skin Care',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Banner 6: Definisi',
                'status' => 1,
                'img' => 'banner/CSrxf3KLR69o8rD4FyNoGOAwgk5ZR5EzYsWgAx00.jpg',
                'url' => 'https://www.freepik.com/free-vector/green-glass-jar-with-natural-cream_4188889.htm#fromView=search&page=1&position=11&uuid=aae432e4-7423-4a7e-998b-60f18dc924d1&query=product+ad',
                'catatan' => 'Banner ini ditampilkan pada halaman definisi kosakata. Disarankan menggunakan gambar berorientasi landscape',
                'hover_title' => 'Iklan Skin Care',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Banner 7: Dashboard',
                'status' => 1,
                'img' => 'banner/N68kHIg5dKvJcOz9PJOa8CBUhXPUbpHzTYuykGrg.jpg',
                'url' => 'https://www.freepik.com/free-psd/product-temaplte-design_184273642.htm#fromView=search&page=3&position=48&uuid=aae432e4-7423-4a7e-998b-60f18dc924d1&query=product+ad',
                'catatan' => 'Banner ini ditampilkan pada halaman dashboard. Disarankan menggunakan gambar berorientasi landscape',
                'hover_title' => 'Bago Spring Collection Diskon Musim Semi',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}