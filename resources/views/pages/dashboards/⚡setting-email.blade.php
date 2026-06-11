<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use App\Models\User;
use App\Mail\EmailBerubah;

new class extends Component {
    #[Title('Ubah email ')]
    #[Layout('layouts.dashboard')]
    #[Validate('required|email:rfc,strict|unique:users,email')]
    public $email;
    #[Validate('required|min:6|max:255')]
    public $password;
    // dapatkan data email pengguna
    public function mount()
    {
        $this->email = auth()->user()->email;
    }

    public function save()
    {   
        // validasi
        $this->validate();

        // authentikasi: cek apakah password yang dimasukkan sudah sama dengan password user
        if (!Hash::check($this->password, auth()->user()->password)) {
            //jika tidak sama...
            $this->dispatch('notify', type: 'failed', message: 'Gagal menyimpan perubahan: kata sandi salah');
            return;
        }

        // buat notifikasi
        createNotification(auth()->user()->id, 'acount', 'Email akun berhasil diubah menjadi "' . $this->email . '"', '/pengaturan/ubah-email');

        // simpan di db
        User::find(auth()->user()->id)->update(['email' => $this->email]);

        // kirim notifikasi ke email lama
        $url = getUrl();
        Mail::to(auth()->user()->email)->send(new EmailBerubah(auth()->user(), $this->email, $url));

        // kembalikan ke view
        $this->dispatch('notify', type: 'success', message: 'Berhasil menyimpan perubahan');
        return;
    }
};
?>

<form wire:submit='save' class="space-y-4">
    @csrf
    <x-input type="email" model="email" id="email" label="Email" placeholder="Email baru..." :autofocus="true" />
    <x-input type="password" model="password" id="password" label="Kata sandi"
        placeholder="Masukkan kata sandi untuk konfirmasi..." />
    <x-button type="submit" target="save" text="Simpan" textLoading="Menyimpan..." icon="save" />
</form>
