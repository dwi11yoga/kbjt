<?php

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Achievement;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    // dapatkan data overview
    #[Title('Pencapaian')]
    #[Layout('layouts.dashboard')]
    #[Computed]
    public function overview()
    {
        if (auth()->user()->role == '') {
            return;
        }

        // achievement yang sudah didapatkan pengguna
        $achieved = auth()->user()->achievement;

        // dapatkan data total achievement
        if (auth()->user()->role == 'kontributor') {
            $totalAchievement = Achievement::whereNot('role', 'pengurus')->orWhereNull('role')->count();
        } else {
            $totalAchievement = Achievement::count();
        }

        $overview = [
            'achievement' => count(is_array($achieved) ? $achieved : []),
            'total' => $totalAchievement,
        ];
        $overview['persentase'] = percentage($overview['achievement'], $overview['total']);

        return $overview;
    }

    // dapatkan data achievement
    #[Computed]
    public function achievements()
    {
        // achievement yang sudah didapatkan pengguna
        $achieved = auth()->user()->achievement;

        // dapatkan data achievement
        $achievement = Achievement::select('*');

        // jika user bukan kepala, tampilkan achievement yang berhak role dapatkan (null berarti semua pengguna berhak)
        if (auth()->user()->role != 'kepala') {
            $achievement = $achievement->where('role', auth()->user()->role)->orWhereNull('role');
        }

        // tampilkan achievement yang sudah didapat lebih dulu
        if (isset($achieved)) {
            $achievement = $achievement->orderByRaw('FIELD(id,' . implode(',', array_keys($achieved)) . ') DESC');
        }

        $achievement = $achievement //
            ->orderBy('rule', 'asc')
            ->orderBy('requirement', 'asc')
            ->paginate(20);

        // CEK PROGRESS ACHIEVEMENT
        // rule yang akan dicek achievementnya
        $rule = ['keanggotaan', 'definisi', 'laporan', 'totalViewKosakata', 'viewKosakata'];
        if (auth()->user()->role == 'pengurus') {
            // tambahan rule khusus untuk pengurus
            $rule = array_merge($rule, ['artikel', 'totalViewBlog', 'viewBlog']);
        }
        //lakukan perulangan untuk cek achievement user
        foreach ($rule as $d) {
            $contributionPoint[$d] = achievement(auth()->user()->id, $d);
        }

        // tambah data progress ke achievement
        foreach ($achievement as $d) {
            if (in_array($d->id, array_keys(is_array($achieved) ? $achieved : []))) {
                // jika achievement sudah didapat
                $d->achieved = 1;
                $d->date_achieved = $achieved[$d->id];
                $d->progress = '100%';
            } else {
                //hitung progress dari achievement sekaligus tambahkan achivement ke pengguna jika sudah memenuhi req.
                $d->progress = percentage($contributionPoint[$d->rule] ?? 0, $d->requirement > 0 ? $d->requirement : 1, 100);
                // jika progress ternyata sudah 100%, tambahkan atribut ini
                if ($d->progress == '100%') {
                    $d->achieved = 1;
                    $d->date_achieved = now();
                }
            }
        }

        return $achievement;
    }
};
?>

<div class="space-y-5">
    {{-- Overview --}}
    @if (auth()->user()->role != 'kepala')
        <div class="space-y-2">
            <div class="">Overview</div>
            <div class="grid md:grid-cols-3 grid-cols-1 gap-2">
                {{-- total achievement --}}
                <x-bento-item title="Pencapaian diperolah"
                    footnote="{{ $this->overview['persentase'] }} penghargaan telah kamu dapatkan">
                    <x-slot:value>
                        <div class="flex items-end">
                            <h1 class="">{{ $this->overview['achievement'] }}</h1>
                            <div class="text-base font-normal">/{{ $this->overview['total'] }}</div>
                        </div>
                    </x-slot:value>
                </x-bento-item>
            </div>
        </div>
    @endif

    {{-- daftar achievement --}}
    <div class="space-y-2">
        @if (auth()->user()->role != 'kepala')
            <div class="flex items-center">Daftar achievement</div>
        @else
            {{-- menu --}}
            <x-button type="button" text="Tambah" icon="plus" url="/achievement/baru" />
        @endif

        {{-- daftar achievement --}}
        <div class="space-y-2">
            @foreach ($this->achievements as $d)
                <x-list-item type="{{ auth()->user()->role == 'kepala' ? 'url' : 'div' }}"
                    url="{{ auth()->user()->role == 'kepala' ? '/achievement/' . $d->id . '/edit' : null }}">
                    <x-slot:leftText>
                        <div class="flex gap-2 w-full">
                            {{-- gambar --}}
                            <div class="w-24 flex items-center justify-center rounded-md overflow-hidden">
                                <img src="{{ asset(isset($d->emblem) ? 'storage/' . $d->emblem : 'storage/d/no-icon') }}"
                                    class="w-full @if ($d->achieved != 1 && auth()->user()->role != 'kepala') grayscale @endif" alt="Icon">
                            </div>
                            {{-- detail --}}
                            <div class="flex flex-col justify-center gap-2 w-full">
                                <div class="">
                                    <div class="capitalize font-medium">{{ $d->nama }}</div>
                                    <div class="text-sm line-clamp-2">{{ $d->deskripsi }}</div>

                                    <div class="text-sm flex items-center space-x-1">
                                        <i data-lucide='astroid' class="size-4 fill-amber-400 inline"></i>
                                        <div>{{ $d->reward }}</div>
                                        @if (auth()->user()->role != 'kepala')
                                            <div>• {{ $d->progress }}</div>
                                            <div class="text-sm md:block hidden">
                                                {{ !empty($d->date_achieved) ? '— Diperoleh ' . dateFormat($d->date_achieved) : '' }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{-- progress --}}
                                @if (auth()->user()->role != 'kepala')
                                    <div class="relative">
                                        <div class="absolute w-full bg-neutral-200 rounded-full py-1 "></div>
                                        <div class="absolute bg-amber-400 rounded-full py-1"
                                            style="width: {{ $d->progress }}">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </x-slot:leftText>
                </x-list-item>
            @endforeach
        </div>

        <div class="">
            {{ $this->achievements->links() }}
        </div>
    </div>
</div>
