<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use App\Models\Definisi;

new class extends Component {
    //dapatkan top kontributor
    #[Title('Selamat Datang Di Kamus Bahasa Jawa Terbuka')]
    #[Computed]
    public function topContributors()
    {
        return User::select(['username', 'nama', 'profile_pic', 'jenis_kelamin', 'poin'])
            ->whereNot('role', 'kepala')
            ->orderBy('poin', 'desc')
            ->limit(100)
            ->get();
    }
    // dapatkan 5 definisi random
    #[Computed]
    public function definitions()
    {
        return Definisi::inRandomOrder()->take(5)->get();
    }

    // statistik
    #[Computed]
    public function stats()
    {
        $totalMembers = number_format(User::select('id')->count(), 0, ',', '.');
        $totalWords = number_format(Definisi::distinct()->pluck('kosakata')->count(), 0, ',', '.');
        $totalDefinitions = number_format(Definisi::select('id')->count(), 0, ',', '.');
        $totalVerifiedDefinition = number_format(Definisi::select('id')->whereNotNull('verifikasi')->count(), 0, ',', '.');
        return [
            'totalMembers' => $totalMembers,
            'totalWords' => $totalWords,
            'totalDefinitions' => $totalDefinitions,
            'totalVerifiedDefinition' => $totalVerifiedDefinition,
        ];
    }
};
?>

<div class="">
    {{-- Section selamat datang --}}
    <div class="container mx-auto py-28 flex flex-col items-center text-center space-y-5">
        {{-- <p class="jawa-h2 -mb-3">ꦱꦸꦒꦼꦁ ꦫꦮꦸꦃ!</p> --}}
        <h1 class="md:text-5xl text-2xl">Selamat datang di <br> <b>Kamus Bahasa Jawa Terbuka</b></h1>
        <p class="">Kamus bahasa jawa online terlengkap dengan <br> dukungan dari komunitas.</p>
        <livewire:search />
    </div>

    {{-- Kosakata acak --}}
    @isset($this->definitions)
        <div class="px-10 py-14 bg-neutral-100 dark:bg-zinc-800 rounded-2xl w-full">
            <div class="container mx-auto">
                <h3 class="mb-8 font-semibold text-center">Kosakata Acak Untuk Kamu</h3>
                <div class="grid grid-cols-6 gap-4">
                    {{-- Daftar kosakata --}}
                    <div class="md:col-start-2 md:col-span-3 col-span-6 space-y-2">
                        @foreach ($this->definitions as $definition)
                            <livewire:word-definition :wordDefinition="$definition" :author="$definition->user" :showWord="true" />
                        @endforeach
                        {{-- Lihat kosakata lainnya --}}
                        {{-- Mobile --}}
                        <div class="md:hidden flex justify-center">
                            <x-button type="button" text="Temukan kosakata lainnya" url="/kosakata" />
                        </div>
                    </div>
                    {{-- Lihat kosakata lainnya --}}
                    {{-- Desktop --}}
                    <div class="md:block hidden col-span-1">
                        <div class="bg-amber-400 text-neutral-800 rounded-2xl p-6 sticky top-24 space-y-2">
                            <h4 class="font-bold">Temukan kosakata lainnya!</h4>
                            <a href="/kosakata"
                                class="block w-fit rounded-lg border-2 border-black p-2 small-text hover:bg-black hover:text-white">Klik
                                disini <i data-lucide='arrow-right' class="inline-block size-5"></i></a>
                        </div>
                    </div>
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
                class="bg-amber-400 text-neutral-800 rounded-2xl md:py-5 py-8 md:px-14 md:w-10/12 mx-auto flex md:flex-row flex-col md:justify-between items-center md:space-x-16">
                <p class="md:order-1 order-2 md:px-0 px-10 md:pt-0 pt-5">
                    <span class="font-semibold">Kamus Bahasa Jawa Terbuka adalah</span> sebuah platform digital
                    yang
                    dirancang untuk memfasilitasi pengguna
                    dalam mencari, mempelajari, dan memperkaya kosa kata bahasa Jawa. Situs ini dibangun tidak hanya
                    sebagai
                    media informasi, tetapi juga sebagai sarana pelestarian bahasa jawa.
                </p>
                <img class="md:order-2 order-1 object-cover max-w-64"
                    alt="Connected world concept illustration (freepik/storyset)"
                    src="{{ asset('img/homepage_banner-01.png') }}">
            </div>

            {{-- Konsep crowdsource --}}
            <div
                class="bg-amber-400 text-neutral-800 rounded-2xl md:py-5 py-8 md:px-14 md:w-10/12 mx-auto flex md:flex-row flex-col md:justify-between items-center md:space-x-16">
                <img class="object-cover max-w-64" alt="New team member concept illustration (freepik/storyset)"
                    src="{{ asset('img/homepage_banner-02.png') }}">
                <p class="md:px-0 px-10 md:pt-0 pt-5">
                    Situs ini menggunakan <span class="font-semibold">konsep crowdsourcing</span>, di mana pengguna
                    dapat
                    berkontribusi secara aktif sehingga
                    konten kamus dapat terus berkembang. Melalui fitur ini, pengguna dapat menambahkan kata baru,
                    memberikan
                    arti, contoh kalimat, atau memberikan penjelasan lebih lanjut tentang istilah yang sudah ada.
                </p>
            </div>

            {{-- Keunggulan --}}
            <div
                class="bg-amber-400 text-neutral-800 rounded-2xl md:py-5 py-8 md:px-14 md:w-10/12 mx-auto flex md:flex-row flex-col md:justify-between items-center md:space-x-16">
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
    <div class="container mx-auto p-10 bg-neutral-100 dark:bg-zinc-800 rounded-xl">
        <div class="mb-3 md:px-24 space-y-5">
            <div class="text-center">
                <h3 class="font-semibold">Kamus Kita dalam Data</h3>
                <p class="w-2/3 mx-auto">Dibangun bersama, tumbuh bersama. Setiap angka di sini adalah bukti nyata
                    kontribusi komunitas dalam
                    melestarikan bahasa Jawa.</p>
            </div>

            <div class="flex md:flex-row flex-col gap-3">
                <div
                    class="px-10 py-16 bg-white dark:bg-zinc-900 hover:outline outline-offset-2 outline-amber-400 outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">{{ $this->stats['totalMembers'] }}</h2>
                    <div>Anggota</div>
                </div>

                <div
                    class="px-10 py-16 bg-white dark:bg-zinc-900 hover:outline outline-offset-2 outline-amber-400 outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">{{ $this->stats['totalWords'] }}</h2>
                    <div>Kosakata</div>
                </div>

                <div
                    class="px-10 py-16 bg-white dark:bg-zinc-900 hover:outline outline-offset-2 outline-amber-400 outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">{{ $this->stats['totalDefinitions'] }}</h2>
                    <div>Definisi</div>
                </div>

                <div
                    class="px-10 py-16 bg-white dark:bg-zinc-900 hover:outline outline-offset-2 outline-amber-400 outline-2 rounded-2xl md:w-1/4 w-full text-center">
                    <h2 class="font-bold">{{ $this->stats['totalVerifiedDefinition'] }}</h2>
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
                Mereka yang paling banyak berkontribusi dalam membangun kamus ini. Terima kasih telah menjadi bagian
                dalam pelestari bahasa Jawa.
            </p>
            <div class="mx-auto mt-8 flex-wrap gap-1">
                @foreach ($this->topContributors as $user)
                    <a href="/u/{{ $user->username }}" title="{{ $user->nama }} (&commat;{{ $user->username }})"
                        class="hover:outline outline-amber-400 rounded-full inline-block">
                        <x-avatar avatarUrl="{{ $user->profile_pic }}" size="12" rounded="full" />
                        {{-- @include('partials.profile-pic-general') --}}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- FAQ --}}
    <div class="container p-10 mb-5 mx-auto">
        <div class="md:px-24">
            <h3 class="font-semibold mb-5">FAQ</h3>
            @php
                $faqs = [
                    [
                        'id' => 1,
                        'title' => 'Bagaimana cara berkontribusi pada platform ini?',
                        'content' =>
                            'Pengguna dapat mendaftar terlebih dahulu, kemudian mulai menambahkan kata atau definisi baru. Kontribusi yang telah dikirimkan akan ditampilkan di halaman kosakata dan akan mendapatkan status "terverifikasi" setelah melalui proses validasi oleh pengurus atau moderator.',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Apakah terdapat keuntungan bagi kontributor?',
                        'content' =>
                            'Ya. Setiap kontribusi yang diberikan akan menghasilkan poin yang menentukan level kontributor. Pada pencapaian level tertentu, kontributor akan menerima sertifikat penghargaan. Selain itu, tersedia sistem pencapaian (achievement) khusus yang dapat diraih melalui penyelesaian aktivitas tertentu. Pengguna lain juga dapat memberikan donasi langsung sebagai bentuk apresiasi atas kontribusi yang telah diberikan.',
                    ],
                    [
                        'id' => 3,
                        'title' => 'Apakah platform ini tersedia secara gratis?',
                        'content' =>
                            'Ya, platform ini dapat digunakan secara gratis oleh seluruh pengguna. Meskipun demikian, pengguna dapat turut mendukung keberlangsungan platform melalui donasi. Dana yang terkumpul akan digunakan untuk membiayai kebutuhan hosting dan domain.',
                    ],
                    [
                        'id' => 4,
                        'title' => 'Apa yang harus dilakukan jika menemukan kata atau definisi yang tidak sesuai?',
                        'content' =>
                            'Pengguna dapat melaporkan kata atau definisi yang tidak sesuai melalui fitur laporkan kesalahan. Laporan tersebut akan ditindaklanjuti oleh pengurus atau moderator, dan perbaikan akan dilakukan apabila diperlukan.',
                    ],
                    [
                        'id' => 5,
                        'title' => 'Apakah pengguna harus memahami Bahasa Jawa untuk menggunakan platform ini?',
                        'content' =>
                            'Tidak. Platform ini dirancang untuk ramah pengguna, termasuk bagi mereka yang baru memulai mempelajari Bahasa Jawa. Tersedia fitur terjemahan dan contoh penggunaan yang dapat membantu pengguna dalam memahami setiap kosakata.',
                    ],
                ];
            @endphp
            <div class="overflow-hidden rounded-xl divide-y">
                @foreach ($faqs as $faq)
                    <div class="">
                        <button onclick="toggleClass('accordion-content-{{ $faq['id'] }}', 'hidden')"
                            id="accordion-header-{{ $faq['id'] }}"
                            class="flex justify-between w-full p-5 hover:bg-amber-400 hover:text-neutral-800">
                            <div id="accordion-title-{{ $faq['id'] }}" class="">
                                <i data-lucide='help-circle' class="inline-block"></i>
                                <i data-feather='help-circle' class="inline-block mr-3"></i>
                                {{ $faq['title'] }}
                            </div>
                            <div id="accordion-show-{{ $faq['id'] }}">
                                <i data-lucide='chevron-down'></i>
                                <i data-feather='chevron-down' class="absolute top-5 right-6"></i>
                            </div>
                        </button>
                        <div id="accordion-content-{{ $faq['id'] }}"
                            class="hidden px-5 py-3 text-neutral-600 dark:text-zinc-400">
                            {!! $faq['content'] !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Ajakan untuk berbagung --}}
    <div class="container mx-auto px-10 py-28 bg-amber-400 text-neutral-800 rounded-xl">
        <div class="grid grid-cols-2">
            <div class="text-center col-span-2 md:col-span-1 mb-10 mt-8">
                <span class="text-6xl font-bold text-white"
                    style="font-family: 'Noto Sans Javanese', sans-serif">ꦕꦼꦥꦼ<br>ꦠ꧀ꦒꦧꦸꦁ!</span>
            </div>
            <div class="pr-16 col-span-2 md:col-span-1 space-y-3">
                <h3 class="font-semibold">Gabung sekarang juga!</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est in unde tempore quasi ratione incidunt
                    assumenda minus explicabo earum officia temporibus iste voluptatibus illum error sed amet.</p>
                <x-button type="button" text="Bergabung sekarang!" url="/masuk" color="bg-white" />
            </div>
        </div>
    </div>
</div>
