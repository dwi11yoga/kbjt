<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Definisi;
use Illuminate\Database\QueryException;

new class extends Component {
    // set data dari parent
    public $wordDefinition,
        $showWord = false,
        $author,
        $highlight = false;

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
    // report
};
?>

{{-- @props(['wordDefinition', 'showWord' => false, 'author', 'highlight' => false]) --}}
<div
    class="rounded-2xl p-5 border border-neutral-200 space-y-3 {{ $highlight ? 'bg-amber-50' : 'bg-white' }}
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
                    {{ $author->nama }}
                    {{ auth()->user() && auth()->user()->username == $author->username ? '(Anda)' : '' }}</div>
                <div class="text-sm"> · {{ dateFormat($wordDefinition->created_at) }}</div>
            </div>
        </a>

        {{-- Menu --}}
        @if (auth()->check() && isset($author->username)) {{-- sembunyikan jika tidak ada $wordDefinition->menu (untuk halaman laporan) --}}
            <div class="relative">
                <button onclick="toggleClass('dropdown{{ $wordDefinition->id }}', 'hidden')"
                    class="p-2 rounded-full hover:bg-neutral-100">
                    <i data-lucide='more-horizontal' class="size-5"></i>
                </button>
                <div id="dropdown{{ $wordDefinition->id }}"
                    class="absolute hidden bg-white right-0 top-10 z-40 p-2 rounded-xl border border-neutral-100 min-w-48 text-neutral-800">
                    <ul>
                        {{-- edit --}}
                        @if ($wordDefinition->user_id == auth()->user()->id)
                            <li onclick="openWindow('editDefinisi-{{ $wordDefinition->id }}')"
                                class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 cursor-pointer">
                                <div>Edit</div>
                                <i data-lucide='pencil' class="size-5"></i>
                            </li>
                        @endif
                        {{-- verifikasi --}}
                        @if (auth()->check() && auth()->user()->role == 'pengurus' && $wordDefinition->user_id !== auth()->user()->id)
                            @if (empty($wordDefinition->verifikasi))
                                <li onclick="openWindow('editDefinisi-{{ $wordDefinition->id }}')"
                                    class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 cursor-pointer">
                                    <div>Verifikasi</div>
                                    <i data-lucide='check-circle' class="size-5"></i>
                                </li>
                            @else
                                <li onclick="openWindow('editDefinisi-{{ $wordDefinition->id }}')"
                                    class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 cursor-pointer">
                                    <div>Verifikasi</div>
                                    <i data-lucide='check-circle' class="size-5"></i>
                                </li>
                            @endif
                        @endif
                        {{-- bagikan --}}
                        <li onclick="openWindow('editDefinisi-{{ $wordDefinition->id }}')"
                            class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 cursor-pointer">
                            <div>Bagikan</div>
                            <i data-lucide='share-2' class="size-5"></i>
                        </li>
                        {{-- hapus --}}
                        @if ($wordDefinition->user_id == auth()->user()->id)
                            <li onclick="openWindow('hapusDefinisi-{{ $wordDefinition->id }}')"
                                class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 text-red-500 cursor-pointer">
                                <div>Hapus</div>
                                <i data-lucide='trash' class="size-5"></i>
                            </li>
                        @endif
                        {{-- laporkan --}}
                        @if ($wordDefinition->user_id != auth()->user()->id)
                            <li onclick="openWindow('laporkan-{{ $wordDefinition->id }}')"
                                class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 text-red-500 cursor-pointer">
                                <div>Laporkan</div>
                                <i data-lucide='flag-triangle-right' class="size-5"></i>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
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
            class="rounded-full p-1 flex items-center hover:bg-neutral-100 w-fit border border-neutral-100 hover:border-neutral-200">
            <div class="p-2 ml-1 font-bold text-xs {{ $this->totalVotes < 0 ? 'text-red-600' : '' }}">
                {{ $this->totalVotes }}</div>
            <div class="">
                <button wire:click='vote(true)'
                    class="rounded-full p-2 hover:bg-neutral-200 {{ in_array(auth()->user()->id, $upvotes ?? []) ? 'bg-green-100 text-green-700' : '' }}">
                    <i wire:ignore data-lucide='chevron-up' class="size-4"></i>
                </button>
                <button wire:click='vote(false)'
                    class="rounded-full p-2 hover:bg-neutral-200 hover:text-red-500 {{ in_array(auth()->user()->id, $downvotes ?? []) ? 'bg-red-100 text-red-700' : '' }}">
                    <i wire:ignore data-lucide='chevron-down' class="size-4"></i>
                </button>
            </div>
        </div>
        <div class="flex justify-between">
            @if (isset($wordDefinition->copies) && $wordDefinition->copies == 1)
                <div class="text-sm rounded-full md:py-2 md:px-3 p-2 bg-blue-200 h-fit flex items-center gap-1">
                    <i data-lucide='copy' class="size-5"></i>
                    <span class="md:block hidden">Salinan definisi</span>
                </div>
            @elseif (isset($author->role) && $author->role == 'pengurus')
                <div class="text-sm rounded-full md:py-2 md:px-3 p-2 bg-purple-200 h-fit flex items-center gap-1"
                    title="Disubmit oleh pengurus">
                    <i data-lucide='circle-star' class="size-5"></i>
                    <span class="md:block hidden">Pengurus</span>
                </div>
            @elseif (isset($wordDefinition->verifikasi))
                <div class="text-sm rounded-full md:py-2 md:px-3 p-2 bg-amber-200 h-fit flex items-center gap-1">
                    <i data-lucide='badge-check' class="size-5"></i>
                    <span class="md:block hidden">Terverifikasi</span>
                </div>
            @endif
        </div>
    </div>
</div>
