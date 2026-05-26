<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use App\Models\Definisi;

new class extends Component {
    //
    use WithPagination;
    public $user;

    // ambil data definisi pengguna
    #[Computed]
    public function definitions()
    {
        $definisi = Definisi::where('user_id', $this->user->id);

        // jika user bukan user yang sedang login, maka sembunyikan definisi yang disembunyikan karena hukuman
        // tampilkan jika definisi==null || hukuman edit bukan 1
        if (isset(Auth::user()->id) && Auth::user()->id != $this->user->id) {
            $definisi = $definisi->where(function ($query) {
                $query->whereNull('hukuman_edit')->orWhere('hukuman_edit', '!=', 1);
            });
        }

        $definisi = $definisi->with('pengurus')->orderBy('updated_at', 'desc')->paginate(10);
        return $definisi;
    }
};
?>

{{-- Definisi --}}
<div class="space-y-2">
    @if (!$this->definitions->isEmpty())
        @foreach ($this->definitions as $definition)
            {{-- @include('partials.definisi') --}}
            <livewire:word-definition :wordDefinition="$definition" :author="$user" :showWord="true" />
        @endforeach
    @else
        <x-errors.not-found text="Belum ada definisi yang ditambahkan oleh pengguna." />
    @endif
    <div class="pt-5">
        {{ $this->definitions->links() }}
    </div>
</div>
