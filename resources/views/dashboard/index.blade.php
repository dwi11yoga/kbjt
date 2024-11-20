@extends('.../layouts/dashboard')

@section('body')
    {{-- Pemberitahuan untuk melengkapi data diri --}}
    @if ($lengkap == false)
        <div class="md:flex md:justify-between border border-gray-200 rounded-xl p-3 shadow-sm mb-4">
            <div>Segera lengkapi profil kamu.</div>
            <a href="#" class="text-blue-600 md:text-base text-sm">Pergi ke pengaturan<i data-feather='arrow-up-right'
                    class="inline-block md:w-5 w-4"></i></a>
        </div>
    @endif

    {{-- Level & Poin --}}
    <div class="grid grid-cols-3 gap-3 ">
        <div
            class="md:col-span-1 col-span-3 border border-gray-200 shadow-sm rounded-xl p-3 hover:outline hover:outline-offset-2 hover:outline-yellow-200 hover:decoration-1">
            <div>
                Level <br>
                <h1 class="font-bold -mt-2">{{ $userProgress['lvl'] }}</h1>
            </div>
            <div class="relative mb-3">
                <div class="absolute top-0 w-full bg-gray-300 h-2 rounded-full"></div>
                <div title="{{ $userProgress['progress'] }}%"
                    class="absolute top-0 min-w-[2%] bg-yellow-400 h-2 rounded-full hover:outline hover:outline-4 hover:outline-yellow-400"
                    style="width: {{ $userProgress['progress'] }}%">
                </div>
            </div>
        </div>

        <div
            class="md:col-span-1 col-span-3 border border-gray-200 shadow-sm rounded-xl p-3 hover:outline hover:outline-offset-2 hover:outline-yellow-200 hover:decoration-1">
            <div>Poin <br>
                <div class="flex items-baseline">
                    <h1 class="font-bold -mt-2">{{ auth()->user()->poin }}</h1>
                    <span class="text-green-600"><i data-feather='arrow-up' class="inline-block w-5 -mt-1"></i>210</span>
                </div>
            </div>
            <div class="small-text">
                @if ($userProgress['poinKurang'] != null)
                    <span class="font-bold">{{ $userProgress['poinKurang'] }} poin</span> lagi sebelum naik level
                @else
                    Kamu telah mencapai level maksimal 🙌
                @endif
            </div>
        </div>

        <div
            class="md:col-span-1 col-span-3 border border-gray-200 shadow-sm rounded-xl p-3 hover:outline hover:outline-offset-2 hover:outline-yellow-200 hover:decoration-1">
            <div>Popularitas<br>
                <h1 class="font-bold -mt-2">52.000</h1>
            </div>
            <div class="small-text">Jumlah kunjungan ke akun kamu</div>
        </div>
    </div>

    {{-- Kontribusi --}}
    <div class="mt-5 flex justify-between">
        <div>Kontribusi terbaru</div>
        <a href="#" class="text-blue-600"><span class="md:inline-block hidden">Lebih lengkap</span><i
                data-feather='arrow-right'class="w-5 inline-block"></i></a>
    </div>
    <?php 
    for ($i=0; $i < 5; $i++) { 
        ?>
    <div class="md:flex md:justify-between border border-gray-200 p-3 mt-3 rounded-xl">
        <div>Lorem ipsum dolor sit amet.</div>
        <div class="md:text-base text-sm"><i data-feather='stop-circle' class="inline-block w-5 text-yellow-600"></i> 10
            poin</div>
    </div>
    <?php
    }
     ?>

    {{-- Sertifikat --}}
    <div class="mt-5 grid grid-cols-4 gap-3 flex items-center p-8 border border-gray-200 rounded-2xl bg-purple-300">
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
    </div>

    {{-- Donasi --}}
    <div class="mt-5 grid grid-cols-4 gap-3 flex items-center p-8 border border-gray-200 rounded-2xl bg-pink-300">
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
    </div>
@endsection
