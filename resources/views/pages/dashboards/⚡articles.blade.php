<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use App\Models\Blog;
use App\Models\User;

new class extends Component {
    use WithPagination;
    #[Title('Artikel')]
    #[Layout('layouts.dashboard')]
    #[Url]
    public $status = '';
    #[Url]
    public $author = '';
    #[Url]
    public $id;

    // ambil data artikel
    #[Computed]
    public function articles()
    {
        // Dapatkan data blog
        $query = Blog::with([
            'user' => function ($query) {
                $query->withTrashed(); //ambil data softdelete juga
            },
        ]);

        // filter status
        if ($this->status == 'dipublikasikan') {
            $query->whereNotNull('status');
        } elseif ($this->status == 'draf') {
            $query->whereNull('status');
        }

        // untuk filter author
        if (!empty($this->author)) {
            // $query->where('user_id', '=', $author);
            $query->whereHas('user', function ($q) {
                $q->where('username', '=', $this->author);
            });
        }

        // tampilkan terlebih dahulu artikel yang ada pada id
        if (!empty($this->id)) {
            $query->orderByRaw('id=? DESC', [$this->id]);
        }

        return $query->orderBy('pinned', 'desc')->orderBy('updated_at', 'desc')->paginate(40);
    }

    // ubah status artikel
    public function statusToggle(int $id)
    {
        // dapatkan data artikel
        $post = Blog::find($id);

        // Jika post tidak ditemukan
        if (empty($post)) {
            $this->dispatch('notify', message: 'Artikel tidak ditemukan', type: 'failed');
            return;
        }

        // alihkan jika user bukan kepala dan bukan yang membuat artikel
        if ($post->user_id != auth()->user()->id && auth()->user()->role != 'kepala') {
            // return $this->error403();
            abort(403, 'Akses tidak diizinkan');
        }

        // set perubahan data
        $newStatus = empty($post->status) ? now() : null;
        // hapus status disematkan
        $pinned = 0;

        // tambah poin pengurus yang mempublikasikan artikel (jika dipublikasikan dan sebelumnya belum dipublikasikan)
        if (empty($post->status)) {
            // jika belum dipublikasikan - tambah poin user
            $poin = addPoint($post->user_id, 'Publikasikan artikel');
            $poin_toast = $poin > 0 ? '(+' . $poin . ' poin)' : '';
        } else {
            // kurangi poin pengurus yang meng-unpublish artikel (jika artikel disimpan dan sebelumnya sudah dipublikasikan)
            User::find($post->user_id)->decrement('poin', $post->poin); // kurangi poin user dengan poin yang sebelumnya didapatkan
            $poin = 0;
            $poin_toast = $post->poin > 0 ? '(-' . $post->poin . ' poin)' : '';
        }

        // Simpan
        Blog::where('id', '=', $id)->update([
            'status' => $newStatus,
            'pinned' => $pinned,
            'poin' => $poin,
        ]);

        // ubah statistik
        // increment artikel dipublikasikan di statistik
        // atau decrement artikel dipublikasikan di statistik
        changeStat('artikel_dipublikasikan', empty($post->status) ? true : false);

        // cek achievement
        $rule = ['artikel', 'totalViewBlog', 'viewBlog'];
        //lakukan perulangan untuk cek achievement user
        foreach ($rule as $d) {
            achievement($post->user_id, $d);
        }

        // kirim notifikasi ke penulis jika bukan penulis yang mengubah status artikel (kepala yang mengubah)
        $pesan = empty($post->status) ? 'Artikel berhasil dipublikasikan' : 'Artikel berhasil disimpan sebagai draf';
        if ($post->user_id != auth()->user()->id) {
            $notif = 'Artikel yang kamu tulis telah di' . (empty($post->status) ? 'jadikan sebagai draft' : 'publikasikan') . ' oleh kepala ' . $poin_toast;
            $url = '/artikel?id=' . $post->id;
            createNotification($post->user_id, 'blog', $notif, $url);
        } else {
            // tambahkan poin + atau - jika yang mengubah status adalah penulis sendiri
            $pesan = $pesan . ' ' . $poin_toast;
        }

        $this->dispatch('notify', message: $pesan, type: 'success');
    }

    // ubah pin aritkel
    public function pinToggle(int $id)
    {
        $post = Blog::find($id);

        // jika artikel tidak ditemukan
        if (empty($post)) {
            $this->dispatch('notify', message: 'Artikel tidak ditemukan', type: 'failed');
            return;
        }

        // set data yang akan diubah
        $pinned = $post['pinned'] == 0 ? 1 : 0;
        $pesan = $post['pinned'] == 0 ? 'Artikel berhasil disematkan' : 'Artikel batal disematkan';

        // ubah status pin
        Blog::where('id', '=', $id)->update(['pinned' => $pinned]);

        // kirim toast
        $this->dispatch('notify', message: $pesan, type: 'success');
    }

    // buka popup delete
    public $openDelete = false;
    public $deletedId; // id artikel dihapus
    public function deleteWindowToggle(int $articleId)
    {
        // ser jadi null jika deletedId saat ini sama dengan target
        // ubah jika nilainya beda
        $this->deletedId = $this->deletedId != $articleId ? $articleId : null;
        $this->openDelete = !$this->openDelete;
    }

    // hapus artikel
    public function delete(int $id)
    {
        // ambil data artikel
        $post = Blog::find($id);

        // cek apakah post ada atau user adalah author atau user adalah kepala
        if (empty($post) || ($post->user_id != Auth::user()->id && Auth::user()->role != 'kepala')) {
            $this->dispatch('notify', message: 'Gagal menghapus artikel', type: 'failed');
            return;
        }

        // hapus artikel
        Blog::destroy($id);

        // kurangi poin yang diterima oleh user dari definisi yang dihapus
        $poin_dikurang = $post->poin;
        User::find($post->user_id)->decrement('poin', $poin_dikurang);

        // Kirim notifikasi ke author jika user yang hapus == kepala
        if ($post->user_id != Auth::user()->id) {
            $notif = 'Artikel yang kamu tulis telah dihapus oleh kepala (-' . $poin_dikurang . ')';
            $url = '/artikel' . $post->id;
            createNotification($post->user_id, 'blog', $notif, $url);
        }

        // tutup window hapus
        $this->deleteWindowToggle($this->deletedId);

        // kembali ke view dengan pesan sukses
        $pesan = 'Artikel berhasil dihapus (-' . $poin_dikurang . ' poin)';
        $this->dispatch('notify', message: $pesan, type: 'success');
    }
};
?>

<div class="space-y-3">
    {{-- menu --}}
    <div class="flex md:flex-row flex-col justify-between gap-2">
        {{-- filter --}}
        <div class="flex md:flex-row flex-col md:items-center gap-2">
            {{-- author --}}
            @if (auth()->user()->role == 'pengurus')
                <x-radio-group>
                    <x-input-radio model="author" id="author-all" value="" text="Semua author" icon="users-round" />
                    <x-input-radio model="author" id="{{ auth()->user()->username }}"
                        value="{{ auth()->user()->username }}" text="Artikelku" icon="user-round" />
                </x-radio-group>
            @endif
            <div class="w-px h-4 bg-gray-200 md:block hidden"></div>
            {{-- status --}}
            <x-radio-group>
                <x-input-radio model="status" id="semua" value="" text="Semua" icon="layout-grid" />
                <x-input-radio model="status" id="dipublikasikan" value="dipublikasikan" text="Dipublikasikan" icon="send" />
                <x-input-radio model="status" id="draf" value="draf" text="Draf" icon="archive" />
            </x-radio-group>
        </div>

        @if (auth()->user()->role == 'pengurus')
            {{-- Buat artikel --}}
            <x-button url="/artikel/baru" text="Buat artikel" icon="plus" width="w-fit" />
        @endif
    </div>

    @if ($this->articles->isEmpty())
        <x-errors.not-found text="Tidak ada artikel yang dapat ditampilkan" />
    @endif
    {{-- daftar artikel --}}
    <div class="space-y-2">
        @foreach ($this->articles as $d)
            <div
                class="relative flex justify-between items-center pr-5 rounded-xl group border border-neutral-200 hover:outline outline-amber-200 {{ request()->id == $d->id ? 'outline outline-amber-400' : '' }}">
                <a href="{{ $d->user_id != auth()->user()->id || auth()->user()->role == 'kepala' ? '/blog/' . $d->slug : '/artikel/edit/' . $d->id }}"
                    class="w-full space-y-1 py-4 pl-5">
                    {{-- Judul --}}
                    <div class="line-clamp-2 flex flex-wrap gap-1 items-center font-semibold" title="Judul artikel">
                        @if ($d->pinned == 1)
                            <x-badge color="bg-amber-200">
                                <i data-lucide='pin' class="size-4 fill-white"></i>
                                <div class="">Disematkan</div>
                            </x-badge>
                        @endif
                        <div class="">{{ $d->judul }}</div>
                    </div>

                    <div class="flex flex-wrap gap-1 items-center text-neutral-600">
                        {{-- author --}}
                        <x-badge gap="1" padding="pl-1 py-1 pr-2" hoverColor="">
                            <x-avatar rounded="full" :avatarUrl="$d->user->profile_pic" size="6" />
                            <div class="line-clamp-2">{{ $d->user?->nama ?? '[Akun dihapus]' }}</div>
                        </x-badge>

                        {{-- Status --}}
                        <x-badge gap="1" color="{{ isset($d->status) ? 'bg-green-100' : 'bg-amber-100' }}"
                            hoverColor="">
                            <i data-lucide='{{ isset($d->status) ? 'check-circle' : 'archive' }}' class="w-4"></i>
                            <span>{{ isset($d->status) ? 'Rilis' : 'Draf' }}</span>
                        </x-badge>

                        {{-- view --}}
                        <x-badge gap="1" hoverColor="" title="Pembaca">
                            <i data-lucide='eye' class="w-4"></i>
                            <span>{{ number_format($d->view, 0, ',', '.') }}</span>
                        </x-badge>

                        {{-- tgl --}}
                        <x-badge gap="1" hoverColor="" title="Terakhir diperbarui">
                            <i data-lucide='calendar' class="w-4"></i>
                            <span>{{ dateFormat($d->updated_at) }}</span>
                        </x-badge>
                    </div>

                </a>

                {{-- tombol opsi --}}
                <button onclick="toggleClass('dropdown{{ $d->id }}', 'hidden')"
                    class="p-2 rounded-full hover:bg-neutral-100">
                    <i data-lucide='ellipsis-vertical' class="size-5"></i>
                </button>
                <div id="dropdown{{ $d->id }}"
                    class="absolute hidden bg-white top-0 right-14 z-40 p-2 rounded-xl border border-neutral-200 min-w-48 text-neutral-800">
                    {{-- Lihat --}}
                    <a href="/blog/{{ $d->slug }}"
                        class="flex justify-between py-2 px-3 rounded-lg hover:bg-amber-100">
                        <div>Lihat</div>
                        <i data-lucide='eye' class="w-5"></i>
                    </a>

                    {{-- ubah status --}}
                    @if (auth()->user()->role == 'kepala' || $d->user_id == auth()->user()->id)
                        <button wire:click='statusToggle({{ $d->id }})'
                            class="flex justify-between py-2 px-3 rounded-lg hover:bg-amber-100 w-full">
                            <div>{{ isset($d->status) ? 'Jadikan draf' : 'Publikasikan' }}</div>
                            <i data-lucide='{{ isset($d->status) ? 'archive' : 'send' }}' class="w-5"></i>
                        </button>
                    @endif

                    {{-- Pin artikel --}}
                    @if (isset($d->status))
                        <button wire:click='pinToggle({{ $d->id }})'
                            class="flex w-full justify-between py-2 px-3 rounded-lg hover:bg-amber-100">
                            <div>{{ $d->pinned == 0 ? 'Sematkan' : 'Lepas semat' }}</div>
                            <i data-lucide='{{ $d->pinned == 0 ? 'pin' : 'pin-off' }}' class="w-5"></i>
                        </button>
                    @endif

                    {{-- Hapus --}}
                    @if (auth()->user()->role == 'kepala' || $d->user_id == auth()->user()->id)
                        <button wire:click='deleteWindowToggle({{ $d->id }})'
                            class="flex w-full justify-between py-2 px-3 rounded-lg hover:bg-amber-100">
                            <div>Hapus</div>
                            <i data-lucide='trash' class="w-5"></i>
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- hapus artikel --}}
    @if ($openDelete)
        <x-popup title="Hapus artikel? {{ $deletedId }}" color="red">
            <div class="space-y-2">
                <p class="py-3">
                    Artikel yang dihapus akan hilang secara permanen dan tidak dapat dipulihkan.
                    Yakin ingin melanjutkan?
                </p>
            </div>
            {{-- Button --}}
            <div class="space-y-1">
                <x-button type="button" width="w-full" model="delete({{ $deletedId }})" target="delete"
                    color="bg-red-600 text-red-100" text="Ya, hapus artikel" textLoading="Menghapus..." />
                <div wire:click='deleteWindowToggle({{ $deletedId }})'>
                    <x-button type="button" width="w-full" color="hover:outline outline-2" text="Batal" />
                </div>
            </div>
        </x-popup>
    @endif

    {{-- Pagination --}}
    <div class="">
        {{ $this->articles->links() }}
    </div>
</div>
