<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use App\Models\Blog;
use App\Models\User;

new class extends Component {
    use WithFileUploads;

    // data id artikel yang akan diedit
    #[Title('Edit artikel')]
    #[Layout('layouts.dashboard')]
    public $id;
    public $isPublish, $judul, $subjudul, $slug, $thumbnail, $konten;
    public $oldThumbnail;
    public $removeThumbnail;
    public $articleDetail; // semua data artikel

    // dapatkan data
    public function mount()
    {
        $data = Blog::find($this->id);
        // jika data tidak ditemukan
        if (empty($data)) {
            abort(404, 'Artikel tidak ditemukan');
        }
        // set ke variabel
        $this->isPublish = !empty($data->status) ? 1 : 0;
        $this->judul = $data->judul;
        $this->subjudul = $data->subjudul;
        $this->slug = $data->slug;
        $this->oldThumbnail = $data->thumbnail;
        $this->konten = $data->konten;
        $this->articleDetail = $data;
    }

    // validasi
    public function rules()
    {
        $rules = [
            'judul' => 'required|string',
            'subjudul' => 'nullable',
            'slug' => 'nullable',
            'thumbnail' => 'nullable|mimes:png,jpg,jpeg,webp|image|max:1024',
            'konten' => 'nullable',
        ];
        if ($this->isPublish) {
            $rules['slug'] = 'required|unique:blog,slug,' . $this->id . ',id|string|regex:/^[a-z0-9-]+$/';
            $rules['konten'] = 'required|string';
        }
        return $rules;
    }

    // cek validasi saat pengguna mengisi input
    public function updated($field)
    {
        $this->validateOnly($field);
    }

    // generate slug otomatis
    public function generateSlug()
    {
        $this->slug = Str::slug($this->judul);
    }

    // thumbnail preview
    #[Computed]
    public function thumbnailPreview()
    {
        if ($this->removeThumbnail) {
            // jika avatar dihapus
            $preview = null;
        } elseif (isset($this->thumbnail) && !$this->getErrorBag()->has('thumbnail')) {
            // jika profil pic diupload
            $preview = $this->thumbnail->temporaryUrl();
        } elseif (isset($this->oldThumbnail)) {
            // selain itu, tampilkan avatar lama pengguna
            $preview = asset('storage/' . $this->oldThumbnail);
        } else {
            $preview = null;
        }

        return $preview;
    }

    // simpan artikel
    public function save($action = 'simpan')
    {
        // Validasi
        $this->validate();

        // cek apakah pengguna berhaik mengedit artikel
        if ($this->articleDetail->user_id != auth()->user()->id) {
            abort(403, 'Akses tidak diizinkan');
        }

        // set data yang akan disimpan
        $data = [
            'judul' => $this->judul,
            'slug' => $this->slug,
            'subjudul' => $this->subjudul,
            'konten' => $this->konten,
            'status' => $this->isPublish ? now() : null,
            'edited_at' => now(),
        ];

        if ($this->removeThumbnail) {
            // jika gambar dihapus
            // hapus foto lama
            if (!empty($this->data->thumbnail)) {
                Storage::disk('public')->delete($this->data->thumbnail);
            }
            $data['thumbnail'] = null;
        } elseif (!empty($this->thumbnail)) {
            // jika pengguna upload gambar baru
            // hapus foto lama
            if (!empty($this->data->thumbnail)) {
                Storage::disk('public')->delete($this->data->thumbnail);
            }
            // simpan foto profil baru
            $data['thumbnail'] = $this->thumbnail->store('avatar', 'public');
        }

        // tambah poin pengurus yang mempublikasikan artikel
        if ($this->isPublish && empty($this->articleDetail->status)) {
            $data['poin'] = addPoint(auth()->user()->id, 'Publikasikan artikel');
            // increment artikel dipublikasikan di statistik
            changeStat('artikel_dipublikasikan');
        }

        // kurangi poin jika pengguna mem-unpublish artikel
        if (!$this->isPublish && !empty($this->articleDetail->status)) {
            User::find(auth()->user()->id)->decrement('poin', $this->articleDetail->poin);
            $data['poin'] = 0;
            // decrement artikel dipublikasikan di statistik
            changeStat('artikel_dipublikasikan', false);
        }

        // Simpan
        Blog::find($this->id)->update($data);

        if ($this->isPublish) {
            // cek achievement author
            $userId = auth()->user()->id;
            // rule yang akan dicek achievementnya
            $rule = ['artikel', 'totalViewBlog', 'viewBlog'];

            //lakukan perulangan untuk cek achievement user
            foreach ($rule as $d) {
                achievement($userId, $d);
            }
            return redirect('/artikel/')->with('success', 'Artikel berhasil dipublikasikan (+' . $data['poin'] . ' poin)');
        } else {
            return redirect('/artikel/edit/' . $this->id)->with('success', 'Artikel berhasil disimpan' . ($this->articleDetail->poin > 0 ? ' (-' . $this->articleDetail->poin . ' poin)' : ''));
        }
    }
};
?>

<form wire:submit='save' class="space-y-3">
    @csrf
    <x-input id="judul" model="judul" label="Judul" :autofocus="true" />
    <x-input id="subjudul" model="subjudul" label="Subjudul" />
    <x-input id="slug" model="slug" footnote="{{ getUrl() }}/blog/{{ $this->slug ?? '...' }}">
        <x-slot:label>
            <div class="">
                Permalink
                <span wire:click='generateSlug' class="text-xs text-blue-600 cursor-pointer">Generate</span>
            </div>
        </x-slot:label>
    </x-input>
    <x-input-file id="thumbnail" model="thumbnail" label="Thumbnail" fileTypes="JPG, JPEG, PNG, WEBP" maxSize="1024KB"
        fileName="{{ isset($thumbnail) ? $thumbnail->getClientOriginalName() : null }}"
        filePreviewUrl="{{ $this->thumbnailPreview }}" />
    @if ($oldThumbnail)
        <div class="w-fit">
            <x-input-toggle id="publish" model="removeThumbnail" label="Hapus thumbnail" toggleLocation="left" />
        </div>
    @endif
    <div class="space-y-1">
        <div class="">Konten</div>
        <x-trix id="konten" :value="$konten" />
    </div>
    <div class="w-fit">
        <x-input-toggle id="publish" model="isPublish" label="Publikasikan artikel" toggleLocation="left" />
    </div>
    <x-button type="submit" target="save" icon="{{ $isPublish ? 'send' : 'save' }}"
        text="{{ $isPublish ? 'Publikasikan' : 'Simpan' }}"
        textLoading="{{ $isPublish ? 'Mempublikasikan' : 'Menyimpan' }}..." />
</form>
