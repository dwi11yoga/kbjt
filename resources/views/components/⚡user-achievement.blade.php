<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Achievement;
use Carbon\Carbon;

new class extends Component {
    public $user;

    #[Computed]
    public function achievements()
    {
        // dapatkan data achievement user (jika ada)
        if (empty($this->user->achievement)) {
            return [];
        }

        $achieved = $this->user->achievement;
        $achievement = Achievement::whereIn('id', array_keys($achieved))->get();
        // tambahkan kapan achievement tsb didapatkan
        foreach ($achievement as $d) {
            $d->achieved = 1;
            $d->progress = '100%';
            $d->date_achieved = Carbon::parse($achieved[$d->id]);
        }
        return $achievement;
    }
};
?>

{{-- Achivement --}}
<div class="">
    @if (empty($this->achievements))
        <x-errors.not-found text="Belum ada achievement yang diperoleh pengguna." />
    @else
        <div class="space-y-2">
            @foreach ($this->achievements as $achievement)
                <x-achievement-item :achievement="$achievement" />
            @endforeach
        </div>
    @endif
</div>
