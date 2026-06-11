<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Definisi;
use App\Models\Blog;
use App\Models\Report;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

new class extends Component {
    // #[Computed]
    public function with()
    {
        // dapatkan data kontribusi user dalam 7 hari terakhir - kalau kepala tidak perlu dijalankan
        // definisi
        $def7hari = Definisi::where('user_id', auth()->user()->id)
            ->where('created_at', '>=', now()->subDays(7))
            ->whereNot('created_at', '>=', now())
            ->orderBy('created_at', 'desc')
            ->get();

        // laporan
        $laporan7hari = Report::where('user_id', auth()->user()->id)
            ->where('created_at', '>=', now()->subDays(7))
            ->whereNot('created_at', '>=', now())
            ->orderBy('created_at', 'desc')
            ->get();

        // khusus pengurus
        if (auth()->user()->role == 'pengurus') {
            // artikel
            $blog7hari = Blog::where('user_id', auth()->user()->id)
                ->whereNotNull('status')
                ->where('status', '>=', now()->subDays(7))
                ->whereNot('status', '>=', now())
                ->orderBy('created_at', 'desc')
                ->get();

            // memverifikasi definisi
            $verif7hari = Definisi::where('verifikasi_oleh', auth()->user()->id)
                ->where('verifikasi', '>=', now()->subDays(7))
                ->whereNot('verifikasi', '>=', now())
                ->orderBy('verifikasi', 'desc')
                ->get();

            // menindaklanjuti laporan
            $tindakLanjut7hari = Report::where('pengurus_id', auth()->user()->id)
                ->where('status', '>=', now()->subDays(7))
                ->whereNot('status', '>=', now())
                ->orderBy('status', 'desc')
                ->get();
        }

        // digunakan untuk mengetahui nilai kontribusi tertinggi - untuk menghitung persentase. gunakan nilai 1 agar tidak error ketika user belum berkontribusi/ tidak ada kontribusi selama 7 hari terakhir
        $kontribusiTertinggi = 0;

        // jumlahkan ke tiap-tiap hari
        for ($i = 0; $i < 7; $i++) {
            // judul array
            $judul = $i == 0 ? 'Hari ini' : ($i == 1 ? 'Kemarin' : now()->subDays($i)->translatedFormat('l'));

            // jumlahkan tiap kontribusi di hari tsb
            // definisi
            $def = $def7hari
                ->filter(function ($item) use ($i) {
                    return $item->created_at->toDateString() == now()->subDays($i)->toDateString();
                    // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                })
                ->count();
            // laporan
            $lap = $laporan7hari
                ->filter(function ($item) use ($i) {
                    return $item->created_at->toDateString() == now()->subDays($i)->toDateString();
                    // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                })
                ->count();
            if (auth()->user()->role == 'pengurus') {
                // artikel
                $blog = $blog7hari
                    ->filter(function ($item) use ($i) {
                        return $item->status->toDateString() == now()->subDays($i)->toDateString();
                        // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                    })
                    ->count();
                // memverifikasi definisi
                $verifdef = $verif7hari
                    ->filter(function ($item) use ($i) {
                        return $item->verifikasi->toDateString() == now()->subDays($i)->toDateString();
                        // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                    })
                    ->count();

                // menindaklanjuti laporan
                $tindaklanjutlap = $tindakLanjut7hari
                    ->filter(function ($item) use ($i) {
                        return $item->status->toDateString() == now()->subDays($i)->toDateString();
                        // toDateString=ubah format hari menjadi string (yyyy-mm-dd)
                    })
                    ->count();
            }

            $contribution = $def + $lap;
            if (auth()->user()->role == 'pengurus') {
                $contribution = $contribution + $blog + $verifdef + $tindaklanjutlap;
            }
            $dataset[] = $contribution;
            $label[] = $judul;
        }

        // balik data
        $dataset = array_reverse($dataset);
        $label = array_reverse($label);

        $chart = LarapexChart::areaChart() //
            ->addData($dataset, 'kontribusi')
            ->setHeight(250)
            ->setXAxis($label)
            ->setGrid();

        return [
            'chart' => $chart,
        ];
        // return $tujuhhari;
    }

    // definisi random
    #[Computed]
    public function randomDefinition()
    {
        // tampilakan definisi random (untuk semacam trivia)
        $definisiRandom = Definisi::where(function ($query) {
            $query->whereNotNull('verifikasi_oleh')->orWhereHas('user', function ($q) {
                $q->where('role', 'pengurus');
            });
        })
            ->whereNull('hukuman_edit')
            ->with('user')
            ->with('pengurus')
            ->inRandomOrder()
            ->first();
        // $definisiRandom = Definisi::find(1);

        // jika tidak ada definisi random yang terverifikasi, maka tampilkan yang tidak terverifikasi
        if (empty($definisiRandom)) {
            $definisiRandom = Definisi::whereHas('kosakata') //
                ->with('user')
                ->inRandomOrder()
                ->first();
        }
        return $definisiRandom;
    }
};
?>

{{-- statistik user (hanya untuk kontributor & pengurus) --}}
<div class="grid md:grid-cols-2 grid-cols-1 gap-2">
    <x-bento-item title="Kontribusi terbaru" urlText="Tambah kontribusi" url="/kosakata">
        <div class="h-fit -m-3">
            @if ($chart)
                {!! $chart->container() !!}
                {!! $chart->script() !!}
            @endif
        </div>
    </x-bento-item>

    {{-- Tampilkan kosakata acak --}}
    <x-bento-item title="Kosakata acak" urlText="Lihat"
        url="/kosakata/{{ $this->randomDefinition->kosakata }}?id={{ $this->randomDefinition->id }}">
        <div class="capitalize font-semibold flex gap-1 items-center">
            <div class="">{{ $this->randomDefinition->kosakata }}</div>
            <i data-lucide='badge-check' class="w-4 dark:stroke-zinc-900 fill-amber-400"></i>
        </div>
        {{-- <div class="line-clamp-5">{!! $this->randomDefinition->definisi !!}</div> --}}
        <div class="line-clamp-5">{!! $this->randomDefinition->definisi !!}</div>
        <div class="text-sm">Disubmit oleh
            @if (!empty($this->randomDefinition->user))
                <a href="/u/{{ $this->randomDefinition->user->username }}"
                    title="Lihat profil {{ $this->randomDefinition->user->nama }}"
                    class="font-semibold hover:underline hover:underline-offset-4 hover:decoration-amber-400 hover:decoration-4">{{ $this->randomDefinition->user->nama }}</a>
            @else
                <span class="font-semibold">[Akun dihapus]</span>
            @endif
        </div>
    </x-bento-item>
</div>
