@extends('.../layouts/homepage')

@section('body')
    {{-- Section selamat datang --}}
    <div class="container mx-auto py-28 text-center bg-white">
        <p class="jawa-h2 -mb-3">ꦱꦸꦒꦼꦁ ꦫꦮꦸꦃ!</p>
        <h1 class="">Selamat datang di <br> <b>Kamus Bahasa Jawa Terbuka</b> 👋</h1>
        <p class="mt-5">Kamus bahasa jawa online terlengkap dengan <br> dukungan dari komunitas.</p>
        <input
            class="rounded-full w-11/12 md:w-1/2 h-12 mt-10 px-7 bg-gray-100 focus:bg-white focus:outline-none focus:outline-yellow-500"
            type="text" placeholder="Cari...">
    </div>

    {{-- Kosakata acak --}}
    <div class="container mx-auto bg-slate-100 p-10">
        <h3 class="mb-6 font-bold text-center">Kosakata Acak Untuk Kamu</h3>
        <div class="grid grid-cols-6 gap-4">
            {{-- Daftar kosakata --}}
            <div class="col-start-2 col-span-3 ">
                <div class="bg-white rounded-2xl p-6 mb-4">
                    {{-- Kosakata --}}
                    <h5 class="font-semibold mb-4">Siram</h5>
                    {{-- Definisi --}}
                    <p class="mb-3">Bahasa krama dari "mandi". Biasa digunakan ketika aksi dilakukan oleh seseorang yang
                        lebih
                        tua.</p>
                    {{-- Contoh kalimat --}}
                    <p>Contoh kalimat:</p>
                    <p>"Bapak nembe siram" (Ayah sedang mandi)</p>
                    {{-- Referensi --}}
                    <div class="italic font-light small-text mt-4">
                        <p>Referensi</p>
                        <ul class="list-decimal list-inside">
                            <li>Kitab Pranata Adicara (Purwadi, 2020)</li>
                            <li>https://www.cnnindoensia.com/bahasa-krama</li>
                        </ul>
                    </div>
                    {{-- Author --}}
                    <p class="mt-4 mb-2">Disubmit oleh</p>
                    <div class="rounded-full w-12 h-12 bg-yellow-400 float-left mr-3"></div>
                    <p>Muklis Satriya Nugraha</p>
                    <p class="small-text">20 September 2024</p>
                </div>

                <div class="bg-white rounded-2xl p-6 mb-4">
                    {{-- Kosakata --}}
                    <h5 class="font-semibold mb-4">Siram</h5>
                    {{-- Definisi --}}
                    <p class="mb-3">Bahasa krama dari "mandi". Biasa digunakan ketika aksi dilakukan oleh seseorang yang
                        lebih tua.</p>
                    {{-- Contoh kalimat --}}
                    <p>Contoh kalimat:</p>
                    <p>"Bapak nembe siram" (Ayah sedang mandi)</p>
                    {{-- Referensi --}}
                    <div class="italic font-light small-text mt-4">
                        <p>Referensi</p>
                        <ul class="list-decimal list-inside">
                            <li>Kitab Pranata Adicara (Purwadi, 2020)</li>
                            <li>https://www.cnnindoensia.com/bahasa-krama</li>
                        </ul>
                    </div>
                    {{-- Author --}}
                    <p class="mt-4 mb-2">Disubmit oleh</p>
                    <div class="rounded-full w-12 h-12 bg-yellow-400 float-left mr-3"></div>
                    <p>Muklis Satriya Nugraha</p>
                    <p class="small-text">20 September 2024</p>
                </div>

                <div class="bg-white rounded-2xl p-6 mb-4">
                    {{-- Kosakata --}}
                    <h5 class="font-semibold mb-4">Siram</h5>
                    {{-- Definisi --}}
                    <p class="mb-3">Bahasa krama dari "mandi". Biasa digunakan ketika aksi dilakukan oleh seseorang yang
                        lebih
                        tua.</p>
                    {{-- Contoh kalimat --}}
                    <p>Contoh kalimat:</p>
                    <p>"Bapak nembe siram" (Ayah sedang mandi)</p>
                    {{-- Referensi --}}
                    <div class="italic font-light small-text mt-4">
                        <p>Referensi</p>
                        <ul class="list-decimal list-inside">
                            <li>Kitab Pranata Adicara (Purwadi, 2020)</li>
                            <li>https://www.cnnindoensia.com/bahasa-krama</li>
                        </ul>
                    </div>
                    {{-- Author --}}
                    <p class="mt-4 mb-2">Disubmit oleh</p>
                    <div class="rounded-full w-12 h-12 bg-yellow-400 float-left mr-3"></div>
                    <p>Muklis Satriya Nugraha</p>
                    <p class="small-text">20 September 2024</p>
                </div>
            </div>
            {{-- Lihat kosakata lainnya --}}
            <div>
                <div class="bg-yellow-400 rounded-2xl p-6 sticky top-24 z-0">
                    <h4 class="font-bold mb-2">Temukan kosakata lainnya!</h4>
                    <button class="rounded-lg border-2 border-black p-2 small-text hover:bg-black hover:text-white">Klik
                        disini<i data-feather='arrow-right' class="inline-block h-4"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengenalan kbjt --}}
    <div class="container mx-auto p-10">
        <h3 class="font-bold mb-6 text-center">Apa itu Kamus Bahasa Jawa Terbuka?</h3>
        <div class="bg-yellow-400 rounded-2xl py-24 px-14 w-10/12 mx-auto">
            <p>Kamus Bahasa Jawa Terbuka adalah Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed nobis quia
                delectus iure, corrupti tempora culpa ut minima voluptatibus. Quisquam recusandae laborum et quam soluta
                nulla, culpa architecto! Ea at pariatur earum libero incidunt hic qui aliquid. Neque aperiam sunt a veniam
                reprehenderit fugit fugiat vitae similique, id placeat molestias!</p>
        </div>
    </div>

    {{-- Statisitk pengguna --}}
    <div class="container mx-auto p-10">
        <div class="grid grid-cols-2 mb-3">
            <div class="pr-10 place-content-center">
                <h3 class="font-bold mb-4">Statistik <br>Kamus Bahasa Jawa Terbuka </h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Est maxime similique quam labore quae adipisci.
                    Debitis accusamus nisi veritatis, reprehenderit quo mollitia quas explicabo? Iste, optio aspernatur.
                    Consectetur, libero? Incidunt?</p>
            </div>
            <div>
                <div class="flex space-x-3 mb-3">
                    <div
                        class="p-10 bg-yellow-100 hover:bg-yellow-200 hover:outline hover:outline-offset-2 hover:outline-yellow-400 hover:outline-2 rounded-2xl w-1/2 text-center">
                        <h2 class="font-bold">9.213</h2>
                        <div>Anggota</div>
                    </div>

                    <div
                        class="p-10 bg-yellow-100 hover:bg-yellow-200 hover:outline hover:outline-offset-2 hover:outline-yellow-400 hover:outline-2 rounded-2xl w-1/2 text-center">
                        <h2 class="font-bold">27.551</h2>
                        <div>Kosakata</div>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <div
                        class="p-10 bg-yellow-100 hover:bg-yellow-200 hover:outline hover:outline-offset-2 hover:outline-yellow-400 hover:outline-2 rounded-2xl w-1/2 text-center">
                        <h2 class="font-bold">67.974</h2>
                        <div>Definisi</div>
                    </div>

                    <div
                        class="p-10 bg-yellow-100 hover:bg-yellow-200 hover:outline hover:outline-offset-2 hover:outline-yellow-400 hover:outline-2 rounded-2xl w-1/2 text-center">
                        <h2 class="font-bold">20.151</h2>
                        <div>Definisi Terverifikasi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto p-10 text-center">
        <h3 class="mb-3 font-bold">Kontributor Teratas</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat alias voluptatibus dicta iure mollitia magnam,
            <br>ipsa consectetur atque reprehenderit itaque!
        </p>
        <div class="w-10/12 mx-auto mt-8">
            <?php 
            for ($i=0; $i < 100; $i++) { 
                ?>
            <div class="rounded-full w-12 h-12 bg-yellow-400 mr-3 inline-block"></div>
            <?php
            }
                ?>
        </div>
    </div>

    {{-- Ajakan untuk berbagung --}}
    <div class="container mx-auto px-10 py-28 bg-yellow-400">
        <div class="grid grid-cols-2">
            <div class="text-center col-span-2 md:col-span-1 mb-10 mt-8">
                <span class="text-6xl font-bold text-white"
                    style="font-family: 'Noto Sans Javanese', sans-serif">ꦕꦼꦥꦼ<br>ꦠ꧀ꦒꦧꦸꦁ!</span>
            </div>
            <div class="pr-16 col-span-2 md:col-span-1">
                <h3 class="font-bold mb-3">Gabung sekarang juga!</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est in unde tempore quasi ratione incidunt
                    assumenda minus explicabo earum officia temporibus iste voluptatibus illum error sed amet.</p>
                <button
                    class="mt-4 rounded-full bg-white py-3 px-6 hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-white active:bg-black active:text-white active:outline-black">Daftar
                    sekarang!</button>
            </div>
        </div>
    </div>
@endsection
