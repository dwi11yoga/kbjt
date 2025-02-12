@extends('layouts.dashboard')

@section('head')
    {{-- import trix editor 2.0.8 --}}
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="{{ asset('js/trix.umd.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body')
    <form action="/metode-donasi/baru" method="POST" id="form" enctype="multipart/form-data" class="space-y-3">
        @csrf
        <div class="flex space-x-3">
            {{-- metode --}}
            <input type="text" id="metode" name="metode" placeholder="Metode donasi" value="{{ old('metode') }}"
                oninput="buatSlug(this, 'slug')"
                class="w-full py-4 px-5 bg-white rounded-xl font-semibold focus:outline-none focus:outline-amber-400 @error('metode')
            border-red-600 border-2
            @enderror">
            {{-- tombol simpan --}}
            <button type="submit" id="simpan" title="Simpan" class="bg-white rounded-xl py-4 px-5 hover:bg-amber-300">
                <i data-feather='save' class="w-5"></i>
            </button>
        </div>
        @error('metode')
            <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
        @enderror

        {{-- rekening --}}
        <input type="text" name="rekening" id="rekening" value="{{ old('rekening') }}"
            placeholder="Rekening/Nomor telepon"
            class="w-full py-4 px-5 bg-white rounded-xl focus:outline-none focus:outline-amber-400 @error('rekening')
            border-red-600 border-2
            @enderror">
        @error('rekening')
            <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
        @enderror

        {{-- link --}}
        <input type="text" name="link" id="link" value="{{ old('link') }}" placeholder="Tautan"
            class="w-full py-4 px-5 bg-white rounded-xl focus:outline-none focus:outline-amber-400 @error('link')
            border-red-600 border-2
            @enderror">
        @error('link')
            <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
        @enderror

        {{-- tambah thumbnail/gambar --}}
        <div class="flex space-x-3">
            {{-- barcode --}}
            <div class="w-full py-4 px-5 bg-white rounded-xl text-neutral-400">
                <img id="thumbmailPreview" src="" alt="Barcode" class="object-cover max-h-72 rounded-xl">
                @error('barcode')
                    <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                @enderror
            </div>
            <div onclick="document.getElementById('barcode').click()" title="Pilih gambar"
                class="bg-white rounded-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14">
                <i data-feather='folder' class="w-5"></i>
            </div>
        </div>

        <input type="file" accept="image/png, image/jpg, image/jpeg, image/webp" id="barcode" name="barcode"
            onchange="previewImage(this,'thumbmailPreview')" class="hidden">

        {{-- konten/text --}}
        <div class="bg-white py-4 px-4 rounded-2xl">

            <div class="mb-2">Deskripsi / cara donasi</div>

            <?php
            $trixId = 'cara_donasi';
            $trixImg = 1;
            $trixUndoRedo = 0;
            $trixBlockTool = 1;
            $updateInput = null;
            ?>
            @include('partials.trix-editor')

        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // textareaHeight(document.getElementById('konten'));
        })
    </script>
@endsection
