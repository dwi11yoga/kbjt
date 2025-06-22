@extends('layouts.dashboard')

@section('head')
    {{-- import trix editor 2.0.8 --}}
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="{{ asset('js/trix.umd.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body')
    <form action="" method="POST" id="form" enctype="multipart/form-data" class="space-y-3">
        @method('PUT')
        @csrf

        {{-- tombol simpan/publikasikan --}}
        <div class="grid grid-cols-2 rounded-xl bg-white py-4 px-5 md:space-y-0 space-y-2">
            <div class="md:col-span-1 col-span-2">Simpan/publikasikan artikel?</div>
            <div class="md:col-span-1 col-span-2 flex md:justify-end space-x-5">
                <button type="submit" id="publish" title="Publikasikan artikel" class="text-blue-600 flex"
                    onclick="document.getElementById('form').action='/artikel/edit/{{ $post->id }}/publikasikan'">
                    <i data-feather='check' class="w-5"></i>
                    <span class="ml-1">Publikasikan</span>
                </button>
                <button type="submit"id="simpan" title="Simpan sebagai draft" class="text-amber-600 flex"
                    onclick="document.getElementById('form').action='/artikel/edit/{{ $post->id }}/simpan'">
                    <i data-feather='save' class="w-5"></i>
                    <span class="ml-1">Simpan sebagai draf</span>
                </button>
            </div>
        </div>

        {{-- judul --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="judul" class="text-sm">Judul</label>
            <input type="text" id="judul" name="judul" placeholder="Masukkan judul"
                value="{{ old('judul', $post->judul) }}"
                class="w-full font-semibold focus:outline-none focus:border-b-2 py-1 @error('judul') 
            border-red-600 text-red-600 @else focus:border-amber-400
            @enderror">
            @error('judul')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- subjudul --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="subjudul" class="text-sm">Subjudul</label>
            <input type="text" id="subjudul" name="subjudul" placeholder="Masukkan subjudul (opsional)"
                value="{{ old('subjudul', $post->subjudul) }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('subjudul') 
            border-red-600 text-red-600 @else focus:border-amber-400
            @enderror">
            @error('subjudul')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- slug --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="slug" class="text-sm">Slug*</label>
            <input type="text" id="slug" name="slug" placeholder="Masukkan slug"
                value="{{ old('slug', $post->slug) }}"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('slug') 
            border-red-600 text-red-600 @else focus:border-amber-400
            @enderror">
            @error('slug')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
            <div class="text-xs">*Tulis
                "{{ !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https:' : 'http' }}://{{ $_SERVER['HTTP_HOST'] }}/lorem-ipsum"
                menjadi "lorem-ipsum" saja</div>
        </div>

        {{-- thumbnail --}}
        <div class="md:col-span-1 col-span-3">
            <div
                class="w-1/2 bg-neutral-100 rounded-t-xl aspect-video text-neutral-400 border-8 border-white flex items-center justify-center overflow-hidden">
                <img id="thumbmailPreview" src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail"
                    class="object-cover w-full h-full">
            </div>
            <div onclick="document.getElementById('thumbnail').click()" title="Pilih gambar"
                class="w-1/2 bg-white rounded-b-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14 flex justify-between">
                <div>Pilih thumbnail*</div>
                <i data-feather='folder' class="w-5"></i>
            </div>
            <input type="file" accept="image/png, image/jpg, image/jpeg, image/webp" id="thumbnail" name="thumbnail"
                onchange="previewImage(this,'thumbmailPreview')" class="hidden">
        </div>

        <div>
            @error('thumbnail')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
            <div class="text-xs">*Pilih gambar berformat .jpg, .jpeg, .png, atau .webp (maks. 1024KB).
            </div>
        </div>

        {{-- konten/text --}}
        <div class="bg-white py-4 rounded-2xl">

            <?php
            $trixId = 'konten';
            $trixImg = 1;
            $trixUndoRedo = 1;
            $trixBlockTool = 1;
            $updateInput = $post->konten;
            ?>
            @include('partials.trix-editor')
            @error('konten')
            <div class="text-xs text-red-600 ml-6 mt-2">*{{ $message }}</div>
        @enderror
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // textareaHeight(document.getElementById('konten'));
        })
    </script>
@endsection
