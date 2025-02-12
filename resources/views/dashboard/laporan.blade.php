@extends('layouts.dashboard')

@section('body')
    {{-- Overview --}}
    <div class="">Overview</div>
    <div class="grid grid-cols-3 gap-3 ">
        {{-- total laporan --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div>Total laporan<br>
                <div class="flex items-baseline">
                    <h1 class="font-bold -mt-2">{{ number_format($stat->laporanTotal, 0, ',', '.') }}</h1>
                </div>
            </div>
            <div class="text-sm">
                Bulan ini bertambah {{ number_format($stat->laporanBlnIni, 0, ',', '.') }} laporan
            </div>
        </div>

        {{-- laporan belum ditangani --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div>Laporan belum ditangani<br>
                <div class="flex items-baseline">
                    <h1 class="font-bold -mt-2">{{ number_format($stat->pending, 0, ',', '.') }}</h1>
                </div>
            </div>
            <div class="text-sm">
                Total {{ number_format($stat->selesai, 0, ',', '.') }} laporan selesai ditangani
            </div>
        </div>

        @if (auth()->user()->role == 'pengurus')
            {{-- Laporan yang kamu tangani --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div>Laporan yang kamu tangani<br>
                    <div class="flex items-baseline">
                        <h1 class="font-bold -mt-2">{{ number_format($stat->ditanganiUser, 0, ',', '.') }}</h1>
                    </div>
                </div>
                <div class="text-sm">
                    Bulan ini kamu menangani {{ number_format($stat->ditanganiBlnIni, 0, ',', '.') }} laporan
                </div>
            </div>
        @endif
    </div>

    {{-- laporan definisi --}}
    <div class="p-5 bg-white rounded-2xl">
        <div class="flex justify-between items-center">
            <div>Definisi Dilaporkan</div>
            <form action="/laporan" method="GET" class="relative">
                <i data-feather='filter' class="w-5 absolute top-2 left-3"></i>
                <select name="filter" id="filter" onchange="muatDropdown(this)"
                    class="appearance-none border border-neutral-200 rounded-xl py-2 pl-10 pr-3 bg-white cursor-pointer">
                    <option value="">Filter</option>
                    <option {{ request()->filter == 'belum-ditangani' ? 'selected' : '' }} value="belum-ditangani">Belum
                        ditangani
                    </option>
                    <option {{ request()->filter == 'selesai-ditangani' ? 'selected' : '' }} value="selesai-ditangani">
                        Selesai ditangani
                    </option>
                    @if (auth()->user()->role == 'pengurus')
                        <option {{ request()->filter == 'kamu-tangani' ? 'selected' : '' }} value="kamu-tangani">
                            Kamu tangani
                        </option>
                    @endif
                </select>
            </form>
        </div>

        <div class="space-y-3">
            @foreach ($definisi as $d)
                <a href="/laporan/{{ $d->id }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid md:grid-cols-8 gap-2 hover:outline hover:outline-amber-400">
                    <div class="line-clamp-1 md:col-span-4 col-span-8 flex items-center">
                        {{ $d->user->username }} melaporkan definisi {{ $d->terlapor }} dalam kosakata
                        "{{ $d->kosakata }}".
                    </div>
                    <div class="md:flex hidden md:text-base text-sm col-span-2 items-center space-x-1">
                        @if (isset($d->status))
                            <div class="flex items-center text-sm space-x-1">
                                <div class="md:w-7 md:h-7 w-8 h-8 rounded-full overflow-hidden">
                                    @include('partials.profil-pic-general-array2')
                                </div>
                                <div class="line-clamp-1">{{ $d->pengurus->username }}</div>
                            </div>
                        @endif
                    </div>
                    <div class="md:col-span-1 col-span-2 flex items-center">
                        @if (isset($d->status))
                            <div class="flex items-center text-sm rounded-full px-3 py-1 bg-green-300 w-fit space-x-1">
                                <i data-feather='check-circle' class="w-5 stroke-neutral-800"></i>
                                <span>Selesai</span>
                            </div>
                        @else
                            <div class="flex items-center text-sm rounded-full px-3 py-1 bg-red-300 w-fit space-x-1">
                                <i data-feather='clock' class="w-5 stroke-neutral-800"></i>
                                <span>Pending</span>
                            </div>
                        @endif
                    </div>
                    <div class="md:col-span-1 col-span-5 flex items-center md:text-base text-sm">
                        {{ $d->created_at->translatedformat('d M Y') }}
                    </div>
                </a>
            @endforeach
            {{ $definisi->links() }}
            @if ($definisi->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @endif
        </div>

    </div>

    {{-- Permintaan untuk mengganti detail kosakata --}}
    <div class="p-5 bg-white rounded-2xl">
        <div>Permintaan mengganti detail kosakata</div>

        <div class="space-y-3">
            @foreach ($editKosakata as $d)
                <a href="/kosakata/{{ $d->kosakata->slug }}/riwayat"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid md:grid-cols-8 gap-2 hover:outline hover:outline-amber-400">
                    <div
                        class="line-clamp-1 @if (isset($d->pengurus_id)) md:col-span-6 @else md:col-span-7 @endif col-span-8 flex items-center">
                        {{ $d->user->nama }} ingin mengganti detail kosakata "{{ $d->kosakata->kosakata }}".
                    </div>
                    @if (isset($d->pengurus_id))
                        <div class="col-span-1 flex items-center">
                            <div class="flex items-center text-sm rounded-full px-3 py-1 bg-green-300 w-fit space-x-1">
                                <i data-feather='check-circle' class="w-5 stroke-neutral-800"></i>
                                <span>Selesai</span>
                            </div>
                        </div>
                    @endif
                    <div
                        class="md:col-span-1 @if (isset($d->pengurus_id)) col-span-6 @else col-span-8 @endif flex items-center md:text-base text-sm">
                        {{ $d->created_at->translatedformat('d M Y') }}
                    </div>
                </a>
            @endforeach
            {{ $editKosakata->links() }}
            @if ($editKosakata->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @endif
        </div>

    </div>

    {{-- laporan (hapus) kosakata --}}
    <div class="p-5 bg-white rounded-2xl">
        <div class="flex justify-between items-center">
            <div>Permintaan menghapus kosakata</div>
            <form action="/laporan" method="GET" class="relative">
                <i data-feather='filter' class="w-5 absolute top-2 left-3"></i>
                <select name="filterKosakata" id="filterKosakata" onchange="muatDropdown(this)"
                    class="appearance-none border border-neutral-200 rounded-xl py-2 pl-10 pr-3 bg-white cursor-pointer">
                    <option value="">Filter</option>
                    <option {{ request()->filterKosakata == 'belum-ditangani' ? 'selected' : '' }} value="belum-ditangani">
                        Belum
                        ditangani
                    </option>
                    <option {{ request()->filterKosakata == 'selesai-ditangani' ? 'selected' : '' }}
                        value="selesai-ditangani">
                        Selesai ditangani
                    </option>
                    @if (auth()->user()->role == 'pengurus')
                        <option {{ request()->filterKosakata == 'kamu-tangani' ? 'selected' : '' }} value="kamu-tangani">
                            Kamu tangani
                        </option>
                    @endif
                </select>
            </form>
        </div>

        <div class="space-y-3">
            @foreach ($kosakata as $d)
                <a href="/laporan/{{ $d->id }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid md:grid-cols-8 gap-2 hover:outline hover:outline-amber-400">
                    <div class="line-clamp-1 md:col-span-4 col-span-8 flex items-center">
                        {{ $d->user->username }} meminta agar kosakata
                        "{{ $d->kosakata->kosakata }}" dihapus.
                    </div>
                    <div class="md:flex hidden md:text-base text-sm col-span-2 items-center space-x-2">
                        @if (isset($d->status))
                            <div class="flex items-center text-sm space-x-1">
                                <div class="md:w-7 md:h-7 w-8 h-8 rounded-full overflow-hidden">
                                    @include('partials.profil-pic-general-array2')
                                </div>
                                <div class="line-clamp-1">{{ $d->pengurus->username }}</div>
                            </div>
                        @endif
                    </div>
                    <div class="md:col-span-1 col-span-2 flex items-center">
                        @if (isset($d->status))
                            <div class="flex items-center text-sm rounded-full px-3 py-1 bg-green-300 w-fit space-x-1">
                                <i data-feather='check-circle' class="w-5 stroke-neutral-800"></i>
                                <span>Selesai</span>
                            </div>
                        @else
                            <div class="flex items-center text-sm rounded-full px-3 py-1 bg-red-300 w-fit space-x-1">
                                <i data-feather='clock' class="w-5 stroke-neutral-800"></i>
                                <span>Pending</span>
                            </div>
                        @endif
                    </div>
                    <div class="md:col-span-1 col-span-5 flex items-center md:text-base text-sm">
                        {{ $d->created_at->translatedformat('d M Y') }}
                    </div>
                </a>
            @endforeach
            {{ $kosakata->links() }}
            @if ($kosakata->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @endif
        </div>

    </div>
@endsection
