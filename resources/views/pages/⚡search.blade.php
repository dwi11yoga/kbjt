<?php

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use App\Models\Definisi;
use App\Models\Blog;
use App\Models\User;

new class extends Component {
    //
    use WithPagination;
    #[Url]
    public $keyword;
    #[Url]
    public $filter = 'semua';

    #[Computed]
    public function words()
    {
        if ($this->filter !== 'kosakata' && $this->filter !== 'semua') {
            return [];
        }
        $words = Definisi::distinct('kosakata')->where('kosakata', 'like', '%' . $this->keyword . '%');
        if ($this->filter === 'semua') {
            $words = $words
                ->limit(10)
                ->get()
                ->map(function ($item) {
                    $item->count = Definisi::where('kosakata', $item->kosakata)->count();
                    return $item;
                });
        }
        if ($this->filter == 'kosakata') {
            $words = $words->paginate(10)->through(function ($item) {
                $item->count = Definisi::where('kosakata', $item->kosakata)->count();
                return $item;
            });
        }
        return $words;
    }

    #[Computed]
    public function users()
    {
        if ($this->filter !== 'pengguna' && $this->filter !== 'semua') {
            return [];
        }
        $users = User::where('username', 'like', '%' . $this->keyword . '%')
            ->orWhere('nama', 'like', '%' . $this->keyword . '%')
            ->orderBy('poin', 'desc');
        if ($this->filter === 'semua') {
            $users = $users->limit(10)->get();
        }
        if ($this->filter == 'pengguna') {
            $users = $users->paginate(20);
        }

        // jika filter lain yang digunakan, kembalikan []
        return $users;
    }
    #[Computed]
    public function articles()
    {
        if ($this->filter == 'artikel' || $this->filter === 'semua') {
            $articles = Blog::select('id', 'judul', 'slug', 'user_id', 'thumbnail', 'status', 'konten', 'updated_at')
                ->with('user:id,username,nama,jenis_kelamin,profile_pic')
                ->whereNotNull('status')
                ->where('judul', 'like', '%' . $this->keyword . '%')
                ->orderBy('updated_at', 'desc');
        }
        // jika menampilkan semua, maka jangan paginate
        if ($this->filter === 'semua') {
            $articles = $articles->limit(10)->get();
        }
        if ($this->filter == 'artikel') {
            $articles = $articles->paginate(20);
            return $articles;
        }
        // jika filter lain yang digunakan, kembalikan []
        return $articles ?? [];
    }
};
?>

<div class="">
    {{-- header --}}
    <div class="space-y-10">
        {{-- header --}}
        <div class="space-y-5">
            <h1>Hasil Pencarian</h1>
            {{-- kolom pencarian (untuk tampilan mobile) --}}
            <div class="lg:hidden">
                <livewire:search />
            </div>

            {{-- filter --}}
            <div class="flex gap-1 overflow-x-auto">
                <div class="">
                    <input type="radio" wire:model.live='filter' name="filter" id="filter-semua" value="semua"
                        class="peer hidden">
                    <label for="filter-semua"
                        class="px-5 py-2 border border-neutral-200 rounded-full flex gap-1 items-center cursor-pointer peer-checked:bg-amber-400">
                        <i data-lucide='layers' class="size-5"></i>
                        Semua
                    </label>
                </div>
                <div class="">
                    <input type="radio" wire:model.live='filter' name="filter" id="filter-kosakata" value="kosakata"
                        class="peer hidden">
                    <label for="filter-kosakata"
                        class="px-5 py-2 border border-neutral-200 rounded-full flex gap-1 items-center cursor-pointer peer-checked:bg-amber-400">
                        <i data-lucide='message-circle-more' class="size-5"></i>
                        Kosakata
                    </label>
                </div>
                <div class="">
                    <input type="radio" wire:model.live='filter' name="filter" id="filter-pengguna" value="pengguna"
                        class="peer hidden">
                    <label for="filter-pengguna"
                        class="px-5 py-2 border border-neutral-200 rounded-full flex gap-1 items-center cursor-pointer peer-checked:bg-amber-400">
                        <i data-lucide='users' class="size-5"></i>
                        Pengguna
                    </label>
                </div>
                <div class="">
                    <input type="radio" wire:model.live='filter' name="filter" id="filter-artikel" value="artikel"
                        class="peer hidden">
                    <label for="filter-artikel"
                        class="px-5 py-2 border border-neutral-200 rounded-full flex gap-1 items-center cursor-pointer peer-checked:bg-amber-400">
                        <i data-lucide='file-text' class="size-5"></i>
                        Artikel
                    </label>
                </div>
            </div>
        </div>

        {{-- jika keyword kosoong --}}
        @if ($this->keyword == null)
            <div
                class="p-12 rounded-2xl flex justify-center items-center text-center flex-col shadow-sm border border-neutral-200 w-full">
                <img src="https://img.freepik.com/free-vector/children-looking-concept-illustration_114360-21682.jpg"
                    alt="Lost concept illustration (Freepik/storyset)" class="w-56 mb-5">
                <div>Silakan ketik kata kunci untuk memulai pencarian</div>
            </div>
        @endif

        {{-- Jika tidak ada data --}}
        @if (count($this->words) == 0 && count($this->users) == 0 && count($this->articles) == 0)
            <?php
            $notFound = 'Pencarian dengan kata kunci "' . $this->keyword . '" tidak ditemukan.';
            ?>
            @include('partials.not-found')
        @endif

        {{-- hasil pencarian --}}
        @if ($this->keyword != null)
            <div class="space-y-5">
                {{-- tampilkan kosakata --}}
                @if (count($this->words) != 0)
                    <div class="space-y-5">
                        @if ($filter == 'semua')
                            <h2 class="">Kosakata</h2>
                        @endif
                        <div class="space-y-2">
                            @foreach ($this->words as $word)
                                <x-word-item word="{{ ucfirst($word->kosakata) }}" desc="{{ $word->count }} definisi"
                                    url="{{ $word->kosakata }}" />
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- pengguna --}}
                @if (count($this->users) != 0)
                    <div class="space-y-5">
                        @if ($filter == 'semua')
                            <h2>Pengguna</h2>
                        @endif
                        <div class="space-y-2">
                            @foreach ($this->users as $user)
                                <x-user-item name="{{ $user->nama }}" username="&commat;{{ $user->username }}"
                                    level="{{ $user->level }}" avatar="{{ $user->profile_pic }}" />
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Artikel --}}
                @if (count($this->articles) != 0)
                    <div class="space-y-5">
                        @if ($filter == 'semua')
                            <h2 class="">Artikel</h2>
                        @endif
                        <div class="space-y-2">
                            @foreach ($this->articles as $article)
                                <x-article-item slug="{{ $article->slug }}" title="{{ $article->judul }}"
                                    image="{{ $article->thumbnail }}" author="{{ $article->user->nama }}"
                                    :desc="$article->konten" :datetime="$article->updated_at" />
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- paginate --}}
                <div>
                    {{-- kosakata --}}
                    @if (!empty($this->words) && $filter == 'kosakata')
                        {{ $this->words->links() }}
                    @endif
                    {{-- user --}}
                    @if (!empty($this->users) && $filter == 'kosakata')
                        {{ $this->users->links() }}
                    @endif
                    {{-- artikel --}}
                    @if (!empty($this->articles) && $filter == 'kosakata')
                        {{ $this->articles->links() }}
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
