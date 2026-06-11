<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\User;

new class extends Component {
    #[Title('Ubah username')]
    #[Layout('layouts.dashboard')]
    #[Validate('required|min:6|max:255|lowercase|unique:users,username|regex:/^[A-Za-z0-9_.]+$/')]
    public $username;
    #[Validate('required|min:6|max:255')]
    public $password;
    // dapatkan data pengguna
    public function mount()
    {
        $this->username = auth()->user()->username;
    }

    // simpan perubahan
    public function save()
    {
        // validasi
        $this->validate();

        // SIMPAN PERUBAHAN USERNAME
        // authentikasi: cek apakah password yang dimasukkan sudah sama dengan password user
        if (!Hash::check($this->password, Auth::user()->password)) {
            //jika tidak sama...
            $this->dispatch('notify', type: 'failed', message: 'Gagal menyimpan perubahan: kata sandi anda salah');
            return;
        }

        // jika password yang diinput benar, simpan di db
        User::find(auth()->user()->id)->update(['username' => $this->username]);

        // buat notifikasi
        createNotification(auth()->user()->id, 'acount', 'Username akun berhasil diubah menjadi "' . $this->username . '"', '/pengaturan/ubah-username');

        // kirim notifikasi via email
        // $url = $this->getUrl(); // url website
        // Mail::to(Auth::user()->email)
        //     ->send(new UsernameBerubah(Auth::user(), $validatedData['username'], $url));

        // kembalikan ke view
        $this->dispatch('notify', type: 'success', message: 'Berhasil menyimpan perubahan');
        return;
        // return back()->with('success', 'Berhasil menyimpan perubahan');
    }
};
?>

<form wire:submit='save' class="space-y-4">
    @csrf
    <x-input model="username" id="username" label="Username" placeholder="Username baru..." :autofocus="true" />
    <x-input type="password" model="password" id="password" label="Kata sandi" placeholder="Masukkan kata sandi untuk konfirmasi..." />
    <x-button type="submit" target="save" text="Simpan" textLoading="Menyimpan..." icon="save" />
</form>
