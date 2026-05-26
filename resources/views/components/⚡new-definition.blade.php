<?php

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Definisi;

new class extends Component {
    // kata yang akan didefinisikan
    public $word;

    #[Validate('required')]
    public $definition;
    #[Validate('required|in:jw,id')]
    public $lang = 'id';

    public function save()
    {
        // validasi
        $this->validate();

        // cek apakah user sudah login/belum
        if (!auth()->check()) {
            return redirect()->to('/masuk')->with('failed', 'Silahkan login dahulu sebelum menambah definisi.');
        }

        // cek apakah pengguna disuspend
        $suspend = suspendedAccount(Auth::user()->id);
        if ($suspend == true) {
            $this->dispatch('notify', message: 'Definisi gagal disimpan: Akun anda masih dalam masa hukuman.', type: 'failed');
        }

        // tambah poin user
        $poin = addPoint(Auth::user()->id, 'Tambah definisi');

        // simpan
        $simpan = Definisi::create([
            'kosakata' => $this->word,
            'user_id' => Auth::user()->id,
            'definisi' => $this->definition,
            'poin_kontributor' => $poin,
            'bahasa' => $this->lang,
        ]);

        // increment definisi baru di statistik
        changeStat('definisi_baru');

        // cek achievement
        achievement(Auth::user()->id, 'definisi');

        // kembalikan view
        // dapatkan slug kosakata
        return redirect()
            ->to('/kosakata/' . $this->word . '?id=' . $simpan->id)
            ->with('success', 'Definisi berhasil ditambahkan (+' . $poin . ' poin)');
    }
};
?>

{{-- tambah definisi --}}
<div class="space-y-1">
    {{-- tidak boleh submit kalau pengguna belum login/kepala --}}
    <form wire:submit='save' class="bg-white rounded-2xl p-5 border border-neutral-200 space-y-3">
        @csrf
        {{-- Author --}}
        <div class="flex gap-2 items-center">
            <x-avatar avatarUrl="{{ auth()->user()?->profile_pic }}" size="8" />
            <div class="flex gap-1 items-center">
                <div class="group-hover:underline underline-offset-4 decoration-amber-400 decoration-4">
                    {{ auth()->check() ? auth()->user()->nama . '(Anda)' : 'Anda' }}
                </div>
                <div class="text-sm"> · {{ dateFormat(now()) }}</div>
            </div>
        </div>

        {{-- Definisi --}}
        <x-trix id="definition" :img="false" :undoRedo="true" :blockTool="false" :updateInput="null"
            value="{{ $definition }}"
            placeholder="Definisi, contoh penggunaan kata, dialek, referensi, dan informasi terkait lainnya.." />
        <div class="flex items-center justify-between">
            <div wire:ignore class="relative">
                <label for="lang" class="absolute top-2 left-3">
                    <i data-lucide='languages' class="size-5 my-0.5"></i>
                </label>
                <select wire:model.live='lang' name="lang" id="lang" title="Bahasa yang digunakan"
                    class="hover:bg-neutral-100 bg-white hover:text-neutral-800 rounded-full py-2 px-3 pl-9 flex gap-1 items-center group transition-all ease-in-out appearance-none cursor-pointer">
                    <option value="id">Bahasa Indonesia</option>
                    <option value="jw">Basa Jawa</option>
                    {{-- <div class="group-hover:block group-focus:block hidden">Semua bahasa</div>  --}}
                </select>
            </div>
            <x-button icon="save" text="Tambah definisi" type="submit" target="save" textLoading="Menyimpan..." />
        </div>
    </form>

    <script>
        // Tampilkan dan semunyikan tambah definisi
        const newDefButton = document.getElementById('newDefButton');
        const newDefinition = document.getElementById('newDefinition');

        newDefButton.addEventListener('click', () => {
            newDefinition.classList.toggle('hidden');
        })
    </script>
</div>
