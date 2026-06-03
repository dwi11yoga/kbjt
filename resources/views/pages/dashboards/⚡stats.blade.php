<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

new class extends Component {
    #[Title('Statistik')]
    #[Layout('layouts.dashboard')]
    public $tahun;
};
?>

<div class="space-y-3">
    statistik nanti saja, pakai chart larapex
</div>
