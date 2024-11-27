@extends('layouts.homepage-with-banner')

@section('body')
    {{-- Hasil --}}
    <div>
        <h3 class="font-semibold">Pencarian</h3>
    </div>
    {{-- Kosakata --}}
    <div>
        <span class="font-semibold">Kosakata</span>
        <br>{{ $jumlahKosakata }} data berhasil ditemukan.
    </div>
    <div class="space-y-3">
        @foreach ($kosakata as $d)
            <a href="/kosakata/{{ $d->slug }}" class="block">
                <div
                    class="group bg-white p-5 rounded-2xl border border-neutral-200 hover:border-amber-100 hover:bg-amber-100 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-amber-300 active:bg-amber-200">
                    <h5 class="capitalize">{{ $d->kosakata }} @if ($d->aksara)
                            <span class="jawa text-sm">({{ $d->aksara }})</span>
                        @endif
                    </h5>

                    {{-- Jika keyword mirip dengan arti indo --}}
                    {{-- stripos digunakan untuk pencocokan kata dari request dengan arti_indo. ada=bernilai posisi string yang sama. tidak ada=false --}}
                    @if (stripos($d->arti_indo, request('keyword')) !== false)
                        <div>
                            Dalam Bahasa Indonesia, kosakata ini berarti <span
                                class="font-semibold capitalize">{{ $d->arti_indo }}</span>.
                        </div>
                    @endif

                    {{-- Jumlah definisi --}}
                    <div>26 definisi (4 definisi terverifikasi)</div>

                    {{-- Kontributor --}}
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
                    {{-- Ragam dan jenis kosakata --}}
                    <div class="text-sm mt-2">
                        @if ($d->ragam)
                            <span class="py-1 px-2 bg-blue-100 rounded-lg">{{ $d->ragam }}</span>
                        @endif
                        @if ($d->jenis)
                            <span class="py-1 px-2 bg-red-100 rounded-lg">{{ $d->jenis }}</span>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    {{-- User --}}
    <div>
        <span class="font-semibold">Anggota</span>
        <br>0 data berhasil ditemukan.
    </div>
@endsection
