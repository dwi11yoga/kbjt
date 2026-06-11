<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Url;
use App\Models\Level;
use App\Models\User;
use App\Models\PoinKontribusi;

new class extends Component {
    // tab
    #[Title('Level & poin')]
    #[Layout('layouts.dashboard')]
    #[Url]
    public $tab = 'level';
    // status popup
    public $openAddLevel = false;

    // dapatkan data level
    #[Computed]
    public function levels()
    {
        // Level
        $level = Level::select('*')->orderBy('lvl', 'desc')->get();
        $user = User::select('id', 'poin')->get();
        $jml_user = $user->count();

        foreach ($level as $d) {
            // Hitung banyaknya user dengan level tertentu
            $d->user_count = $user
                ->filter(function ($u) use ($d) {
                    return $u->poin >= $d->min_poin;
                })
                ->count();

            // Hapus user dari $user jika user sudah mendapatkan level
            $user = $user->reject(function ($u) use ($d) {
                return $u->poin >= $d->min_poin;
            });

            // Hitung persentase
            $d->persentase = number_format(($d->user_count / $jml_user) * 100, 1, ',');
        }
        return $level;
    }

    #[Computed]
    public function points()
    {
        $kontribusi = new stdClass();
        $kontribusi->kontributor = PoinKontribusi::where('role', 'kontributor')->get();
        $kontribusi->pengurus = PoinKontribusi::where('role', 'pengurus')->get();
        return $kontribusi;
    }

    // simpan level baru
    #[Validate('required|integer|min:1|unique:levels,lvl')]
    public $level;
    #[Validate('required|integer|min:1')]
    public $min_poin;
    public function create()
    {
        // validasi data
        $this->validate();

        // cek min_level apakah lebih kecil dari level dibawahnya atau lebih besar daripada level diatasnya
        $poinSebelumnya = Level::where('lvl', $this->level - 1)->first();
        $poinSetelahnya = Level::where('lvl', $this->level + 1)->first();
        if (isset($poinSebelumnya->min_poin) && $this->min_poin <= $poinSebelumnya->min_poin) {
            $this->dispatch('notify', type: 'failed', message: 'Gagal menyimpan perubahan');
            $this->addError('min_poin', 'min poin should be bigger than the previous level');
            return;
        } elseif (isset($poinSetelahnya) && $this->min_poin >= $poinSetelahnya->min_poin) {
            $this->dispatch('notify', type: 'failed', message: 'Gagal menyimpan perubahan');
            $this->addError('min_poin', 'min poin should be smaller than the next level');
            return;
        }

        // simpan level
        Level::create([
            'lvl' => $this->level,
            'min_poin' => $this->min_poin,
        ]);

        // set data tambah menjadi null
        $this->level = $this->min_poin = null;

        // tutup popup
        $this->openAddLevel = false;
        $this->dispatch('notify', type: 'success', message: 'Level berhasil ditambahkan');
        return;
    }
};
?>

<div id="levelContent" class="space-y-3">
    {{-- filter --}}
    <div class="flex justify-between">
        <div class="flex gap-1">
            <x-input-radio model="tab" id="level" icon="trophy" value="level" text="Level" />
            <x-input-radio model="tab" id="poin-kontributor" icon="astroid" value="poin-kontributor"
                text="Poin kontributor" />
            <x-input-radio model="tab" id="poin-pengurus" icon="astroid" value="poin-pengurus"
                text="Poin pengurus" />
        </div>
        @if ($tab == 'level')
            <div wire:click='$toggle("openAddLevel")'>
                <x-button type="button" text="Tambah" icon="plus" />
            </div>
        @endif
    </div>
    <div class="space-y-2">
        {{-- Level --}}
        @if ($tab == 'level')
            @foreach ($this->levels as $d)
                <livewire:level-item wire:key='level{{ $d->lvl }}' :id="$d->id" :level="$d->lvl"
                    :min_poin="$d->min_poin" :persentase="$d->persentase" :user_count="$d->user_count" />
            @endforeach
        @endif
        {{-- Poin kontribusi --}}
        {{-- reward kontributor --}}
        @if ($tab == 'poin-kontributor')
            @foreach ($this->points->kontributor as $d)
                <livewire:point-item wire:key='poin-kontributor{{ $d->id }}' :id="$d->id" :kontribusi="$d->kontribusi" :deskripsi="$d->deskripsi"
                    :poin="$d->poin" />
            @endforeach
        @endif
        @if ($tab == 'poin-pengurus')
            @foreach ($this->points->pengurus as $d)
                <livewire:point-item wire:key='poin-pengurus{{ $d->id }}' :id="$d->id" :kontribusi="$d->kontribusi"
                    :deskripsi="$d->deskripsi" :poin="$d->poin" />
            @endforeach
        @endif
    </div>

    {{-- popup --}}
    @if ($openAddLevel)
        <x-popup title="Tambah level" color="green">
            <form wire:submit='create' class="space-y-3">
                <x-input type="number" model="level" id="level" label="Level" :autofocus="true" />
                <x-input type="number" model="min_poin" id="min_poin" label="Poin minimal" />
                <x-popup-action target="create" closeAction="$toggle('openAddLevel')" />
            </form>
        </x-popup>
    @endif
</div>
