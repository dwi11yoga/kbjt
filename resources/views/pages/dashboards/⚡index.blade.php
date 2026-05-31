<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

new class extends Component {
    #[Layout('layouts.dashboard')]
    #[Title('Dashboard')]
    public $lorem;
};
?>

<div class="space-y-2">
    {{-- alert --}}
    <livewire:dashboard.alert />

    {{-- iklan atas --}}
    <livewire:ad id="7" />

    {{-- overview --}}
    <livewire:dashboard.overview />

    {{-- stat pengguna --}}
    @if (auth()->user()->role === 'kontributor' || auth()->user()->role === 'pengurus')
        <livewire:dashboard.user-stats />
    @endif

    {{-- stat website --}}
    @if (auth()->user()->role === 'pengurus' || auth()->user()->role === 'kepala')
        <livewire:dashboard.web-stats />
    @endif

    {{-- achievement --}}
    @if (auth()->user()->role != 'kepala' && isset(auth()->user()->achievement))
        <livewire:dashboard.achievement />
    @endif

    {{-- Sertifikat, dukung, ajak teman --}}
    <div class="space-y-2">
        <div class="">Sertifikat & komunitas</div>
        <div class="gap-2 grid md:grid-cols-3 grid-cols-2">
            {{-- Sertifikat --}}
            @if (auth()->user()->role != 'kepala')
                <a href="/sertifikat">
                    <x-bento-item padding="">
                        <div class="overflow-hidden w-full h-24 rounded-t-xl top-0">
                            <img class="object-cover w-full h-full"
                                src="https://img.freepik.com/free-vector/completed-concept-illustration_114360-31751.jpg"
                                alt="Completed concept illustration (freepik/storyset)">
                        </div>
                        <div class="p-4">
                            <div>Dapatkan sertifikat</div>
                            <p class="text-xs">Dapatkan penghargaan atas kontribusimu dalam melestarikan Bahasa Jawa!
                            </p>
                        </div>
                    </x-bento-item>
                </a>
            @endif

            {{-- Ajak teman --}}
            <a href="/dukung#bagikan">
                <x-bento-item padding="">
                    <div class="overflow-hidden w-full h-24 rounded-t-xl top-0">
                        <img class="object-cover w-full h-full"
                            src="https://img.freepik.com/free-vector/collective-hug-concept-illustration_114360-19747.jpg"
                            alt="Collective hug concept illustration (freepik/storyset)">
                    </div>
                    <div class="p-4">
                        <div>Ajak teman</div>
                        <p class="text-xs">Ajak temanmu untuk berkontribusi dalam melestarikan Bahasa Jawa.</p>
                    </div>
                </x-bento-item>
            </a>

            {{-- dukung --}}
            {{-- <a href="/dukung">
                <x-bento-item padding="">
                    <div class="overflow-hidden w-full h-24 rounded-t-xl top-0">
                        <img class="object-cover w-full h-full"
                            src="https://img.freepik.com/free-vector/team-work-concept-illustration_114360-28760.jpg"
                            alt="Team work concept illustration by storyset">
                    </div>
                    <div class="p-4">
                        <div>Beri dukungan</div>
                        <p class="text-xs">
                            Setiap dukungan yang kamu berikan berdampak langsung pada kelestarian BahasaJawa.
                        </p>
                    </div>
                </x-bento-item>
            </a> --}}
        </div>
    </div>

</div>
