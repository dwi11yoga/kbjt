<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use App\Models\User;
use App\Models\Definisi;
use App\Models\Report;
use Illuminate\Database\QueryException;

new class extends Component {
    // set data dari parent
    public $wordDefinition,
        $showWord = false,
        $author,
        $highlight = false;

    // status popup
    public $openReport = false,
        $openShare = false,
        $openVerify = false,
        $openEdit = false,
        $openDelete = false;

    // set jumlah upvote & downvote
    public $upvotes, $downvotes;
    public function mount()
    {
        $this->upvotes = $this->wordDefinition->upvotes ?? [];
        $this->downvotes = $this->wordDefinition->downvotes ?? [];
        // dd($this->upvotes, $this->downvotes, $this->totalVotes);
    }

    #[Computed]
    public function totalVotes()
    {
        return count($this->upvotes) - count($this->downvotes);
    }

    // vote
    public function vote(bool $isUpvote)
    {
        // cek apakah pengguna sudah login
        if (!auth()->check()) {
            return redirect()->to('/masuk')->with('failed', 'Silahkan masuk terlebih dahulu');
        }
        $userId = auth()->user()->id;

        $upvotes = $this->upvotes;
        $downvotes = $this->downvotes;

        // apakah pengguna upvote/downvote
        if ($isUpvote) {
            // cek apakah pengguna sudah like/belum
            if (!in_array($userId, $upvotes)) {
                // jika tidak ditemukan, maka tambah pengguna pada daftar
                array_push($upvotes, $userId);
            } else {
                // jika ditemukan, maka hapus pengguna dari daftar
                $upvotes = array_diff($upvotes, [$userId]);
            }
            // cek apakah pengguna sudah downvote/belum
            // jika ditemukan, maka hapus pengguna dari daftar downvotes
            if (in_array($userId, $downvotes)) {
                $downvotes = array_diff($downvotes, [$userId]);
            }
        } else {
            // cek apakah pengguna sudah downvote/belum
            if (!in_array($userId, $downvotes)) {
                // jika tidak ditemukan, maka tambah pengguna pada daftar
                array_push($downvotes, $userId);
            } else {
                // jika ditemukan, maka hapus pengguna dari daftar
                $downvotes = array_diff($downvotes, [$userId]);
            }
            // cek apakah pengguna sudah upvote/belum
            // jika ditemukan, maka hapus pengguna dari daftar downvotes
            if (in_array($userId, $upvotes)) {
                $upvotes = array_diff($upvotes, [$userId]);
            }
        }

        // simpan perubahan
        try {
            Definisi::find($this->wordDefinition->id)->update(['upvotes' => $upvotes, 'downvotes' => $downvotes]);
            $this->upvotes = $upvotes;
            $this->downvotes = $downvotes;
        } catch (QueryException $err) {
            $this->dispatch('notify', message: 'Gagal melakukan voting, coba lagi', type: 'failed');
        }
    }

    // listen dispatch dari child untuk menutup popup
    // key=mendengarkan dispatch
    // value=function yang akan dijalankan
    protected $listeners = ['closeDelete' => 'closeDelete', 'closeVerify' => 'closeVerify', 'closeReport' => 'closeReport'];
    public function closeDelete()
    {
        $this->openDelete = false;
    }
    public function closeVerify()
    {
        $this->openVerify = false;
    }
    public function closeReport()
    {
        $this->openReport = false;
    }
    public function closeEdit()
    {
        $this->openEdit = false;
    }
};
?>

{{-- @props(['wordDefinition', 'showWord' => false, 'author', 'highlight' => false]) --}}
<div
    class="rounded-2xl p-5 border border-neutral-200 dark:border-zinc-800 space-y-3 {{ $highlight ? 'bg-amber-50 dark:bg-zinc-800' : 'bg-white dark:bg-zinc-900' }}
        {{ isset($wordDefinition->selected) && $wordDefinition->selected == 1
            ? 'outline outline-2 outline-amber-500 hover:outline-amber-400'
            : 'hover:outline hover:outline-2 hover:outline-amber-400' }}
        ">
    {{-- Author --}}
    <div class="flex justify-between">
        <a href="{{ !empty($author) ? '/u/' . $author->username : '#' }}" class="flex gap-2 items-center group">
            <x-avatar avatarUrl="{{ $author->profile_pic }}" size="8" />
            <div class="flex gap-1 items-center">
                <div class="group-hover:underline underline-offset-4 decoration-amber-400 decoration-4">
                    {{ $author->nama }} {{ $author->trashed() ? '[Akun dihapus]' : '' }}
                    {{ auth()->user() && auth()->user()->username == $author->username ? '(Anda)' : '' }}</div>
                <div class="text-sm"> · {{ dateFormat($wordDefinition->edited_at) }}</div>
            </div>
        </a>

        {{-- Menu --}}
        @if (auth()->check() && isset($author->username)) {{-- sembunyikan jika tidak ada $wordDefinition->menu (untuk halaman laporan) --}}
            <x-menu-group menuIcon="more-horizontal" menuId="dropdown{{ $wordDefinition->id }}">
                {{-- edit --}}
                @if ($wordDefinition->user_id == auth()->user()->id)
                    <x-menu-item type="url" action="/definisi/{{ $wordDefinition->id }}/edit" name="Edit"
                        icon="pencil" />
                @endif
                {{-- verifikasi --}}
                @if (auth()->check() && auth()->user()->role == 'pengurus' && $wordDefinition->user_id !== auth()->user()->id)
                    <x-menu-item type="button" action='$toggle("openVerify")'
                        name="{{ empty($wordDefinition->verifikasi) ? 'Verifikasi' : 'Unverifikasi' }}"
                        icon="check-circle" />
                @endif
                {{-- bagikan --}}
                <x-menu-item type="button" action='$toggle("openShare")' name="Bagikan" icon="share-2" />
                {{-- hapus --}}
                @if ($wordDefinition->user_id == auth()->user()->id)
                    <x-menu-item type="button" action='$toggle("openDelete")' name="Hapus" icon="trash"
                        textColor="text-red-500" />
                @endif
                {{-- laporkan --}}
                @if ($wordDefinition->user_id != auth()->user()->id)
                    <x-menu-item type="button" action='$toggle("openReport")' name="Laporkan"
                        icon="flag-triangle-right" textColor="text-red-500" />
                @endif
            </x-menu-group>
        @endif

    </div>

    {{-- Kosakata --}}
    @if ($showWord)
        <h5 class="font-semibold capitalize pt-3">
            <a class="hover:underline underline-offset-4 decoration-amber-400 decoration-4"
                href="/kosakata/{{ Str::slug($wordDefinition->kosakata) }}">{{ $wordDefinition->kosakata }}</a>
        </h5>
    @endif

    {{-- Definisi --}}
    <p class="mb-3">{!! $wordDefinition->definisi !!}</p>

    {{-- <div class="border-t"></div> --}}

    {{-- aksi --}}
    <div class="flex justify-between items-center">
        {{-- vote --}}
        <div
            class="rounded-full p-1 flex items-center {{ auth()->check() && in_array(auth()->user()->id, $upvotes ?? []) ? 'bg-green-100 dark:bg-green-900' : (auth()->check() && in_array(auth()->user()->id, $downvotes ?? []) ? 'bg-red-100 dark:bg-red-900' : 'hover:bg-neutral-100 dark:hover:bg-zinc-800') }} w-fit border border-neutral-100 dark:border-zinc-800 hover:border-neutral-200">
            <div
                class="p-2 ml-1 font-bold text-xs {{ $this->totalVotes < 0 ? 'text-red-600 dark:text-red-200' : '' }}">
                {{ $this->totalVotes }}</div>
            <div class="">
                <button wire:click='vote(true)'
                    class="rounded-full p-2 hover:bg-green-200 dark:hover:bg-green-100 group">
                    <i data-lucide='arrow-big-up'
                        class="size-4 {{ auth()->check() && in_array(auth()->user()->id, $upvotes ?? []) ? 'dark:fill-green-300 fill-green-700 dark:stroke-green-300 stroke-green-700' : 'group-hover:fill-green-500 group-hover:stroke-green-500' }}"></i>
                </button>
                <button wire:click='vote(false)' class="rounded-full p-2 hover:bg-red-200 dark:hover:bg-red-100 group">
                    <i data-lucide='arrow-big-down'
                        class="size-4 {{ auth()->check() && in_array(auth()->user()->id, $downvotes ?? []) ? 'dark:fill-red-300 fill-red-700 dark:stroke-red-300 stroke-red-700' : 'group-hover:fill-red-500 group-hover:stroke-red-500' }}"></i>
                </button>
            </div>
        </div>
        {{-- keterangan --}}
        <div class="flex w-fit justify-between">
            @if ($wordDefinition->hukuman_edit)
                {{-- tampilkan jika definisi perlu diedit --}}
                <x-badge color="bg-red-200 dark:text-neutral-800" hoverColor="" gap="1">
                    <i data-lucide='eye-off' class="size-4"></i>
                    <div class="">Disembunyikan: perlu diperbaiki</div>
                </x-badge>
            @elseif (isset($author->role) && $author->role == 'pengurus')
                <x-badge color="bg-amber-200 dark:text-neutral-800" gap="1">
                    <i data-lucide='user-round-key' class="size-4"></i>
                    <div class="md:block hidden">Terverifikasi</div>
                </x-badge>
            @elseif (isset($wordDefinition->verifikasi))
                <x-badge color="bg-amber-200 dark:text-neutral-800" gap="1">
                    <i data-lucide='badge-check' class="size-5"></i>
                    <div class="md:block hidden">Terverifikasi</div>
                </x-badge>
            @endif
        </div>
    </div>

    {{-- popup laporkan --}}
    @if ($openReport)
        <livewire:definition.report :author="$author" :definition="$wordDefinition" />
    @endif

    {{-- popup bagikan --}}
    @if ($openShare)
        <x-definition.share :definition="$wordDefinition" />
    @endif

    {{-- verifikasi definisi --}}
    @if ($openVerify)
        <livewire:definition.verify :definition="$wordDefinition" :author="$author" />
    @endif

    {{-- hapus --}}
    @if ($openDelete)
        <livewire:definition.delete :definition="$wordDefinition" closeStatusVariable="openDelete" />
    @endif
</div>
