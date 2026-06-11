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
        $user = User::withTrashed()->where('username', $this->username)->first();
        // jika pengguna tidak ditemukan, maka tampilkan hal.error
        if (empty($user)) {
            abort(404, 'Pengguna tidak ditemukan');
        }
        $user->level = levelCalculator($user->poin);
        // url user
        $user->url = getUrl() . '/u/' . $user->username;

        // sembunyikan data pribadi pengguna jika akun dihapus
        if ($user->trashed()) {
            $user->tgl_lahir = $user->jenis_kelamin = $user->kota = $user->profile_pic = $user->telp = $user->tautan = $user->media_sosial = $user->donasi = null;
        }

        return $user;
    }

    public $tabs; // daftar tab/menu
    public function mount()
    {
        // tambah jumlah pengunjung jika pengguna belum mengunjungi detail pengguna
        if (!Cookie::has('user_' . $this->user->id)) {
            // jika belum ada cookie = user belum melihat halaman ini
            User::withTrashed()->find($this->user->id)->increment('view', 1); // naikkan view
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

    // promosikan/demosi status pengguna
    public $openRolePanel = false;
    public function rolePanelToggle()
    {
        $this->openRolePanel = !$this->openRolePanel;
    }
    public function changeRole()
    {
        // periksa kembali apakah role user == kepala
        // Tidak perlu, sudah ada middleware
        if (auth()->check() && auth()->user()->role != 'kepala') {
            abort(403, 'Akses ditolak');
        }

        if ($this->user->role == 'pengurus') {
            // jika user==pengurus, maka ubah menjadi kontributor
            $ubahJadi = 'kontributor';
            $pesan = 'Mohon maaf, status dan hak istimewa kamu sebagai pengurus telah dicabut oleh Kepala.';
            $url = '#';
            $toast = $this->user->nama . ' berhasil didemosikan sebagai pengurus';
        } elseif ($this->user->role == 'kontributor') {
            // jika user==kontributor, maka ubah menjadi pengurus
            $ubahJadi = 'pengurus';
            $pesan = 'Selamat! Kepala telah mempromosikan kamu menjadi pengurus 🥳. Lihat apa saja yang bisa kamu lakukan sebagai pengurus di sini.';
            $url = '/blog/post/hak-istimewa-pengurus';
            $toast = $this->user->nama . ' berhasil dipromosikan menjadi pengurus';
        } else {
            // selain itu, maka alihkan ke halaman 404. karena pasti user yang coba diubah usernya adalah kepala
            abort(404);
        }

        // ubah data di database
        User::find($this->user->id)->update([
            'role' => $ubahJadi,
        ]);

        // kirim notifikasi ke user
        createNotification($this->user->id, 'kepengurusan', $pesan, $url);

        // kembalikan kepala ke view
        return redirect('/u/'.$this->username)->with('success', $toast);
    }
};
?>

<div>
    {{-- Header profil --}}
    <x-slot:header>
        {{-- cek apakah akun user dihapus/tidak --}}
        @if ($this->user->trashed())
        <div class="p-5 dark:bg-red-800 bg-red-200 dark:text-red-200 text-red-800 font-bold">
            Akun telah dihapus
        </div>
        @elseif (suspendedAccount($this->user->suspended_time) &&
                auth()->check() &&
                (in_array(auth()->user()->role, ['pengurus', 'kepala']) || auth()->user()->id == $this->user->id))
            {{-- cek apakah user tersuspend atau didak --}}
            <div class="p-5 dark:bg-red-800 bg-red-200 dark:text-red-200 text-red-800">
                <span class="font-bold">Akun tersuspend</span> hingga
                {{-- {{ $this->user->suspended_time->format('j F Y H:i') }}. --}}
                {{ dateFormat($this->user->suspended_time) }}.
            </div>
        @endif


        <section class="md:px-28 px-5 pt-14 mx-auto dark:bg-zinc-800 bg-neutral-100">
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
                            {{-- nama --}}
                            <h3 class="font-bold">{{ $this->user->nama }}
                                {{ $this->user->username === auth()->user()?->username ? '(Anda)' : '' }}</h3>
                            <div>
                                &#64;{{ $this->user->username }}
                                • <span class="text-neutral-600 dark:text-zinc-400">{{ ucfirst($this->user->role) }}</span>
                            </div>
                        </div>

                        {{-- level --}}
                        <div class="flex items-center -translate-x-2">
                            {{-- level --}}
                            @if ($this->user->role != 'kepala')
                                <div class="flex space-x-1 hover:bg-amber-400 dark:hover:text-neutral-800 rounded-full px-2 py-0.5">
                                    Level {{ $this->user->level }}
                                </div>
                            @endif
                            {{-- poin --}}
                            @if ($this->user->role != 'kepala')
                                <div class="flex space-x-1 dark:hover:bg-zinc-900 hover:bg-neutral-200 rounded-full px-2 py-0.5">
                                    <i data-lucide='astroid' class="w-5 fill-neutral-800 dark:fill-zinc-200"></i>
                                    <span>{{ number_format($this->user->poin, 0, ',', '.') }} poin</span>
                                </div>
                            @endif
                            {{-- jumlah kunjungan --}}
                            <div class="flex space-x-1 dark:hover:bg-zinc-900 hover:bg-neutral-200 rounded-full px-2 py-0.5">
                                <i data-lucide='flame' class="w-5 fill-amber-300 dark:fill-amber-700"></i>
                                <span>{{ number_format($this->user->view, 0, ',', '.') }} kunjungan</span>
                            </div>
                        </div>

                        {{-- Bio --}}
                        <p class="line-clamp-2 dark:text-zinc-400 text-neutral-600 text-sm md:w-2/3 lg:w-1/2">
                            {{ isset($this->user->bio) ? $this->user->bio : 'Bio belum ditambahkan.' }}
                        </p>

                        {{-- Website & Media sosial --}}
                        <div class="flex flex-wrap items-center -ml-2 mt-1 md:gap-0 gap-1">
                            {{-- Website --}}
                            @if (isset($this->user->tautan))
                                <a target="_blank" href="{{ $this->user->tautan }}" title="Buka tautan"
                                    class="group w-9 h-9 flex justify-center items-center rounded-full dark:hover:bg-zinc-200 hover:bg-neutral-800">
                                    <i data-lucide='globe' class="dark:group-hover:stroke-zinc-900 group-hover:stroke-white"></i>
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
                                    class="group w-9 h-9 flex justify-center items-center rounded-full dark:hover:bg-zinc-200 hover:bg-neutral-800">
                                    <i data-lucide='instagram' class="dark:group-hover:stroke-zinc-900 group-hover:stroke-white"></i>
                                </a>
                            @endif
                            {{-- Tiktok --}}
                            @if (isset($this->user->media_sosial['tiktok']) && $this->user->media_sosial['tiktok'] != '')
                                <a target="_blank"
                                    href="https://www.tiktok.com/&#64;{{ $this->user->media_sosial['tiktok'] }}"
                                    title="Buka tiktok"
                                    class="group w-9 h-9 flex justify-center items-center rounded-full dark:hover:bg-zinc-200 hover:bg-neutral-800">
                                    <i data-lucide='tiktok' class="dark:fill-zinc-200 fill-black stroke-none dark:group-hover:stroke-zinc-900 group-hover:stroke-white"></i>
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
                                    class="group w-9 h-9 flex justify-center items-center rounded-full dark:hover:bg-zinc-200 hover:bg-neutral-800">
                                    <i data-lucide='github' class="dark:group-hover:stroke-zinc-900 group-hover:stroke-white"></i>
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
                <div class="flex mt-7 space-x-7 border-b-2 border-neutral-200 dark:border-zinc-700 md:overflow-hidden overflow-x-scroll">
                    <a href="/u/{{ $this->user->username }}"
                        class="-mb-0.5 py-3 {{ !in_array($tab, $tabs) ? 'border-b-4 dark:text-zinc-200 text-black border-amber-400 font-bold' : 'text-neutral-600 dark:text-zinc-400' }} dark:hover:text-zinc-200 hover:text-black hover:border-b-4 dark:hover:border-zinc-200 hover:border-black">
                        Definisi
                    </a>
                    @foreach ($tabs as $t)
                        <a href="/u/{{ $this->user->username }}/{{ $t }}"
                            class="-mb-0.5 py-3 {{ $tab == $t ? 'border-b-4 dark:text-zinc-200 text-black border-amber-400 font-bold' : 'text-neutral-600 dark:text-zinc-400' }} dark:hover:text-zinc-200 hover:text-black hover:border-b-4 dark:hover:border-zinc-200 hover:border-black">
                            {{ ucfirst($t) }}
                        </a>
                    @endforeach
                </div>

            </div>
        </section>
    </x-slot:header>

    {{-- kontribusi pengguna --}}
    <div class="md:col-span-3 col-span-4 text-justify">
        {{-- promosi/demosi pengguna --}}
        @if (auth()->check() && auth()->user()->role == 'kepala' && $this->user->role != 'kepala')
            <div class="flex justify-end pb-2">
                <button type="button" wire:click='$toggle("openRolePanel")'
                    class="flex gap-1 items-center w-fit translate-x-3 p-3 rounded-full hover:bg-neutral-200 group">
                    <i data-lucide="{{ $this->user->role == 'kontributor' ? 'user-round-plus' : 'user-round-minus' }}"
                        class="size-5"></i>
                    <div class="">
                        {{ $this->user->role == 'kontributor' ? 'Promosikan' : 'Demosi' }}</div>
                </button>
                {{-- popup --}}
                @if ($openRolePanel)
                    <x-popup
                        title="{{ $this->user->role == 'kontributor' ? 'Promosikan sebagai pengurus' : 'Demosi sebagai pengurus' }}"
                        color="{{ $this->user->role == 'kontributor' ? 'green' : 'red' }}">
                        <div class="">
                            Kamu yakin ingin
                            {{ $this->user->role == 'kontributor' ? 'mempromosikan' : 'mendemosikan' }}
                            {{ $this->user->nama }} sebagai pengurus?
                        </div>
                        <div class="space-y-1">
                            <div class="" wire:click='changeRole'>
                                <x-button width="w-full" target="changeRole"
                                    color="{{ $this->user->role == 'kontributor' ? 'bg-green-600 text-green-100' : 'bg-red-600 text-red-100' }}"
                                    text="{{ $this->user->role == 'kontributor' ? 'Promosikan' : 'Demosi' }}"
                                    textLoading="Menyimpan aksi..." />
                            </div>
                            <div wire:click='$toggle("openRolePanel")'>
                                <x-button type="button" width="w-full" color="hover:outline outline-2"
                                    text="Batal" />
                            </div>
                        </div>
                    </x-popup>
                @endif
            </div>
        @endif
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
