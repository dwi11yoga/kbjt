<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use App\Models\Definisi;

new class extends Component {
    use WithPagination;
    //
    public $word;
    #[Url]
    public $lang;
    #[Url]
    public $id;

    // jumlah definisi
    public int $definitionCount, $verifiedCount;

    public function render()
    {
        // hitung jumlah definisi dan definisi terverifikasi
        $definitionCount = Definisi::where('kosakata', $this->word)->count();
        $verifiedCount = Definisi::where('kosakata', $this->word)->whereNotNull('verifikasi')->count();
        $this->definitionCount = $definitionCount;
        $this->verifiedCount = $verifiedCount;

        // alihkan ke hal. 404 jika kosakata tidak ditemukan
        if ($definitionCount == 0) {
            abort(404, 'Kosakata tidak ditemukan');
        }

        // judul dinamis
        return $this->view()->title(ucfirst($this->word));
    }

    #[Computed]
    public function definitions()
    {
        // dapatkan data definisi
        $definitions = Definisi::with('user') //
            ->where('kosakata', $this->word);
        // jika filter bahasa digunakan
        if (!empty($this->lang)) {
            $definitions = $definitions->where('bahasa', $this->lang);
        }
        // jika id ada, maka tampilkan dulu
        if ($this->id) {
            $definitions = $definitions->orderByRaw('id=? DESC', $this->id);
        }
        $definitions = $definitions->paginate(20);
        return $definitions;
    }

    // rekomendasi kosakata random
    #[Computed]
    public function moreWords()
    {
        return Definisi::distinct('kosakata') //
            ->inRandomOrder()
            ->limit(12)
            ->pluck('kosakata');
    }
};
?>

<div class="space-y-5">
    {{-- judul / nama kata --}}
    <div class="py-10 space-y-2">

        <div class="">
            <div class="flex items-center gap-2">
                <h1 class="font-bold text-4xl">
                    {{ ucwords($word) }}
                </h1>
                <div class="flex">
                    <button wire:ignore class="hover:bg-neutral-100 rounded-full p-2">
                        <i data-lucide='volume-2' class="size-5"></i>
                    </button>
                    <a href="#share" wire:ignore class="hover:bg-neutral-100 rounded-full p-2">
                        <i data-lucide='share-2' class="size-5"></i>
                    </a>
                </div>
            </div>
            <div wire:ignore class="text-neutral-600 flex items-center gap-1">
                <div class="javanese" id="aksara-text"></div>
                <button onclick="toggleClass('aksara-disclaimer', 'hidden')" wire:ignore
                    class="hover:bg-neutral-100  text-neutral-500 rounded-full p-1">
                    <i data-lucide='circle-question-mark' class="size-4"></i>
                </button>
                <script>
                    window.addEventListener("load", function() {
                        document.getElementById('aksara-text').innerText = convertToJavanese("{{ $word }}");
                    })
                </script>
            </div>
        </div>

        <div class="text-neutral-600 text-sm">
            {{ $definitionCount }} Definisi
            {{ $verifiedCount != 0 ? '· ' . $verifiedCount . ' Terverifikasi' : '' }}
        </div>

        {{-- disclaimer penulisan aksara jawa --}}
        <div id="aksara-disclaimer" class="bg-amber-50  text-amber-700 py-2 px-3 rounded-md w-fit hidden">
            <i data-lucide='triangle-alert' class="size-5 inline-block"></i>
            Aksara Jawa di-generate secara otomatis. Kesalahan penulisan mungkin terjadi.
        </div>
    </div>

    <div class="space-y-2">
        <div class="flex gap-1 items-center pb-2">
            <button onclick="toggleClass('newdefinition', 'hidden')"
                class="w-full bg-neutral-100 hover:bg-amber-400 py-3 px-5 rounded-full flex items-center gap-2">
                <i data-lucide='plus' class="size-5"></i>
                Tambah definisi
            </button>
            <div wire:ignore class="relative">
                <label for="lang" class="absolute top-3 left-4">
                    <i data-lucide='languages' class="size-5 my-0.5"></i>
                </label>
                <select wire:model.live='lang' name="lang" id="lang"
                    onchange="this.style.width = this.options[this.selectedIndex].text.length + 7 + 'ch'"
                    class="bg-neutral-100 hover:bg-amber-400 rounded-full py-3 px-5 pl-10 flex gap-1 items-center group transition-all ease-in-out appearance-none cursor-pointer">
                    <option class="bg-white" value="">Semua bahasa</option>
                    <option class="bg-white" value="id">Bahasa Indonesia</option>
                    <option class="bg-white" value="jw">Basa Jawa</option>
                    {{-- <div class="group-hover:block group-focus:block hidden">Semua bahasa</div>  --}}
                </select>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const langSelect = document.getElementById('lang');
                        langSelect.style.width = langSelect.options[langSelect.selectedIndex].text.length + 7 + 'ch';
                    })
                </script>
            </div>
            <div wire:ignore class="relative">
                <label for="lang" class="absolute top-3 left-4">
                    <i data-lucide='arrow-down-wide-narrow' class="size-5 my-0.5"></i>
                </label>
                <select wire:model.live='sort' name="sort" id="sort"
                    onchange="this.style.width = this.options[this.selectedIndex].text.length + 7 + 'ch'"
                    class="bg-neutral-100 hover:bg-amber-400 rounded-full py-3 px-5 pl-10 flex gap-1 items-center group transition-all ease-in-out appearance-none cursor-pointer">
                    <option class="bg-white" value="terbaru">Terbaru</option>
                    <option class="bg-white" value="terlama">Terlama</option>
                    <option class="bg-white" value="terpopuler">Terpopuler</option>
                    {{-- <div class="group-hover:block group-focus:block hidden">Semua bahasa</div>  --}}
                </select>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const sortSelect = document.getElementById('sort');
                        sortSelect.style.width = sortSelect.options[sortSelect.selectedIndex].text.length + 7 + 'ch';
                    })
                </script>
            </div>
        </div>
        {{-- form tambah definisi --}}
        {{-- @if ($showForm == true) --}}
        <div id="newdefinition" class="hidden">
            <livewire:new-definition word="{{ $word }}" />
        </div>
        {{-- @endif --}}
        {{-- iklan atas --}}
        @if (count($this->definitions) >= 10)
            <livewire:ad id="3" />
        @endif
        {{-- deskripsi kosakata --}}
        @foreach ($this->definitions as $definition)
            <livewire:word-definition :wordDefinition="$definition" :author="$definition->user" :highlight="$id == $definition->id ? true : false" />
        @endforeach
        {{-- iklan --}}
        @if (count($this->definitions) >= 10)
            <livewire:ad id="4" />
        @endif
    </div>


    <x-share id="share" title="Bagikan Kosakata"
        desc="
Temukan kosakata ini bermanfaat? Bagikan kepada rekan, keluarga, atau siapa pun yang ingin turut mengenal dan melestarikan kekayaan Bahasa Jawa."
        shareText="Cek arti kosakata {{ $word }} di {{ env('APP_NAME') }} sekarang juga!" />

    {{-- kosakata lainnya --}}
    <div class="space-y-5">
        <h2 class="font-semibold">Lihat juga</h2>
        <div class="grid md:grid-cols-3 grid-cols-2 gap-2">
            @foreach ($this->moreWords as $word)
                <x-word-item word="{{ ucfirst($word) }}" url="{{ $word }}" />
                {{-- <a href="/kosakata/{{ $word }}" class="">{{ $word }}</a> --}}
            @endforeach
        </div>
    </div>
</div>
