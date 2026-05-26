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
// $trixPlaceholder=null;
?>

@props([
    'id',
    'img' => 1,
    'undoRedo' => 1,
    'blockTool' => 1,
    'updateInput' => null,
    'placeholder' => null,
    'value' => '',
])

<div class="">
    @if ($undoRedo == 0)
        {{-- Sembunyikan undo/redo --}}
        <style>
            trix-toolbar [data-trix-action="undo"],
            trix-toolbar [data-trix-action="redo"],
            trix-toolbar [data-trix-button-group="history-tools"] {
                display: none;
            }
        </style>
    @endif
    @if ($img == 0)
        {{-- Sembunyikan tombol upload file --}}
        <style>
            trix-toolbar [data-trix-button-group="file-tools"] {
                display: none;
            }
        </style>
    @endif

    @if ($blockTool == 0)
        {{-- Sembunyikan tombol Untuk buat list dan h1 --}}
        <style>
            trix-toolbar [data-trix-button-group="block-tools"] {
                display: none;
            }
        </style>
    @endif


    {{-- Trix Toolbar --}}
    <div wire:ignore class="sticky top-0 bg-white">
        <trix-toolbar id="my_toolbar-{{ $id }}"></trix-toolbar>
        <div class="more-stuff-inbetween"></div>
    </div>

    {{-- Trix Editor --}}
    <div class="">
        <input id="{{ $id }}" name="{{ $id }}" hidden value={{ $value }}>
        <trix-editor wire:ignore toolbar="my_toolbar-{{ $id }}" input="{{ $id }}"
            placeholder="{{ $placeholder ?? 'Ketik disini...' }}"
            class="px-4 py-3 w-full min-h-52 rounded-md block bg-neutral-100 focus:border-b-2 border-0 focus:rounded-b-none outline-none transition-all ease-in-out duration-75 
        {{ $errors->has($id) ? 'border-red-500' : 'border-amber-400' }}">
        </trix-editor>
    </div>
    @error($id)
        <div class="text-xs text-red-600 mt-2 mb-2">{{ $message }}</div>
    @enderror

    {{-- update value variabel livewire --}}
    <script>
        document.addEventListener('trix-change', (e) => {
        const input = document.getElementById('{{ $id }}');
        clearTimeout(window._trixTimeout);
        window._trixTimeout = setTimeout(() => {
            @this.set('{{ $id }}', input.value);
        }, 800); // tambah debounce
    });
    </script>

    @if ($undoRedo == 0)
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
    @if ($img == 1)
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
    @elseif ($img == 0)
        <script>
            // disable fungsi upload
            document.addEventListener("trix-file-accept", function(event) {
                event.preventDefault(); // Mencegah file diterima
                console.log("Upload file telah dinonaktifkan.");
            });
        </script>
    @endif
</div>
