@extends('.../layouts/homepage')

@section('body')
    {{-- Section selamat datang --}}
    <div class="container w-screen mx-auto py-28 text-center">
        {{-- <p class="jawa-h2">ꦱꦸꦒꦼꦁ ꦫꦮꦸꦃ!</p> --}}
        <h1 class="md:text-5xl text-2xl">Selamat datang di <br> <b>Kamus Bahasa Jawa Terbuka</b></h1>
        <p class="mt-5">Kamus bahasa jawa online terlengkap dengan <br> dukungan dari komunitas.</p>
        <form action="/cari" method="GET">
            <input name="keyword" id="keyword" required
                class="rounded-full w-11/12 md:w-1/2 h-12 mt-10 px-7 bg-neutral-200 hover:bg-white hover:outline hover:outline-2 hover:outline-amber-400 focus:outline focus:outline-amber-400 focus:outline-2 focus-within:bg-white"
                type="text" placeholder="Cari...">
        </form>
    </div>

    {{-- Kosakata acak --}}
    @isset($definisi)
        <div class="container mx-auto px-10 py-14 bg-neutral-100 rounded-2xl">
            <h3 class="mb-8 font-semibold text-center">Kosakata Acak Untuk Kamu</h3>
            <div class="grid grid-cols-6 gap-4">
                {{-- Daftar kosakata --}}
                <div class="md:col-start-2 md:col-span-3 col-span-6">
                    @foreach ($definisi as $d)
                        @include('partials.definisi')
                    @endforeach
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
                        <a href="/daftar-kosakata"
                            class="rounded-lg border-2 border-black p-2 small-text hover:bg-black hover:text-white">Klik
                            disini<i data-feather='arrow-right' class="inline-block h-4"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    {{-- artikel terbaru --}}
    @isset($artikel)
        <div class="container mx-auto px-10 py-14 rounded-2xl">
            <h3 class="mb-8 font-semibold text-center">Artikel terbaru</h3>
            <div class="grid grid-cols-6 gap-4">
                {{-- Daftar kosakata --}}
                <div class="md:col-start-2 md:col-span-4 col-span-6 space-y-3 mb-3">
                    @foreach ($artikel as $d)
                        <a href="/blog/post/{{ $d->slug }}"
                            class="grid md:grid-cols-10 grid-cols-12 group w-full rounded-2xl border border-gray-200 hover:border-yellow-100 hover:bg-yellow-100 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-yellow-300 active:bg-yellow-200">
                            <div class="md:col-span-3 col-span-4">
                                <div
                                    class="md:rounded-none md:rounded-l-2xl rounded-l-2xl w-full h-full md:aspect-video aspect-square overflow-hidden">
                                    <img src="{{ isset($d->thumbnail) ? asset('storage/' . $d->thumbnail) : asset('img/no-image.png') }}"
                                        class="w-full h-full object-cover" alt="">
                                </div>
                            </div>
                            <div class="flex items-center md:col-span-7 col-span-7 md:ml-5 ml-3 md:my-0 my-5">
                                <div class="">
                                    @if ($d->pinned == 1)
                                        <div
                                            class="md:text-base text-sm rounded-md bg-yellow-100 inline-block px-2 text-gray-800 group-hover:bg-yellow-200 group-active:bg-yellow-300">
                                            📌Dipin oleh pengurus
                                        </div>
                                    @endif
                                    <h5 class="mb-1 md:line-clamp-2 line-clamp-2 md:text-xl text-sm">{{ $d->judul }}</h5>
                                    <div class="text-gray-700 md:text-base text-xs"><span
                                            class="font-semibold">{{ $d->user->nama ?? '[Akun dihapus]' }}</span>
                                        • {{ $d->updated_at->format('d F Y') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                {{-- Lihat artikel lainnya --}}
                <div class="col-span-6 mx-auto">
                    <a href="/blog"
                        class="bg-amber-400 p-4 rounded-full hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-amber-400 active:bg-amber-500">Baca
                        artikel lainnya <i data-feather='arrow-right' class="inline-block"></i></a>
                </div>
            </div>
        </div>
    @endisset

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
                    alt="Connected world concept illustration (freepik/storyset)"
                    src="{{ asset('img/homepage_banner-01.png') }}">
            </div>

            {{-- Konsep crowdsource --}}
            <div
                class="bg-amber-400 rounded-2xl md:py-5 py-8 md:px-14 md:w-10/12 mx-auto flex md:flex-row flex-col md:justify-between items-center md:space-x-16">
                <img class="object-cover max-w-64" alt="New team member concept illustration (freepik/storyset)"
                    src="{{ asset('img/homepage_banner-02.png') }}">
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
                    alt="Product quality concept illustration (freepik/storyset)"
                    src="{{ asset('img/homepage_banner-03.png') }}">
            </div>
        </div>
    </div>

    {{-- Statisitk pengguna --}}
    <div class="container mx-auto p-10 bg-neutral-100 rounded-xl">
        <div class="mb-3 md:px-24">
            <h3 class="font-semibold mb-5">Kamus Bahasa Jawa Terbuka <br>Dalam Angka</h3>

            <div class="flex md:flex-row flex-col md:space-x-3 md:space-y-0 space-y-3 mb-3">
                <div
                    class="px-10 py-16 bg-white hover:bg-white hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">{{ $jmlAnggota }}</h2>
                    <div>Anggota</div>
                </div>

                <div
                    class="px-10 py-16 bg-white hover:bg-white hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">{{ $jmlKosakata }}</h2>
                    <div>Kosakata</div>
                </div>

                <div
                    class="px-10 py-16 bg-white hover:bg-white hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">{{ $jmlDefinisi }}</h2>
                    <div>Definisi</div>
                </div>

                <div
                    class="px-10 py-16 bg-white hover:bg-white hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">{{ $jmlTerverifikasi }}</h2>
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
                @foreach ($topContributor as $d)
                    <a href="/u/{{ $d->username }}" title="{{ $d->nama }} ({{ $d->username }})"
                        class="overflow-hidden w-14 h-14 rounded-full justify-center hover:outline hover:outline-amber-400 hover:outline-offset-2 hover:outline-2 inline-block">
                        @include('partials.profile-pic-general')
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- FAQ --}}
    <div class="container p-10 mb-5 mx-auto">
        <div class="md:px-24">
            <h3 class="font-semibold mb-5">FAQ</h3>

            <?php
            $faq = [
                [
                    'id' => 1,
                    'title' => 'Bagaimana cara aku ikut berkontribusi?',
                    'content' => 'Kamu bisa mendaftar sebagai pengguna, kemudian mulai menambahkan kata atau definisi baru. Setelah itu, kontribusi kamu akan ditampilkan di halaman kosakata. Kontribusi kamu akan mendapat status "terferifikasi" setelah divalidasi oleh pengurus/moderator.',
                ],
                [
                    'id' => 2,
                    'title' => 'Apakah ada keuntungan menjadi kontributor?',
                    'content' => 'Ya! Kontributor akan mendapatkan poin setiap kali berkontribusi pada komunitas. Poin tersebutmenentukan level kontributor. Kontributor juga akan menerima sertifikat saat mencapai level tertentu. Selain itu, kontributor bisa meraih pencapaian (achievement) khusus dengan menyelesaikan aktivitas tertentu. Pengguna lain pun dapat memberikan donasi langsung kepada kontributor sebagai bentuk apresiasi.',
                ],
                [
                    'id' => 3,
                    'title' => 'Apakah platform ini gratis untuk digunakan?',
                    'content' => 'Ya, platform ini gratis untuk digunakan oleh semua pengguna.',
                ],
                [
                    'id' => 4,
                    'title' => 'Bagaimana jika aku menemukan kata atau definisi yang tidak sesuai?',
                    'content' => 'Kamu dapat melaporkan kata atau definisi tersebut melalui fitur laporkan kesalahan. Pengurus / moderator akan memproses laporan kamu dan melakukan perbaikan jika diperlukan.',
                ],
                [
                    'id' => 5,
                    'title' => 'Apakah aku harus paham Bahasa Jawa untuk menggunakan platform ini?',
                    'content' => 'Tidak. Platform ini dirancang ramah pengguna, termasuk mereka yang baru belajar Bahasa Jawa. Kamu bahkan dapat melihat terjemahan dan contoh penggunaan untuk membantu memahami.',
                ],
            ];
            ?>

            @foreach ($faq as $d)
                <div class="relative">
                    <div id="accordion-header-{{ $d['id'] }}" class="text-neutral-600">
                        <button id="accordion-title-{{ $d['id'] }}"
                            class="w-full bg-white text-left py-5 pl-6 pr-10 border border-neutral-200 hover:bg-amber-100">
                            <i data-feather='help-circle' class="inline-block mr-3"></i>
                            {{ $d['title'] }}
                        </button>
                        <div id="accordion-show-{{ $d['id'] }}"><i data-feather='chevron-down'
                                class="absolute top-5 right-6"></i>
                        </div>
                        <div id="accordion-hide-{{ $d['id'] }}" class="hidden"><i data-feather='chevron-up'
                                class="absolute top-5 right-6"></i>
                        </div>
                    </div>
                    <div id="accordion-content-{{ $d['id'] }}"
                        class="hidden py-5 pl-6 pr-4 border border-neutral-200 text-neutral-600">
                        {!! $d['content'] !!}
                    </div>
                </div>
            @endforeach

            {{-- FAQ 1 --}}
            {{-- <div class="relative">
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
            </div> --}}

            {{-- FAQ 2" --}}
            {{-- <div class="relative">
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
            </div> --}}

            {{-- FAQ 3" --}}
            {{-- <div class="relative">
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
            </div> --}}

            {{-- FAQ 4" --}}
            {{-- <div class="relative">
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
            </div> --}}

            {{-- FAQ 5" --}}
            {{-- <div class="relative">
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
            </div> --}}

        </div>
    </div>

    <script>
        for (let i = 1; i <= 5; i++) {
            document.getElementById(`accordion-title-${i}`).addEventListener('click', () => {
                accordion(
                    5,
                    document.getElementById(`accordion-header-${i}`),
                    document.getElementById(`accordion-title-${i}`),
                    document.getElementById(`accordion-content-${i}`),
                    document.getElementById(`accordion-show-${i}`),
                    document.getElementById(`accordion-hide-${i}`)
                );
            });
        }
    </script>

    {{-- Ajakan untuk berbagung --}}
    <div class="container mx-auto px-10 py-28 bg-amber-400 rounded-xl">
        <div class="grid grid-cols-2">
            <div class="text-center col-span-2 md:col-span-1 mb-10 mt-8">
                <span class="text-6xl jawa font-bold text-white">ꦕꦼꦥꦼ<br>ꦠ꧀ꦒꦧꦸꦁ!</span>
            </div>
            <div class="pr-16 col-span-2 md:col-span-1">
                <h3 class="font-semibold mb-3">Gabung sekarang juga!</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est in unde tempore quasi ratione incidunt
                    assumenda minus explicabo earum officia temporibus iste voluptatibus illum error sed amet.</p>
                <a href="/daftar">
                    <button
                    class="mt-4 rounded-full bg-white py-3 px-6 hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-white active:bg-black active:text-white active:outline-black">
                    Daftar sekarang!
                </button>
                </a>
            </div>
        </div>
    </div>
@endsection
