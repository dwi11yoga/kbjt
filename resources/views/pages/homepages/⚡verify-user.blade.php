<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\VerifikasiUser;
use App\Models\User;
use App\Mail\WelcomeMail;

new class extends Component {
    //
    #[TItle('Verifikasi email')]
    #[Layout('layouts.auth')]
    #[Validate('required|size:6')]
    public $kode;

    //
    public function verify()
    {
        // valisasi
        $this->validate();

        // cari datanya di database
        $dataVerifikasi = VerifikasiUser::where('kode', $this->kode)
            ->whereNull('status')
            ->where('kedaluarsa', '>', now()) // belum kedaluarsa (yang tanggal kedaluarsanya lebih besar dari hari ini)
            ->first();

        // kembalikan jika data tidak ditemukan/kedaluarsa
        if (empty($dataVerifikasi)) {
            $this->dispatch('notify', type: 'failed', message: 'Kode verifikasi tidak dikanali atau telah kedaluarsa');
            return;
        }

        // tambah waktu verifikasi pada data user
        $user = User::find($dataVerifikasi->user_id);
        $user->update([
            'email_verified_at' => now(),
        ]);

        // update data verifikasi jadi sudah dipakai
        $dataVerifikasi->update([
            'status' => now(),
        ]);

        // increment nilai user baru pada tabel statistik
        changeStat('user_baru');

        // buat notifikasi
        $pesan = 'Sugeng rawuh! Selamat datang di komunitas pelestari bahasa Jawa. 
        Baca dokumentasi berikut sebagai langkah awal dalam melestarikan bahasa jawa.';
        $url = '/cari?keyword=dokumentasi%3A&filter=artikel';
        createNotification($user->id, 'user', $pesan, $url);

        // kirim email selamat datang
        $url = getUrl();
        Mail::to($user->email)->send(new WelcomeMail($user, $url));

        // redirect ke view login
        return redirect('/masuk')->with('success', 'Akun berhasil terdaftar, silahkan login');
    }
};
?>

<div class="space-y-5 w-96">
    {{-- Judul --}}
    <div class="space-y-2">
        <h1 class="">Verifikasi email</h1>
        <p class="">Silakan cek kotak masuk email kamu dan masukkan kode verifikasi yang telah kami kirimkan.</p>
    </div>
    <form wire:submit='verify' class="space-y-3">
        @csrf
        {{-- kode --}}
        <x-input type="text" model="kode" id="kode" label="Kode" maxLength="6" customStyle="uppercase" />
        <x-button type="submit" rounded="full" text="Verifikasi" width="w-full" target="verify"
            textLoading="Memverifikasi..." />
    </form>
    <div class="text-center">
        <a href="/masuk"
            class="text-sm hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4">
            <i data-lucide='arrow-left' class="w-3.5 inline-block"></i> Kembali ke halaman login
        </a>
    </div>
</div>
