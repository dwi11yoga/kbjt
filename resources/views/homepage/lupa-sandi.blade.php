@extends('layouts.auth')
@section('body')
    <div class="">
        Silakan masukkan username atau email terdaftar. Kami akan kirimkan kode untuk mengatur ulang kata sandi.
    </div>
    <form action="/reser-kata-sandi/eksekusi" method="POST" class="space-y-2">
        @csrf
        <div class="">
            <input type="text" name="user" id="user" placeholder="Username/Email" value="{{ old('user') }}"
                class="w-full p-3 border border-neutral-300 rounded-lg focus:outline focus:outline-amber-400">
            @error('user')
                <div class="text-xs text-red-600 mt-1">*{{ $message }}</div>
            @enderror
        </div>
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
