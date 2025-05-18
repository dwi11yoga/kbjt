@extends('layouts.auth')
@section('body')
    <div class="">
        Masukkan kode yang telah kami kirim ke email kamu untuk melanjutkan proses reset kata sandi. Pastikan
        kode yang dimasukkan sesuai dan masih berlaku.
    </div>
    <form action="/reset-kata-sandi/autentikasi/elsekusi" method="POST" class="space-y-2">
        @csrf
        {{-- kode --}}
        <div class="">
            <input type="text" name="kode" id="kode" placeholder="kode" maxlength="6" style="letter-spacing: 1rem" value="{{ old('kode') }}"
                class="w-full p-3 border border-neutral-300 rounded-lg uppercase focus:outline focus:outline-amber-400 text-center">
            @error('kode')
                <div class="text-xs text-red-600 mt-1">*{{ $message }}</div>
            @enderror
        </div>

        {{-- password  --}}
        <div class="">
            <input type="password" name="password1" id="password1" placeholder="Kata sandi baru" value="{{ old('password1') }}"
                class="w-full p-3 border border-neutral-300 rounded-lg focus:outline focus:outline-amber-400">
            @error('password1')
                <div class="text-xs text-red-600 mt-1">*{{ $message }}</div>
            @enderror
        </div>
        <div class="">
            <input type="password" name="password2" id="password2" placeholder="Ulangi kata sandi baru" value="{{ old('password2') }}"
                class="w-full p-3 border border-neutral-300 rounded-lg focus:outline focus:outline-amber-400">
            @error('password2')
                <div class="text-xs text-red-600 mt-1">*{{ $message }}</div>
            @enderror
        </div>

        {{-- tombol --}}
        <button type="submit"
            class="bg-amber-400 rounded-lg p-3 w-full hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-amber-400">
            Reset kata sandi
        </button>
    </form>
    <div class="text-center">
        <a href="/masuk"
            class="text-sm hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4">
            <i data-feather='arrow-left' class="w-3.5 inline-block"></i> Kembali ke halaman login
        </a>
    </div>
@endsection
