@extends('layouts.dashboard')

@section('body')
    {{-- Detail laporan --}}
    <div class="p-5 bg-white rounded-2xl">
        <div class="mb-3">Detail Laporan</div>
        <div class="grid md:grid-cols-2 grid-cols-1 md:space-x-4 space-x-0 md:space-y-0 space-y-8">

            {{-- detail --}}
            <div class="space-y-3">
                <div class="">
                    <div class="text-sm text-neutral-600">ID Laporan</div>
                    <div class="">#{{ $laporan->idZerofill }}</div>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Pelapor</div>
                    <div class="">{{ $laporan->user->nama }}</div>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Terlapor</div>
                    <div class="">{{ $laporan->author->nama }}</div>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Alasan</div>
                    <div class="">{{ $laporan->alasan }}</div>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Waktu</div>
                    <div class="">{{ $laporan->created_at->format('d F Y H:i') }} WIB</div>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Status</div>
                    <div class="">
                        @if (isset($laporan->status))
                            Ditangani
                        @else
                            Pending
                        @endif
                    </div>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Catatan</div>
                    <div class="">
                        @isset($laporan->catatan)
                            {{ $laporan->catatan }}
                        @else
                            Tidak ada
                        @endisset
                    </div>
                </div>
            </div>

            {{-- preview definisi dilaporkan --}}
            <div class="">

                <div class="sticky top-5">
                    <?php $d = $definisi; ?>
                    {{-- import tampilan definisi --}}
                    @include('partials.definisi')

                    {{-- kunjungi definisi --}}
                    <div class="flex justify-center">
                        <a href="/kosakata/{{ $laporan->kosakata->slug }}?definisi={{ $laporan->definisi_id }}"
                            class="rounded-full flex items-center space-x-1 py-2 px-4 border border-neutral-200 w-fit hover:bg-amber-400">
                            @if ($d->updated == 1)
                                <span>Lihat definisi asli</span>
                            @else
                                <span>Definisi asli sudah diubah, cek</span>
                            @endif
                            <i data-feather='arrow-right' class="w-5"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Tindakan --}}
    <div class="p-5 bg-white rounded-2xl">
        <div class="mb-3">Tindakan</div>
        @if (isset($laporan->status))
            <div class="grid md:grid-cols-2 grid-cols-1 md:space-x-4 space-x-0 md:space-y-0 space-y-4">
                <div class="col-span-1 space-y-3">
                    <div class="">
                        <div class="text-sm text-neutral-600">Ditangani oleh</div>
                        <div class="">Muklis Kusuma Wardana</div>
                    </div>
                    <div class="">
                        <div class="text-sm text-neutral-600">Waktu</div>
                        <div class="">11 Januari 2025 15:30</div>
                    </div>
                    <div class="">
                        <div class="text-sm text-neutral-600">Keputusan</div>
                        <div class="">Pelanggaran ditemukan</div>
                    </div>
                    <div class="">
                        <div class="text-sm text-neutral-600">Hukuman</div>
                        <div class="">Tidak ada</div>
                    </div>
                    <div class="">
                        <div class="text-sm text-neutral-600">Catatan</div>
                        <div class="">Tidak ada</div>
                    </div>
                </div>

                <div class="col-span-1">
                    <div class="sticky top-5">
                        <div class="flex justify-center">
                            <img src="https://img.freepik.com/free-vector/high-five-concept-illustration_114360-26757.jpg"
                                class="w-3/5" alt="High five concept illustration">
                        </div>
                        <div class="font-semibold text-center">Terima kasih atas laporannya!</div>
                        <div class="text-center">Situs ini jadi lebih aman berkat kamu.</div>
                    </div>
                </div>
            </div>
        @else
            <?php $notFound = 'Belum ada tindakan yang diambil'; ?>
            @include('partials.not-found')
        @endif
    </div>
@endsection
