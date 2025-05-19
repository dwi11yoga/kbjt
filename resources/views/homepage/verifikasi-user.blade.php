@extends('layouts.auth')
@section('body')
    <div class="">
        Silakan cek kotak masuk email kamu dan masukkan kode verifikasi yang telah kami kirimkan.
    </div>
    <form action="/daftar/verifikasi" method="POST" class="space-y-2">
        @method('PUT')
        @csrf
        {{-- kode --}}
        <div class="">
            <input type="text" name="kode" id="kode" placeholder="kode" maxlength="6" style="letter-spacing: 1rem" value="{{ old('kode') }}"
                class="w-full p-3 border border-neutral-300 rounded-lg uppercase focus:outline focus:outline-amber-400 text-center">
            @error('kode')
                <div class="text-xs text-red-600 mt-1">*{{ $message }}</div>
            @enderror
        </div>

        <button type="submit"
            class="bg-amber-400 rounded-lg p-3 w-full hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-amber-400">
            Verifikasi
        </button>
    </form>
    <div class="text-center">
        <a href="/masuk"
            class="text-sm hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-4">
            <i data-feather='arrow-left' class="w-3.5 inline-block"></i> Kembali ke halaman login
        </a>
    </div>
@endsection
