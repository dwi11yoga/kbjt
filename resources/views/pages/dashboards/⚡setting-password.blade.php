<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\User;
use App\Mail\KataSandiBerubah;

new class extends Component {
    #[Title('Ubah kata sandi ')]
    #[Layout('layouts.dashboard')]
    public $show; // status tampilan kata sandi
    #[Validate('required|min:6|max:255')]
    public $newPassword;
    #[Validate('required|min:6|max:255|same:newPassword')]
    public $newPassword2;
    #[Validate('required|min:6|max:255')]
    public $password; // password lama

    public function save()
    {
        // dd($request);
        // Validasi
        $this->validate();

        // Cek apakah password lama benar
        if (!Hash::check($this->password, auth()->user()->password)) {
            $this->dispatch('notify', type: 'failed', message: 'Gagal mengubah kata sandi: kata sandi lama salah');
            return;
        }

        // simpan ke db
        $user = User::find(auth()->user()->id);
        $user->update(['password' => $this->newPassword2]);

        // kirim notifikasi lewat email
        $url = getUrl();
        Mail::to($user->email)->send(new KataSandiBerubah($user, $url));

        // kembali ke view
        $this->password = $this->newPassword = $this->newPassword2 = null;
        $this->dispatch('notify', type: 'success', message: 'Kata sandi berhasil diubah');
        return;
    }
};
?>

<form wire:submit='save' class="space-y-4">
    @csrf
    <x-input-toggle label="Tampilkan" model="show" id="show" />
    <x-input type="{{ $show ? 'text' : 'password' }}" model="newPassword" id="newPassword" label="Kata sandi baru"
        :autofocus="true" />
    <x-input type="{{ $show ? 'text' : 'password' }}" model="newPassword2" id="newPassword2"
        label="Ulangi Kata sandi baru" />
    <x-input type="password" model="password" id="password" label="Kata sandi lama"
        placeholder="Masukkan kata sandi untuk konfirmasi..." />
    <x-button type="submit" target="save" text="Simpan" textLoading="Menyimpan..." icon="save" />
</form>
