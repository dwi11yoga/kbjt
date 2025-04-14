@extends('layouts.dashboard')

@section('body')
    <form action="/pengaturan/tautan/simpan" method="POST" class="space-y-3">
        @method('put')
        @csrf

        <div class="flex items-center justify-between rounded-xl bg-white py-4 px-5">
            <div>Simpan perubahan?</div>
            <button type="submit" class="text-amber-600 flex">
                <i data-feather='check' class="w-5"></i>
                <span class="ml-1">Simpan</span>
            </button>
        </div>

        {{-- tautan --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="tautan" class="text-sm">Tautan</label>
            <input type="text" id="tautan" name="tautan" placeholder="Masukkan tautan" title="Klik untuk edit"
                value="{{ old('tautan', auth()->user()->tautan) }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('tautan') 
                border-red-600 text-red-600 @else focus:border-amber-400
                @enderror">
            @error('tautan')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- telp --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="telp" class="text-sm">Nomor telepon</label>
            <input type="text" id="telp" name="telp" placeholder="Masukkan nomor telepon" title="Klik untuk edit"
                value="{{ old('telp', auth()->user()->telp) }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('telp') 
                border-red-600 text-red-600 @else focus:border-amber-400
                @enderror">
            @error('telp')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>


        {{-- fb --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="fb" class="text-sm">Facebook</label>
            <input type="text" id="fb" name="fb" placeholder="Masukkan username" title="Klik untuk edit"
                value="{{ old('fb', auth()->user()->media_sosial['fb'] ?? '') }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('fb') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('fb')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- x --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="x" class="text-sm">Twitter</label>
            <input type="text" id="x" name="x" placeholder="Masukkan username" title="Klik untuk edit"
                value="{{ old('x', auth()->user()->media_sosial['x'] ?? '') }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('x') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('x')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- ig --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="ig" class="text-sm">Instagram</label>
            <input type="text" id="ig" name="ig" placeholder="Masukkan username" title="Klik untuk edit"
                value="{{ old('ig', auth()->user()->media_sosial['ig'] ?? '') }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('ig') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('ig')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- tiktok --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="tiktok" class="text-sm">Tiktok</label>
            <input type="text" id="tiktok" name="tiktok" placeholder="Masukkan username" title="Klik untuk edit"
                value="{{ old('tiktok', auth()->user()->media_sosial['tiktok'] ?? '') }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('tiktok') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('tiktok')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- wa --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="wa" class="text-sm">Whatsapp</label>
            <input type="text" id="wa" name="wa" placeholder="Masukkan username" title="Klik untuk edit"
                value="{{ old('wa', auth()->user()->media_sosial['wa'] ?? '') }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('wa') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('wa')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- telegram --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="telegram" class="text-sm">Telegram</label>
            <input type="text" id="telegram" name="telegram" placeholder="Masukkan username" title="Klik untuk edit"
                value="{{ old('telegram', auth()->user()->media_sosial['telegram'] ?? '') }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('telegram') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('telegram')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- linkedin --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="linkedin" class="text-sm">LinkedIn</label>
            <input type="text" id="linkedin" name="linkedin" placeholder="Masukkan username" title="Klik untuk edit"
                value="{{ old('linkedin', auth()->user()->media_sosial['linkedin'] ?? '') }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('linkedin') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('linkedin')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- github --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="github" class="text-sm">Github</label>
            <input type="text" id="github" name="github" placeholder="Masukkan username" title="Klik untuk edit"
                value="{{ old('github', auth()->user()->media_sosial['github'] ?? '') }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('github') 
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('github')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>
    </form>
@endsection
