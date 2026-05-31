<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\ResetPassword;
use App\Mail\ResetPassword as ResetPasswordMail;

new class extends Component {
    // #[Validate('required')]
    #[Title('Reset kata sandi')]
    #[Layout('layouts.auth')]
    public $user;

    // jalankan untuk memvalidasi form
    public function validation()
    {
        // Cek apakah username/email yang diinput user
        $fieldType = filter_var($this->user, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        // validasi
        $rule = $fieldType == 'email' ? ['user' => 'required|email:rfc,strict'] : ['user' => 'required|min:6|max:255|regex:/^[A-Za-z0-9_.@-]+$/'];
        $this->validate($rule);
    }

    public function updatedUser()
    {
        $this->validation();
    }

    // kirim reset kode
    public function sendCode()
    {
        // Cek apakah username/email yang diinput user
        $fieldType = filter_var($this->user, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        // validasi
        $this->validation();

        // cek apakah user ditemukan di db
        $user = User::where($fieldType, $this->user)->first();
        if (empty($user)) {
            // jika user tidak ditemukan
            $this->dispatch('notify', message: 'Akun tidak ditemukan', type: 'failed');
            return;
        }

        // generate kode random untuk dikirim ke user
        $kode = Str::upper(Str::random(6));

        // SIMPAN KODE DI DB
        // jika user mengenerate ulang kode (kode sebelumnya belum kedaluarsa agar lebih efisien)
        $cek = ResetPassword::where('user_id', $user->id)
            ->whereNull('status')
            ->where('kedaluarsa', '>', now()) // yang belum kedaluarsa
            ->first();
        if (empty($cek)) {
            // jika $cek kosong, maka buat data baru
            ResetPassword::create([
                'user_id' => $user->id,
                'kode' => $kode,
                'kedaluarsa' => now()->addMinutes(5),
            ]);
        } else {
            // jika $cek ada datanya, maka update waktu kedaluarsa
            $cek->update([
                'kode' => $kode,
                'kedaluarsa' => now()->addMinutes(5),
            ]);
        }

        // kirim email dengan kode verifikasi ke user
        $url = getUrl();
        Mail::to($user->email)->send(new ResetPasswordMail($user, $kode, $url));

        // redirect ke view
        return redirect()->to('/reset-kata-sandi/autentikasi')->with('success', 'Kode reset kata sandi berhasil dikirim.');
    }
    //
};
?>

<div class="space-y-5 w-96">
    {{-- judul --}}
    <div class="mb-7">
        <h3 class="font-bold">Reset kata sandi</h3>
        <p>Silakan masukkan username atau email terdaftar. Kami akan kirimkan kode untuk mengatur ulang kata sandi.</p>
    </div>
    {{-- form --}}
    <form wire:submit='sendCode' class="space-y-2">
        @csrf
        <x-input type="text" id="user" model="user" :autofocus="true" label="Username/Email" />
        <x-button type="submit" text="Reset kata sandi" width="w-full" rounded="full" target="sendCode" />
    </form>
    <div class="text-center">
        <a href="/masuk"
            class="text-sm hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4">
            <i data-lucide='arrow-left' class="w-3.5 inline-block"></i> Kembali ke halaman login
        </a>
    </div>
</div>
