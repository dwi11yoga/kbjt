<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Achievement;
use Carbon\Carbon;

new class extends Component {
    //
    #[Computed]
    public function achievements()
    {
        // Achievement
        $achieved = auth()->user()->achievement ?? [];
        $achievement = Achievement::whereIn('id', array_keys($achieved))->limit(4)->get();
        foreach ($achievement as $d) {
            $d->date_achieved = Carbon::parse($achieved[$d->id])->timezone('Asia/Jakarta');
        }
        $achievement = $achievement->sortByDesc('date_achieved')->take(4); //urutkan achievement
        return $achievement;
    }
};
?>

{{-- achievement --}}
<div class="space-y-2">
    {{-- title --}}
    <div class="flex items-center justify-between">
        <div class="">Achievement</div>
        <a href="/achievement" title="Pergi ke halaman achievement"
            class="text-sm flex items-center hover:underline decoration-4 underline-offset-4 decoration-amber-400">
            <div class="">Lebih lengkap</div>
            <i data-lucide='arrow-right' class="size-4"></i>
        </a>
    </div>
    {{-- daftar achievement terbaru yang didapatkan --}}
    <div class="space-x-3 flex overflow-x-auto overflow-y-hidden p-1">
        @foreach ($this->achievements as $d)
            <a href="#"
                class="md:w-2/5 w-1/2 md:min-w-0 min-w-52 bg-neutral-100 rounded-xl p-4 h-44 flex justify-start items-end hover:outline hover:outline-amber-400">
                <div class="">
                    <div class="max-w-12 max-h-12 overflow-hidden rounded-md">
                        <img alt="icon" class="object-cover w-full h-full"
                            src="{{ asset('storage/' . $d->emblem) }}">
                    </div>
                    <div>{{ $d->nama }}</div>
                    <p class="text-xs line-clamp-1">{{ $d->deskripsi }}</p>
                </div>
            </a>
        @endforeach
    </div>
</div>
