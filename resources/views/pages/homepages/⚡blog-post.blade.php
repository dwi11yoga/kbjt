<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use App\Models\Blog;
use Illuminate\Http\Request;

new class extends Component {
    public $slug;
    // set Title
    public function render()
    {
        return $this->view()->title($this->article->judul);
    }

    // data artikel
    #[Computed]
    public function article()
    {
        $article = Blog::where('slug', $this->slug) //
            ->with('user:id,username,nama,jenis_kelamin,profile_pic')
            ->first();
        // cek apakah artikel adalah dokumentasi/tidak
        $potongJudul = substr($article->judul, 0, 12);
        $article->dokumentasi = $potongJudul == 'Dokumentasi:' ? true : false;
        return $article;
    }

    // rekomendasi artikel lain
    #[Computed]
    public function relatedArticles()
    {
        return Blog::with('user') //
            ->whereNotNull('status')
            ->where('id', '!=', $this->article->id)
            ->inRandomOrder()
            ->limit(6)
            ->get();
    }

    // url untuk fitur share
    public $url;
    public function mount(Request $request)
    {
        // JANGAN IZINKAN PENGGUNA MELIHAT PREVIEW JIKA BUKAN PENGURUS

        // set url saat ini
        $this->url = $request->fullUrl();

        // tambahkan view di database
        // cek apakah user sudah mengunjungi halaman tsb hari ini
        // jika user hari ini belum membaca artikel, naikkan view artikel (pakai cookie)
        if (!Cookie::has('artikel_' . $this->article->id) && !empty($this->article->status)) {
            // cek apakah user sudah mengunjungi artikel hari ini (cek ada/tidaknya cookie)
            Blog::find($this->article->id)->increment('view', 1); // naikkan view definis
            Cookie::queue('artikel_' . $this->article->id, true, 24 * 60); // buat cookie (kedaluarsa dalam 1 hari)
            $this->article->view = $this->article->view + 1;
        }
    }
};
?>

<div class="space-y-5">
    {{-- header --}}
    <div class="space-y-2">
        {{-- peringatan jika preview --}}
        @if (empty($this->article->status))
            <div
                class="bg-red-600 text-white w-full rounded-md py-3 uppercase inline-flex overflow-hidden justify-center font-semibold">
                @for ($i = 0; $i < 13; $i++)
                    <div class="mr-5">Preview</div>
                @endfor
            </div>
        @endif

        {{-- author --}}
        <a href="{{ $this->article->user ? '/u/' . $this->article->user->username : '#' }}"
            class="flex gap-1 items-center group">
            <x-avatar avatarUrl="{{ $this->article->user->profile_pic }}" size="6" />
            <div class="group-hover:underline decoration-4 decoration-amber-400">
                {{ $this->article->user->nama ?? '[Akun dihapus]' }}</div>
        </a>

        {{-- judul dan subjudul --}}
        <div class="space-y-1">
            {{-- Judul --}}
            <h3 class="font-bold leading-tight">{{ $this->article->judul }}</h3>
            {{-- subjudul --}}
            @isset($this->article->subjudul)
                <div class="text-neutral-600 dark:text-zinc-400 text-lg">{{ $this->article->subjudul }}</div>
            @endisset
        </div>

        {{-- Waktu --}}
        <div class="text-neutral-600 dark:text-zinc-400 inline-flex items-center space-x-3 md:text-base text-sm">
            <div class="flex space-x-1 items-center">
                <i data-lucide='calendar' class="size-5"></i>
                <span>{{ !empty($this->article->status) ? $this->article->status->translatedFormat('d F Y') : $this->article->updated_at->translatedFormat('d F Y') }}</span>
            </div>
            <div class="flex space-x-1 items-center">
                <i data-lucide='clock' class="size-5"></i>
                <span>{{ !empty($this->article->status) ? $this->article->status->format('h:i A') : $this->article->updated_at->format('h:i A') }}</span>
            </div>
            <div class="flex space-x-1 items-center">
                <i data-lucide='eye' class="size-5"></i>
                <span>{{ number_format($this->article->view, 0, ',', '.') ?? 0 }}x dilihat</span>
            </div>
        </div>
    </div>

    {{-- Thumbnail --}}
    @isset($this->article->thumbnail)
        <img alt="" class="object-cover w-full rounded-xl mb-5"
            src="{{ asset('storage/' . $this->article->thumbnail) }}">
    @endisset

    {{-- banner atas/banner 3 --}}
    <livewire:ad id="3" />

    {{-- Isi Blog --}}
    <div class="space-y-3 my-5 md:text-justify trix">
        {{-- <x-blog-style />  --}}
        {!! $this->article->konten !!}
    </div>

    {{-- jika artikel adalah dokumentasi --}}
    @if ($this->article->dokumentasi == true)
        <div class="w-full rounded-xl py-6 px-7 space-y-3 bg-amber-400 text-neutral-800">
            <div class="text-xl font-bold">
                <i data-lucide='book-text' class="inline-flex fill-white"></i>
                Lihat Dokumentasi Lain
            </div>
            <p>
                Temukan berbagai dokumentasi dan panduan penggunaan yang telah disediakan untuk membantu memahami fitur
                serta cara kerja Kamus Bahasa Jawa Terbuka secara menyeluruh. Jelajahi seluruh dokumentasi yang tersedia
                untuk mendapatkan pengalaman penggunaan yang lebih optimal.
            </p>
            <a href="/cari?keyword=dokumentasi%3A&filter=artikel">
                <button
                    class="p-3 mt-3 rounded-lg border-2 border-neutral-800 hover:bg-neutral-800 hover:text-white">Cek
                    sekarang
                    <i data-lucide='arrow-right' class="size-5 inline-flex"></i>
                </button>
            </a>
        </div>
    @endif


    {{-- banner bawah/banner 4 --}}
    <livewire:ad id="4" />

    @if (isset($this->article->status))
        {{-- bagikan --}}
        <x-share title="Bagikan ke teman"
            desc="Merasa artikel ini bermanfaat? Bagikan kepada rekan atau kerabat agar manfaatnya dapat dirasakan
                    oleh lebih banyak orang."
            shareText="Baca artikel {{ $this->article->judul }} di kbjt sekarang juga!" />
        {{-- artikel lain --}}
        @if (!empty($this->relatedArticles))
            <div class="pt-5 space-y-3">
                <div class="mb-3 font-semibold text-xl">Artikel lainnya</div>
                <div class="grid grid-cols-6 gap-2">
                    @foreach ($this->relatedArticles as $d)
                        <a href="/blog/post/{{ $d->slug }}"
                            class="md:col-span-2 col-span-3 overflow-hidden rounded-lg hover:outline outline-2 outline-amber-400 hover:bg-amber-100 dark:hover:text-neutral-800 group">
                            {{-- gambar --}}
                            <div class="aspect-video overflow-hidden rounded-md">
                                <img src="{{ asset(isset($d->thumbnail) ? 'storage/' . $d->thumbnail : 'img/no-image.png') }}"
                                    alt="Thumbnail" class="object-cover">
                            </div>
                            <div class="group-hover:px-2 py-2 space-y-1 transition-all ease-in-out">
                                {{-- judul --}}
                                <div class="line-clamp-2 font-bold">{{ $d->judul }}</div>
                                {{-- penulis --}}
                                <div class="text-sm opacity-80">Oleh <span
                                        class="font-semibold">{{ $d->user->nama }}</span></div>
                            </div>
                        </a>
                    @endforeach

                </div>
            </div>
        @endif
    @endif

</div>
