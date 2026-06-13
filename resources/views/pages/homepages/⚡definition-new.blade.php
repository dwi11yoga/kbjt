<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use App\Models\Definisi;

new class extends Component {
    #[TItle('Tambah definisi baru')]
    public $id;

    #[Validate('required')]
    public $kosakata;

    #[Validate('required')]
    public $definisi;
    #[Validate('required|in:jw,id')]
    public $lang = 'id';

    // tampilkan kosakata yang sudah ada saat pengguna mengetik kosakata
    public $sugestionWord = [];
    public function updatedKosakata()
    {
        $this->sugestionWord = Definisi::distinct()
            ->whereLike('kosakata', $this->kosakata . '%')
            ->limit(5)
            ->pluck('kosakata');
    }

    // fungsi untuk menubah value kosakata ketika diklik
    public function setKosakata(string $value)
    {
        // set value kosakata
        $this->kosakata = $value;
        // hapus sugestion
        $this->sugestionWord = [];
    }

    // simpan
    public function save()
    {
        // validasi
        $this->validate();

        // cek apakah user sudah login/belum
        if (!auth()->check()) {
            return redirect()->to('/masuk')->with('failed', 'Silahkan login dahulu sebelum menambah definisi.');
        }

        // cek apakah pengguna disuspend
        $suspend = suspendedAccount();
        if ($suspend == true) {
            $this->dispatch('notify', message: 'Definisi gagal disimpan: Akun anda masih dalam masa hukuman.', type: 'failed');
            return;
        }

        // tambah poin user
        $poin = addPoint(Auth::user()->id, 'Tambah definisi');

        // simpan
        $simpan = Definisi::create([
            'kosakata' => $this->kosakata,
            'user_id' => Auth::user()->id,
            'definisi' => $this->definisi,
            'poin_kontributor' => $poin,
            'bahasa' => $this->lang,
            'edited_at' => now(),
        ]);

        // increment definisi baru di statistik
        changeStat('definisi_baru');

        // cek achievement
        achievement(Auth::user()->id, 'definisi');

        // kembalikan view
        // dapatkan slug kosakata
        return redirect()
            ->to('/kosakata/' . $this->kosakata . '?id=' . $simpan->id)
            ->with('success', 'Definisi berhasil ditambahkan (+' . $poin . ' poin)');
    }
};
?>

<div>
    {{-- kembali --}}
    <a href="{{ url()->previous() != url()->current() ? url()->previous() : '/kosakata/' }}" class="">
        <x-button type="button" width="w-fit" color="hover:outline outline-2 dark:text-zinc-200 -translate-x-4"
            text="Kembali" icon="arrow-left" />
    </a>
    {{-- judul --}}
    <div class="mb-7">
        <h3 class="font-bold">Tambah definisi baru</h3>
        {{-- <p>Perbarui definisi yang telah Anda tulis sebelumnya.</p> --}}
    </div>

    <form wire:submit='save' class="space-y-2">
        {{-- kosakata --}}
        <x-input id="kosakata" model="kosakata" label="Kosakata" :autofocus="true" />
        {{-- sarankan kosakata yang sudah ada  --}}
        <div class="flex gap-1">
            @foreach ($sugestionWord as $word)
                <div class="w-fit cursor-pointer" wire:click='setKosakata("{{ $word }}")'>
                    <x-badge>{{ $word }}</x-badge>
                </div>
            @endforeach
        </div>
        {{-- Definisi --}}
        <x-trix id="definisi" :img="false" :undoRedo="true" :blockTool="false" :updateInput="null" :autofocus="false"
            {{-- value="{{ $definition }}" --}}
            placeholder="Definisi, contoh penggunaan kata, dialek, referensi, dan informasi terkait lainnya.." />
        <div class="flex justify-between items-center">
            <div wire:ignore class="relative">
                <label for="lang" class="absolute top-2 left-3">
                    <i data-lucide='languages' class="size-5 my-0.5"></i>
                </label>
                <select wire:model.live='lang' name="lang" id="lang" title="Bahasa yang digunakan"
                    class="hover:bg-neutral-100 bg-white dark:bg-zinc-900 dark:hover:bg-zinc-800 rounded-full py-2 px-3 pl-9 flex gap-1 items-center group transition-all ease-in-out appearance-none cursor-pointer">
                    <option value="id">Bahasa Indonesia</option>
                    <option value="jw">Basa Jawa</option>
                    {{-- <div class="group-hover:block group-focus:block hidden">Semua bahasa</div>  --}}
                </select>
            </div>
            <x-button type="submit" width="w-fit" icon="save" target="save" color="bg-amber-400" text="Simpan"
                textLoading="Menyimpan..." />
        </div>
        <div class="space-y-1">
            <div wire:click='close'>

            </div>
        </div>
    </form>
</div>
