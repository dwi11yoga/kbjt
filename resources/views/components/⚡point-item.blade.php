<?php

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\PoinKontribusi;

new class extends Component {
    // dapatkan data dari parent
    public $id, $kontribusi, $deskripsi, $poin;

    // var status popup edit
    public $openEditKontribusi = false;

    // edit
    #[Validate('nullable')]
    public $editKontribusi;
    #[Validate('nullable')]
    public $editDeskripsi;
    #[Validate('required|integer|min:1')]
    public $editPoin;

    // set nilai edit
    public function mount()
    {
        $this->editKontribusi = $this->kontribusi;
        $this->editDeskripsi = $this->deskripsi;
        $this->editPoin = $this->poin;
    }

    public function update()
    {
        // validasi data
        $this->validate();

        // simpan
        PoinKontribusi::find($this->id)->update([
            'poin' => $this->editPoin,
        ]);

        // ubah tampilan
        $this->poin = $this->editPoin;

        // kirim toast
        $this->dispatch('notify', type: 'success', message: 'Poin kontribusi berhasil diedit');
        $this->openEditKontribusi = false;
        return;
    }
};
?>

<div class="">
    <x-list-item type="div">
        <x-slot:leftText>
            <div class="cursor-pointer w-full h-full" wire:click='$toggle("openEditKontribusi")'>
                <div class="">{{ $kontribusi }}</div>
                <div class="text-sm text-neutral-600">{{ $deskripsi }}</div>
            </div>
        </x-slot:leftText>
        <x-slot:rightText>
            <x-badge gap="1" title="Jumlah pengguna">
                <i data-lucide='astroid' class="size-4 fill-black dark:fill-white"></i>
                <div class="">{{ $poin }}</div>
            </x-badge>
        </x-slot:rightText>
    </x-list-item>
    {{-- popup edit --}}
    @if ($openEditKontribusi)
        <x-popup title="Edit poin kontribusi" color="green">
            <form wire:submit='update' class="space-y-3">
                <x-input label="Kontribusi" id="editKontribusi" model="editKontribusi" :disabled="true" />
                <x-input-textarea label="Deskripsi" id="editDeskripsi" model="editDeskripsi" :disabled="true"/>
                <x-input type="number" label="Poin hadiah" id="editPoin" model="editPoin" />
                <x-popup-action target="update" closeAction="$toggle('openEditKontribusi')" />
            </form>
        </x-popup>
    @endif
</div>
