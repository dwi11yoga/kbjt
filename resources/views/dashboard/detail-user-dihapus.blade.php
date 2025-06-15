{{-- View detail user yang menghapus akunnya sendiri  --}}
@extends('layouts.dashboard')
@section('body')
    <div class="grid grid-cols-3 md:gap-2 gap-3">
        {{-- tentang user --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div class="mb-2 flex items-center">
                Tentang {{ $user->role }}
            </div>
            <div class="space-y-2">
                <div>
                    <div class="text-sm">ID</div>
                    <div class="">{{ $user->idZeroFill }}</div>
                </div>
                <div>
                    <div class="text-sm">Nama</div>
                    <div class="">{{ $user->nama }}</div>
                </div>
                <div>
                    <div class="text-sm">Username</div>
                    <div class="">&#64;{{ $user->username }}</div>
                </div>
                <div>
                    <div class="text-sm">Tanggal lahir</div>
                    <div class="">{{ $user->tgl_lahir?->translatedFormat('d F Y') ?? 'T/A' }}</div>
                </div>
                <div>
                    <div class="text-sm">Kota asal</div>
                    <div class="">{{ $user->kota ?? 'T/A' }}</div>
                </div>
            </div>
        </div>

        {{-- kontribusi user --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div class="mb-2 flex items-center">
                Kontribusi
            </div>
            <div class="space-y-2">
                <div>
                    <div class="text-sm">Level</div>
                    <div class="">{{ $user->level }}</div>
                </div>
                <div>
                    <div class="text-sm">Poin</div>
                    <div class="">{{ number_format($user->poin, 0, ',', '.') }}</div>
                </div>
                <div>
                    <div class="text-sm">Total kontribusi</div>
                    <div class="">{{ $user->kontribusi }}</div>
                </div>
                <div>
                    <div class="text-sm">Total Achievement</div>
                    <div class="">{{ $user->totalAchievement }}</div>
                </div>
                <div>
                    <div class="text-sm">Total Sertifikat</div>
                    <div class="">{{ $user->totalSertifikat }}</div>
                </div>
            </div>
        </div>

        {{-- alasan akun dihapus --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div class="mb-2 flex items-center">Alasan akun dihapus</div>
            <div class="space-y-1">
                <div>"{{ $alasan->alasan ?? 'Tidak ada' }}"</div>
                <div class="text-sm">— pada
                    {{ $alasan->created_at->translatedFormat('d F Y') }} pukul {{ $alasan->created_at->format('H:i') }}.
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar kosakata disumit oleh pengguna --}}
    <div class="p-5 bg-white rounded-2xl" id="kosakata">
        <div class="flex items-center justify-between py-2">
            Kosakata disubmit oleh pengguna
        </div>

        <div class="space-y-3">
            @foreach ($kosakata as $d)
                <a href="/kosakata/{{ $d->slug }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl md:flex block md:justify-between md:space-y-0 space-y-1 hover:outline hover:outline-amber-400">
                    <div
                        class="md:col-span-5 col-span-10 flex items-center line-clamp-2 md:font-normal font-semibold capitalize">
                        Kosakata {{ $d->kosakata ?? '[Kosakata dihapus]' }}
                    </div>

                    <div class="">{{ $d->created_at->translatedFormat('d M Y H:i') }} WIB</div>
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

    {{-- Daftar edit kosakata disumit oleh pengguna --}}
    <div class="p-5 bg-white rounded-2xl" id="kosakata">
        <div class="flex items-center justify-between py-2">
            Edit kosakata disubmit oleh pengguna
        </div>

        <div class="space-y-3">
            @foreach ($editKosakata as $d)
                <a href="{{ !empty($d->kosakata) ? '/kosakata/' . $d->kosakata->slug . '/riwayat' : '#' }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl md:flex block md:justify-between md:space-y-0 space-y-1 hover:outline hover:outline-amber-400">
                    <div
                        class="md:col-span-5 col-span-10 flex items-center line-clamp-2 md:font-normal font-semibold">
                        [{{ empty($d->pengurus_id) ? 'Pending':'Disetujui' }}] Edit detail kosakata {{ $d->kosakata->kosakata ?? '[Kosakata dihapus]' }}
                    </div>

                    <div class="">{{ $d->created_at->translatedFormat('d M Y H:i') }} WIB</div>
                </a>
            @endforeach
            @if ($editKosakata->isEmpty())
                <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
            @endif
        </div>

        <div class="mt-3">
            {{ $editKosakata->links() }}
        </div>
    </div>

    {{-- Daftar definisi terbaru dari kontributor --}}
    <div class="p-5 bg-white rounded-2xl" id="definisi">
        <div class="flex items-center justify-between py-2">
            Definisi disubmit oleh pengguna
        </div>

        <div class="space-y-3">
            @foreach ($definisi as $d)
                <a href="{{ !empty($d->kosakata) ? '/kosakata/' . $d->kosakata->slug . '?definisi=' . $d->id : '#' }}"
                    class="border border-neutral-200 p-3 mt-3 rounded-xl md:flex block md:justify-between hover:outline hover:outline-amber-400">
                    <div>
                        Definisi untuk kosakata <span
                            class="capitalize">{{ $d->kosakata->kosakata ?? '[Kosakata dihapus]' }}</span>
                    </div>

                    <div class="">{{ $d->created_at->translatedFormat('d M Y H:i') }} WIB</div>
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
        <div class="py-2">Laporan dibuat oleh pengguna</div>

        <div class="space-y-3">
            <div class="space-y-3">
                @foreach ($laporan as $d)
                    <a href="/laporan/{{ $d->id }}"
                        class="border border-neutral-200 p-3 mt-3 rounded-xl md:flex block md:justify-between hover:outline hover:outline-amber-400">
                        <div>
                            Melaporkan {{ $d->dilaporkan }} yang disubmit oleh {{ $d->terlapor ?? '[Akun dihapus]' }}
                        </div>

                        <div class="">{{ $d->created_at->translatedFormat('d M Y H:i') }} WIB</div>
                    </a>
                @endforeach
                @if ($laporan->isEmpty())
                    <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
                @endif
            </div>

            <div class="mt-3">
                {{ $laporan->links() }}
            </div>
        </div>
    </div>

    {{-- jika pengguna adalah pengurus --}}
    @if ($user->role == 'pengurus')
        {{-- detail kosakata diperbarui --}}
        <div class="p-5 bg-white rounded-2xl" id="laporan">
            <div class="flex items-center justify-between py-2">
                Edit kosakata disetujui oleh pengguna
            </div>

            <div class="space-y-3">
                @foreach ($setujuiEditKosakata as $d)
                    <a href="{{ !empty($d->kosakata) ? '/kosakata/' . $d->kosakata->slug . '/riwayat' : '#' }}"
                        class="border border-neutral-200 p-3 mt-3 rounded-xl md:flex block md:justify-between hover:outline hover:outline-amber-400">
                        <div>
                            Menyetujui edit kosakata {{ strtolower($d->kosakata->kosakata) }} yang disubmit oleh {{ $d->user->nama ?? '[Akun dihapus]' }}
                        </div>

                        <div class="">{{ $d->created_at->translatedFormat('d M Y H:i') }} WIB</div>
                    </a>
                @endforeach
                @if ($setujuiEditKosakata->isEmpty())
                    <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
                @endif
            </div>

            <div class="mt-3">
                {{ $setujuiEditKosakata->links() }}
            </div>
        </div>

        {{-- artikel --}}
        <div class="p-5 bg-white rounded-2xl" id="laporan">
            <div class="py-2">Artikel ditulis oleh pengguna</div>

            <div class="space-y-3">
                <div class="space-y-3">
                    @foreach ($artikel as $d)
                        <a href="{{ empty($d->status) ? '/blog/preview/':'/blog/post/' }}{{ $d->slug }}"
                            class="border border-neutral-200 p-3 mt-3 rounded-xl md:flex block md:justify-between hover:outline hover:outline-amber-400">
                            <div>
                                [{{ empty($d->status) ? 'Draft' : 'Dipublikasikan' }}] {{ $d->judul }}
                            </div>

                            <div class="">{{ $d->created_at->translatedFormat('d M Y H:i') }} WIB</div>
                        </a>
                    @endforeach
                    @if ($artikel->isEmpty())
                        <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
                    @endif
                </div>

                <div class="mt-3">
                    {{ $artikel->links() }}
                </div>
            </div>
        </div>
    @endif
@endsection
