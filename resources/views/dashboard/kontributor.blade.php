@extends('layouts.dashboard')

@section('body')
    {{-- Overview --}}
    <div class="">
        <div class="mb-3">Overview</div>
        <div class="grid grid-cols-3 gap-3 ">

            {{-- Kontributor --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div>Kontributor<br>
                    <h1 class="font-bold -mt-2">{{ $overview['kontributor'] }}</h1>
                </div>
                <div class="text-sm">Bulan ini bertambah {{ $overview['kontributorBlnIni'] }} kontributor</div>
            </div>

            {{-- Total Kontribusi --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div>Total kontribusi bulan ini<br>
                    <h1 class="font-bold -mt-2">{{ $overview['kontribusi'] }}</h1>
                </div>
                <div class="text-sm">Total kontribusi bulan kemarin adalah {{ $overview['kontribusiBlnKemarin'] }}</div>
            </div>

        </div>
    </div>

    <div class="w-full rounded-lg bg-blue-200 p-4 flex md:items-center gap-2">
        <i data-feather='info' class="md:w-5 w-14"></i>
        <div>Total kontribusi dihitung dari jumlah kosakata, definisi, laporan, dan edit kosakata yang disubmit.</div>
    </div>

    {{-- Daftar kontributor --}}
    <div class="p-5 bg-white rounded-2xl" id="laporan">
        <div class="py-2">
            Daftar kontributor
        </div>

        <div class="space-y-3">
            @foreach ($kontributor as $d)
                <a href="/u/{{ $d->username }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid grid-cols-10 md:space-y-0 space-y-1 hover:outline hover:outline-amber-400">
                    <div class="flex gap-2 md:col-span-3 col-span-9 items-center">
                        <div class="rounded-full w-8 h-8 overflow-hidden">
                            @include('partials.profile-pic-general')
                        </div>
                        <div class="line-clamp-1">{{ $d->nama }}</div>
                    </div>
                    <div class="md:col-span-2 col-span-7 text-neutral-700 md:flex hidden items-center line-clamp-2">
                        &#64;{{ $d->username }}
                    </div>
                    <div class="md:col-span-1 col-span-1 flex items-center">
                        <div class="rounded-full py-1 px-3 bg-amber-200 w-fit text-sm">
                            <span class="md:block hidden">Level {{ $d->level }}</span>
                            <span class="md:hidden block">{{ $d->level }}</span>
                        </div>
                    </div>
                    <div class="md:col-span-2 col-span-10 flex items-center md:justify-center">{{ $d->kontribusiBlnIni }}
                        kontribusi bulan
                        ini</div>
                    <div class="md:col-span-2 col-span-10 flex items-center md:justify-end">{{ $d->kontribusiTotal }}
                        kontribusi total</div>
                </a>
            @endforeach
            @if ($kontributor->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @endif
        </div>

        <div class="mt-3">
            {{ $kontributor->links() }}
        </div>
    </div>

    {{-- Daftar kosakata terbaru dari kontributor --}}
    <div class="p-5 bg-white rounded-2xl" id="kosakata">
        <div class="flex items-center justify-between py-2">
            Kosakata terbaru dari kontributor
        </div>

        <div class="space-y-3">
            @foreach ($kosakata as $d)
                <a href="/kosakata/{{ $d->slug }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid grid-cols-10 md:space-y-0 space-y-1 hover:outline hover:outline-amber-400">
                    <div
                        class="md:col-span-5 col-span-10 flex items-center line-clamp-2 md:font-normal font-semibold capitalize">
                        Kosakata {{ $d->kosakata ?? '[Kosakata dihapus]' }}
                    </div>
                    <div class="flex gap-2 md:col-span-3 col-span-10 items-center">
                        <div class="rounded-full w-8 h-8 overflow-hidden">
                            <?php
                            $sementara = $d;
                            $d = $d->user;
                            ?>
                            @include('partials.profile-pic-general')
                            <?php $d = $sementara; ?>
                        </div>
                        <div class="line-clamp-2">{{ $d->user->nama }}</div>
                    </div>
                    <div class="md:col-span-2 col-span-10 flex items-center md:justify-end">
                        <div class="">{{ $d->created_at->translatedFormat('d M Y H:i') }} WIB</div>
                    </div>
                </a>
            @endforeach
            @if ($kosakata->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @endif
        </div>

        <div class="mt-3">
            {{ $kosakata->links() }}
        </div>
    </div>

    {{-- Daftar definisi terbaru dari kontributor --}}
    <div class="p-5 bg-white rounded-2xl" id="definisi">
        <div class="flex items-center justify-between py-2">
            Definisi terbaru dari kontributor
        </div>

        <div class="space-y-3">
            @foreach ($definisi as $d)
                <a href="{{ !empty($d->kosakata) ? '/kosakata/' . $d->kosakata->slug . '?definisi=' . $d->id : '#' }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid grid-cols-10 md:space-y-0 space-y-1 hover:outline hover:outline-amber-400">
                    <div class="md:col-span-5 col-span-10 flex items-center line-clamp-2 md:font-normal font-semibold">
                        <div>
                            Definisi untuk kosakata <span
                                class="capitalize">{{ $d->kosakata->kosakata ?? '[Kosakata dihapus]' }}</span>
                        </div>
                    </div>
                    <div class="flex gap-2 md:col-span-3 col-span-10 items-center">
                        <div class="rounded-full w-8 h-8 overflow-hidden">
                            <?php
                            $sementara = $d;
                            $d = $d->user;
                            ?>
                            @include('partials.profile-pic-general')
                            <?php $d = $sementara; ?>
                        </div>
                        <div class="line-clamp-2">{{ $d->user->nama }}</div>
                    </div>
                    <div class="md:col-span-2 col-span-10 flex items-center md:justify-end">
                        <div class="">{{ $d->created_at->translatedFormat('d M Y H:i') }} WIB</div>
                    </div>
                </a>
            @endforeach
            @if ($definisi->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @endif
        </div>

        <div class="mt-3">
            {{ $definisi->links() }}
        </div>
    </div>

    {{-- Laporan --}}
    <div class="p-5 bg-white rounded-2xl" id="laporan">
        <div class="py-2">Laporan & permintaan edit kosakata terbaru</div>

        <div class="space-y-3">
            <div href="/kontribusi/laporan/{{ $d->id }}"
                class="border border-neutral-200 p-3 mt-3 rounded-xl text-center"> Beralih ke halaman <a href="/laporan"
                    class="underline underline-offset-2 decoration-amber-400 decoration-2">Laporan</a>.
            </div>
        </div>
    </div>

    {{-- Daftar kontributor yang menghapus akunnya --}}
    <div class="p-5 bg-white rounded-2xl" id="laporan">
        <div class="py-2">
            Kontributor yang menghapus akunnya
        </div>

        <div class="space-y-3">
            @if ($kontributorDihapus->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @else
                @foreach ($kontributorDihapus as $d)
                    <a href="/akun-dihapus/{{ $d->id }}"
                        class="border border-neutral-200 p-3 mt-3 rounded-xl grid grid-cols-10 md:space-y-0 space-y-1 hover:outline hover:outline-amber-400">
                        <div class="flex gap-2 md:col-span-3 col-span-9 items-center">
                            <div class="rounded-full w-8 h-8 overflow-hidden">
                                <?php $sementara = $d;
                                $d = $d->user;
                                ?>
                                @include('partials.profile-pic-general')
                                <?php $d = $sementara; ?>
                            </div>
                            <div class="line-clamp-1">{{ $d->user->nama }}</div>
                        </div>
                        <div class="md:col-span-2 col-span-7 text-neutral-700 md:flex hidden items-center line-clamp-2">
                            &#64;{{ $d->user->username }}
                        </div>
                        <div class="md:col-span-1 col-span-1 flex items-center">
                            <div class="rounded-full py-1 px-3 bg-amber-200 w-fit text-sm">
                                <span class="md:block hidden">Level {{ $d->user->level }}</span>
                                <span class="md:hidden block">{{ $d->user->level }}</span>
                            </div>
                        </div>
                        <div class="md:col-span-4 col-span-10 flex items-center md:justify-end">
                            Dihapus pada {{ $d->created_at->translatedFormat('d F Y') }}
                        </div>
                    </a>
                @endforeach
            @endif
        </div>

        <div class="mt-3">
            {{ $kontributorDihapus->links() }}
        </div>
    </div>
@endsection
