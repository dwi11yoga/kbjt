<?php

use Livewire\Component;
use App\Models\Level;

new class extends Component {
    // data dari parent
    public $id, $level, $user_count, $persentase, $min_poin;

    // var untuk simpan status buka popup
    public $openEdit = false;

    // var untuk diedit
    public $editLevel, $editMinPoint;
    public function mount()
    {
        $this->editLevel = $this->level;
        $this->editMinPoint = $this->min_poin;
    }

    // validasi
    public function rules()
    {
        return [
            'editLevel' => 'required|integer|min:1|exists:levels,lvl|unique:levels,lvl,' . $this->level . ',lvl', //
            'editMinPoint' => 'required|integer',
        ];
    }
    public function updated($field)
    {
        $this->validateOnly($field);
    }

    // fungsi simpan edit level
    public function update()
    {
        // validasi data
        $this->validate();
        // cek min_level apakah lebih kecil dari level dibawahnya atau lebih besar daripada level diatasnya
        $poinSebelumnya = Level::where('lvl', $this->editLevel - 1)->first();
        $poinSetelahnya = Level::where('lvl', $this->editLevel + 1)->first();
        if (!empty($poinSebelumnya) && $this->editMinPoint <= $poinSebelumnya->min_poin) {
            $this->dispatch('notify', type: 'failed', message: 'Gagal menyimpan perubahan');
            $this->addError('editMinPoint', 'min poin should be bigger than the previous level');
            return;
        } elseif (!empty($poinSetelahnya) && $this->editMinPoint >= $poinSetelahnya->min_poin) {
            $this->dispatch('notify', type: 'failed', message: 'Gagal menyimpan perubahan');
            $this->addError('editMinPoint', 'min poin should be smaller than the next level');
            return;
        }

        // simpan
        Level::find($this->id)->update([
            'lvl' => $this->editLevel,
            'min_poin' => $this->editMinPoint,
        ]);

        // ubah tampilan
        $this->level = $this->editLevel;
        $this->min_poin = $this->editMinPoint;

        // kirim toast
        $this->dispatch('notify', type: 'success', message: 'Level berhasil diedit');
        $this->openEdit = false;
        return;
    }
};
?>

<div>
    <x-list-item type="div">
        <x-slot:leftText>
            <div wire:click='$toggle("openEdit")' class="cursor-pointer w-full h-full">Level {{ $level }}</div>
        </x-slot:leftText>
        <x-slot:rightText>
           <div class="flex gap-1">
             <x-badge gap="1" title="Jumlah pengguna">
                <i data-lucide='users-round' class="size-4"></i>
                <div class="">{{ numberFormat($user_count) }}</div>
            </x-badge>
            <x-badge gap="1" title="Persentase pengguna">
                <i data-lucide='badge-percent' class="size-4"></i>
                <div class="">{{ $persentase }}</div>
            </x-badge>
            <x-badge gap="1" title="Persyaratan poin">
                <i data-lucide='astroid' class="size-4 fill-black dark:fill-white"></i>
                <div class="">
                    < {{ numberFormat($min_poin) }} poin</div>
            </x-badge>
           </div>
        </x-slot:rightText>
    </x-list-item>
    
    {{-- popup edit --}}
    @if ($openEdit)
        <x-popup title="Edit level" color="green">
            <form wire:submit='update' class="space-y-3">
                <x-input type="number" model="editLevel" id="level" label="Level" />
                <x-input type="number" model="editMinPoint" id="min_poin" label="Poin minimal" />
                <x-popup-action target="update" closeAction="$toggle('openEdit')" />
            </form>
        </x-popup>
    @endif
</div>
