<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\HapusAkun;

new class extends Component {
    #[Title('Ubah kata sandi ')]
    #[Layout('layouts.dashboard')]
    #[Validate('required|min:20')]
    public $alasan;
    #[Validate('required|min:6|max:255')]
    public $password;
    #[Validate('required')]
    public $konfirmasi1;
    #[Validate('required')]
    public $konfirmasi2;

    public function save()
    {
        // validasi
        $this->validate();

        // cek apakah password yang dimasukkan sudah benar
        if (!Hash::check($this->password, auth()->user()->password)) {
            $this->dispatch('notify', type: 'failed', message: 'Gagal menghapus akun: kata sandi salah');
            return;
        }

        // simpan alasan di db
        HapusAkun::create([
            'user_id' => auth()->user()->id,
            'alasan' => $this->alasan,
        ]);

        // kirim email notifikasi ke user
        $url = getUrl();
        Mail::to(auth()->user()->email)->send(new \App\Mail\HapusAkun(auth()->user(), $url));

        // hapus akun
        // User::find(auth()->user()->id)->delete();
        auth()->user()->delete();

        // increment akun dihapus di statistik
        changeStat('akun_dihapus');

        // meng-logout-kan user
        auth()->logout();
        //menghapus semua data session yang ada saat ini, mencegah session fixation attack.
        request()->session()->invalidate();
        //mengganti CSRF token, Cross-Site Request Forgery
        request()->session()->regenerateToken();
        // alihkan ke homepage
        return redirect('/')->with('success', 'Selamat tinggal, akun anda berhasil dihapus');
    }
};
?>

<form wire:submit='save' class="space-y-4">
    @csrf
    {{-- alasan --}}
    <x-input-textarea id="alasan" model="alasan" label="Mengapa kamu ingin menghapus akun anda?" :autofocus="true" />
    {{-- password --}}
    <x-input type="password" model="password" id="password" label="Kata sandi"
        placeholder="Masukkan kata sandi untuk konfirmasi..." />

    {{-- konfirmasi --}}
    <div class="space-y-1">
        <div>
            <input type="checkbox" class="cursor-pointer" wire:model.live='konfirmasi1' name="konfirmasi1"
                id="konfirmasi1">
            <label for="konfirmasi1" class="text-sm cursor-pointer">
                Saya memahami bahwa akun saya akan dihapus secara permanen dan tidak dapat dikembalikan.
            </label>
            @error('konfirmasi1')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input type="checkbox" class="cursor-pointer" wire:model.live='konfirmasi2' name="konfirmasi2"
                id="konfirmasi2">
            <label for="konfirmasi2" class="text-sm cursor-pointer">
                Saya memahami bahwa menghapus akun saya tidak akan menghapus kontribusi saya.
            </label>
            @error('konfirmasi2')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>
    </div>
    {{-- tombol hapus --}}
    <x-button type="submit" target="save" text="Hapus akun" textLoading="Menghapus akun..." icon="trash" />
</form>
