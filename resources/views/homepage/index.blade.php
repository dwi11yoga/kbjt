@extends('.../layouts/homepage')

@section('body')
    {{-- Section selamat datang --}}
    <div class="container w-screen mx-auto py-28 text-center">
        {{-- <p class="jawa-h2 -mb-3">ꦱꦸꦒꦼꦁ ꦫꦮꦸꦃ!</p> --}}
        <h1 class="md:text-5xl text-2xl">Selamat datang di <br> <b>Kamus Bahasa Jawa Terbuka</b></h1>
        <p class="mt-5">Kamus bahasa jawa online terlengkap dengan <br> dukungan dari komunitas.</p>
        <form action="#" method="GET">
            @csrf
            <input
                class="rounded-full w-11/12 md:w-1/2 h-12 mt-10 px-7 bg-neutral-200 hover:bg-white hover:outline hover:outline-2 hover:outline-amber-400 focus:outline focus:outline-amber-400 focus:outline-2 focus-within:bg-white"
                type="text" placeholder="Cari...">
        </form>
    </div>

    {{-- Kosakata acak --}}
    <div class="container mx-auto px-10 py-14 bg-neutral-100 rounded-2xl">
        <h3 class="mb-8 font-semibold text-center">Kosakata Acak Untuk Kamu</h3>
        <div class="grid grid-cols-6 gap-4">
            {{-- Daftar kosakata --}}
            <div class="md:col-start-2 md:col-span-3 col-span-6">
                <div class="bg-white rounded-2xl p-6 mb-4 hover:outline hover:outline-2 hover:outline-amber-400">
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

                <div class="bg-white rounded-2xl p-6 mb-4 hover:outline hover:outline-2 hover:outline-amber-400">
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

                <div class="bg-white rounded-2xl p-6 mb-4 hover:outline hover:outline-2 hover:outline-amber-400">
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

                <div class="bg-white rounded-2xl p-6 mb-4 hover:outline hover:outline-2 hover:outline-amber-400">
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
            {{-- Mobile --}}
            <div class="md:hidden block col-span-6 mx-auto">
                <a href="#"
                    class="bg-amber-400 p-4 rounded-full hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-amber-400 active:bg-amber-500">Temukan
                    kosakata lainnya <i data-feather='arrow-right' class="inline-block"></i></a>
            </div>
            {{-- Desktop --}}
            <div class="md:block hidden col-span-1">
                <div class="bg-amber-400 rounded-2xl p-6 sticky top-24 z-0">
                    <h4 class="font-bold mb-2">Temukan kosakata lainnya!</h4>
                    <button class="rounded-lg border-2 border-black p-2 small-text hover:bg-black hover:text-white">Klik
                        disini<i data-feather='arrow-right' class="inline-block h-4"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengenalan kbjt --}}
    <div class="container mx-auto p-10">
        <h3 class="font-semibold md:px-24 mb-6">Apa itu Kamus Bahasa Jawa Terbuka?</h3>
        <div class="space-y-5">
            {{-- Pengertian --}}
            <div
                class="bg-amber-400 rounded-2xl md:py-5 py-8 md:px-14 md:w-10/12 mx-auto flex md:flex-row flex-col md:justify-between items-center md:space-x-16">
                <p class="md:order-1 order-2 md:px-0 px-10 md:pt-0 pt-5">
                    <span class="font-semibold">Kamus Bahasa Jawa Terbuka adalah</span> sebuah platform digital
                    yang
                    dirancang untuk memfasilitasi pengguna
                    dalam mencari, mempelajari, dan memperkaya kosa kata bahasa Jawa. Situs ini dibangun tidak hanya sebagai
                    media informasi, tetapi juga sebagai sarana pelestarian bahasa jawa.
                </p>
                <img class="md:order-2 order-1 object-cover max-w-64"
                    src="https://cdn3d.iconscout.com/3d/premium/thumb/language-translate-3d-illustration-download-in-png-blend-fbx-gltf-file-formats--learning-international-course-global-online-school-pack-education-illustrations-3404368.png"
                    alt="3d language icon">
            </div>

            {{-- Konsep crowdsource --}}
            <div
                class="bg-amber-400 rounded-2xl md:py-5 py-8 md:px-14 md:w-10/12 mx-auto flex md:flex-row flex-col md:justify-between items-center md:space-x-16">
                <img class="object-cover max-w-64"
                    src="https://static.vecteezy.com/system/resources/thumbnails/022/597/384/small_2x/3d-chatting-social-media-png.png"
                    alt="3d language icon">
                <p class="md:px-0 px-10 md:pt-0 pt-5">
                    Situs ini menggunakan <span class="font-semibold">konsep crowdsourcing</span>, di mana pengguna dapat
                    berkontribusi secara aktif sehingga
                    konten kamus dapat terus berkembang. Melalui fitur ini, pengguna dapat menambahkan kata baru, memberikan
                    arti, contoh kalimat, atau memberikan penjelasan lebih lanjut tentang istilah yang sudah ada.
                </p>
            </div>

            {{-- Keunggulan --}}
            <div
                class="bg-amber-400 rounded-2xl md:py-5 py-8 md:px-14 md:w-10/12 mx-auto flex md:flex-row flex-col md:justify-between items-center md:space-x-16">
                <p class="md:order-1 order-2 md:px-0 px-10 md:pt-0 pt-5">
                    Akses yang mudah melalui internet memungkinkan siapa saja, kapan saja, untuk belajar bahasa
                    Jawa, tanpa dibatasi oleh lokasi atau perangkat. Hal ini menjadikannya alat yang efektif untuk
                    melestarikan dan mempopulerkan bahasa Jawa di era digital.
                </p>
                <img class="md:order-2 order-1 object-cover max-w-64"
                    src="https://cdn3d.iconscout.com/3d/premium/thumb/thumb-up-3d-icon-download-in-png-blend-fbx-gltf-file-formats--like-logo-feedback-hand-gesture-ui-kit-elements-pack-user-interface-icons-5285041.png"
                    alt="3d language icon">
            </div>
        </div>
    </div>

    {{-- Statisitk pengguna --}}
    <div class="container mx-auto p-10 bg-neutral-100 rounded-xl">
        <div class="mb-3 md:px-24">
            <h3 class="font-semibold mb-5">Kamus Bahasa Jawa Terbuka <br>Dalam Statistik</h3>

            <div class="flex md:flex-row flex-col md:space-x-3 space-y-3 mb-3">
                <div
                    class="px-10 py-16 bg-white hover:bg-white hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">9.213</h2>
                    <div>Anggota</div>
                </div>

                <div
                    class="px-10 py-16 bg-white hover:bg-white hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">27.551</h2>
                    <div>Kosakata</div>
                </div>

                <div
                    class="px-10 py-16 bg-white hover:bg-white hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">67.974</h2>
                    <div>Definisi</div>
                </div>

                <div
                    class="px-10 py-16 bg-white hover:bg-white hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">20.151</h2>
                    <div>Definisi Terverifikasi</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Kontributor teratas --}}
    <div class="container mx-auto pt-10 text-center">
        <div class="md:px-24">
            <h3 class="font-semibold mb-3">Kontributor Teratas</h3>
            <p class="w-2/3 mx-auto">
                Mereka yang menjadi tulang punggung Kamus Bahasa Jawa Terbuka. Mereka yang telah menyumbangkan waktu dan
                pengetahuan untuk memperkaya kamus ini demi melestarikan bahasa jawa.
            </p>
            <div class="mx-auto mt-8 space-x-2 space-y-1">
                <?php for ($i=0; $i < 100; $i++) { ?>
                {{-- <div class="rounded-full w-12 h-12 bg-yellow-400 mr-3 inline-block"></div> --}}
                <div
                    class="overflow-hidden w-14 h-14 rounded-full justify-center hover:outline hover:outline-amber-400 hover:outline-offset-2 hover:outline-2 inline-block">
                    <img class="w-full h-full object-cover"
                        src="https://cdn.thefairnews.co.kr/news/photo/202404/25369_59232_5627.jpg" alt="Profile picture">
                </div>
                <?php
            } ?>
            </div>
        </div>
    </div>

    {{-- FAQ --}}
    <div class="container p-10 mb-5 mx-auto">
        <div class="md:px-24">
            <h3 class="font-semibold mb-5">FAQ</h3>

            {{-- FAQ 1 --}}
            <div class="relative">
                <div id="accordion-header-1" class="text-neutral-600">
                    <button id="accordion-title-1"
                        class="w-full bg-white text-left py-5 pl-6 pr-10 rounded-t-xl border border-neutral-200 hover:bg-amber-100">
                        <i data-feather='help-circle' class="inline-block mr-3"></i>
                        Bagaimana cara saya ikut berkontribusi?
                    </button>
                    <div id="accordion-show-1"><i data-feather='chevron-down' class="absolute top-5 right-6"></i></div>
                    <div id="accordion-hide-1" class="hidden"><i data-feather='chevron-up'
                            class="absolute top-5 right-6"></i>
                    </div>
                </div>
                <div id="accordion-content-1" class="hidden py-5 pl-6 pr-4 border border-neutral-200 text-neutral-600">
                    <p>Kamu bisa mendaftar sebagai pengguna, kemudian mulai menambahkan kata atau definisi baru. Setelah
                        itu,
                        kontribusi kamu akan ditampilkan di halaman kosakata. Kontribusi kamu akan mendapat status
                        "terferifikasi" setelah divalidasi oleh pengurus/moderator.
                    </p>
                </div>
            </div>

            {{-- FAQ 2" --}}
            <div class="relative">
                <div id="accordion-header-2" class="text-neutral-600">
                    <button id="accordion-title-2"
                        class="w-full bg-white text-left py-5 pl-6 pr-10 border border-neutral-200 hover:bg-amber-100">
                        <i data-feather='help-circle' class="inline-block mr-3"></i>
                        Apakah ada keuntungan menjadi kontributor?
                    </button>
                    <div id="accordion-show-2"><i data-feather='chevron-down' class="absolute top-5 right-6"></i>
                    </div>
                    <div id="accordion-hide-2" class="hidden"><i data-feather='chevron-up'
                            class="absolute top-5 right-6"></i>
                    </div>
                </div>
                <div id="accordion-content-2" class="hidden py-5 pl-6 pr-4 border border-neutral-200 text-neutral-600">
                    <p>
                        Ya! Kontributor akan mendapatkan poin setiap kali berkontribusi pada komunitas. Poin tersebut
                        menentukan
                        level kontributor. Kontributor juga akan menerima sertifikat saat mencapai level tertentu. Selain
                        itu,
                        kontributor bisa meraih pencapaian (achievement) khusus dengan menyelesaikan aktivitas tertentu.
                        Pengguna lain pun dapat memberikan donasi langsung kepada kontributor sebagai bentuk apresiasi.
                    </p>
                </div>
            </div>

            {{-- FAQ 3" --}}
            <div class="relative">
                <div id="accordion-header-3" class="text-neutral-600">
                    <button id="accordion-title-3"
                        class="w-full bg-white text-left py-5 pl-6 pr-10 border border-neutral-200 hover:bg-amber-100">
                        <i data-feather='help-circle' class="inline-block mr-3"></i>
                        Apakah platform ini gratis untuk digunakan?
                    </button>
                    <div id="accordion-show-3"><i data-feather='chevron-down' class="absolute top-5 right-6"></i>
                    </div>
                    <div id="accordion-hide-3" class="hidden"><i data-feather='chevron-up'
                            class="absolute top-5 right-6"></i>
                    </div>
                </div>
                <div id="accordion-content-3" class="hidden py-5 pl-6 pr-4 border border-neutral-200 text-neutral-600">
                    Ya, platform ini gratis untuk semua pengguna. Meski begitu, kamu dapat mendukung keberlanjutan aplikasi
                    ini melalui donasi. Uang donasi nantinya digunakan untuk membayar hosting dan domain.
                </div>
            </div>

            {{-- FAQ 4" --}}
            <div class="relative">
                <div id="accordion-header-4" class="text-neutral-600">
                    <button id="accordion-title-4"
                        class="w-full bg-white text-left py-5 pl-6 pr-10 border border-neutral-200 hover:bg-amber-100">
                        <i data-feather='help-circle' class="inline-block mr-3"></i>
                        Bagaimana jika saya menemukan kata atau definisi yang tidak sesuai?
                    </button>
                    <div id="accordion-show-4"><i data-feather='chevron-down' class="absolute top-5 right-6"></i>
                    </div>
                    <div id="accordion-hide-4" class="hidden"><i data-feather='chevron-up'
                            class="absolute top-5 right-6"></i>
                    </div>
                </div>
                <div id="accordion-content-4" class="hidden py-5 pl-6 pr-4 border border-neutral-200 text-neutral-600">
                    Kamu dapat melaporkan kata atau definisi tersebut melalui fitur laporkan kesalahan. Pengurus / moderator
                    akan memproses laporan kamu dan melakukan perbaikan jika diperlukan.
                </div>
            </div>

            {{-- FAQ 5" --}}
            <div class="relative">
                <div id="accordion-header-5" class="text-neutral-600">
                    <button id="accordion-title-5"
                        class="w-full bg-white text-left py-5 pl-6 pr-10 border border-neutral-200 hover:bg-amber-100">
                        <i data-feather='help-circle' class="inline-block mr-3"></i>
                        Apakah saya harus paham Bahasa Jawa untuk menggunakan platform ini?
                    </button>
                    <div id="accordion-show-5"><i data-feather='chevron-down' class="absolute top-5 right-6"></i>
                    </div>
                    <div id="accordion-hide-5" class="hidden"><i data-feather='chevron-up'
                            class="absolute top-5 right-6"></i>
                    </div>
                </div>
                <div id="accordion-content-5" class="hidden py-5 pl-6 pr-4 border border-neutral-200 text-neutral-600">
                    Tidak. Platform ini dirancang ramah pengguna, termasuk mereka yang baru belajar Bahasa Jawa. Kamu bahkan
                    dapat melihat terjemahan dan contoh penggunaan untuk membantu memahami.
                </div>
            </div>

        </div>
    </div>

    <script>
        function accordion(accordionHeader, accordionTitle, accordionContent, accordionShow, accordionHide) {
            accordionContent.classList.toggle('hidden');
            if (accordionContent.classList.contains('hidden')) { // Jika item disembunyikan
                accordionTitle.classList.remove('bg-amber-100');
                accordionTitle.classList.add('bg-white', 'text-neutral-600');
                accordionShow.classList.remove('hidden');
                accordionHide.classList.add('hidden');
                accordionHeader.classList.remove('text-amber-700');
                accordionHeader.classList.add('text-neutral-600');
            } else { //Jika item ditampilkan
                accordionTitle.classList.remove('bg-white', 'text-neutral-600')
                accordionTitle.classList.add('bg-amber-100');
                accordionShow.classList.add('hidden');
                accordionHide.classList.remove('hidden');
                accordionHeader.classList.remove('text-neutral-600');
                accordionHeader.classList.add('text-amber-700');
            }
        }
    </script>

    <?php for($i=1; $i<=5; $i++) { ?>
    <script>
        document.getElementById('accordion-title-<?= $i ?>').addEventListener('click', () => {
            accordion(
                document.getElementById('accordion-header-<?= $i ?>'),
                document.getElementById('accordion-title-<?= $i ?>'),
                document.getElementById('accordion-content-<?= $i ?>'),
                document.getElementById('accordion-show-<?= $i ?>'),
                document.getElementById('accordion-hide-<?= $i ?>')
            );
        });
    </script>
    <?php } ?>

    {{-- Ajakan untuk berbagung --}}
    <div class="container mx-auto px-10 py-28 bg-amber-400 rounded-xl">
        <div class="grid grid-cols-2">
            <div class="text-center col-span-2 md:col-span-1 mb-10 mt-8">
                <span class="text-6xl font-bold text-white"
                    style="font-family: 'Noto Sans Javanese', sans-serif">ꦕꦼꦥꦼ<br>ꦠ꧀ꦒꦧꦸꦁ!</span>
            </div>
            <div class="pr-16 col-span-2 md:col-span-1">
                <h3 class="font-semibold mb-3">Gabung sekarang juga!</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est in unde tempore quasi ratione incidunt
                    assumenda minus explicabo earum officia temporibus iste voluptatibus illum error sed amet.</p>
                <button
                    class="mt-4 rounded-full bg-white py-3 px-6 hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-white active:bg-black active:text-white active:outline-black">Daftar
                    sekarang!</button>
            </div>
        </div>
    </div>
@endsection
