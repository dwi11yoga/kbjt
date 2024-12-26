@extends('layouts.dashboard')

@section('head')
    {{-- import trix editor 2.0.8 --}}
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="{{ asset('js/trix.umd.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body')
    <form action="" method="POST" id="form" enctype="multipart/form-data" class="space-y-3">
        @csrf
        <div class="flex space-x-3">
            {{-- judul --}}
            <input type="text" id="judul" name="judul" placeholder="Judul" value="{{ old('judul') }}"
                oninput="buatSlug(this, 'slug')"
                class="w-full py-4 px-5 bg-white rounded-xl font-semibold focus:outline-none focus:outline-amber-400 @error('judul')
            border-red-600 border-2
            @enderror">
            {{-- tombol simpan --}}
            <button type="submit" id="simpan" onclick="document.getElementById('form').action='/artikel/baru/simpan'"
                title="Simpan sebagai draf" class="bg-white rounded-xl py-4 px-5 hover:bg-amber-300">
                <i data-feather='save' class="w-5"></i>
            </button>
            {{-- tombol publish --}}
            <button type="submit" id="publish"
                onclick="document.getElementById('form').action='/artikel/baru/publikasikan'" title="Publikasikan artikel"
                class="bg-white rounded-xl py-4 px-5 hover:bg-amber-300">
                <i data-feather='send' class="w-5"></i>
            </button>
        </div>
        @error('judul')
            <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
        @enderror

        {{-- slug --}}
        <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
            placeholder="URL ({{ $url }}/blog/post/...)"
            class="w-full py-4 px-5 bg-white rounded-xl focus:outline-none focus:outline-amber-400 @error('slug')
            border-red-600 border-2
            @enderror">
        @error('slug')
            <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
        @enderror

        {{-- subtitle --}}
        <input type="text" name="subjudul" id="subjudul" value="{{ old('subjudul') }}" placeholder="Subjudul (opsional)"
            class="w-full py-4 px-5 bg-white rounded-xl focus:outline-none focus:outline-amber-400">
        {{-- tambah thumbnail/gambar --}}

        <div class="flex space-x-3">
            {{-- Thumbnail --}}
            <div class="w-full py-4 px-5 bg-white rounded-xl text-neutral-400">
                <img id="thumbmailPreview" src="" alt="Thumbnail" class="object-cover max-h-72 rounded-xl">
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
        <style>
            trix-editor h1 {
                font-size: 1.3rem;
                font-weight: 600;
            }

            trix-editor ul {
                padding-left: 25px;
                /* Space before list items */
                list-style-type: disc;
                /* Bullet (•) for items */
            }

            trix-editor ol {
                padding-left: 25px;
                /* Space before list items */
                list-style-type: decimal;
                /* Numbers (1, 2, 3, ...) for items */
            }

            trix-editor li {
                display: list-item;
                /* Default display for list items */
            }

            trix-editor pre {
                display: block;
                /* Ditampilkan sebagai blok */
                font-family: monospace;
                /* Menggunakan font monospace */
                white-space: pre;
                /* Pertahankan spasi dan baris baru */
                margin: 1em 0;
                /* Margin atas dan bawah */
                background-color: #e5e5e5;
                padding: 0.5rem 0.5rem;
                font-size: 1rem;
                border-radius: 0.5rem;
                overflow-inline: scroll;
            }

            trix-editor blockquote {
                display: block;
                margin-top: 0.5rem;
                padding-left: 0.5rem;
                /* Margin atas */
                margin-bottom: 0.5rem;
                /* Margin bawah */
                margin-inline-start: 0.5rem;
                /* Indentasi kiri */
                margin-inline-end: 0.5rem;
                /* Indentasi kanan */
                font-size: inherit;
                /* Ukuran font sesuai elemen induk */
                font-style: italic;
                /* Teks miring */
                border-left: 4px solid #fbbf24;
            }

            trix-editor a {
                text-decoration: underline;
                text-decoration-color: #fbbf24;
                text-decoration-thickness: 2px;
                text-underline-offset: 2px;
            }

            /* sembunyikan redo dan undo trix */
            trix-toolbar [data-trix-action="undo"],
            trix-toolbar [data-trix-action="redo"],
            trix-toolbar [data-trix-button-group="history-tools"] {
                display: none;
            }
        </style>
        <div class="bg-white py-4 rounded-2xl">
            <div class="sticky top-0 px-5 bg-white py-2">
                <trix-toolbar id="my_toolbar"></trix-toolbar>
                <div class="more-stuff-inbetween"></div>
            </div>
            <div class="px-5 mt-1">
                <input id="konten" type="hidden" name="konten" value="{{ old('konten') }}">
                <trix-editor toolbar="my_toolbar" input="konten"
                    class="rounded-xl min-h-52 focus:outline-none focus:outline-amber-300 focus:outline-offset-0 space-y-2"></trix-editor>
            </div>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // textareaHeight(document.getElementById('konten'));
        })

        // disable fungsi undo dan redo
        document.addEventListener("trix-action-invoke", function(event) {
            const actionName = event.actionName;

            if (actionName === "undo" || actionName === "redo") {
                event.preventDefault(); // Mencegah aksi undo atau redo
                console.log(`Action "${actionName}" has been disabled.`);
            }
        });

        // Jenis dan ukuran max file yang diterima oleh trix
        document.addEventListener("trix-file-accept", function(event) {
            const acceptedTypes = ["image/png", "image/jpg", "image/jpeg", "image/webp"];
            const file = event.file;

            if (!acceptedTypes.includes(file.type)) {
                event.preventDefault(); // Batalkan unggahan file
                alert("Hanya gambar dengan format PNG, JPG, JPEG, dan WEBP yang diperbolehkan.");
            }

            if (file.size > 1048576) {
                event.preventDefault(); // Batalkan unggahan file
                alert("Ukuran gambar maksimal yang diterima adalah 1MB.");
            }
        });
    </script>
@endsection
