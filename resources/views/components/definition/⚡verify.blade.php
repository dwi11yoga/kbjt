<?php

use Livewire\Component;
use App\Models\User;
use App\Models\Definisi;

new class extends Component {
    //
    public $definition, $author;

    public $verified;

    public function mount()
    {
        $this->verified = empty($this->definition->verifikasi);
    }

    // verifikasi/unverifikasi
    public function verify()
    {
        // jika pengguna belum login
        if (!auth()->check()) {
            return redirect()->to('masuk')->with('failed', 'Silahkan masuk terlebih dahulu');
        }
        // jika user != pengurus, maka alihkan ke halaman 403
        if (Auth::user()->role != 'pengurus') {
            $this->dispatch('notify', message: 'Aksi tidak dapat diautorisasi.', type: 'failed');
            return;
        }

        if (empty($this->definition->verifikasi)) {
            // jika belum diverifikasi, maka verifikasi
            $verifikasi = now();
            $verifikasi_oleh = Auth::user()->id;

            // tambah poin
            // kontributor
            $poin_verifikasi = addPoint($this->definition->user_id, 'Definisi terverifikasi');
            // pengurus
            $poin_pengurus = addPoint(Auth::user()->id, 'Verifikasi definisi');

            // atur pesan yang akan dikirimkan
            $notif = 'Definisi yang kamu submit untuk kosakata ' . $this->definition->kosakata . ' telah diverifikasi oleh pengurus (+' . $poin_verifikasi . ' poin)';
            $toast = 'Definisi berhasil diverifikasi (+' . $poin_pengurus . ' poin)';
        } else {
            // jika sudah diverifikasi, maka unverifikasi
            $verifikasi = null;
            $verifikasi_oleh = null;

            // Atur poin menjadi 0
            $poin_verifikasi = 0;
            $poin_pengurus = 0;

            // atur pesan yang akan dikirimkan
            $notif = 'Status verifikasi untuk definisi yang kamu submit untuk kosakata ' . $this->definition->kosakata . ' telah dicabut oleh pengurus (-' . $this->definition->poin_verifikasi . ' poin)';
            if (Auth::user()->id == $this->definition->verifikasi_oleh) {
                // tambahkan poin yang dikurang jika user yang meng-unverifikasi adalah yang memverifikasi
                $toast = 'Definisi berhasil di un-verifikasi (-' . $this->definition->poin_pengurus . ' poin)';
            } else {
                $toast = 'Definisi berhasil di un-verifikasi';
            }

            // kurangi poin yang dimiliki oleh kontributor dan pengurus
            // kontributor
            User::find($this->definition->user_id)->decrement('poin', $this->definition->poin_verifikasi);
            // pengurus
            User::find($this->definition->verifikasi_oleh)->decrement('poin', $this->definition->poin_pengurus);
        }

        // simpan verifikasi/unverifikasi
        Definisi::find($this->definition->id)->update([
            'verifikasi' => $verifikasi,
            'verifikasi_oleh' => $verifikasi_oleh,
            'poin_verifikasi' => $poin_verifikasi,
            'poin_pengurus' => $poin_pengurus,
        ]);

        // increment/decrement stat definisi diverifikasi
        changeStat('definisi_diverifikasi', empty($this->definition->verifikasi) ? true : false);

        // buat notifikasi untuk author
        $url = '/kosakata/' . $this->definition->kosakata . '?id=' . $this->definition->id;
        createNotification($this->author->id, 'definisi', $notif, $url);

        if (!empty($this->definition->verifikasi_oleh) && Auth::user()->id != $this->definition->verifikasi_oleh) {
            // kirim notif untuk peng-verifikasi jika definisinya di-unverifikasi
            $notif = 'Definisi yang kamu verifikasi milik ' . $this->author->nama . ' pada kosakata ' . $this->definition->kosakata . ' telah di-unverifikasi oleh ' . Auth::user()->nama . ' (-' . $this->definition->poin_verifikasi . ' poin)';
            createNotification($this->definition->verifikasi_oleh, 'definisi', $notif, $url);
        }

        // kembali ke view
        return redirect($url)->with('success', $toast);
    }

    // tutup popup
    public function close()
    {
        $this->dispatch('closeVerify');
    }
};
?>

<x-popup title="{{ $verified ? 'Verifikasi' : 'Unverifikasi' }}" color="{{ $verified ? 'green' : 'red' }}">
    <p class="py-3">
        Apakah kamu yakin ingin {{ $verified ? 'memverifikasi' : 'meng-unverifikasi' }} definisi yang ditulis
        oleh {{ $author->nama }} ini?
    </p>
    <div class="space-y-1">
        <x-button type="button" width="w-full" model="verify" target="verify"
            color="{{ $verified ? 'bg-green-700 text-green-100' : 'bg-red-600 text-red-100' }}"
            text="Ya, {{ $verified ? 'Verifikasi' : 'Unverifikasi' }}" textLoading="Mengubah status..." />
        <div wire:click='close'>
            <x-button type="button" width="w-full" color="hover:outline outline-2" text="Batal" />
        </div>
    </div>
</x-popup>
