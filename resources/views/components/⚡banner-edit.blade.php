<?php

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\Banner;

new class extends Component {
    use WithFileUploads;
    // data banner dari parent
    public $banner;
    #[Validate('nullable')]
    public $status;
    #[Validate('nullable')]
    public $iklan;
    #[Validate('nullable|image|mimes:jpg,jpeg,png,webp|max:1024')]
    public $img;
    #[Validate('nullable|url')]
    public $url;
    #[Validate('nullable')]
    public $catatan;
    #[Validate('nullable|max:255')]
    public $hover_title;

    public function mount()
    {
        $this->catatan = $this->banner->catatan;
        $this->url = $this->banner->url;
        $this->hover_title = $this->banner->hover_title;
        $this->status = $this->banner->status;
        $this->iklan = $this->banner->iklan;
    }

    // fungsi edit banner
    public function edit()
    {
        sleep(2);
        // validasi
        $this->validate();

        // SET VALUE YANG AKAN DISIMPAN
        $simpan = [];
        // status
        $simpan['status'] = !empty($this->status) ? now() : null;
        // status iklan
        $simpan['iklan'] = !empty($this->iklan) ? 1 : 0;
        // url
        $simpan['url'] = !empty($this->url) ? $this->url : null;
        // hover title
        $simpan['hover_title'] = !empty($this->hover_title) ? $this->hover_title : null;
        // pengurus yang mengedit
        $simpan['user_id'] = Auth::user()->id;

        // proses gambar
        if (isset($this->img)) {
            // hapus foto lama jika ada
            if (isset($this->banner['img'])) {
                Storage::delete($this->banner['img']);
            }
            // simpan gambar baru
            $simpan['img'] = $this->img->store('banner', 'public');
        }

        // Simpan data
        Banner::find($this->banner['id'])->update($simpan);

        // tutup window
        $this->closeWindow();
        // tampilkan notif
        $this->dispatch('notify', message: 'Perubahan berhasil disimpan', type: 'success');
    }

    // tutup window edit
    public function closeWindow()
    {
        $this->dispatch('editToggle', id: $this->banner['id']);
    }
};
?>

<x-popup title="{{ $banner['name'] }}">
    <form wire:submit='edit' class="w-full space-y-2">
        {{-- radiobutton status --}}
        <x-input-toggle id="status" model="status" label="Tampilkan" />

        {{-- Tandai sebagai iklan --}}
        <x-input-toggle id="iklan" model="iklan" label="Tandai sebagai iklan" />

        {{-- gambar --}}
        <x-input id="img" model="img" type="file" label="Gambar" />
        {{-- keterangan tambahan jika banner ditampilkan namun gambar belum diupload  --}}
        @if ($banner['status'] == 1 && (empty($banner['img']) || $banner['img'] == null))
            <x-alert color="red" textSize="text-sm"
                message="Meskipun banner diatur untuk ditampilkan, banner tidak akan muncul jika belum ada gambar yang diunggah" />
        @endif

        {{-- url --}}
        <x-input id="url" label="URL" placeholder="Masukkan tautan..." model="url" />

        {{-- hover teks --}}
        <x-input id="hover_title" label="Teks tooltip" placeholder="Masukkan teks tooltip..." model="hover_title" />

        {{-- catatan --}}
        <x-input-textarea id="catatan" model="catatan" label="Catatan" />
        <x-popup-action target="edit" text="Simpan" textLoading="Menyimpan..." closeAction="closeWindow" closeText="Batal" />
    </form>
</x-popup>
