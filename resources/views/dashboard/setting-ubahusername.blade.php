@extends('layouts.dashboard')
@section('body')
    <form action="/pengaturan/ubah-username/simpan" method="POST" class="space-y-3">
        @method('put')
        @csrf
        <div class="flex items-center justify-between rounded-xl bg-white py-4 px-5">
            <div>Simpan perubahan?</div>
            <button type="submit" class="text-amber-600 flex">
                <i data-feather='check' class="w-5"></i>
                <span class="ml-1">Simpan</span>
            </button>
        </div>


        {{-- username --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="username" class="text-sm">Username baru</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username"
                value="{{ old('username', auth()->user()->username) }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('username') 
            border-red-600 text-red-600 @else focus:border-amber-400
            @enderror">
            @error('username')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- password --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="password" class="text-sm">Password*</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('password') 
            border-red-600 text-red-600 @else focus:border-amber-400
            @enderror">
            @error('password')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
            <div class="text-xs">*Silakan masukkan kata sandi untuk konfirmasi identitas kamu</div>
        </div>
    </form>

    <script>
        // ubah warna teks dan garis input error jadi normal ketika user menginput
        var validatedInput = ['username', 'password'];
        document.addEventListener('DOMContentLoaded', () => {
            removeErrorIndicators(validatedInput);
        })
    </script>
@endsection
