<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Models\Blog;

new class extends Component {
    use WithPagination;

    public $user;
    #[Computed]
    public function articles()
    {
        // dapatkan daftar artikel by user
        if ($this->user->role != 'pengurus') {
            return [];
        }
        $posts = Blog::select('id', 'judul', 'slug', 'konten', 'user_id', 'status', 'updated_at', 'thumbnail') //
            ->where('user_id', '=', $this->user->id)
            ->whereNotNull('status')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        // ->paginate(10, ['*'], 'artikel-page')
        // ->appends(request()->query());
        return $posts;
    }
};
?>

{{-- Artikel --}}
<div class="space-y-2">
    {{-- {{ $user->role }} --}}
    @if (count($this->articles) == 0)
        <x-errors.not-found text="Belum ada artikel yang ditulis oleh pengguna." />
    @else
        @foreach ($this->articles as $d)
            {{-- @include('partials.artikel-list') --}}
            <x-article-item slug="{{ $d->slug }}" author="{{ $user->nama }}" title="{{ $d->judul }}"
                image="{{ $d->thumbnail }}" :desc="$d->konten" :datetime="$d->updated_at" />
        @endforeach

        {{-- paginate --}}
        <div class="py-5">
            {{ $this->articles->links() }}
        </div>
    @endif
</div>
