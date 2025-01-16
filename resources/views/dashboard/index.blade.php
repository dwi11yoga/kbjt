@extends('.../layouts/dashboard')

@section('body')
    {{-- Pemberitahuan untuk melengkapi data diri --}}
    @if ($lengkap == false)
        <div class="md:flex md:justify-between bg-white border border-neutral-200 rounded-xl p-3 shadow-sm mb-4">
            <div>Segera lengkapi profil kamu.</div>
            <a href="/pengaturan" class="text-blue-600 md:text-base text-sm">Pergi ke pengaturan<i
                    data-feather='arrow-up-right' class="inline-block md:w-5 w-4"></i></a>
        </div>
    @endif

    {{-- Overview --}}
    {{-- Level & Poin --}}
    <div class="">
        <div class="mb-3">Overview</div>
        <div class="grid grid-cols-3 gap-3 ">
            @if (auth()->user()->role == 'kontributor' || auth()->user()->role == 'pengurus')
                {{-- Level --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>
                        Level <br>
                        <h1 class="font-bold -mt-2 inline-block">{{ $userProgress['lvl'] }}</h1>
                    </div>
                    <div class="relative mb-3">
                        <div class="absolute top-0 w-full bg-neutral-300 h-2 rounded-full"></div>
                        <div title="{{ $userProgress['progress'] }}%"
                            class="absolute top-0 min-w-[2%] bg-amber-400 h-2 rounded-full hover:outline hover:outline-4 hover:outline-amber-400"
                            style="width: {{ $userProgress['progress'] }}%">
                        </div>
                    </div>
                </div>
                {{-- Poin --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>Poin <br>
                        <div class="flex items-baseline">
                            <h1 class="font-bold -mt-2">{{ number_format(auth()->user()->poin, 0, ',', '.') }}</h1>
                        </div>
                    </div>
                    <div class="text-sm">
                        @if ($userProgress['poinKurang'] != null)
                            <span class="font-bold">{{ $userProgress['poinKurang'] }} poin</span> lagi sebelum naik level
                        @else
                            Kamu telah mencapai level maksimal 🙌
                        @endif
                    </div>
                </div>
                {{-- Popularitas --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>Popularitas<br>
                        <h1 class="font-bold -mt-2">52.000</h1>
                    </div>
                    <div class="text-sm">Jumlah kunjungan ke akun kamu</div>
                </div>
            @endif

            @if (auth()->user()->role == 'pengurus' || auth()->user()->role == 'kepala')
                {{-- Pengunjung --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>Pengunjung bulan ini<br>
                        <h1 class="font-bold -mt-2">3.000</h1>
                    </div>
                    <div class="text-sm">Bulan sebelumnya 2.167 pengunjung</div>
                </div>

                {{-- Anggota --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>Anggota<br>
                        <h1 class="font-bold -mt-2">{{ $statistik['anggota'] }}</h1>
                    </div>
                    <div class="text-sm">Bulan ini bertambah {{ $statistik['anggotaBlnIni'] }} anggota</div>
                </div>

                {{-- kosakata --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>Kosakata<br>
                        <h1 class="font-bold -mt-2">{{ $statistik['kosakata'] }}</h1>
                    </div>
                    <div class="text-sm">Bulan ini bertambah {{ $statistik['kosakataBlnIni'] }} kosakata</div>
                </div>

                {{-- definisi --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>Definisi<br>
                        <h1 class="font-bold -mt-2">{{ $statistik['definisi'] }}</h1>
                    </div>
                    <div class="text-sm">Bulan ini bertambah {{ $statistik['definisiBlnIni'] }} definisi</div>
                </div>

                {{-- Post --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>Artikel<br>
                        <h1 class="font-bold -mt-2">{{ $statistik['post'] }}</h1>
                    </div>
                    <div class="text-sm">{{ $statistik['postPublish'] }} artikel dipublikasikan</div>
                </div>
            @endif
        </div>
    </div>

    @if (auth()->user()->role != 'kepala')
        {{-- Kontribusi --}}
        <div class="p-5 bg-white rounded-2xl">
            <div class="flex justify-between">
                <div>Kontribusi Terbaru</div>
                <a href="/kontribusi" class="text-blue-600"><span class="md:inline-block hidden">Lebih lengkap</span><i
                        data-feather='arrow-right'class="w-5 inline-block"></i></a>
            </div>
            @foreach ($kontribusi as $d)
                <div class="md:flex md:justify-between border border-neutral-200 p-3 mt-3 rounded-xl">
                    <div>{{ $d['kontribusi'] }}</div>
                    <div class="md:text-base text-sm"><i data-feather='stop-circle'
                            class="inline-block w-5 text-amber-600"></i>
                        {{ $d['poin'] }}
                        poin</div>
                </div>
            @endforeach
        </div>
    @endif

    @if (auth()->user()->role != 'kepala')
        {{-- Achivement --}}
        <div class="bg-white rounded-2xl p-5">
            <div class="mb-3">Achivement</div>
            <div class="space-x-3 flex">
                <?php for ($i=0; $i < 4; $i++) { ?>
                <a href="#"
                    class="w-2/5 bg-neutral-100 rounded-xl p-4 h-44 flex justify-start items-end hover:outline hover:outline-amber-400 hover:outline-offset-4">
                    <div>
                        <img alt="simple 10 icon png" class="object-cover max-w-12 max-h-12"
                            src="https://www.freeiconspng.com/thumbs/number-10-icon/number-10-11.gif">
                        <div>Novice Contributor</div>
                        <p class="text-xs line-clamp-1">Menambahkan 10 definisi baru</p>
                    </div>
                </a>
                <?php } ?>

                <a href="/achivement" title="Lebih lengkap"
                    class="w-1/12 bg-neutral-100 rounded-xl p-4 h-44 flex justify-center items-center hover:bg-yellow-300 hover:outline hover:outline-amber-400 hover:outline-offset-4">
                    <div>
                        <i data-feather='chevron-right'></i>
                    </div>
                </a>
            </div>
        </div>
    @endif

    {{-- Sertifikat, donasi, ajak teman --}}
    <div class="flex space-x-3">
        {{-- Sertifikat --}}
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
        <a href="/donasi"
            class="w-1/3 bg-white rounded-xl border border-neutral-200 hover:outline hover:outline-amber-400 hover:outline-offset-4">
            <div class="overflow-hidden w-full h-24 rounded-t-xl top-0">
                <img class="object-cover w-full h-full"
                    src="https://img.freepik.com/free-vector/inflation-concept-illustration_114360-25779.jpg"
                    alt="Inflation concept illustration (freepik/storyset)">
            </div>
            <div class="p-4">
                <div>Donasi</div>
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
        </div>
    </div> --}}

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
