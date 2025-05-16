@extends('layouts.homepage-with-banner')

@section('body')
    <h3 class="font-bold">Riwayat edit</h3>
    <p class="mb-7">
        Halaman ini menampilkan riwayat edit kosakata {{ $kosakata->kosakata }}, termasuk siapa yang mengedit, kapan, dan
        perubahan yang dilakukan.
        Kamu bisa melihat versi sebelumnya untuk melacak perubahan.
    </p>

    <ol class="relative border-l border-neutral-200 space-y-5 ml-4">
        <?php $n = 1; ?>
        @foreach ($riwayat as $r)
            {{-- foto --}}
            <div class="absolute" style="left: -1rem">
                <div class="w-8 h-8 rounded-full overflow-hidden outline outline-8 outline-white">
                    <?php $d = $r->user; ?>
                    @include('partials.profile-pic-general')
                </div>
            </div>

            <li class="space-y-3" style="margin-left: 1.75rem;">
                <div class="grid grid-cols-10 md:space-y-0 space-y-1">
                    <div class="md:col-span-9 col-span-10">
                        <div class="text-base -mt-1">Disubmit oleh
                            @if (isset($r->user))
                                <a class="font-bold" href="/u/{{ $r->user->username }}">{{ $r->user->nama }}</a>
                            @else
                                <span class="font-semibold">[Akun dihapus]</span>
                            @endif
                            pada
                            {{ $r->created_at->translatedFormat('d F Y H:i') }} WIB
                            <div class="text-xs">{{ $r->catatan ?? 'Tidak ada catatan' }}</div>
                        </div>
                    </div>

                    <div class="md:col-span-1 col-span-10 md:justify-end justify-start flex items-center space-x-1">
                        @if (isset(auth()->user()->role) && auth()->user()->role == 'pengurus' && empty($r->pengurus_id))
                        {{-- jika role user adalah pengurus dan kosakata belum diverifikasi --}}
                            <form action="/kosakata/{{ $kosakata->slug }}/riwayat/{{ $r->id }}/setujui"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="w-fit text-amber-700 flex hover:text-amber-800">
                                    <i data-feather='check' class="w-5 inline"></i>
                                    Setujui
                                </button>
                            </form>
                        @elseif (isset(auth()->user()->role) && (auth()->user()->role == 'kepala'|| auth()->user()->id==$r->user_id) && empty($r->pengurus_id))
                        {{-- jika role user adalah kepala/user yang mensubmit dan kosakata belum diverifikasi --}}
                            <div class="flex items-center space-x-1"><i data-feather='clock'
                                    class="w-5"></i><span>Pending</span></div>
                        @elseif (isset(auth()->user()->role) && auth()->user()->role != 'kontributor' && isset($r->pengurus_id))
                            <?php $d = $r->pengurus; ?>
                            <a href="/u/{{ $d->username }}"
                                class="rounded-full overflow-hidden w-8 h-8 hover:outline hover:outline-offset-2 hover:outline-amber-400"
                                title="Disetujui oleh {{ $d->nama }}">
                                @include('partials.profile-pic-general')
                            </a>
                            <span class="md:hidden block text-sm line-clamp-1">Disetujui oleh <a
                                    href="/u/{{ $d->username }}">{{ $d->nama }}</a></span>
                        @endif
                    </div>

                </div>
                {{-- deskripsi --}}
                <div class="rounded-2xl border border-neutral-200 p-5">

                    <div class="flex justify-between">
                        <h4 class="capitalize">{{ $kosakata->kosakata }} <span
                                class="text-sm jawa">{{ $r->aksara }}</span>
                        </h4>
                        @if ($n == 1 && isset($r->status))
                            <div class="text-sm rounded-full py-1 px-3 bg-blue-300 h-fit"
                                title="Detail deskripsi yang digunakan">
                                ⭐ <span class="md:inline hidden">Digunakan sekarang</span>
                            </div>
                        @endif
                    </div>
                    @if ($r->notasi_fonetik)
                        <div>/{{ $r->notasi_fonetik }}/</div>
                    @endif
                    <div>
                        @if (isset($r->etimologi) && $r->etimologi != [''] && $r->etimologi[0] == 'Asli')
                            Kosakata asli Bahasa Jawa.
                        @elseif (isset($r->etimologi) && $r->etimologi != [''])
                            Kata serapan dari bahasa {{ $r->etimologi[0] }} "{{ $r->etimologi[1] }}"
                        @endif
                    </div>

                    <div>
                        @if (isset($r->arti_indo))
                            🇮🇩 {{ $r->arti_indo }}
                        @endif

                        @if (isset($r->serupa) && $r->serupa != [''])
                            🏴󠁩󠁤󠁪󠁷󠁿 {!! implode(',&nbsp;', array_map(fn($d) => "<span class=\"capitalize\">{$d}</span>", $r->serupa)) !!}
                        @endif
                    </div>

                    <div class="md:flex block md:space-x-2 space-x-0 md:space-y-0 space-y-2 items-center mt-1">
                        <div class="flex space-x-2">
                            @isset($r->ragam)
                                <div class="py-1 px-2 bg-blue-100 rounded-lg">{{ $r->ragam }}</div>
                            @endisset
                            @isset($r->jenis)
                                <div class="py-1 px-2 bg-red-100 rounded-lg">{{ $r->jenis }}</div>
                            @endisset
                        </div>
                    </div>

                </div>
            </li>
            @isset($r->pengurus->id)
                <?php $n++; ?>
            @endisset
        @endforeach

        <div class="absolute" style="left: -1rem">
            <div class="w-8 h-8 rounded-full overflow-hidden outline outline-8 outline-white">
                <?php $d = $kosakata->user; ?>
                @if (isset($d))
                    {{-- jika user ditemukan --}}
                    @include('partials.profile-pic-general')
                @else
                    {{-- jika user dihapus/tidak ditemukan --}}
                    @include('partials.profil-pic-general-array2')
                @endif
            </div>
        </div>

        <li class="space-y-2" style="margin-left: 1.75rem;">
            <div class="text-base">Disubmit oleh
                @if (isset($kosakata->user))
                    <a class="font-bold" href="/u/{{ $kosakata->user->username }}">{{ $kosakata->user->nama }}</a> pada
                    {{ $kosakata->created_at->translatedFormat('d F Y H:i') }} WIB
                @else
                    [Akun dihapus]
                @endif
                <div class="text-xs capitalize">{{ $kosakata->catatan ?? 'Tidak ada catatan' }} </div>
            </div>
            {{-- deskripsi --}}
            <div class="rounded-2xl border border-neutral-200 p-5">

                <div class="flex justify-between">
                    <h4 class="capitalize">{{ $kosakata->kosakata }} <span
                            class="text-sm jawa">{{ $kosakata->aksara }}</span>
                    </h4>
                    <div class="text-sm md:block hidden rounded-full py-1 px-3 bg-blue-300 h-fit">
                        ☝️ Versi awal
                    </div>
                </div>
                @if ($kosakata->notasi_fonetik)
                    <div>/{{ $kosakata->notasi_fonetik }}/</div>
                @endif
                <div>
                    @if (isset($kosakata->etimologi) && $kosakata->etimologi != [''] && $kosakata->etimologi[0] == 'Asli')
                        Kosakata asli Bahasa Jawa.
                    @elseif (isset($kosakata->etimologi) && $kosakata->etimologi != [''])
                        Kata serapan dari bahasa {{ $kosakata->etimologi[0] }} "{{ $kosakata->etimologi[1] }}"
                    @endif
                </div>

                <div>
                    @if (isset($kosakata->arti_indo))
                        🇮🇩 Perut
                    @endif

                    @if (isset($kosakata->serupa) && $kosakata->serupa != [''])
                        🏴󠁩󠁤󠁪󠁷󠁿 {!! implode(',&nbsp;', array_map(fn($d) => "<span class=\"capitalize\">{$d}</span>", $kosakata->serupa)) !!}
                    @endif
                </div>

                <div class="md:flex block md:space-x-2 space-x-0 md:space-y-0 space-y-2 items-center mt-1">
                    <div class="flex space-x-2">
                        @isset($kosakata->ragam)
                            <div class="py-1 px-2 bg-blue-100 rounded-lg">{{ $kosakata->ragam }}</div>
                        @endisset
                        @isset($kosakata->jenis)
                            <div class="py-1 px-2 bg-red-100 rounded-lg">{{ $kosakata->jenis }}</div>
                        @endisset
                    </div>
                </div>

            </div>
        </li>

    </ol>

    <div>
        {{ $riwayat->links() }}
    </div>
@endsection

@section('toast')
    @include('partials.toast')
@endsection
