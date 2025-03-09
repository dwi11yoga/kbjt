{{-- Trix Editor --}}

{{-- 
INFO!!!
untuk meng-include file ini, definisikan hal ini lebih dulu 
note: 1=enabled, 0=disabled
--}}

<?php
// $trixId = 'lorem';
// $trixImg = 1;
// $trixUndoRedo = 1;
// $trixBlockTool=1;
// $updateInput=null;
?>

{{-- Trix Style --}}
{{-- Trix Style --}}
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
</style>

@if ($trixUndoRedo == 0)
    {{-- Sembunyikan undo/redo --}}
    <style>
        trix-toolbar [data-trix-action="undo"],
        trix-toolbar [data-trix-action="redo"],
        trix-toolbar [data-trix-button-group="history-tools"] {
            display: none;
        }
    </style>
@endif
@if ($trixImg == 0)
    {{-- Sembunyikan tombol upload file --}}
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }
    </style>
@endif

@if ($trixBlockTool == 0)
    {{-- Sembunyikan tombol Untuk buat list dan h1 --}}
    <style>
        trix-toolbar [data-trix-button-group="block-tools"] {
            display: none;
        }
    </style>
@endif


{{-- Trix Toolbar --}}
<div class="sticky top-0 bg-white">
    <trix-toolbar id="my_toolbar"></trix-toolbar>
    <div class="more-stuff-inbetween"></div>
</div>

{{-- Trix Editor --}}
<div class="mt-1">
    <input id="{{ $trixId }}" type="hidden" name="{{ $trixId }}"
        value="{{ isset($updateInput) ? old('trixId', $updateInput) : old($trixId) }}">
    <trix-editor toolbar="my_toolbar" input="{{ $trixId }}"
        class="rounded-xl min-h-52 focus:outline-none focus:outline-amber-400 focus:outline-offset-0 space-y-2"></trix-editor>
</div>

@if ($trixUndoRedo == 0)
    <script>
        // disable fungsi undo dan redo
        document.addEventListener("trix-action-invoke", function(event) {
            const actionName = event.actionName;

            if (actionName === "undo" || actionName === "redo") {
                event.preventDefault(); // Mencegah aksi undo atau redo
                console.log(`Action "${actionName}" has been disabled.`);
            }
        });
    </script>
@endif

{{-- Fungsi upload gambar --}}
@if ($trixImg == 1)
    <script>
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
@elseif ($trixImg == 0)
    <script>
        // disable fungsi upload
        document.addEventListener("trix-file-accept", function(event) {
            event.preventDefault(); // Mencegah file diterima
            console.log("Upload file telah dinonaktifkan.");
        });
    </script>
@endif
