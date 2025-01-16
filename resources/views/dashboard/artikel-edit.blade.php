@extends('layouts.dashboard')

@section('head')
    {{-- import trix editor 2.0.8 --}}
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="{{ asset('js/trix.umd.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body')
    <form action="" method="POST" id="form" enctype="multipart/form-data" class="space-y-3">
        @method('put')
        @csrf
        <div class="flex space-x-3">
            {{-- judul --}}
            <input type="text" id="judul" name="judul" placeholder="Judul" value="{{ old('judul', $post->judul) }}"
                oninput="buatSlug(this, 'slug')"
                class="w-full py-4 px-5 bg-white rounded-xl font-semibold focus:outline-none focus:outline-amber-400 @error('judul')
            border-red-600 border-2
            @enderror">
            {{-- tombol simpan --}}
            <button type="submit" id="simpan"
                onclick="document.getElementById('form').action='/artikel/edit/{{ $post->id }}/simpan'"
                title="Simpan sebagai draf" class="bg-white rounded-xl py-4 px-5 hover:bg-amber-300">
                <i data-feather='save' class="w-5"></i>
            </button>
            {{-- tombol publish --}}
            <button type="submit" id="publish"
                onclick="document.getElementById('form').action='/artikel/edit/{{ $post->id }}/publikasikan'"
                title="Publikasikan artikel" class="bg-white rounded-xl py-4 px-5 hover:bg-amber-300">
                <i data-feather='send' class="w-5"></i>
            </button>
        </div>
        @error('judul')
            <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
        @enderror

        {{-- slug --}}
        <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}"
            placeholder="URL ({{ $url }}/blog/post/...)"
            class="w-full py-4 px-5 bg-white rounded-xl focus:outline-none focus:outline-amber-400 @error('slug')
            border-red-600 border-2
            @enderror">
        @error('slug')
            <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
        @enderror

        {{-- subtitle --}}
        <input type="text" name="subjudul" id="subjudul" value="{{ old('subjudul', $post->subjudul) }}"
            placeholder="Subjudul (opsional)"
            class="w-full py-4 px-5 bg-white rounded-xl focus:outline-none focus:outline-amber-400">
        {{-- tambah thumbnail/gambar --}}

        <div class="flex space-x-3">
            {{-- Thumbnail --}}
            <div class="w-full py-4 px-5 bg-white rounded-xl text-neutral-400">
                <img id="thumbmailPreview" src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail"
                    class="object-cover max-h-72 rounded-xl">
                @error('thumbnail')
                    <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                @enderror
            </div>
            <div onclick="document.getElementById('thumbnail').click()" title="Pilih gambar"
                class="bg-white rounded-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14">
                <i data-feather='folder' class="w-5"></i>
            </div>
        </div>

        <input type="file" accept="image/png, image/jpg, image/jpeg, image/webp" id="thumbnail" name="thumbnail"
            onchange="previewImage(this,'thumbmailPreview')" class="hidden">

        {{-- konten/text --}}
        <?php
        $trixId = 'konten';
        $trixImg = 1;
        $trixUndoRedo = 0;
        $trixBlockTool = 1;
        $updateInput = $post->konten;
        ?>
        @include('partials.trix-editor')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // textareaHeight(document.getElementById('konten'));
        })
    </script>
@endsection
