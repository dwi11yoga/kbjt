<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use App\Models\User;
use Illuminate\Database\QueryException;

new class extends Component {
    //
    #[Title('Buat akun')]
    #[Layout('layouts.auth')]
    #[Validate('required|min:3|max:255')]
    public $nama;
    #[Validate('required|email:rfc,strict|unique:users,email')]
    public $email;
    #[Validate('required|min:6|max:255|lowercase|unique:users,username|regex:/^[A-Za-z0-9_.]+$/')]
    public $username;
    #[Validate('required|min:6|max:255')]
    public $password;
    #[Validate('required|min:6|max:255|same:password')]
    public $password2;
    #[Validate('required')]
    public $eula;

    public function save()
    {
        $data = $this->validate();
        // simpan user
        try {
            $user = User::create($data);
            // kirim email selamat bergabung
            // langsung masuk dan arahkan pengugna ke hal.dashboard
            Auth::login($user);
            session()->regenerate();
            return redirect()
                ->intended('/dashboard')
                ->with('success', 'Selamat datang, ' . $user->nama . '!');
        } catch (QueryException $err) {
            $this->dispatch('notify', message: 'Gagal membuat akun, coba lagi', type: 'failed');
            report($err); //catat error ke log
        }
    }
};
?>

<div class="space-y-5 w-full">
    {{-- Judul --}}
    <div class="space-y-2">
        <h1 class="">Buat akun</h1>
        <p id="deskripsi" class="">Daftar sekarang dan jadilah bagian dari komunitas pelestari bahasa Jawa.</p>
    </div>
    {{-- Form --}}
    <form wire:submit='save' class="space-y-3">
        @csrf
        <div class="flex gap-3 w-full">
            <div class="md:w-96 space-y-3">
                <x-input id="nama" model="nama" label="Nama" :autofocus="true" />
                <x-input id="email" model="email" label="Email" type="email" />
                <x-input id="username" model="username" label="Username" />
            </div>
            <div class="md:w-96 space-y-3">
                <x-input id="password" model="password" label="Kata sandi" type="password" />
                <x-input id="password2" model="password2" label="Ulangi kata sandi" type="password" />
                <input type="checkbox" wire:model.live='eula' name="eula" id="eula"
                    class="mr-1 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <label for="eula"
                    class="@error('eula')
            underline underline-offset-2 decoration-red-600 decoration-2
        @enderror">
                    Saya telah membaca dan menyetujui <a href="/syarat-ketentuan"
                        class="text-blue-500 hover:underline hover:underline-offset-4 hover:decoration-4 hover:decoration-amber-400">syarat
                        dan ketentuan</a>
                    yang berlaku.
                </label>
            </div>
        </div>
        <x-button type="submit" rounded="full" text="Daftar" width="w-full" target="save"
            textLoading="Menyimpan..." />
        {{-- <input type="submit" value="Buat akun"
            class="block bg-amber-400 text-center p-3 w-full rounded-full cursor-pointer hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-amber-400 active:bg-amber-300"> --}}
        <p id="masuk" class="">
            Sudah punya akun?
            <a href="/masuk"
                class="text-blue-600 hover:underline hover:underline-offset-4 hover:decoration-amber-400 hover:decoration-[3px] active:text-blue-800">
                Masuk
            </a>.
        </p>
    </form>
</div>
