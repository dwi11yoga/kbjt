<?php

use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Request;

new class extends Component {
    //
    #[Validate('required|min:3')]
    public $keyword;
    public function search()
    {
        $this->validate();
        return redirect()->to('/cari?keyword=' . $this->keyword);
    }
    public function mount()
    {
        $this->keyword = $_REQUEST['keyword'] ?? null;
    }
};
?>

<form wire:submit='search' class="relative">
    <label for="keyword"
        class="lg:w-96 w-full flex items-center justify-between gap-2 px-5 py-2.5 bg-neutral-100 dark:bg-zinc-800 rounded-full hover:outline focus-within:outline outline-2 outline-amber-400">
        <input wire:model.live.debounce.500ms='keyword' name="keyword" id="keyword" type="text"
            class="w-full bg-transparent focus:outline-none" placeholder="Cari...">
        <button type="submit" class="text-neutral-500 hover:text-amber-400" title="Cari">
            <i data-lucide='search' class="size-5"></i>
        </button>
    </label>
    @error('keyword')
        <div class="absolute translate-y-1 text-xs text-red-500 bg-red-100 rounded-full px-2 py-1 text-nowrap" title="{{ $message }}">
            {{ $message }}</div>
    @enderror
</form>
