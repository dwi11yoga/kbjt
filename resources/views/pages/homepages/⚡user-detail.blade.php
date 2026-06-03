<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\User;

new class extends Component {
    //
    public $username;
    public $tab; //tab saat ini
    #[Computed]
    public function user()
    {
        $user = User::where('username', $this->username)->first();
        // jika pengguna tidak ditemukan, maka tampilkan hal.error
        if (empty($user)) {
            abort(404, 'Pengguna tidak ditemukan');
        }
        $user->level = levelCalculator($user->poin);
        // url user
        $user->url = getUrl() . '/u/' . $user->username;
        return $user;
    }

    public $tabs; // daftar tab/menu
    public function mount()
    {
        // tambah jumlah pengunjung jika pengguna belum mengunjungi detail pengguna
        if (!Cookie::has('user_' . $this->user->id)) {
            // jika belum ada cookie = user belum melihat halaman ini
            User::find($this->user->id)->increment('view', 1); // naikkan view
            Cookie::queue('user_' . $this->user->id, true, 24 * 60); // buat cookie (kedaluarsa dalam 1 hari)
            $this->user->view += 1;
        }

        // set daftar tab
        $tabs = [];
        if ($this->user->role === 'pengurus') {
            $tabs[] = 'artikel';
        }
        $tabs = array_merge($tabs, ['achievement', 'tentang']);
        $this->tabs = $tabs;
    }

    // title
    public function render()
    {
        return $this->view()->title($this->user->nama);
    }
};
?>

<div>
    {{-- Header profil --}}
    <x-slot:header>
        {{-- cek apakah user tersuspend atau didak --}}
        @if (suspendedAccount($this->user->suspended_time) &&
                auth()->check() &&
                (in_array(auth()->user()->role, ['pengurus', 'kepala']) || auth()->user()->id == $this->user->id))
            <div class="p-5 bg-red-200 text-red-800">
                <span class="font-bold">Akun tersuspend</span> hingga
                {{-- {{ $this->user->suspended_time->format('j F Y H:i') }}. --}}
                {{ dateFormat($this->user->suspended_time) }}.
            </div>
        @endif

        <section class="md:px-28 px-5 pt-14 mx-auto bg-neutral-100">
            <div class="container mx-auto">
                <div class="grid grid-cols-4 gap-5">
                    {{-- foto profil --}}
                    <div class="lg:col-span-1 col-span-4">
                        <x-avatar avatarUrl="{{ $this->user->profile_pic }}" size="64" rounded="full" />
                    </div>

                    {{-- detail singkat pengguna --}}
                    <div class="lg:col-span-3 col-span-4 flex flex-col justify-center gap-2">
                        {{-- Nama & username --}}
                        <div>
                            <div class="flex items-center space-x-2">
                                {{-- nama --}}
                                <h3 class="font-bold">{{ $this->user->nama }}
                                    {{ $this->user->username === auth()->user()?->username ? '(Anda)' : '' }}</h3>
                                {{-- menu --}}
                                @if (isset(auth()->user()->role) && auth()->user()->role == 'kepala' && $this->user->role != 'kepala')
                                    <div class="relative">
                                        {{-- tombol menu --}}
                                        <button id="dropdownBtn" onclick="dropdown(this, 'dropdown')"
                                            class="p-2 rounded-full hover:bg-neutral-200">
                                            <i data-lucide='more-horizontal'></i>
                                        </button>

                                        <div id="dropdown"
                                            class="absolute font-normal hidden bg-white right-0 z-40 p-2 rounded-xl border border-neutral-200 min-w-48 text-neutral-800">
                                            <ul>
                                                @if ($this->user->role == 'kontributor')
                                                    <li onclick="openWindow('promosikanUser')"
                                                        class="flex justify-between py-2 px-3 rounded-lg hover:bg-amber-100 cursor-pointer">
                                                        <div>Promosikan</div>
                                                        <i data-lucide='arrow-up' class="w-5"></i>
                                                    </li>
                                                @elseif ($this->user->role == 'pengurus')
                                                    <li onclick="openWindow('demosiUser')"
                                                        class="flex justify-between py-2 px-3 rounded-lg text-red-500 hover:bg-red-100 cursor-pointer">
                                                        <div>Demosi</div>
                                                        <i data-lucide='arrow-down' class="w-5"></i>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>


                            <div>
                                &#64;{{ $this->user->username }}
                                • <span class="text-neutral-500">{{ ucfirst($this->user->role) }}</span>
                            </div>
                        </div>

                        {{-- level --}}
                        <div class="flex items-center -translate-x-2">
                            {{-- level --}}
                            @if ($this->user->role != 'kepala')
                                <div class="flex space-x-1 hover:bg-amber-400 rounded-full px-2 py-0.5">
                                    Level {{ $this->user->level }}
                                </div>
                            @endif
                            {{-- poin --}}
                            @if ($this->user->role != 'kepala')
                                <div class="flex space-x-1 hover:bg-neutral-200 rounded-full px-2 py-0.5">
                                    <i data-lucide='astroid' class="w-5 fill-neutral-800"></i>
                                    <span>{{ number_format($this->user->poin, 0, ',', '.') }} poin</span>
                                </div>
                            @endif
                            {{-- jumlah kunjungan --}}
                            <div class="flex space-x-1 hover:bg-neutral-200 rounded-full px-2 py-0.5">
                                <i data-lucide='flame' class="w-5 fill-amber-300"></i>
                                <span>{{ number_format($this->user->view, 0, ',', '.') }} kunjungan</span>
                            </div>
                        </div>

                        {{-- Bio --}}
                        <p class="line-clamp-2 text-neutral-500 text-sm md:w-2/3 lg:w-1/2">
                            {{ isset($this->user->bio) ? $this->user->bio : 'Bio belum ditambahkan.' }}
                        </p>

                        {{-- Website & Media sosial --}}
                        <div class="flex flex-wrap items-center -ml-2 mt-1 md:gap-0 gap-1">
                            {{-- Website --}}
                            @if (isset($this->user->tautan))
                                <a target="_blank" href="{{ $this->user->tautan }}" title="Buka tautan"
                                    class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-neutral-800">
                                    <i data-lucide='globe' class="group-hover:stroke-white"></i>
                                </a>
                            @endif
                            {{-- Facebook --}}
                            @if (isset($this->user->media_sosial['fb']) && $this->user->media_sosial['fb'] != '')
                                <a target="_blank" href="https://facebook.com/{{ $this->user->media_sosial['fb'] }}"
                                    title="Buka facebook"
                                    class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-blue-800">
                                    <i data-lucide='facebook'
                                        class="fill-blue-800 group-hover:fill-white stroke-none"></i>
                                </a>
                            @endif

                            {{-- Twitter --}}
                            @if (isset($this->user->media_sosial['x']) && $this->user->media_sosial['x'] != '')
                                <a target="_blank" href="https://x.com/{{ $this->user->media_sosial['x'] }}"
                                    title="Buka twitter(x)"
                                    class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-blue-500">
                                    <i data-lucide='twitter'
                                        class="fill-blue-500 group-hover:fill-white stroke-none"></i>
                                </a>
                            @endif

                            {{-- Instagram --}}
                            @if (isset($this->user->media_sosial['ig']) && $this->user->media_sosial['ig'] != '')
                                <a target="_blank"
                                    href="https://www.instagram.com/{{ $this->user->media_sosial['ig'] }}"
                                    title="Buka instagram"
                                    class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-neutral-800">
                                    <i data-lucide='instagram' class="group-hover:stroke-white"></i>
                                </a>
                            @endif
                            {{-- Tiktok --}}
                            @if (isset($this->user->media_sosial['tiktok']) && $this->user->media_sosial['tiktok'] != '')
                                <a target="_blank"
                                    href="https://www.tiktok.com/&#64;{{ $this->user->media_sosial['tiktok'] }}"
                                    title="Buka tiktok"
                                    class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-neutral-800">
                                    <i data-lucide='tiktok' class="fill-black stroke-none group-hover:fill-white"></i>
                                </a>
                            @endif

                            {{-- Whatsapp --}}
                            @if (isset($this->user->media_sosial['wa']) && $this->user->media_sosial['wa'] != '')
                                <a target="_blank" href="https://wa.me/{{ $this->user->media_sosial['wa'] }}"
                                    title="Buka whatsapp"
                                    class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-green-500">
                                    <i data-lucide='whatsapp'
                                        class="fill-green-500 group-hover:fill-white stroke-none"></i>
                                </a>
                            @endif

                            {{-- Telegram --}}
                            @if (isset($this->user->media_sosial['telegram']) && $this->user->media_sosial['telegram'] != '')
                                <a target="_blank" href="https://t.me/{{ $this->user->media_sosial['telegram'] }}"
                                    title="Buka telegram"
                                    class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-blue-500">
                                    <i data-lucide='telegram'
                                        class="fill-blue-500 stroke-none group-hover:fill-white"></i>
                                </a>
                            @endif

                            {{-- linkedin --}}
                            @if (isset($this->user->media_sosial['linkedin']) && $this->user->media_sosial['linkedin'] != '')
                                <a target="_blank"
                                    href="https://www.linkedin.com/in/{{ $this->user->media_sosial['linkedin'] }}"
                                    title="Buka linkedin"
                                    class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-blue-600">
                                    <i data-lucide='linkedin'
                                        class="fill-blue-600 group-hover:fill-white stroke-none"></i>
                                </a>
                            @endif

                            {{-- Github --}}
                            @if (isset($this->user->media_sosial['github']) && $this->user->media_sosial['github'] != '')
                                <a target="_blank" href="https://github.com/{{ $this->user->media_sosial['github'] }}"
                                    title="Buka github"
                                    class="group w-9 h-9 flex justify-center items-center rounded-full hover:bg-neutral-800">
                                    <i data-lucide='github' class="group-hover:stroke-white"></i>
                                </a>
                            @endif

                            @if (!empty($this->user->donasi) && $this->user->donasi['metode'] != null && $this->user->donasi['rekening'] != null)
                                {{-- donasi --}}
                                <a href="/u/{{ $this->user->username }}/tentang#donasi"
                                    class="rounded-md w-fit ml-1 cursor-pointer border text-neutral-700 border-neutral-500 flex items-center h-9 px-2 hover:bg-neutral-800 hover:text-white">
                                    Donasi
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Tab --}}
                <div class="flex mt-7 space-x-7 border-b-2 border-neutral-200 md:overflow-hidden overflow-x-scroll">
                    <a href="/u/{{ $this->user->username }}"
                        class="-mb-0.5 py-3 {{ !in_array($tab, $tabs) ? 'border-b-4 text-black border-amber-400 font-bold' : 'text-neutral-600' }} hover:text-black hover:border-b-4 hover:border-black">
                        Definisi
                    </a>
                    @foreach ($tabs as $t)
                        <a href="/u/{{ $this->user->username }}/{{ $t }}"
                            class="-mb-0.5 py-3 {{ $tab == $t ? 'border-b-4 text-black border-amber-400 font-bold' : 'text-neutral-600' }} hover:text-black hover:border-b-4 hover:border-black">
                            {{ ucfirst($t) }}
                        </a>
                    @endforeach
                </div>

            </div>
        </section>
    </x-slot:header>

    {{-- kontribusi pengguna --}}
    <div class="md:col-span-3 col-span-4 text-justify">
        @if ($this->user->role === 'pengurus' && $tab === 'artikel')
            <livewire:user-articles :user="$this->user" />
        @elseif($tab === 'achievement')
            <livewire:user-achievement :user="$this->user" />
        @elseif($tab === 'tentang')
            <livewire:user-about :user="$this->user" />
        @else
            {{-- Definisi --}}
            <livewire:user-definitions :user="$this->user" />
        @endif
    </div>
</div>
