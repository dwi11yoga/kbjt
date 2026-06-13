<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\Blog;

new class extends Component {
    use WithPagination;
    //
    #[Title('Artikel terbaru')]
    #[Computed]
    public function posts()
    {
        return Blog::whereNotNull('status') //
            ->with('user:id,nama')
            ->orderBy('pinned', 'desc')
            ->orderBy('updated_at', 'desc')
            ->paginate(20);
    }
};
?>

<div>
    <h3 class="mb-7 font-bold">Artikel Terbaru</h3>

    {{-- List artikel --}}
    <div class="space-y-3">

        {{-- Artikel --}}
        @foreach ($this->posts as $article)
            <x-article-item slug="{{ $article->slug }}" title="{{ $article->judul }}" image="{{ $article->thumbnail }}"
                author="{{ $article->user->nama }}" :desc="$article->konten" :datetime="$article->edited_at" :pinned="$article->pinned" />
        @endforeach

        {{-- Pagination --}}
        <div class="">
            {{ $this->posts->links() }}
        </div>
    </div>
</div>
