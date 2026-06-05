<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Definisi;
use App\Models\Report;
use App\Models\User;
use App\Models\HapusAkun;
use App\Models\Blog;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    #[Title('Pengurus')]
    #[Layout('layouts.dashboard')]
    #[Computed]
    public function overview()
    {
        // jumlah pengurus
        $overview['jmlPengurus'] = User::where('role', 'pengurus')->count();
        $overview['jmlUser'] = User::count();
        $overview['rasioUser'] = number_format(($overview['jmlPengurus'] / $overview['jmlUser']) * 10, 1, ',');

        // kontribusi pengurus bulan ini
        $definisi = Definisi::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->whereHas('user', function ($query) {
                $query->where('role', 'pengurus');
            })
            ->count();
        $laporan = Report::whereNotNull('status') //
            ->whereMonth('status', now()->month)
            ->whereYear('status', now()->year)
            ->count();
        $blog = Blog::whereNotNull('status') //
            ->whereMonth('status', now()->month)
            ->whereYear('status', now()->year)
            ->count();
        // kurang banner
        $overview['kontribusiBlnIni'] = $definisi + $laporan + $blog;

        // kontributsi pengurus bulan lalu
        // menentukan tahun (mencegah error saat di bulan januari)
        if (now()->month == '01') {
            $tahun = now()->subYear()->year;
        } else {
            $tahun = now()->year;
        }
        $definisi = Definisi::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $tahun)
            ->whereHas('user', function ($query) {
                $query->where('role', 'pengurus');
            })
            ->count();
        $laporan = Report::whereNotNull('status')
            ->whereMonth('status', now()->subMonth()->month)
            ->whereYear('status', $tahun)
            ->count();
        $blog = Blog::whereNotNull('status')
            ->whereMonth('status', now()->subMonth()->month)
            ->whereYear('status', $tahun)
            ->count();
        // kurang banner
        $overview['kontribusiBlnKmrn'] = $definisi + $laporan + $blog;
        // dd($kosakata);
        return $overview;
    }

    // dapatkan data pengurus
    #[Computed]
    public function pengurus()
    {
        $pengurus = User::where('role', 'pengurus')
            ->orderBy('poin', 'desc')
            ->paginate(20, '*', 'pengurus')
            ->appends(request()->query());

        foreach ($pengurus as $d) {
            // level
            $d->level = levelCalculator($d->poin);
            // kontribusi total
            $definisi = Definisi::where('user_id', '=', $d->id)->count();
            $laporan = Report::where('pengurus_id', '=', $d->id)->count();
            $blog = Blog::whereNotNull('status')->where('user_id', '=', $d->id)->count();
            $d->kontribusiTotal = $definisi + $laporan + $blog;
            // kontribusi bulan ini
            $definisi = Definisi::where('user_id', '=', $d->id)->whereMonth('created_at', '=', now()->month)->count();
            $laporan = Report::where('pengurus_id', '=', $d->id)->whereMonth('created_at', '=', now()->month)->count();
            $blog = Blog::whereNotNull('status')->where('user_id', '=', $d->id)->whereMonth('status', '=', now()->month)->count();
            $d->kontribusiBlnIni = $definisi + $laporan + $blog;
        }
        return $pengurus;
    }

    // pengurus yang menhapus akunnya
    #[Computed]
    public function deletedAccount()
    {
        // data pengurus yang telah menghapus akunnya
        return HapusAkun::with([
            'user' => function ($query) {
                $query->withTrashed();
            },
        ])
            ->whereHas('user', function ($query) {
                $query->withTrashed()->where('role', 'pengurus');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10, '*', 'pengurus')
            ->appends(request()->query());
    }

    // dapatkan data definisi terbaru
    #[Computed]
    public function latestDefinitions()
    {
        return Definisi::whereHas('user', function ($query) {
            $query->where('role', 'pengurus');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10, '*', 'definisi')
            ->appends(request()->query());
    }
};
?>

<div class="space-y-5">
    {{-- Overview --}}
    <div class="">
        <div class="mb-3">Overview</div>
        <div class="grid  md:grid-cols-3 grid-cols-2 gap-2 ">
            {{-- Jumlah pengurus aktif --}}
            <x-bento-item title="Jumlah pengurus aktif" value="{{ $this->overview['jmlPengurus'] }}"
                footnote="{{ $this->overview['rasioUser'] }}/10 pengguna adalah pengurus" />

            {{-- Total Kontribusi --}}
            <x-bento-item title="Total kontribusi bulan ini" value="{{ $this->overview['kontribusiBlnIni'] }}"
                footnote="Total kontribusi bulan kemarin adalah {{ $this->overview['kontribusiBlnKmrn'] }}" />
        </div>
    </div>

    <x-alert color="blue" icon="info"
        message="Total kontribusi dihitung dari jumlah definisi, artikel, dan laporan yang disubmit." />

    {{-- Daftar pengurus --}}
    <div class="bg-white rounded-2xl" id="laporan">
        <div class="py-2">
            Daftar pengurus
        </div>

        <div class="space-y-2">
            @foreach ($this->pengurus as $d)
                <x-list-item type="url" url="/u/{{ $d->username }}">
                    <div class="flex flex-wrap items-center gap-1">
                        {{-- foto profil --}}
                        <x-avatar avatarUrl="{{ $d->profile_pic }}" />
                        <div class="">{{ $d->nama }}</div>
                        <div class="text-neutral-600 text-sm">&#64;{{ $d->username }}</div>
                        <x-badge color="bg-amber-200">Lvl.{{ $d->level }}</x-badge>
                    </div>
                    <div class="flex flex-wrap items-center gap-1">
                        <x-badge>{{ $d->kontribusiBlnIni }} kontribusi bulan ini</x-badge>
                        <x-badge>{{ $d->kontribusiTotal }} kontribusi total</x-badge>
                    </div>
                </x-list-item>
            @endforeach
            @if ($this->pengurus->isEmpty())
                <x-errors.not-found text="Belum ada data" />
            @endif
        </div>

        <div class="mt-3">
            {{ $this->pengurus->links() }}
        </div>
    </div>

    {{-- Daftar definisi terbaru dari pengurus --}}
    <div id="definisi" class="bg-white rounded-2xl" id="definisi">
        <div class="flex items-center justify-between py-2">
            Definisi terbaru dari pengurus
        </div>

        <div class="space-y-2">
            @foreach ($this->latestDefinitions as $d)
                <x-list-item url="/kosakata/{{ $d->kosakata }}?id={{ $d->id }}">
                    <x-slot:leftText>
                        <div class="">Definisi untuk kosakata {{ $d->kosakata }}</div>
                        {{-- verified? --}}
                        @if (isset($d->verifikasi))
                            <div wire:ignore class="" title="Telah diverifikasi">
                                <i data-lucide='badge-check' class="size-4 fill-amber-400"></i>
                            </div>
                        @endif
                        {{-- pengguna --}}
                        <x-badge padding="p-1 pr-2" gap="1">
                            <x-avatar rounded="full" avatarUrl="{{ $d->user->profile_pic }}" size="6" />
                            <div class="">{{ $d->user->nama ?? '[Akun dihapus]' }}</div>
                        </x-badge>
                        {{-- poin diperoleh --}}
                        <x-badge title="Poin diperoleh">
                            <i data-lucide='astroid' class="size-3 fill-black"></i>
                            <div class="">{{ $d->poin_kontributor + $d->poin_verifikasi }} Poin</div>
                        </x-badge>
                    </x-slot:leftText>
                    <x-slot:rightText>
                        <x-badge>{{ dateFormat($d->updated_at) }}</x-badge>
                    </x-slot:rightText>
                </x-list-item>
            @endforeach
            @if ($this->latestDefinitions->isEmpty())
                <x-errors.not-found text="Belum ada data" />
            @endif
        </div>

        <div class="mt-3">
            {{ $this->latestDefinitions->links() }}
        </div>
    </div>

    {{-- Daftar pengurus yang menghapus akunnya --}}
    <div class="bg-white rounded-2xl" id="laporan">
        <div class="py-2">
            Pengurus yang menghapus akunnya
        </div>

        <div class="space-y-3">
            @if ($this->deletedAccount->isEmpty())
                <x-errors.not-found text="Belum ada data" />
            @endif
            @foreach ($this->deletedAccount as $d)
                <x-list-item type="url" url="/u/{{ $d->username }}">
                    <div class="flex flex-wrap items-center gap-1">
                        {{-- foto profil --}}
                        <x-avatar avatarUrl="{{ $d->profile_pic }}" />
                        <div class="">{{ $d->nama }}</div>
                        <div class="text-neutral-600 text-sm">&#64;{{ $d->username }}</div>
                        <x-badge color="bg-amber-200">Lvl.{{ $d->level }}</x-badge>
                    </div>
                    <div class="flex flex-wrap items-center gap-1">
                        <x-badge>{{ dateFormat($d->deleted_at) }}</x-badge>
                    </div>
                </x-list-item>
            @endforeach
        </div>

        <div class="mt-3">
            {{ $this->deletedAccount->links() }}
        </div>
    </div>

    {{-- Artikel --}}
    <div class="bg-white rounded-2xl" id="laporan">
        <div class="py-2">Artikel terbaru</div>

        <div class="space-y-2">
            <div href="/kontribusi/laporan/{{ $d->id }}"
                class="border border-neutral-200 p-3 mt-3 rounded-xl text-center"> Beralih ke halaman <a href="/artikel"
                    class="underline underline-offset-2 decoration-amber-400 decoration-4">Artikel</a>.
            </div>
        </div>
    </div>

    {{-- Laporan --}}
    <div class="bg-white rounded-2xl" id="laporan">
        <div class="py-2">Laporan</div>

        <div class="space-y-2">
            <div href="/kontribusi/laporan/{{ $d->id }}"
                class="border border-neutral-200 p-3 mt-3 rounded-xl text-center"> Beralih ke halaman <a href="/laporan"
                    class="underline underline-offset-2 decoration-amber-400 decoration-4">Laporan</a>.
            </div>
        </div>
    </div>
</div>
