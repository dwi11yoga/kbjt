@extends('layouts.homepage-with-banner')

@section('body')
    <div class="bg-white border border-neutral-200 p-5 rounded-t-2xl -mb-[1.3rem] z-50">
        <div class="flex justify-between">
            <h4>Madaran <span class="text-sm jawa">ꦩꦢꦫꦤ꧀</span></h4>
            <div><i data-feather='more-horizontal'></i></div>
        </div>
        <div>/ma-da-ran/</div>
        <div>Kosakata asli dalam Bahasa Jawa.</div>
        {{-- <div>Dalam Bahasa Indonesia, kata ini berarti "Perut".</div> --}}
        <div class="flex space-x-2 items-center mt-1">
            <div class="py-1 px-2 bg-blue-100 rounded-lg">Krama</div>
            <div class="py-1 px-2 bg-red-100 rounded-lg">Nomina</div>
            <div class="flex -space-x-3">
                <div class="overflow-hidden h-8 w-8 rounded-full z-20 border-white group-hover:border-amber-100 border-2">
                    <img class="object-cover w-full h-full"
                        src="https://img.freepik.com/free-photo/portrait-volunteer-who-organized-donations-charity_23-2149230567.jpg?w=360"
                        alt="">
                </div>
                <div class="overflow-hidden h-8 w-8 rounded-full z-10 border-white group-hover:border-amber-100 border-2">
                    <img class="object-cover w-full h-full"
                        src="https://img.freepik.com/free-photo/portrait-interesting-young-man-winter-clothes_158595-914.jpg?w=360"
                        alt="">
                </div>
                <div class="overflow-hidden h-8 w-8 rounded-full border-white group-hover:border-amber-100 border-2">
                    <img class="object-cover w-full h-full"
                        src="https://img.freepik.com/free-photo/portrait-smiling-blonde-woman_23-2148316635.jpg?w=360"
                        alt="">
                </div>
            </div>
            <div class="ml-2">26 Kontributor</div>
        </div>
    </div>
    <div class="bg-amber-300 rounded-b-2xl px-5 py-2 flex">
        Lihat juga:&nbsp;
        <a href="#" class="text-amber-950">Weteng (Ngoko)<i data-feather='arrow-up-right'
                class="inline-block w-5"></i></a>
    </div>

    <div class="space-y-1">
        {{-- Definisi --}}
        @for ($i = 0; $i < 10; $i++)
            <div class="md:col-start-2 md:col-span-3 col-span-6">
                <div
                    class="bg-white rounded-2xl p-6 mb-4 border border-neutral-200 hover:outline hover:outline-2 hover:outline-amber-400">
                    {{-- Kosakata --}}
                    <h5 class="font-semibold mb-4">Madaran</h5>
                    {{-- Definisi --}}
                    <p class="mb-3">Bahasa krama dari "perut". Biasa digunakan ketika aksi dilakukan oleh seseorang yang
                        lebih tua.</p>
                    {{-- Contoh kalimat --}}
                    <p>Contoh kalimat:</p>
                    <p>"Ibu nembe gerah madaran" (Ibu sedang sakit perut)</p>
                    {{-- Referensi --}}
                    <div class="italic font-light small-text mt-4">
                        <p>Referensi</p>
                        <ul class="list-decimal list-inside">
                            <li>Kitab Pranata Adicara (Purwadi, 2020)</li>
                            <li>https://www.cnnindoensia.com/bahasa-krama</li>
                            <li>https://brainly.co.id/tugas/17480360</li>
                        </ul>
                    </div>
                    {{-- Author --}}
                    <p class="mt-4 mb-2">Disubmit oleh</p>
                    <div class="rounded-full w-12 h-12 bg-yellow-400 float-left mr-3"></div>
                    <div class="flex justify-between items-end">
                        <div>
                            <div>Muklis Satriya Nugraha</div>
                            <div class="small-text">20 September 2024</div>
                        </div>
                        <div><i data-feather='more-vertical'></i></div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection
