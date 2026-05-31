<?php

use Livewire\Component;
use App\Models\Definisi;
use App\Models\User;

new class extends Component {
    //
    public $definition;

    public function close()
    {
        $this->dispatch('closeDelete');
    }

    public function delete()
    {
        // cek apakah pengguna sudah login
        if (!auth()->check()) {
            return redirect()->to('/masuk')->with('failed', 'Silahkan masuk terlebih dahulu');
        }
        // Cek apakah definisi benar-benar milik user
        if ($this->definition->user_id != Auth::user()->id) {
            $this->dispatch('notify', message: 'Tidak dapat menghapus kontribusi pengguna lain', type: 'failed');
            return;
        }

        // cek apakah user kena suspend/tidak
        if (suspendedAccount() == true) {
            $this->dispatch('notify', message: 'Tidak dapat menghapus definisi saat pengguna tersuspend.', type: 'failed');
            return;
        }

        // hapus definisi
        Definisi::destroy($this->definition->id);

        // kurangi poin yang diterima oleh user dari definisi yang dihapus
        $poin_dikurang = $this->definition->poin_kontributor + $this->definition->poin_verifikasi;
        User::find($this->definition->user_id)->decrement('poin', $poin_dikurang);

        // kembali ke view
        session()->flash('success', 'Definisi berhasil dihapus (-' . $poin_dikurang . ' poin)');
        return $this->redirect(request()->header('Referer'), navigate: true);
    }
};
?>

{{-- hapus --}}
<x-popup title="Hapus Definisi" color="red">
    <p class="py-3">
        Apakah kamu yakin ingin menghapus definisi {{ $definition->kosakata }} yang kamu tulis?
    </p>
    <div class="space-y-1">
        <x-button type="button" width="w-full" model="delete" target="delete" color="bg-red-600 text-red-100"
            text="Hapus definisi" textLoading="Menghapus..." />
        <div wire:click='close'>
            <x-button type="button" width="w-full" color="hover:outline outline-2" text="Batal" />
        </div>
    </div>
</x-popup>
