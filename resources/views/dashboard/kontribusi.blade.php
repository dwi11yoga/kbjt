@extends('layouts.dashboard')

@section('body')
    {{-- Overview --}}
    <div class="">
        <div class="mb-3">Overview</div>
        <div class="grid grid-cols-3 gap-3 ">
            {{-- Kosakata --}}
            <a href="#kosakata"
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div>Kosakata disubmit<br>
                    <div class="flex items-baseline">
                        <h1 class="font-bold -mt-2">{{ number_format($statistik['kosakataTotal'], 0, ',', '.') }}</h1>
                    </div>
                </div>
                <div class="text-sm">
                    Bulan ini, kamu men-submit {{ $statistik['kosakataBln'] }} kosakata!
                </div>
            </a>

            {{-- Definisi --}}
            <a href="#definisi"
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div>Definisi disubmit<br>
                    <div class="flex items-baseline">
                        <h1 class="font-bold -mt-2">{{ number_format($statistik['definisiTotal'], 0, ',', '.') }}</h1>
                    </div>
                </div>
                <div class="text-sm">
                    Bulan ini, kamu men-submit {{ $statistik['definisiBln'] }} definisi!
                </div>
            </a>

            {{-- Laporan --}}
            <a href="#laporan"
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div>Laporan pending<br>
                    <div class="flex items-baseline">
                        <h1 class="font-bold -mt-2">{{ $statistik['laporanPending'] }}</h1>
                    </div>
                </div>
                <div class="text-sm">
                    Total {{ number_format($statistik['laporanTotal'], 0, ',', '.') }} laporan telah kamu submit.
                </div>
            </a>

        </div>
    </div>

    {{-- Kosakata --}}
    <div class="p-5 bg-white rounded-2xl" id="kosakata">
        <div>Kosakata</div>
        <div class="space-y-3">
            @foreach ($data['kosakata'] as $d)
                <a href="/kosakata/{{ $d->slug }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid grid-cols-6 hover:outline hover:outline-offset-2 hover:outline-amber-400">
                    <div class="line-clamp-1 col-span-3 flex items-center">Mensubmit kosakata
                        <span class="capitalize">"{{ $d->kosakata }}"</span>.
                    </div>
                    <div class="md:text-base text-sm col-span-1 flex justify-center">
                        <div class="md:text-base text-sm col-span-1 flex items-center justify-center space-x-1">
                            <i data-feather='stop-circle' class="inline-block w-5 text-amber-600" title="Poin"></i>
                            <span>{{ $d->poin }}</span>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="flex items-center text-sm rounded-full px-3 py-1 bg-purple-300 w-fit space-x-1">
                            <i data-feather='edit-3' class="w-5 fill-neutral-800 stroke-neutral-800"></i>
                            <span>Belum diedit</span>
                        </div>
                    </div>
                    <div class="col-span-1 flex items-center">{{ $d->updated_at->format('d F Y') }}</div>
                </a>
            @endforeach
            @if ($data['kosakata']->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @endif
        </div>
        <div class="mt-3">
            {{ $data['kosakata']->links() }}
        </div>
    </div>

    {{-- Definisi --}}
    <div class="p-5 bg-white rounded-2xl" id="definisi">
        <div>Definisi</div>
        <div class="space-y-3">
            @foreach ($data['definisi'] as $d)
                <a href="/kosakata/{{ $d->kosakata->slug }}?definisi={{ $d->id }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid grid-cols-6 hover:outline hover:outline-offset-2 hover:outline-amber-400">
                    <div class="line-clamp-1 col-span-3 flex items-center">Mensubmit definisi untuk kosakata
                        <span class="capitalize">"{{ $d->kosakata->kosakata }}"</span>.
                    </div>
                    <div class="md:text-base text-sm col-span-1 flex items-center justify-center space-x-1">
                        <i data-feather='stop-circle' class="inline-block w-5 text-amber-600" title="Poin"></i>
                        <span>{{ $d->poin }}</span>
                    </div>
                    <div class="col-span-1">
                        @if (isset($d->verifikasi))
                            <div title="Diverifikasi oleh pengurus"
                                class="flex items-center text-sm rounded-full px-3 py-1 bg-amber-300 w-fit space-x-1">
                                <i data-feather='star' class="w-5 fill-neutral-800 stroke-none"></i>
                                <span>Terverifikasi</span>
                            </div>
                        @else
                            <div title="Belum diverifikasi oleh pengurus"
                                class="flex items-center text-sm rounded-full px-3 py-1 bg-red-300 w-fit space-x-1">
                                <i data-feather='star' class="w-5 fill-neutral-800 stroke-none"></i>
                                <span class="line-clamp-1">Tak terverifikasi</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-span-1 flex items-center">24 December 2024</div>
                </a>
            @endforeach
            @if ($data['definisi']->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @endif
        </div>

        <div class="mt-3">
            {{ $data['definisi']->links() }}
        </div>

    </div>

    {{-- Laporan --}}
    <div class="p-5 bg-white rounded-2xl" id="laporan">
        <div class="flex items-center justify-between">
            <span>Laporan</span>
            <form action="/kontribusi" method="GET" class="relative">
                <i data-feather='filter' class="w-5 absolute top-2 left-3"></i>
                <select name="filter_laporan" id="filter_laporan" onchange="muatDropdown(this)"
                    class="appearance-none border border-neutral-200 rounded-xl py-2 pl-10 pr-3 bg-white cursor-pointer">
                    <option value="">Filter</option>
                    <option {{ request()->filter_laporan == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option {{ request()->filter_laporan == 'Ditangani' ? 'selected' : '' }}>Ditangani</option>
                </select>
            </form>
        </div>

        <div class="space-y-3">
            @foreach ($data['laporan'] as $d)
                <a href="/kontribusi/laporan/{{ $d->id }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid grid-cols-6 hover:outline hover:outline-offset-2 hover:outline-amber-400">
                    <div class="line-clamp-1 col-span-3 flex items-center">Melaporkan definisi dari kosakata
                        <span class="capitalize">"{{ $d->kosakata }}"</span>.
                    </div>
                    <div class="md:text-base text-sm col-span-1 flex items-center justify-center space-x-1">
                        <i data-feather='stop-circle' class="inline-block w-5 text-amber-600" title="Poin"></i>
                        <span>0</span>
                    </div>
                    <div class="col-span-1">
                        @if (isset($d->status))
                            <div class="flex items-center text-sm rounded-full px-3 py-1 bg-green-300 w-fit space-x-1">
                                <i data-feather='check-circle' class="w-5 stroke-neutral-800"></i>
                                <span>Ditindaklanjuti</span>
                            </div>
                        @else
                            <div class="flex items-center text-sm rounded-full px-3 py-1 bg-red-300 w-fit space-x-1">
                                <i data-feather='clock' class="w-5 stroke-neutral-800"></i>
                                <span>Pending</span>
                            </div>
                        @endif
                    </div>
                    <div class="col-span-1 flex items-center">24 December 2024</div>
                </a>
            @endforeach
            @if ($data['laporan']->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @endif
        </div>

        <div class="mt-3">
            {{ $data['laporan']->links() }}
        </div>

    </div>
@endsection
