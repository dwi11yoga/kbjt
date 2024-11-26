@extends('layouts.homepage-with-banner')

@section('body')
    {{-- Hasil --}}
    <div>
        <h3 class="font-semibold">Pencarian</h3>
        <div>23 kosakata berhasil ditemukan.</div>
    </div>
    {{-- Kosakata --}}
    <div class="mb-3">Kosakata</div>
    <div class="space-y-3">
        @for ($i = 0; $i < 5; $i++)
            <a href="/kosakata/madaran" class="block">
                <div
                    class="group bg-white p-5 rounded-2xl border border-neutral-200 hover:border-amber-100 hover:bg-amber-100 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-amber-300 active:bg-amber-200">
                    <h5 class="">Madaran <span class="jawa text-sm">(ꦩꦢꦫꦤ꧀)</span></h5>
                    <div>26 definisi (4 definisi terverifikasi)</div>
                    <div class="flex mt-1 items-center">
                        <div class="flex -space-x-3">
                            <div
                                class="overflow-hidden h-8 w-8 rounded-full z-20 border-white group-hover:border-amber-100 border-2">
                                <img class="object-cover w-full h-full"
                                    src="https://img.freepik.com/free-photo/portrait-volunteer-who-organized-donations-charity_23-2149230567.jpg?w=360"
                                    alt="">
                            </div>
                            <div
                                class="overflow-hidden h-8 w-8 rounded-full z-30 border-white group-hover:border-amber-100 border-2">
                                <img class="object-cover w-full h-full"
                                    src="https://img.freepik.com/free-photo/portrait-interesting-young-man-winter-clothes_158595-914.jpg?w=360"
                                    alt="">
                            </div>
                            <div
                                class="overflow-hidden h-8 w-8 rounded-full border-white group-hover:border-amber-100 border-2">
                                <img class="object-cover w-full h-full"
                                    src="https://img.freepik.com/free-photo/portrait-smiling-blonde-woman_23-2148316635.jpg?w=360"
                                    alt="">
                            </div>
                        </div>
                        <div class="ml-2">26 Kontributor</div>
                    </div>
                    <div class="text-sm mt-2">
                        <span class="py-1 px-2 bg-blue-100 rounded-lg">Krama</span>
                        <span class="py-1 px-2 bg-red-100 rounded-lg">Nomina</span>
                    </div>
                </div>
            </a>
        @endfor
    </div>
    {{-- User --}}
    <div class="">Anggota</div>
@endsection
