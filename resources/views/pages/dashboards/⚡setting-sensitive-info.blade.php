<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\User;

new class extends Component {
    #[Title('Sembunyikan data sensitif')]
    #[Layout('layouts.dashboard')]
    public $email;
    public $telp;

    public function mount(){
        $hiddenData=auth()->user()->sembunyikan_data;
        $this->email = is_null($hiddenData) ||  (!empty($hiddenData) && $hiddenData['email']==true) ? 1:0;
        $this->telp = is_null($hiddenData) ||  (!empty($hiddenData) && $hiddenData['telp']==true) ? 1:0;
    }

    // simpan perubahan
    public function save()
    {
        $data = [
            'email'=>!empty($this->email) ? true:false,
            'telp'=>!empty($this->telp) ? true:false,
        ];

        // simpan
        User::find(auth()->user()->id)->update(['sembunyikan_data' => $data]);

        // kembalikan
        // kembali ke view
        $this->dispatch('notify', type: 'success', message: 'Preferensi berhasil disimpan');
        return;
    }
};
?>

<form wire:submit='save' class="space-y-2">
    @csrf
    {{-- email --}}
    <x-input-toggle id="email" model="email" label="Sembunyikan email" footnote="Alamat email akan disembunyikan dari halaman profil kamu."/>
    {{-- telp --}}
    <x-input-toggle id="telp" model="telp" label="Sembunyikan nomor telepon" footnote="Nomor telepon akan disembunyikan dari halaman profil kamu."/>

    {{-- simpan --}}
    <x-button type="submit" target="save" text="Simpan" textLoading="Menyimpan..." icon="save" />

</form>
