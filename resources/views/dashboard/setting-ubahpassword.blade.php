@extends('layouts.dashboard')

@section('body')
    <form action="/pengaturan/ubah-password/simpan" method="POST" class="space-y-3">
        @method('put')
        @csrf
        <div class="flex items-center justify-between rounded-xl bg-white py-4 px-5">
            <div>Simpan perubahan?</div>
            <button type="submit" class="text-amber-600 flex">
                <i data-feather='check' class="w-5"></i>
                <span class="ml-1">Simpan</span>
            </button>
        </div>

        {{-- password lama --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="oldPassword" class="text-sm">Password lama</label>
            <input type="password" value="{{ old('oldPassword') }}" id="oldPassword" name="oldPassword" placeholder="Masukkan password lama"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('oldPassword') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('oldPassword')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- password baru 1 --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="newPassword1" class="text-sm">Password baru</label>
            <input type="password" value="{{ old('newPassword1') }}" id="newPassword1" name="newPassword1" placeholder="Masukkan password lama"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('newPassword1') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('newPassword1')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- password baru 2 --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="newPassword2" class="text-sm">Ulangi password baru</label>
            <input type="password" value="{{ old('newPassword2') }}" id="newPassword2" name="newPassword2" placeholder="Masukkan password lama"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('newPassword2') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('newPassword2')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>
    </form>

    <script>
        // ubah warna teks dan garis input error jadi normal ketika user menginput
        var validatedInput = ['oldPassword', 'newPassword1', 'newPassword2'];
        document.addEventListener('DOMContentLoaded', () => {
            removeErrorIndicators(validatedInput);
        })
    </script>
@endsection
