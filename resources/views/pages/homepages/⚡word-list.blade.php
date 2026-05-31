<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use App\Models\Definisi;

new class extends Component {
    //
    #[Title('Daftar kosakata')]
    #[Computed]
    public function words()
    {
        return Definisi::distinct('kosakata')
            ->whereLike('kosakata', $this->letter . '%')
            ->pluck('kosakata');
        // dd($coba);
    }

    // ubah kata pertama untuk dicari
    #[Url]
    public $letter = 'A';
    public function changeFirstLetter($newLetter)
    {
        $this->letter = $newLetter;
    }
};
?>

<div class="space-y-5">
    {{-- Judul --}}
    <h3 class="font-bold mb-7">Daftar Kosakata</h3>
    {{-- Dropdown huruf --}}
    <div class="space-y-1">
        @foreach (range('A', 'Z') as $d)
            <button wire:click='changeFirstLetter("{{ $d }}")' name="filter" value="{{ $d }}"
                class="py-2 px-4 {{ $letter == $d ? 'bg-amber-400 font-bold rounded-3xl font-serif' : 'border border-neutral-200 rounded-md' }} hover:bg-amber-300 ease-in-out transition-all">
                {{ $d }}
            </button>
        @endforeach
    </div>

    @if (count($this->words) == 0)
        <?php $notFound = "Belum ada data. <a href='/kosakata/buat' class='text-blue-500'>Tambahkan?</a>"; ?>
        @include('partials.not-found')
    @else
        <div class="grid grid-cols-3 gap-2">
            @foreach ($this->words as $word)
                <x-word-item word="{{ ucfirst($word) }}" url="{{ $word }}" />
            @endforeach
        </div>
    @endif
</div>
