@extends('layouts.dashboard')

@section('head')
    {{-- import trix editor 2.0.8 --}}
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="{{ asset('js/trix.umd.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body')
    <form action="/metode-donasi/{{ $donasi->id }}/edit" method="POST" id="form" enctype="multipart/form-data"
        class="space-y-3">
        @method('PUT')
        @csrf
        <div class="flex items-center justify-between rounded-xl bg-white py-4 px-5">
            <div>Simpan perubahan?</div>
            <button type="submit" class="text-amber-600">Simpan</button>
        </div>

        <div class="">
            <div class="grid grid-cols-5 md:space-x-2 md:space-y-0 space-y-2">
                <div class="md:col-span-1 col-span-3">
                    
                    {{-- barcode --}}
                    <div
                        class="w-full py-4 px-5 bg-neutral-100 rounded-t-xl aspect-square text-neutral-400 border-8 border-white">
                        <img id="thumbmailPreview" src="" alt="barcode"
                            class="object-cover max-h-72 rounded-xl">
                    </div>
                    <div onclick="document.getElementById('barcode').click()" title="Pilih gambar"
                        class="bg-white rounded-b-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14 flex justify-end">
                        <i data-feather='folder' class="w-5"></i>
                    </div>
                    @error('barcode')
                        <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                    @enderror
                    <input type="file" accept="image/png, image/jpg, image/jpeg, image/webp" id="barcode"
                        name="barcode" onchange="previewImage(this,'thumbmailPreview')" class="hidden">
                </div>

                <div class="md:col-span-4 col-span-5 bg-white px-5 py-4 space-y-2 rounded-xl">
                    {{-- metode --}}
                    <div class="">
                        <label for="metode" class="text-sm">Metode</label>
                        <input type="text" id="metode" name="metode" placeholder="Masukkan metode donasi..."
                            value="{{ old('metode', $donasi->metode) }}"
                            class="w-full font-semibold focus:outline-none focus:border-b-2 py-1 @error('metode') 
                    border-red-600 text-red-600 @else focus:border-amber-400
                    @enderror">
                        @error('metode')
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- rekening --}}
                    <div class="">
                        <label for="rekening" class="text-sm">Rekening</label>
                        <input type="text" id="rekening" name="rekening" placeholder="Masukkan rekening/tujuan donasi..."
                            value="{{ old('rekening', $donasi->rekening) }}"
                            class="w-full focus:outline-none focus:border-b-2 py-1 @error('rekening')
                    border-red-600 text-red-600 @else focus:border-amber-400
                    @enderror">
                        @error('rekening')
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- link --}}
                    <div class="">
                        
                        {{-- URL donasi --}}
                        <label for="link" class="text-sm">URL Donasi</label>
                        <input type="text" id="link" name="link" placeholder="Masukkan link/tujuan donasi..."
                            value="{{ old('link', $donasi->url) }}"
                            class="w-full focus:outline-none focus:border-b-2 py-1 @error('link')
                    border-red-600 text-red-600 @else focus:border-amber-400
                    @enderror">

                        @error('link')
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>
        </div>

        {{-- konten/text --}}
        <div class="bg-white py-4 px-4 rounded-2xl">

            <div class="mb-2">Deskripsi / cara donasi</div>

            <?php
            $trixId = 'cara_donasi';
            $trixImg = 0;
            $trixUndoRedo = 0;
            $trixBlockTool = 1;
            $updateInput = $donasi->cara_donasi;
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
