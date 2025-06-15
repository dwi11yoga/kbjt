@extends('layouts.dashboard')

@section('body')
    {{-- Overview --}}
    <div class="">
        <div class="mb-3">Overview</div>
        <div class="grid grid-cols-3 gap-3 ">

            {{-- Pengurus --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div>Jumlah pengurus aktif<br>
                    <h1 class="font-bold -mt-2">{{ $overview['jmlPengurus'] }}</h1>
                </div>
                <div class="text-sm">{{ $overview['rasioUser'] }}/10 pengguna adalah pengurus</div>
            </div>

            {{-- Total Kontribusi --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div>Total kontribusi bulan ini<br>
                    <h1 class="font-bold -mt-2">{{ $overview['kontribusiBlnIni'] }}</h1>
                </div>
                <div class="text-sm">Total kontribusi bulan kemarin adalah {{ $overview['kontribusiBlnKmrn'] }}</div>
            </div>

        </div>
    </div>

    <div class="w-full rounded-lg bg-blue-200 p-4 flex md:items-center gap-2">
        <i data-feather='info' class="md:w-5 w-14"></i>
        <div>Total kontribusi dihitung dari kosakata, definisi, artikel, banner, edit kosakata, dan laporan yang
            ditindaklanjuti.</div>
    </div>

    {{-- Daftar pengurus --}}
    <div class="p-5 bg-white rounded-2xl" id="laporan">
        <div class="py-2">
            Daftar pengurus
        </div>

        <div class="space-y-3">
            @foreach ($pengurus as $d)
                <a href="/u/{{ $d->username }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid grid-cols-10 md:space-y-0 space-y-1 hover:outline hover:outline-amber-400">
                    <div class="flex gap-2 md:col-span-3 col-span-10 items-center">
                        <div class="rounded-full w-8 h-8 overflow-hidden">
                            @include('partials.profile-pic-general')
                        </div>
                        <div class="line-clamp-2">
                            {{ $d->nama }}
                            {{ isset($d->statusUser) && $d->statusUser == 'dihapus' ? '(Akun dihapus)' : '' }}
                        </div>
                    </div>
                    <div class="md:col-span-2 col-span-7 text-neutral-700 md:flex hidden items-center line-clamp-2">
                        &#64;{{ $d->username }}
                    </div>
                    <div class="md:col-span-1 col-span-3 flex items-center">
                        <div class="rounded-full py-1 px-3 bg-amber-200 w-fit text-sm">Level {{ $d->level }}</div>
                    </div>
                    <div class="md:col-span-2 col-span-7 flex items-center justify-center">{{ $d->kontribusiBlnIni }}
                        kontribusi bulan
                        ini</div>
                    <div class="md:col-span-2 col-span-5 flex items-center justify-end">{{ $d->kontribusiTotal }}
                        kontribusi total</div>
                </a>
            @endforeach
            @if ($pengurus->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl text-center">Tidak ada data</div>
            @endif
        </div>

        <div class="mt-3">
            {{ $pengurus->links() }}
        </div>
    </div>

    {{-- Daftar kosakata terbaru dari pengurus --}}
    <div class="p-5 bg-white rounded-2xl" id="laporan">
        <div class="flex items-center justify-between py-2">
            Kosakata terbaru dari pengurus
        </div>

        <div class="space-y-3">
            @foreach ($kosakata as $d)
                <a href="/kosakata/{{ $d->slug }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid grid-cols-10 md:space-y-0 space-y-1 hover:outline hover:outline-amber-400">
                    <div
                        class="md:col-span-5 col-span-10 flex items-center line-clamp-2 md:font-normal font-semibold capitalize">
                        Kosakata {{ $d->kosakata }}
                    </div>
                    <div class="flex gap-2 md:col-span-3 col-span-10 items-center">
                        <div class="rounded-full w-8 h-8 overflow-hidden">
                            <?php
                            $sementara = $d;
                            $d = $d->user; 
                            ?>
                            @include('partials.profile-pic-general')
                            <?php $d=$sementara; ?>
                        </div>
                        <div class="line-clamp-2">{{ $d->user->nama }}</div>
                    </div>
                    <div class="md:col-span-2 col-span-10 flex items-center md:justify-end">
                        <div class="">{{ $d->created_at->translatedFormat('d M Y H:i') }} WIB</div>
                    </div>
                </a>
            @endforeach
            @if ($kosakata->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl text-center">Tidak ada data</div>
            @endif
        </div>

        <div class="mt-3">
            {{ $kosakata->links() }}
        </div>
    </div>

    {{-- Daftar definisi terbaru dari pengurus --}}
    <div class="p-5 bg-white rounded-2xl" id="laporan">
        <div class="flex items-center justify-between py-2">
            Definisi terbaru dari pengurus
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
                            <?php $d=$sementara ?>
                        </div>
                        <div class="line-clamp-2">{{ $d->user->nama }}</div>
                    </div>
                    <div class="md:col-span-2 col-span-10 flex items-center md:justify-end">
                        <div class="">{{ $d->created_at->translatedFormat('d M Y H:i') }} WIB</div>
                    </div>
                </a>
            @endforeach
            @if ($definisi->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl text-center">Tidak ada data</div>
            @endif
        </div>

        <div class="mt-3">
            {{ $definisi->links() }}
        </div>
    </div>

    {{-- detail kosakata diperbarui --}}
    <div class="p-5 bg-white rounded-2xl" id="laporan">
        <div class="flex items-center justify-between py-2">
            Detail kosakata diperbarui oleh pengurus
        </div>

        <div class="space-y-3">
            @foreach ($editKosakata as $d)
                <a href="{{ !empty($d->kosakata) ? '/kosakata/' . $d->kosakata->slug . '/riwayat' : '#' }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl grid grid-cols-10 md:space-y-0 space-y-1 hover:outline hover:outline-amber-400">
                    <div class="md:col-span-5 col-span-10 flex items-center line-clamp-2 md:font-normal font-semibold">
                        <div>
                            Menyetujui {{ $d->user->username ?? '[Akun dihapus]' }} untuk mengganti detail kosakata <span
                                class="capitalize">{{ $d->kosakata->kosakata ?? '[Kosakata dihapus]' }}</span>
                        </div>
                    </div>
                    <div class="flex gap-2 md:col-span-3 col-span-10 items-center">
                        <?php
                        $sementara = $d;
                        $d = $d->pengurus;
                        ?>
                        <div class="rounded-full w-8 h-8 overflow-hidden">
                            @include('partials.profile-pic-general')
                        </div>
                        <div class="line-clamp-2">{{ $d->nama ?? '[Akun dihapus]' }}</div>
                        <?php $d = $sementara; ?>
                    </div>
                    <div class="md:col-span-2 col-span-10 flex items-center md:justify-end">
                        <div class="">{{ $d->created_at->translatedFormat('d M Y H:i') }} WIB</div>
                    </div>
                </a>
            @endforeach
            @if ($editKosakata->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl text-center">Tidak ada data</div>
            @endif
        </div>

        <div class="mt-3">
            {{ $editKosakata->links() }}
        </div>
    </div>

    {{-- Blog --}}
    <div class="p-5 bg-white rounded-2xl" id="blog">
        <div class="py-2">Artikel terbaru dari pengurus</div>

        <div class="space-y-3">
            <div class="border border-neutral-200 p-3 mt-3 rounded-xl text-center"> Beralih ke halaman <a href="/artikel"
                    class="underline underline-offset-2 decoration-amber-400 decoration-2">Artikel</a>.
            </div>
        </div>
    </div>

    {{-- Laporan --}}
    <div class="p-5 bg-white rounded-2xl" id="laporan">
        <div class="py-2">Laporan</div>

        <div class="space-y-3">
            <div class="border border-neutral-200 p-3 mt-3 rounded-xl text-center"> Beralih ke halaman <a href="/laporan"
                    class="underline underline-offset-2 decoration-amber-400 decoration-2">Laporan</a>.
            </div>
        </div>
    </div>

    {{-- Daftar pengurus yang menghapus akunnya --}}
    <div class="p-5 bg-white rounded-2xl" id="laporan">
        <div class="py-2">
            Pengurus yang menghapus akunnya
        </div>

        <div class="space-y-3">
            @if ($pengurusDihapus->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @else
                @foreach ($pengurusDihapus as $d)
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
            {{ $pengurusDihapus->links() }}
        </div>
    </div>
@endsection
