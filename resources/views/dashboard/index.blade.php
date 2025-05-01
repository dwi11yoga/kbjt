@extends('.../layouts/dashboard')

@section('body')
    {{-- Pemberitahuan untuk melengkapi data diri --}}
    @if ($lengkap == false)
        <div class="md:flex md:justify-between bg-white border border-neutral-200 rounded-xl p-3 shadow-sm mb-4">
            <div>Segera lengkapi profil kamu.</div>
            <a href="/pengaturan" class="text-amber-600 md:text-base text-sm">Pergi ke pengaturan<i
                    data-feather='arrow-up-right' class="inline-block md:w-5 w-4"></i></a>
        </div>
    @endif

    {{-- banner --}}
    <?php $idBanner = 7; ?>
    @include('partials.banner')

    {{-- Overview --}}
    <div class="grid grid-cols-3 md:space-x-2 md:space-y-0 space-y-2">

        {{-- profil --}}
        <div
            class="space-y-4 md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div class="flex justify-between items-center">
                <div>Profil</div>
                <a href="/u/{{ auth()->user()->username }}" title="Pergi ke halaman profil"
                    class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                    Lihat profil <i data-feather='arrow-up-right' class="w-4"></i>
                </a>
            </div>

            {{-- foto profil --}}
            <div class="flex justify-center">
                <div class="rounded-full overflow-hidden w-20">
                    @include('partials.profile-pic')
                </div>
            </div>

            {{-- nama --}}
            <div class="text-center">
                <div class="font-semibold">{{ auth()->user()->nama }}</div>
                <div class="capitalize text-sm -mt-1">{{ auth()->user()->role }}</div>
            </div>

            {{-- popularitas --}}
            <div class="flex justify-center">
                <div class="cursor-pointer bg-neutral-200 rounded-full px-2 py-1 text-sm"
                    title="Jumlah kunjungan ke akun kamu">🔥 52.000</div>
            </div>
        </div>

        <div class="md:col-span-2 col-span-3 space-y-2">
            {{-- level & poin --}}
            <div class="grid grid-cols-2 space-x-2">
                {{-- Level --}}
                <div
                    class="md:col-span-1 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>
                        Level <br>
                        <h1 class="font-bold -mt-2 inline-block">
                            {{ auth()->user()->role == 'kepala' ? '∞' : $userProgress['lvl'] }}</h1>
                    </div>
                    <div class="relative mb-3">
                        <div class="absolute top-0 w-full bg-neutral-300 h-2 rounded-full"></div>
                        <div title="{{ $userProgress['progress'] }}%"
                            class="absolute top-0 min-w-[2%] bg-amber-400 h-2 rounded-full hover:outline hover:outline-4 hover:outline-amber-400"
                            style="width: {{ auth()->user()->role == 'kepala' ? '100' : $userProgress['progress'] }}%">
                        </div>
                    </div>
                    <div class="text-sm">
                        @if (auth()->user()->role == 'kepala')
                            <span>Sebagai kepala, kamu tidak bisa naik level!</span>
                            {{-- <span>∞</span> --}}
                        @elseif ($userProgress['poinKurang'] != null)
                            <span>{{ $userProgress['progress'] }}%</span>
                        @else
                            Kamu telah mencapai level maksimal 🙌
                        @endif
                    </div>
                </div>
                {{-- Poin --}}
                <div
                    class="md:col-span-1 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>Poin <br>
                        <div class="flex items-baseline">
                            <h1 class="font-bold -mt-2">
                                {{ auth()->user()->role == 'kepala' ? '∞' : number_format(auth()->user()->poin, 0, ',', '.') }}
                            </h1>
                        </div>
                        <div class="text-sm">
                            @if (auth()->user()->role == 'kepala')
                                <span>Sebagai kepala, kamu tidak memiliki poin kontribusi!</span>
                            @else
                                <span class="font-bold">{{ $userProgress['poinKurang'] ?? 0 }} poin</span> lagi sebelum naik
                                level!
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- notifikasi --}}
            <div class="col-span-2">
                <a href="/notifikasi" title="Cek notifikasi"
                    class="border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1 flex justify-between items-center">
                    <div>
                        <div>Notifikasi</div>
                        <div class="font-semibold -mt-1">
                            {{ cekNotifikasi() == true ? 'Kamu punya notifikasi baru!' : 'Belum ada notifikasi baru.' }}
                        </div>
                    </div>
                    <div class="bg-amber-400 rounded-2xl py-3 px-3 relative">
                        <i data-feather='bell'></i>
                        @if (cekNotifikasi() == true)
                            <div class="absolute right-3 top-3 w-2.5 h-2.5 rounded-full bg-red-600"></div>
                        @endif
                    </div>
                </a>
            </div>
        </div>
    </div>

    {{-- statistik user (hanya untuk kontributor & pengurus) --}}
    @if (auth()->user()->role != 'kepala')
        <div class="grid grid-cols-2 md:space-x-2 md:space-y-0 space-y-2">
            {{-- statistik kontribusi user selama 7 hari terakhir  --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2 flex items-center justify-between">
                    <div>Kontribusimu 7 hari terakhir</div>
                    <a href="/daftar-kosakata/"
                        class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                        Tambah kontribusi <i data-feather='plus' class="w-4"></i>
                    </a>
                </div>
                <div class="space-y-1">
                    @foreach ($tujuhhari as $key => $d)
                        <div class="grid grid-cols-6 items-center">
                            <div class="col-span-1 text-sm">{{ $key }}</div>
                            <div class="col-span-5 rounded-md bg-amber-{{ $d['kontribusi'] == 0 ? '200' : '400' }} hover:bg-amber-500 cursor-pointer h-full flex items-center justify-end pr-1 text-sm"
                                style="width: {{ $d['persentase'] > 5 ? $d['persentase'] . '%' : '5%' }};"
                                title="{{ $d['tanggal'] }}: {{ $d['kontribusi'] }} kontribusi">
                                <span class="md:hidden">{{ $d['kontribusi'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="text-sm flex justify-center mt-1 items-center hover:underline hover:decoration-4 hover:underline-offset-4
                    hover:decoration-amber-400"
                    href="/kontribusi">
                    <div>Cek kontribusimu secara lengkap</div>
                    <i data-feather='arrow-right' class="w-4"></i>
                </a>
            </div>

            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                @if (isset($belumBerkontribusi) && $belumBerkontribusi == true)
                    <div class="mb-2">Khusus pengguna baru</div>
                    <ul class="space-y-2">
                        <li>
                            <div>Panduan</div>
                            <ul class="text-sm">
                                <li class="flex items-center justify-between">
                                    <div>Cara berkontribusi dengan baik</div>
                                    <a href="#"
                                        class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                        Baca <i data-feather='arrow-up-right' class="w-4"></i>
                                    </a>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div>Contoh definisi & kosakata yang baik</div>
                                    <a href="#"
                                        class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                        Baca <i data-feather='arrow-up-right' class="w-4"></i>
                                    </a>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div>Cara kerja level dan poin</div>
                                    <a href="#"
                                        class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                        Baca <i data-feather='arrow-up-right' class="w-4"></i>
                                    </a>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div>Manfaat menjadi kontributor aktif</div>
                                    <a href="#"
                                        class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                        Baca <i data-feather='arrow-up-right' class="w-4"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <div>Mulai berkontribusi</div>
                            <ul class="text-sm">
                                <li class="flex items-center justify-between">
                                    <div>Buat definisi baru</div>
                                    <a href="/daftar-kosakata"
                                        class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                        Tambah <i data-feather='arrow-up-right' class="w-4"></i>
                                    </a>
                                </li>
                                <li class="flex items-center justify-between">
                                    <div>Tambah kosakata baru</div>
                                    <a href="/tambah/kosakata"
                                        class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                        Tambah <i data-feather='arrow-up-right' class="w-4"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @elseif (isset($terakhirBerkontribusi))
                    {{-- Tampilkan ajakan untuk berkontribusi --}}
                    <div class="mb-2">Komunitas butuh bantuan kamu!</div>
                    <div class="space-y-2">
                        <div class="text-sm">{{ auth()->user()->nama }}, sudah <span
                                class="font-bold">{{ $terakhirBerkontribusi }}</span> hari sejak kontribusi terakhirmu.
                            Bagikan
                            pengetahuanmu & bantu komunitas melestarikan bahasa jawa!</div>

                        <ul class="space-y-2">
                            <li>
                                <div class="text-sm font-semibold">Mulai berkontribusi</div>
                                <ul class="text-sm">
                                    <li class="flex items-center justify-between">
                                        <div>Buat definisi baru</div>
                                        <a href="/daftar-kosakata"
                                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                            Tambah <i data-feather='arrow-up-right' class="w-4"></i>
                                        </a>
                                    </li>
                                    <li class="flex items-center justify-between">
                                        <div>Tambah kosakata baru</div>
                                        <a href="/tambah/kosakata"
                                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                            Tambah <i data-feather='arrow-up-right' class="w-4"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <div class="text-sm font-semibold">Kehilangan sentuhan?</div>
                                <ul class="text-sm">
                                    <li class="flex items-center justify-between">
                                        <div>Cara berkontribusi dengan baik</div>
                                        <a href="#"
                                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                            Baca <i data-feather='arrow-up-right' class="w-4"></i>
                                        </a>
                                    </li>
                                    <li class="flex items-center justify-between">
                                        <div>Contoh definisi & kosakata yang baik</div>
                                        <a href="#"
                                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                            Baca <i data-feather='arrow-up-right' class="w-4"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                @else
                    {{-- Tampilkan kosakata acak --}}
                    <div class="mb-1 flex justify-between items-center">
                        <div>Kosakata acak</div>
                        <a href="/kosakata/{{ $definisiRandom->kosakata->slug }}?definisi={{ $definisiRandom->id }}"
                            title="Kunjungi kosakata {{ $definisiRandom->kosakata->kosakata }}"
                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                            Lihat detail <i data-feather='arrow-up-right' class="w-4"></i>
                        </a>
                    </div>
                    <div class="space-y-1">
                        <div class="capitalize font-semibold">{{ $definisiRandom->kosakata->kosakata }} <span
                                title="Definisi terverifikasi">✅</span></div>
                        <div class="line-clamp-5">{!! $definisiRandom->definisi !!}</div>
                        <div class="text-sm">Disubmit oleh 
                            @if (!empty($definisiRandom->user))
                            <a href="/u/{{ $definisiRandom->user->username }}"
                                title="Lihat profil {{ $definisiRandom->user->nama }}"
                                class="font-semibold hover:underline hover:underline-offset-4 hover:decoration-amber-400 hover:decoration-4">{{ $definisiRandom->user->nama }}</a>
                            @else
                                <span class="font-semibold">[Akun dihapus]</span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif





    {{-- Statistik web (hanya untuk pengurus dan kepala) --}}
    @if (auth()->user()->role == 'pengurus' || auth()->user()->role == 'kepala')
        <div class="">
            <div class="grid grid-cols-3 gap-2 ">
                {{-- Pengunjung --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>Pengunjung bulan ini</div>
                    <h1 class="font-bold -mt-2">3.000</h1>
                    <div class="text-sm">Bulan sebelumnya 2.167 pengunjung</div>
                </div>

                {{-- Anggota --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div class="flex items-center justify-between">
                        <div class="">Anggota</div>
                        <a href="/kontributor" title="Pergi ke halaman kontributor"
                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                            Detail <i data-feather='arrow-right' class="w-4"></i>
                        </a>
                    </div>
                    <h1 class="font-bold -mt-2">{{ $statistik['anggota'] }}</h1>
                    <div class="text-sm">Bulan ini bertambah {{ $statistik['anggotaBlnIni'] }} anggota</div>
                </div>

                {{-- kosakata --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div class="flex items-center justify-between">
                        <div class="">Kosakata</div>
                        <a href="/kontributor#kosakata" title="Pergi ke halaman kontributor"
                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                            Detail <i data-feather='arrow-right' class="w-4"></i>
                        </a>
                    </div>
                    <h1 class="font-bold -mt-2">{{ $statistik['kosakata'] }}</h1>
                    <div class="text-sm">Bulan ini bertambah {{ $statistik['kosakataBlnIni'] }} kosakata</div>
                </div>

                {{-- definisi --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div class="flex items-center justify-between">
                        <div class="">Definisi</div>
                        <a href="/kontributor#definisi" title="Pergi ke halaman kontributor"
                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                            Detail <i data-feather='arrow-right' class="w-4"></i>
                        </a>
                    </div>
                        <h1 class="font-bold -mt-2">{{ $statistik['definisi'] }}</h1>
                    <div class="text-sm">Bulan ini bertambah {{ $statistik['definisiBlnIni'] }} definisi</div>
                </div>

                {{-- Post --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div class="flex items-center justify-between">
                        <div class="">Artikel</div>
                        <a href="/artikel" title="Pergi ke halaman artikel"
                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                            Detail <i data-feather='arrow-right' class="w-4"></i>
                        </a>
                    </div>
                        <h1 class="font-bold -mt-2">{{ $statistik['post'] }}</h1>
                    <div class="text-sm">Total {{ $statistik['postPublish'] }} artikel dipublikasikan</div>
                </div>

                {{-- Laporan --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div class="flex items-center justify-between">
                        <div class="">Laporan belum ditangani</div>
                        <a href="/laporan" title="Pergi ke halaman laporan"
                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                            Detail <i data-feather='arrow-right' class="w-4"></i>
                        </a>
                    </div>
                        <h1 class="font-bold -mt-2">{{ $statistik['laporanBlmDitangani'] }}</h1>
                    <div class="text-sm">Bulan ini ada {{ $statistik['laporanBlnIni'] }} laporan baru</div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->role != 'kepala' && isset(auth()->user()->achievement))
        {{-- achievement --}}
        <div class="bg-white rounded-2xl p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="">Achievement</div>
                <a href="/achievement" title="Pergi ke halaman achievement"
                    class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                    Lebih lengkap <i data-feather='arrow-right' class="w-4"></i>
                </a>
            </div>
            <div class="space-x-3 flex overflow-x-auto overflow-y-hidden p-1">
                @foreach ($achievement as $d)
                    <a href="#"
                        class="md:w-2/5 w-1/2 md:min-w-0 min-w-52 bg-neutral-100 rounded-xl p-4 h-44 flex justify-start items-end hover:outline hover:outline-amber-400">
                        <div class="">
                            <div class="max-w-12 max-h-12 overflow-hidden rounded-md">
                                <img alt="icon" class="object-cover w-full h-full"
                                    src="{{ asset('storage/' . $d->emblem) }}">
                            </div>
                            <div>{{ $d->nama }}</div>
                            <p class="text-xs line-clamp-1">{{ $d->deskripsi }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Sertifikat, donasi, ajak teman --}}
    <div class="flex space-x-2">
        {{-- Sertifikat --}}
        @if (auth()->user()->role != 'kepala')
            <a href="/sertifikat"
                class="w-1/3 bg-white rounded-xl border border-neutral-200 hover:outline hover:outline-amber-400 hover:outline-offset-4">
                <div class="overflow-hidden w-full h-24 rounded-t-xl top-0">
                    <img class="object-cover w-full h-full"
                        src="https://img.freepik.com/free-vector/certification-concept-illustration_114360-5171.jpg?w=740"
                        alt="Certification concept illustration (freepik/storyset)">
                </div>
                <div class="p-4">
                    <div>Dapatkan sertifikat</div>
                    <p class="text-xs">Dapatkan penghargaan atas kontribusimu dalam melestarikan Bahasa Jawa!</p>
                </div>
            </a>
        @endif

        {{-- Ajak teman --}}
        <a href="#"
            class="w-1/3 bg-white rounded-xl border border-neutral-200 hover:outline hover:outline-amber-400 hover:outline-offset-4">
            <div class="overflow-hidden w-full h-24 rounded-t-xl top-0">
                <img class="object-cover w-full h-full"
                    src="https://img.freepik.com/free-vector/solidarity-concept-illustration_114360-6286.jpg?w=740"
                    alt="Solidarity concept illustration (freepik/storyset)">
            </div>
            <div class="p-4">
                <div>Ajak teman</div>
                <p class="text-xs">Ajak temanmu untuk berkontribusi dalam melestarikan Bahasa Jawa.</p>
            </div>
        </a>

        {{-- donasi --}}
        <a href="/dukung"
            class="w-1/3 bg-white rounded-xl border border-neutral-200 hover:outline hover:outline-amber-400 hover:outline-offset-4">
            <div class="overflow-hidden w-full h-24 rounded-t-xl top-0">
                <img class="object-cover w-full h-full"
                    src="https://img.freepik.com/free-vector/inflation-concept-illustration_114360-25779.jpg"
                    alt="Inflation concept illustration (freepik/storyset)">
            </div>
            <div class="p-4">
                <div>Beri dukungan</div>
                <p class="text-xs">Setiap donasi membantu mengembangkan kamus dan meningkatkan akses Bahasa Jawa.</p>
            </div>
        </a>
    </div>


    {{-- Sertifikat --}}
    {{-- <div class="mt-5 grid grid-cols-4 gap-3 flex items-center p-8 border border-neutral-200 rounded-2xl bg-purple-300">
        <div class="md:col-span-2 col-span-4 md:order-1 order-2">
            <h3 class="font-bold">Dapatkan sertifikat</h3>
            <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores aperiam cum a.</p>
            <a href="#"
                class="py-3 px-4 bg-white rounded-full hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-white active:bg-black active:text-white active:outline-black">Klaim
                sertifikat</a>
        </div>
        <div class="md:col-span-2 col-span-4 md:order-2 order-1 flex md:justify-end justify-center">
            <img class="w-44"
                src="https://cdn3d.iconscout.com/3d/premium/thumb/certificate-3d-illustration-download-in-png-blend-fbx-gltf-file-formats--diploma-degree-achievement-education-pack-school-illustrations-3162178.png?f=webp"
                alt="Donation icon">
        </div> --}}
    </div>

    {{-- Donasi --}}
    {{-- <div class="mt-5 grid grid-cols-4 gap-3 flex items-center p-8 border border-neutral-200 rounded-2xl bg-pink-300">
        <div class="md:col-span-2 col-span-4 md:order-1 order-2">
            <h3 class="font-bold leading-none mb-2">Dukung situs ini untuk terus beroprasi</h3>
            <p class="mb-5">Donasi kamu sangat berarti untuk membantu usaha kami dalam melestarikan Bahasa Jawa.</p>
            <a href="#"
                class="py-3 px-4 bg-white rounded-full hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-white active:bg-black active:text-white active:outline-black">Kirim
                Donasi</a>
        </div>
        <div class="md:col-span-2 col-span-4 md:order-2 order-1 flex md:justify-end justify-center">
            <img class="w-44"
                src="https://cdn3d.iconscout.com/3d/premium/thumb/money-donation-3d-icon-download-in-png-blend-fbx-gltf-file-formats--charity-box-donate-help-day-pack-business-icons-4817969.png?f=webp"
                alt="Donation icon">
        </div>
    </div> --}}
@endsection
