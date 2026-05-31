<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\ResetPassword;
use App\Models\User;
use App\Mail\ResetPasswordBerhasil;

new class extends Component {
    #[Title('Reset kata sandi')]
    #[Layout('layouts.auth')]
    #[Validate('required|size:6')]
    public $kode;
    #[Validate('required|min:6')]
    public $password1;
    #[Validate('required|min:6|same:password1')]
    public $password2;

    // fungsi reset password
    public function resetPassword()
    {
        // validasi
        $this->validate();

        // cari data reset password
        $data = ResetPassword::where('kode', $this->kode)
            ->where('kedaluarsa', '>', now()) // belum kedaluarsa (yang tanggal kedaluarsanya lebih besar dari hari ini)
            ->first();

        // jika tidak ada data, maka kembalikan
        if (empty($data)) {
            $this->dispatch('notify', message: 'Permintaan reset tidak ditemukan atau kedaluarsa', type: 'failed');
            return;
        }

        // ganti kata sandi akun
        $user = User::find($data->user_id);
        $user->update([
            'password' => $this->password1, // tidak perlu di hash karena sudah diatur hash di model
        ]);

        // update status reset kata sandi
        $data->update([
            'status' => now(),
        ]);

        // buat notifikasi
        $pesan = 'Kata sandi akun kamu berhasil direset';
        createNotification($user->id, 'akun', $pesan, '#');

        // kirim email
        $url = getUrl();
        Mail::to($user->email)->send(new ResetPasswordBerhasil($user, $url));

        // kembalikan ke halaman login
        return redirect()->to('/masuk')->with('success', 'Kata sandi berhasil direset');
    }
};
?>

<div class="space-y-5 w-96">
    {{-- judul --}}
    <div class="mb-7">
        <h3 class="font-bold">Reset kata sandi</h3>
        <p>
            Masukkan kode yang telah kami kirim ke email anda untuk melanjutkan proses reset kata sandi. Pastikan
            kode yang dimasukkan sesuai dan belum kedaluarsa.
        </p>
    </div>
    <form wire:submit='resetPassword' class="space-y-2">
        @csrf
        <x-input type="text" id="kode" model="kode" label="Kode" :autofocus="true" />
        <x-input type="password" id="password1" model="password1" label="Kata sandi baru" />
        <x-input type="password" id="password2" model="password2" label="Ulangi kata sandi baru" />
        <x-button type="submit" text="Reset kata sandi" textLoading="Menyimpan kata sandi baru..."
            target="resetPassword" rounded="full" width="w-full" />
    </form>
    <div class="text-center">
        <a href="/masuk"
            class="text-sm hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4">
            <i data-lucide='arrow-left' class="w-3.5 inline-block"></i> Kembali ke halaman login
        </a>
    </div>
</div>
