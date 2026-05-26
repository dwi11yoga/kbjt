<?php

use Livewire\Component;
use App\Models\Banner; // ad
use Livewire\Attributes\Computed;

new class extends Component {
    public $id;
    #[Computed]
    public function ad()
    {
        return Banner::find($this->id);
    }
};
?>

{{-- jika data ada, status diisi, dan gambar juga diisi --}}
<div class="">
    @if (!empty($this->ad) && !empty($this->ad->status) && isset($this->ad->img))
        <div class="rounded-xl bg-gray-200 w-full overflow-hidden relative">
            <a href="{{ $this->ad->url ?? '#' }}" title="{{ $this->ad->hover_title }}" target="_blank">
                <img src="{{ asset('storage/' . $this->ad->img) }}" alt="Banner {{ $id }}" class="w-full h-full">
            </a>
            {{-- jika keterangan iklan ditampilkan --}}
            @if ($this->ad->iklan == 1)
                <div class="absolute top-2.5 right-2.5 text-xs bg-black bg-opacity-30 text-white  px-2 py-1 rounded-md">
                    Ad
                </div>
            @endif
        </div>
    @endif
</div>
