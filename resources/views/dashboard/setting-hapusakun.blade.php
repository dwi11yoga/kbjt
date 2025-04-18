@extends('layouts.dashboard')

@section('body')
    <form action="/pengaturan/hapus-akun/konfirmasi" method="POST" class="space-y-3">
        @method('put')
        @csrf

        {{-- alasan --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="alasan" class="text-sm">Mengapa kamu ingin menghapus akun ini?</label>
            <textarea id="alasan" name="alasan" placeholder="Masukkan alasan" oninput="textareaHeight(this)"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('alasan') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">{{ old('alasan') }}</textarea>
            @error('alasan')
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

        {{-- konfirmasi --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <input type="checkbox" name="konfirmasi" id="konfirmasi" required {{ old('konfirmasi')=='on'?'checked':'' }}>
            <label for="konfirmasi" class="text-sm">
                Saya memahami bahwa akun saya akan dihapus secara permanen dan tidak dapat dikembalikan.
            </label>
            @error('konfirmasi')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- tombol konfirmasi --}}
        <div class="flex items-center justify-between rounded-xl bg-white py-4 px-5">
            <div>Hapus akun secara permanen?</div>
            <button type="submit" class="text-red-600 flex">
                <i data-feather='check' class="w-5"></i>
                <span class="ml-1">Konfirmasi</span>
            </button>
        </div>
    </form>

    <script>
        // ubah warna teks dan garis input error jadi normal ketika user menginput
        var validatedInput = ['alasan', 'password'];
        document.addEventListener('DOMContentLoaded', () => {
            removeErrorIndicators(validatedInput);
        })
    </script>
@endsection
