<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Definisi;
use App\Models\Report;
use App\Models\User;

new class extends Component {
    use WithPagination;
    // overview
    #[Title('Kontribusi')]
    #[Layout('layouts.dashboard')]
    #[Computed]
    public function overview()
    {
        // definisi
        $definisiQuery = Definisi::with([
            'user' => function ($query) {
                $query->withTrashed();
            },
        ])->where('user_id', '=', Auth::user()->id);
        $current = (clone $definisiQuery) //
            ->whereYear('updated_at', now()->year) //
            ->whereMonth('updated_at', '=', now()->month)
            ->count();
        $statistik['definisi'] = ['title' => 'Definisi disubmit', 'footnote' => 'Bulan ini, anda mensubmit ' . $current . ' definisi'];
        $statistik['definisi']['value'] = (clone $definisiQuery)->count();

        // verifikasi definisi
        if (Auth::user()->role == 'pengurus') {
            $verifikasiQuery = Definisi::where('verifikasi_oleh', Auth::user()->id)->whereNotNull('verifikasi');
            $current = (clone $verifikasiQuery)
                ->whereYear('verifikasi', now()->year) //
                ->whereMonth('verifikasi', '=', now()->month)
                ->count();
            $statistik['verifikasi'] = ['title' => 'Definisi diverifikasi', 'footnote' => 'Bulan ini, anda memverifikasi ' . $current . ' definisi'];
            $statistik['verifikasi']['value'] = (clone $verifikasiQuery)->count();
        }

        // laporan
        $laporanQuery = Report::with([
            'definisi' => function ($query) {
                $query->withTrashed();
            },
        ])->where('user_id', '=', auth()->user()->id);
        $total = (clone $laporanQuery)->count();
        $statistik['laporan'] = ['title' => 'Laporan pending', 'footnote' => 'Total ' . $total . ' laporan telah anda submit'];
        $statistik['laporan']['value'] = (clone $laporanQuery)->whereNull('status')->count(); //pakai "clone" agar query  didalam $laporanQuery tidak berubah

        return $statistik;
    }

    // dapatkan kontribusi definisi
    #[Computed]
    public function definitions()
    {
        // definisi
        return Definisi::with([
            'user' => function ($query) {
                $query->withTrashed();
            },
        ])
            ->where('user_id', '=', auth()->user()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'definisi-page')
            ->onEachSide(2)
            ->appends(request()->query());
    }

    // kontribusi verifikasi definisi (khusus pengurus)
    #[Computed]
    public function verifiedDefinitions()
    {
        // verifikasi definisi
        if (auth()->user()->role != 'pengurus') {
            return;
        }
        return Definisi::where('verifikasi_oleh', auth()->user()->id)
            ->whereNotNull('verifikasi')
            ->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'verifikasi-page')
            ->onEachSide(2)
            ->appends(request()->query());
    }

    // kontribusi laporan
    #[Url]
    public $filter = 'ditangani';
    #[Computed]
    public function reports()
    {
        // dapatkan data laporan
        $report = Report::with([
            'definisi' => function ($query) {
                $query->withTrashed();
            },
        ])->where('user_id', '=', auth()->user()->id);

        // filter status
        if ($this->filter === 'pending') {
            $report = $report->whereNull('status');
        }
        if ($this->filter === 'selesai') {
            $report = $report->whereNotNull('status');
        }

        $report = $report
            ->orderBy('updated_at', 'desc')
            ->paginate(10, ['*'], 'report-page')
            ->onEachSide(2)
            ->appends(request()->query());

        foreach ($report as $d) {
            $d->terlapor = User::find($d['definisi']['user_id'])->nama ?? '[Akun dihapus]';
        }
        return $report;
    }
};
?>

<div class="space-y-5">
    {{-- Overview --}}
    <div class="space-y-3">
        <div class="">Overview</div>
        <div class="grid md:grid-cols-3 grid-cols-2 gap-2">

            @foreach ($this->overview as $key => $data)
                <x-bento-item title="{{ $data['title'] }}" value="{{ $data['value'] }}"
                    footnote="{{ $data['footnote'] }}" />
            @endforeach
        </div>
    </div>

    {{-- Definisi --}}
    <div class="space-y-3" id="definisi">
        <div>Definisi Ditambahkan</div>
        <div class="space-y-2">
            @foreach ($this->definitions as $d)
                <x-list-item url="/kosakata/{{ $d->kosakata }}?id={{ $d->id }}">
                    <x-slot:leftText>
                        <div class="">Mensubmit definisi untuk kosakata {{ $d->kosakata }}</div>
                        @if (isset($d->verifikasi))
                            <div wire:ignore class="" title="Telah diverifikasi">
                                <i data-lucide='badge-check' class="size-4 fill-amber-400 dark:stroke-zinc-800"></i>
                            </div>
                        @endif
                        <x-badge title="Poin diperoleh">
                            <i data-lucide='astroid' class="size-3 fill-black dark:fill-white"></i>
                            <div class="">{{ $d->poin_kontributor + $d->poin_verifikasi }} Poin</div>
                        </x-badge>
                    </x-slot:leftText>
                    <x-slot:rightText>
                        <x-badge>{{ dateFormat($d->updated_at) }}</x-badge>
                    </x-slot:rightText>
                </x-list-item>
            @endforeach
            @if ($this->definitions->isEmpty())
                <x-errors.not-found text="Belum ada data" />
            @endif
        </div>

        <div class="mt-3">
            {{ $this->definitions->links() }}
        </div>

    </div>

    {{-- Verifikasi Definisi (hanya untuk pengurus) --}}
    @if (auth()->user()->role == 'pengurus')
        <div class="space-y-3" id="verifikasi-definisi">
            <div>Definisi Diverifikasi</div>
            <div class="space-y-2">
                @foreach ($this->verifiedDefinitions as $d)
                    <x-list-item url="/kosakata/{{ $d->kosakata }}?id={{ $d->id }}">
                        <x-slot:leftText>
                            <div class="">
                                Memverifikasi definisi {{ $d->kosakata }} oleh
                                {{ $d->user->nama ?? '[Pengguna dihapus]' }}
                            </div>
                            @if (isset($d->verifikasi))
                                <div wire:ignore class="" title="Telah diverifikasi">
                                    <i data-lucide='badge-check' class="size-4 fill-amber-400 dark:stroke-zinc-800"></i>
                                </div>
                            @endif
                            {{-- poin --}}
                            <x-badge title="Poin diperoleh">
                                <i data-lucide='astroid' class="size-3 fill-black dark:fill-white"></i>
                                <div class="">{{ $d->poin_verifikasi }} Poin</div>
                            </x-badge>
                        </x-slot:leftText>
                        <x-slot:rightText>
                            <x-badge>{{ dateFormat($d->verifikasi) }}</x-badge>
                        </x-slot:rightText>
                    </x-list-item>
                @endforeach
                @if ($this->verifiedDefinitions->isEmpty())
                    <x-errors.not-found text="Belum ada data" />
                @endif
            </div>

            <div class="mt-3">
                {{ $this->verifiedDefinitions->links() }}
            </div>

        </div>
    @endif

    {{-- Laporan --}}
    <div class="space-y-3" id="laporan">
        <div class="">Laporan kamu</div>

        <div class="space-y-3">
            @foreach ($this->reports as $d)
                <x-list-item url="/laporan/{{ $d->id }}">
                    <x-slot:leftText>
                        <div class="">
                            Melaporkan definisi dari kosakata {{ $d->definisi->kosakata }}
                        </div>
                        {{-- status laporan --}}
                        <x-badge gap="1" color="{{ isset($d->status) ? 'bg-green-200' : 'bg-red-200' }}">
                            <i data-lucide='{{ isset($d->status) ? 'check-circle' : 'clock' }}' class="size-3"></i>
                            <div class="">{{ isset($d->status) ? 'Ditindaklanjuti' : 'Pending' }}</div>
                        </x-badge>

                        {{-- poin --}}
                        @isset($d->status)
                            <x-badge title="Poin diperoleh">
                                <i data-lucide='astroid' class="size-3 fill-black dark:fill-white"></i>
                                <div class="">{{ $d->poin_pelapor ?? 0 }} Poin</div>
                            </x-badge>
                        @endisset
                    </x-slot:leftText>
                    <x-slot:rightText>
                        {{ dateFormat($d->updated_at) }}
                    </x-slot:rightText>
                </x-list-item>
            @endforeach
            @if ($this->reports->isEmpty())
                <x-errors.not-found text="Belum ada data" />
            @endif
        </div>

        <div class="mt-3">
            {{ $this->reports->links() }}
        </div>

    </div>
</div>
