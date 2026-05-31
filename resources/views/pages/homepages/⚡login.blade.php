<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VerifikasiUser;
use Carbon\Carbon;
use App\Mail\VerifikasiUserMail;

new class extends Component {
    #[Layout('layouts.auth')]
    #[Title('Masuk')]
    public $remember;
    #[Validate('required|min:6|max:255|regex:/^[A-Za-z0-9_.@-]+$/')]
    public $credential = 'muklis';
    #[Validate('required|min:6|max:255')]
    public $password = 'passaword';

    // fungsi login
    public function authenticate(Request $request)
    {
        // validasi
        $credentials = $this->validate();

        // Cek remember me
        $remember = $request->has('remember'); //hasil=true/false

        // Cek apakah username/email yang digunakan
        $fieldType = filter_var($credentials['credential'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // cek apakah user dihapus (soft delete). jika iya, maka alihkan ke halaman diblokir
        $cekAkun = User::withTrashed()->where($fieldType, $credentials['credential'])->first();

        // jika user terblokir
        if (isset($cekAkun) && $cekAkun->trashed() && Hash::check($credentials['password'], $cekAkun->password)) {
            return redirect()->to('/akses-gagal');
        }

        // cek apakah user sudah terverifikasi/belum
        if (isset($cekAkun) && empty($cekAkun->email_verified_at) && Hash::check($credentials['password'], $cekAkun->password)) {
            // jika verified email kosong dan password benar..
            $this->verifyUser($cekAkun);
        }

        // Authentikasi
        if (Auth::attempt([$fieldType => $credentials['credential'], 'password' => $credentials['password']], $remember)) {
            $request->session()->regenerate(); //untuk mencegah serangan session fixation

            // cek achievement
            $userId = Auth::user()->id;
            // rule yang akan dicek achievementnya
            $rule = ['keanggotaan', 'definisi', 'laporan'];
            if (Auth::user()->role == 'pengurus') {
                // tambahan rule khusus untuk pengurus
                $rulePengurus = ['artikel', 'totalViewBlog', 'viewBlog'];
                $rule = array_merge($rule, $rulePengurus);
            }
            // jika user login = kepala, maka kosongkan rule achievement yang perlu dicek
            if (Auth::user()->role == 'kepala') {
                $rule = [];
            }

            //lakukan perulangan untuk cek achievement user
            foreach ($rule as $d) {
                achievement($userId, $d);
            }

            // cek sertifikat (untuk notifikasi)
            cekSertifikat($userId);

            return redirect()
                ->intended('/dashboard')
                ->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
        }

        // return back()->with('failed', 'Username, email, atau password salah')->withInput();
        $this->dispatch('notify', message: 'Kredensial yang Anda masukkan tidak valid, Coba lagi.', type: 'failed');
    }

    // verifikasi user (jika belum)
    public function verifyUser($userData)
    {
        // generate kode verifikasi random baru
        $kode = Str::upper(Str::random(6));

        // cek apakah kode verifikasi pernah dikirim
        $cek = VerifikasiUser::where('user_id', $userData->id)->first();
        if (empty($cek)) {
            // jika belum pernah dikirim
            // buat data verifikasi baru
            VerifikasiUser::create([
                'user_id' => $userData->id,
                'kode' => $kode,
                'kedaluarsa' => Carbon::now()->addMinutes(10), // kedaluarsa dalam 10 menit
            ]);
        } else {
            // jika sudah
            // update data verifikasi user
            VerifikasiUser::where('user_id', $userData->id)->update([
                'kode' => $kode,
                'kedaluarsa' => Carbon::now()->addMinutes(10), // kedaluarsa dalam 10 menit
            ]);
        }

        // kirim kode verifikasi ke email
        $url = $this->getUrl();
        Mail::to($userData->email)->send(new VerifikasiUserMail($userData, $url, $kode));

        // arahkan ke halaman verifikasi
        return redirect()->to('/daftar/verifikasi');
    }
};
?>

<div class="space-y-5 w-96">
    {{-- Judul --}}
    <div class="space-y-2">
        <h1 class="">Masuk</h1>
        <p class="">Masuk dan lanjutkan perjalanan dalam mengenal dan menjaga bahasa Jawa.</p>
    </div>

    {{-- Form --}}
    <form wire:submit='authenticate' class="space-y-3">
        @csrf
        <x-input id="credential" model="credential" label="Username/Email" :autofocus="true" />
        <x-input id="password" model="password" label="Kata sandi" type="password" />

        <div class="columns-2">
            <input wire:model.live='remember' type="checkbox" name="remember" id="remember"
                class="mr-1 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <label for="remember">Ingat saya</label>
            <div class="text-right">
                <a href="/reset-kata-sandi"
                    class="text-blue-600 hover:underline hover:underline-offset-4 hover:decoration-amber-400 hover:decoration-[3px] active:text-blue-800">Lupa
                    kata sandi</a>
            </div>
        </div>
        {{-- <a href="/dashboard" class="block mt-6 bg-amber-400 text-center p-3 w-full rounded-full cursor-pointer hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-amber-400 active:bg-amber-300">Masuk</a> --}}
        <x-button type="submit" rounded="full" text="Masuk" width="w-full" target="authenticate" textLoading="Mencoba masuk..." />
    </form>

    <p class="mt-3">Belum punya akun?
        <a href="/daftar"
            class="text-blue-600 hover:underline hover:underline-offset-4 hover:decoration-amber-400 hover:decoration-[3px] active:text-blue-800">
            Daftar sekarang
        </a>
    </p>
</div>
