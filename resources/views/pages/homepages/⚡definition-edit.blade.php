<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use App\Models\Definisi;

new class extends Component {
    public $id;

    #[Validate('required')]
    public $def;
    #[Validate('required|in:jw,id')]
    public $lang = 'id';

    #[Computed]
    public function definition()
    {
        $definition = Definisi::find($this->id);
        // cek apakah pengguna adalah pemilik definisi
        if ($definition->user_id != auth()->user()->id) {
            abort(403, 'Akses ditolak');
        }
        return $definition;
    }

    // simpan
    public function update()
    {
        // validasi
        $this->validate();

        // cek apakah definisi milik user
        if ($this->definition->user_id != auth()->user()->id) {
            $this->dispatch('notify', message: 'Tidak dapat mengedit definisi milik pengguna lain.', type: 'failed');
            return;
        }

        // cek apakah user kena suspend/tidak
        if (suspendedAccount() == true) {
            $this->dispatch('notify', message: 'Gagal mengedit definisi karena akunmu sedang disuspend.', type: 'failed');
            return;
        }

        // Simpan
        Definisi::find($this->definition->id)->update([
            'definisi' => $this->def,
            'verifikasi' => null,
            'verifikasi_oleh' => null,
            'hukuman_edit' => null,
            'edited_at' => now(),
        ]);

        return redirect()
            ->to('/kosakata/' . $this->definition->kosakata . '?id=' . $this->definition->id)
            ->with('success', 'Definisi berhasil diedit');
    }
};
?>

<div>
    {{-- kembali --}}
    <a href="{{ url()->previous() != url()->current() ? url()->previous() : '/kosakata/' . $this->definition->kosakata }}"
        class="">
        <x-button type="button" width="w-fit" color="hover:outline outline-2 dark:text-zinc-200 -translate-x-4" text="Kembali" icon="arrow-left" />
    </a>
    {{-- judul --}}
    <div class="mb-7">
        <h3 class="font-bold">Edit Definisi {{ ucfirst($this->definition->kosakata) }}</h3>
        <p>Perbarui definisi yang telah Anda tulis sebelumnya.</p>
    </div>
    {{-- Definisi --}}
    <form wire:submit='update' class="space-y-2">
        <x-trix id="def" :img="false" :undoRedo="true" :blockTool="false" :updateInput="null" :value="$this->definition->definisi"
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
            <x-button type="submit" width="w-fit" icon="save" target="update" color="bg-amber-400" text="Simpan"
                textLoading="Menyimpan..." />
        </div>
        <div class="space-y-1">
            <div wire:click='close'>

            </div>
        </div>
    </form>
</div>
