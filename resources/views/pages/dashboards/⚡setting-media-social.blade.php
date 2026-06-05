<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\User;

new class extends Component {
    // data input
    #[Title('Ubah tautan')]
    #[Layout('layouts.dashboard')]
    #[Validate('nullable|url')]
    public $tautan;
    #[Validate('nullable|numeric|digits_between:10,13')]
    public $telp;
    #[Validate('nullable')]
    public $fb;
    #[Validate('nullable')]
    public $x;
    #[Validate('nullable')]
    public $ig;
    #[Validate('nullable')]
    public $tiktok;
    #[Validate('nullable|numeric|digits_between:10,13')]
    public $wa;
    #[Validate('nullable')]
    public $telegram;
    #[Validate('nullable')]
    public $linkedin;
    #[Validate('nullable')]
    public $github;

    // set nilai dari data penggnuna
    public function mount()
    {
        $this->tautan = auth()->user()->tautan;
        $this->telp = auth()->user()->telp;
        $this->fb = auth()->user()->media_sosial['fb'];
        $this->x = auth()->user()->media_sosial['x'];
        $this->ig = auth()->user()->media_sosial['ig'];
        $this->tiktok = auth()->user()->media_sosial['tiktok'];
        $this->wa = auth()->user()->media_sosial['wa'];
        $this->telegram = auth()->user()->media_sosial['telegram'];
        $this->linkedin = auth()->user()->media_sosial['linkedin'];
        $this->github = auth()->user()->media_sosial['github'];
    }

    // simpan tautan pengguna
    public function save()
    {
        // validasi
        $this->validate();
        // simpan data
        $data = [
            'tautan' => $this->tautan,
            'telp' => $this->telp,
            'media_sosial' => [
                'fb' => $this->fb,
                'x' => $this->x,
                'ig' => $this->ig,
                'tiktok' => $this->tiktok,
                'wa' => $this->wa,
                'telegram' => $this->telegram,
                'linkedin' => $this->linkedin,
                'github' => $this->github,
            ],
        ];
        User::find(Auth::user()->id)->update($data);

        // kembali ke view
        $this->dispatch('notify', type: 'success', message: 'Informasi user berhasil diperbarui');
        return;
    }
};
?>

<form wire:submit='save' class="space-y-2">
    @csrf
    {{-- tautan --}}
    <x-input model="tautan" id="tautan" label="Tautan" placeholder="https:://tautankamu.com" />
    {{-- telp --}}
    <x-input model="telp" id="telp" label="Nomor telepon" placeholder="nomor telepon" />
    {{-- Facebook --}}
    <x-input model="fb" id="fb" label="Facebook" placeholder="usuername" />
    {{-- Twitter --}}
    <x-input model="x" id="x" label="Twitter" placeholder="usuername" />
    {{-- Instagram --}}
    <x-input model="ig" id="ig" label="Instagram" placeholder="usuername" />
    {{-- Tiktok --}}
    <x-input model="tiktok" id="tiktok" label="Tiktok" placeholder="usuername" />
    {{-- Whatsapp --}}
    <x-input model="wa" id="wa" label="Whatsapp" placeholder="nomor telepon" />
    {{-- Telegram --}}
    <x-input model="telegram" id="telegram" label="Telegram" placeholder="usuername" />
    {{-- LinkedIn --}}
    <x-input model="linkedin" id="linkedin" label="LinkedIn" placeholder="usuername" />
    {{-- Github --}}
    <x-input model="github" id="github" label="Github" placeholder="usuername" />

    {{-- simpan --}}
    <x-button type="submit" target="save" text="Simpan" textLoading="Menyimpan..." icon="save" />
</form>
