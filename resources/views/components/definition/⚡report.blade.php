<?php

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Report;
use App\Models\Definisi;

new class extends Component {
    // data dari parent
    public $author, $definition;

    #[Validate('required')]
    public $alasan;
    #[Validate('nullable|max:255')]
    public $catatan;

    public function report()
    {
        // cek apakah pengguna sudah login
        if (!auth()->check()) {
            return redirect()->to('/masuk')->with('failed', 'Silahkan masuk terlebih dahulu');
        }
        // cek apakah user kena suspend/tidak
        if (suspendedAccount() == true) {
            $this->dispatch('notify', message: 'Gagal menyimpan laporan: akun anda sedang disuspend.', type: 'failed');
            return;
        }

        // validasi
        $this->validate();

        // cek apakah laporan sudah dilaporkan/belum
        $cek = Report::where('definisi_id', $this->definition->id)->whereNull('pengurus_id')->first();
        if (isset($cek)) {
            $this->dispatch('notify', message: 'Definisi sudah dilaporkan oleh pengguna lain.', type: 'failed');
            return;
        }

        // Simpan ke database
        $data = [
            'user_id' => Auth::user()->id,
            'definisi_id' => $this->definition->id,
            'alasan' => $this->alasan,
            'def_dilaporkan' => $this->definition->definisi,
            'waktu_definisi' => $this->definition->edited_at,
        ];
        if (isset($this->catatan)) {
            $data['catatan'] = $this->catatan;
        }

        $laporan = Report::create($data);

        // increment laporan baru di statistik
        changeStat('laporan_baru', true);

        // kembalikan ke view
        if (Auth::user()->role == 'pengurus') {
            return redirect('/laporan/' . $laporan->id)->with('success', 'Laporan berhasil dibuat, silahkan ditindaklanjuti');
        } else {
            return back()->with('success', 'Definisi berhasil dilaporkan');
        }
    }

    // function cancel
    public function close()
    {
        $this->dispatch('closeReport');
    }
};
?>

<x-popup title="Laporkan" color="red">
    <p>
        {{ auth()->check() && auth()->user()->role == 'pengurus'
            ? 'Deskripsikan kesalahan yang kamu temukan dalam definisi yang disubmit oleh' . $author->nama ??
                '[Pengguna dihapus]' . '.'
            : 'Apakah Anda yakin ingin melaporkan definisi yang ditulis ' . $author->nama ??
                '[Pengguna dihapus]' .
                    '?
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                Laporan yang Anda kirimkan akan ditinjau dan ditindaklanjuti oleh pengurus.' }}
    </p>
    <form wire:submit='report' class="space-y-2">
        <x-input-select id="alasan" model="alasan" label="Alasan" :options="[
            'Pilih',
            'tidak_relevan' => 'Definisi tidak relevan dengan kosakata',
            'tidak_akurat' => 'Definisi tidak akurat atau menyesatkan',
            'duplikat' => 'Pengguna sudah mengirim definisi yang sama sebelumnya',
            'bahasa_kasar' => 'Mengandung kata-kata kasar atau tidak sopan',
            'sara' => 'Mengandung unsur SARA',
            'spam' => 'Spam',
            'promosi' => 'Mempromosikan barang/jasa',
            'informasi_pribadi' => 'Mengandung informasi pribadi orang lain',
            'lainnya' => 'Alasan lainnya',
        ]" />
        <x-input-textarea id="catatan" model="catatan" label="Catatan" placeholder="Tulis catatan laporan..." />
        <div class="space-y-1">
            <x-button type="submit" width="w-full" target="report" color="bg-red-600 text-red-100" text="Laporkan"
                textLoading="Melaporkan..." />
            <div wire:click='close'>
                <x-button type="button" width="w-full" color="hover:outline outline-2" text="Batal" />
            </div>
        </div>
    </form>
</x-popup>
