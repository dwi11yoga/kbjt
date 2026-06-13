<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use App\Models\Blog;

new class extends Component {
    use WithFileUploads;
    #[Title('Buat artikel')]
    #[Layout('layouts.dashboard')]
    public $isPublish;
    public $judul, $subjudul, $slug, $thumbnail, $konten;

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
            $rules['slug'] = 'required|unique:blog,slug|string|regex:/^[a-z0-9-]+$/';
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

    // simpan artikel
    public function save($action = 'simpan')
    {
        // Validasi
        $this->validate();

        // set data yang akan disimpan
        $data = [
            'user_id' => Auth::user()->id,
            'judul' => $this->judul,
            'slug' => $this->slug,
            'subjudul' => $this->subjudul,
            'konten' => $this->konten,
            'status' => $this->isPublish ? now() : null,
            'edited_at' => now(),
        ];

        // simpan gambar
        if (isset($this->thumbnail)) {
            $data['thumbnail'] = $this->thumbnail->store('post-thumbnail', 'public');
        }

        // tambah poin pengurus yang mempublikasikan artikel
        if ($this->isPublish) {
            $data['poin'] = addPoint($data['user_id'], 'Publikasikan artikel');
        }

        // Simpan
        Blog::create($data);

        if ($this->isPublish) {
            // increment artikel dipublikasikan di statistik
            changeStat('artikel_dipublikasikan');

            // cek achievement author
            $userId = Auth::user()->id;
            // rule yang akan dicek achievementnya
            $rule = ['artikel', 'totalViewBlog', 'viewBlog'];

            //lakukan perulangan untuk cek achievement user
            foreach ($rule as $d) {
                achievement($userId, $d);
            }
            return redirect('/blog/' . $this->slug)->with('success', 'Artikel berhasil dipublikasikan (+' . $data['poin'] . ' poin)');
        } else {
            // redirect ke halaman edit
            $post = Blog::select('id', 'slug')->where('slug', '=', $this->slug)->first();
            return redirect('/artikel/edit/' . $post->id)->with('success', 'Artikel berhasil disimpan sebagai draf');
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
        filePreviewUrl="{{ isset($thumbnail) && !$errors->has('thumbnail') ? $thumbnail->temporaryUrl() : null }}" />
    <div class="space-y-1">
        <div class="">Konten</div>
        <x-trix id="konten" />
    </div>
    <div class="w-fit">
        <x-input-toggle id="publish" model="isPublish" label="Publikasikan artikel" toggleLocation="left" />
    </div>
    <x-button type="submit" target="save" icon="{{ $isPublish ? 'send' : 'save' }}"
        text="{{ $isPublish ? 'Publikasikan' : 'Simpan' }}" />
</form>
