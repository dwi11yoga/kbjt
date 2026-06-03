<?php

use Livewire\Component;
use App\Models\Report;
use Livewire\Attributes\Computed;

new class extends Component {
    public $terlaporId;
    // riwayat hukuman
    #[Computed]
    public function history()
    {
        // dapatkan data
        return Report::with([
            'definisi' => function ($query) {
                $query->withTrashed();
            },
        ])
            ->with('user:username,nama,id')
            ->whereNotNull('status')
            ->whereNotNull('hukuman')
            ->whereHas('definisi', function ($query) {
                $query->where('user_id', $this->terlaporId);
            })
            ->orderby('status', 'desc')
            ->limit(5)
            ->get();
    }
};
?>

{{-- riwayat hukuman --}}
<x-bento-item title="Riwayat hukuman terlapor">
    @if (!$this->history->isEmpty())
        @foreach ($this->history as $d)
            <div class="space-y-1">
                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        @if (!empty($d->definisi))
                            Definisi <span class="capitalize">{{ $d->definisi->kosakata }}</span>
                            ({{ $d->created_at->translatedFormat('d F Y') }})
                        @else
                            Kosakata {{ $d->kosakata->kosakata }}
                        @endif
                    </div>
                    <a href="/laporan/{{ $d->id }}" title="Lihat detail laporan"
                        class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                        Detail <i data-lucide='arrow-right' class="w-4"></i>
                    </a>
                </div>
            </div>
        @endforeach
    @else
        <x-errors.not-found text="Belum ada data" :border="false" />
    @endif
</x-bento-item>
