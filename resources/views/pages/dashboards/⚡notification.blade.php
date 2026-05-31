<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Notifikasi;
use Carbon\Carbon;

new class extends Component {
    #[Title('Notifikasi')]
    #[Layout('layouts.dashboard')]
    #[Computed]
    public function notifications()
    {
        // HAPUS NOTIFIKASI YANG SUDAH DIBACA DAN SUDAH LEBIH DARI 30 HARI
        Notifikasi::where('user_id', Auth::user()->id)
            ->where('dilihat', 1)
            ->where('updated_at', '<', Carbon::now()->subDays(30))
            ->delete();

        // Ambil data dari database
        $notif = Notifikasi::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // sortir berdasarkan tanggal
        // dapatkan data tanggal
        $tanggal = (clone $notif)
            ->pluck('created_at') // ambil hanya kolom created_at saja
            ->map(fn($item) => $item->toDateString()) // ubah firmat tanggal ke yyyy-mm-dd, menggunakan map untuk mengubah atau memodifikasi setiap item dalam sebuah koleksi
            ->unique(); // jangan simpan tanggal duplikat

        // Lakukan pengelompokan
        $data = []; // perlu ini agar tidak error ketika $notif==null
        foreach ($tanggal as $d) {
            $key = $d == Carbon::now()->toDateString() ? 'Hari ini' : ($d == Carbon::yesterday()->toDateString() ? 'Kemarin' : Carbon::createFromFormat('Y-m-d', $d)->translatedFormat('d F Y'));
            $data[$key] = $notif->filter(function ($item) use ($d) {
                // lakukan filter
                return $item->created_at->toDateString() == $d; // kembalikan $item jika created_at sama dengan $d
            });
        }

        // ubah status notifikasi yang belum dibaca menjadi dibaca
        $belumDilihat = (clone $notif)->where('dilihat', 0)->pluck('id');
        // cek apakah ditemukan notif yang belum dilihat
        if ($belumDilihat->isNotEmpty()) {
            // update menjadi dilihat
            Notifikasi::whereIn('id', $belumDilihat)->update(['dilihat' => 1]);
        }

        return $data;
    }
};
?>

<div class="space-y-5">
    {{-- jika data kosong --}}
    @if (!empty($this->notifications))
        <div class="space-y-5">
            @foreach ($this->notifications as $key => $d)
                <div class="" id="kosakata">
                    <div class="md:flex md:justify-between md:space-y-0 space-y-1">
                        <div>{{ $key }}</div>
                        <div class="flex space-x-2">
                            <div class="flex space-x-1 items-center">
                                <div class="w-2 h-2 bg-amber-400"></div>
                                <div class="text-xs">Achievement</div>
                            </div>
                            <div class="flex space-x-1 items-center">
                                <div class="w-2 h-2 bg-blue-400"></div>
                                <div class="text-xs">Sertifikat</div>
                            </div>
                            <div class="flex space-x-1 items-center">
                                <div class="w-2 h-2 bg-red-400"></div>
                                <div class="text-xs">Laporan</div>
                            </div>
                            <div class="flex space-x-1 items-center">
                                <div class="w-2 h-2 bg-neutral-400"></div>
                                <div class="text-xs">Lain-lain</div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        @foreach ($d as $i)
                            <a href="{{ $i->url ?? '#' }}" title="{{ $i->dilihat == 0 ? 'Belum dibaca' : '' }}"
                                class="border border-neutral-200 {{ $i->dilihat == 1 ? 'bg-neutral-200 text-neutral-700' : '' }} p-3 mt-3 rounded-xl flex justify-between space-x-2.5 hover:outline hover:outline-amber-400">
                                <div class="flex space-x-2 items-center">
                                    {{-- indikator --}}
                                    <?php
                                    if ($i->kategori == 'achievement') {
                                        $warna = 'amber';
                                    } elseif ($i->kategori == 'sertifikat') {
                                        $warna = 'blue';
                                    } elseif ($i->kategori == 'laporan') {
                                        $warna = 'red';
                                    } else {
                                        $warna = 'neutral';
                                    }
                                    ?>
                                    <div class="w-1 h-3 bg-{{ $warna }}-400 rounded-full shrink-0"
                                        title="{{ ucfirst($i->kategori) }}"></div>

                                    {{-- pesan --}}
                                    <div>
                                        {{ $i->message }}
                                    </div>
                                </div>

                                <div class="flex items-center space-x-2">
                                    <div class="">{{ $i->created_at->format('H:i') }}</div>
                                    @if ($i->dilihat == 0)
                                        <div class="bg-red-600 animate-pulse w-1.5 h-1.5 rounded-full"></div>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center text-neutral-500 text-sm">— Notifikasi yang sudah dibaca akan terhapus otomatis setelah
            30 hari —</div>
    @else
        <?php $notFound = 'Belum ada notifikasi'; ?>
        @include('partials.not-found')
    @endif
</div>
