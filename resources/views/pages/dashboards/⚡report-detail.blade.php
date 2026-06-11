<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use App\Models\Report;
use App\Models\Definisi;
use App\Models\User;
use App\Mail\UserDiblokir;
use Carbon\Carbon;

new class extends Component {
    // id laporan
    #[Title('Laporan')]
    #[Layout('layouts.dashboard')]
    public $id;
    #[Computed]
    public function details()
    {
        // ambil data laporan
        $laporan = Report::with('definisi')->with('user')->with('pengurus')->find($this->id);

        // alihkan jika data laporan tidak ditemukan
        if (empty($laporan)) {
            abort('404', 'Laporan tidak ditemukan');
        }
        // ambil data definisi dan author
        $laporan->author = User::withTrashed()->where('id', $laporan->definisi->user_id)->first();
        // cek apakah data pengurus terhapus/tidak
        if ($laporan->author->trashed()) {
            $laporan->author->statusUser = 'dihapus';
        }

        // alihkan jika user tidak berhak
        if (auth()->user()->role == 'kontributor' && $laporan->user_id != auth()->user()->id && $laporan->author->id != auth()->user()->id) {
            abort('403', 'Akses ditolak');
        }

        // buat id zerofill
        $laporan->idZerofill = str_pad($laporan->id, 10, '0', STR_PAD_LEFT);

        return $laporan;
    }

    // simulasikan poin pengguna yang akan dikurangi saat hukuman adalah pengurangan poin
    #[Computed]
    public function penaltySimulation()
    {
        // hitung berapa poin yang dikurangi jika hukuman yang diberikan adalah pengurangan poin
        $persentasePoinDikurang = [2, 5, 8, 10, 15, 20];
        foreach ($persentasePoinDikurang as $d) {
            //bulatkan
            $hasilPenguranganPoin[$d] = (int) round($this->details->author->poin - ($this->details->author->poin * $d) / 100);
        }
        return $hasilPenguranganPoin;
    }

    // SIMPAN TINDAKAN
    #[Validate('required')]
    public $pelanggaran; // pelanggaran ditemukan/tidak
    public $tindakanDefinisi;
    public $hukuman; // hukuman untuk terlapor
    #[Validate('nullable')]
    public $catatan;

    // validasi
    public function rules(): array
    {
        $rules = ['pelanggaran' => 'required'];
        // jika pelanggaran ditemukan, maka tambah validasi pada tindakan dan hukuman
        if ($this->pelanggaran == 1) {
            $rules = array_merge($rules, [
                'tindakanDefinisi' => 'required',
                'hukuman' => 'required',
            ]);
        }

        return $rules;
    }
    public function updatedTindakanDefinisi()
    {
        $this->validateOnly('tindakanDefinisi');
    }
    public function updatedHukuman()
    {
        $this->validateOnly('hukuman');
    }

    // simpan tindakan
    public function save()
    {
        // validasi
        $this->validate();

        // dapatkan data laporan
        $laporan = $this->details;

        // cek apakah laporan sudah ditangani pengurus lain
        // alihkan jika laporan yang dikirim sudah ditangani oleh pengurus lain (kuatir di inspect)
        $cek = Report::find($this->id);
        if (isset($cek->status)) {
            $this->dispatch('notify', type: 'failed', message: 'Laporan sudah selesai ditangani oleh pengurus lain');
            return;
        }

        // pengurus hanya boleh menangani laporan dgn author kontributor & pengurus hanya boleh menangani laporan dgn author kontributors
        $cek = (auth()->user()->role == 'pengurus' && $laporan->author->role != 'kontributor') || (auth()->user()->role == 'kepala' && $laporan->author->role != 'pengurus');
        if ($cek) {
            abort(403, 'Akses tidak diizinkan');
        }

        // atur data hukuman
        if ($this->hukuman == 'peringatan') {
            // jika hukumannya hanya peringatan
            $hukuman = 'Peringatan';
            $hukuman_berakhir = null;
        } elseif (substr($this->hukuman, 0, 11) == 'kurangiPoin') {
            // jika hukumannya pengurangan poin
            $userPoin = $laporan->author->poin;

            // hitung poin yang akan dikurangi
            $persentase = intval(substr($this->hukuman, 11, 3)); // dapatkan persentase
            $hukumanPoin = ($userPoin * $persentase) / 100; // jumlah poin yang akan dikurangi dari poin milik user.
            $hasil = round($userPoin - $hukumanPoin);
            // data yang akan disimpan
            $hukuman = 'Penguranagan poin sebesar ' . $persentase . '%, dari ' . $userPoin . ' menjadi ' . $hasil;
            $hukuman_berakhir = null;
        } elseif (substr($this->hukuman, -2) == 'hr') {
            // jika hukumannya suspend
            $lama = (int) rtrim($this->hukuman, 'hr'); // hapus hr. lama dalam hari.
            $hukuman = 'Suspend selama ' . $lama . ' hari';
            $hukuman_berakhir = now()->addDays($lama);
        } elseif ($this->hukuman == 'blokir') {
            // jika hukumannya memblokir akun author
            $hukuman = 'Akun terlapor diblokir';
            $hukuman_berakhir = null;
        } else {
            // jika tidak diberi hukuman
            $hukuman = 'Tidak ada';
            $hukuman_berakhir = null;
        }

        // tindakan: jalankan hukuman
        if ($this->pelanggaran == 1) {
            // set data yang akan diperbarui
            $data = [
                'tindakan' => $this->tindakanDefinisi,
                'hukuman' => $hukuman,
                'hukuman_berakhir' => $hukuman_berakhir,
            ];

            // tindakan untuk definisi
            if ($this->tindakanDefinisi == 'hapus') {
                // hapus definisi
                Definisi::find($laporan->definisi_id)->delete();
                // kurangi poin yang diterima oleh user dari definisi yang dihapus
                $poin_dikurang = $laporan->definisi->poin_kontributor + $laporan->definisi->poin_verifikasi;
            } else {
                // minta user untuk edit definisi
                Definisi::find($laporan->definisi_id)->update([
                    'hukuman_edit' => 1, // maka definisi tidak akan ditampilkan di web
                    'verifikasi' => null, // cabut status terverifikasi
                    'verifikasi_oleh' => null,
                ]);
                // kurangi poin pengguna dari poin verifikasi
                $poin_dikurang = $laporan->definisi->poin_verifikasi ?? 0;
            }

            // tindakan untuk pengguna
            if (substr($this->hukuman, 0, 11) == 'kurangiPoin') {
                // kurangi poin
                $poin_dikurang = $poin_dikurang + $hukumanPoin;
                $hasil = round($userPoin - $poin_dikurang);
                $hukuman = "Pengurangan poin {$persentase}% (ditambah poin kontribusi & verifikasi), dari {$userPoin} menjadi {$hasil}";
            } elseif (substr($this->hukuman, -2) == 'hr') {
                // suspend pengguna
                // hapus hr. lama dalam hari.
                $lama = (int) rtrim($this->hukuman, 'hr');
                // set berapa lama pengguna akan disuspend. jika sebelumnya sudah disuspend, maka tambah waktu suspend
                $currenly_suspended = !empty($laporan->author->suspended_time) ? Carbon::parse($laporan->author->suspended_time) : now();
                $suspended = $currenly_suspended->addDays($lama);
                User::find($laporan->author->id)->update(['suspended_time' => $suspended]);
            } elseif ($this->hukuman == 'blokir') {
                // Jika user diblokir, maka hapus user
                User::find($laporan->author->id)->delete();
            }

            // kurangi poin terlapor
            User::withTrashed()->find($laporan->author->id)->decrement('poin', $poin_dikurang);
        } else {
            $data = [];
        }

        // tambahkan poin untuk pelapor dan pengurus
        // pelapor
        $poin_pelapor = $this->pelanggaran == 1 ? addPoint($laporan->user_id, 'Laporkan definisi') : 0;
        // pengurus
        $poin_pengurus = addPoint(auth()->user()->id, 'Tindaklanjuti laporan');

        // tambahkan data yang diupdate
        $newData = [
            'status' => now(), //
            'pengurus_id' => auth()->user()->id,
            'catatan_pengurus' => $this->catatan,
            'poin_pelapor' => $poin_pelapor,
            'poin_pengurus' => $poin_pengurus,
            'poin_terlapor' => $poin_dikurang,
        ];
        $data = array_merge($data, $newData);

        // ubah status laporan
        Report::find($this->id)->update($data);

        // increment laporan ditangani di statistik
        changeStat('laporan_ditangani', true);
        // jika laporan dinyatakan bersalah, increment laporan bersalah di statistik
        if ($this->pelanggaran == 1) {
            changeStat('laporan_bersalah', true);
        }

        // KIRIM NOTIFIKASI
        $url = '/laporan/' . $this->id;
        // untuk pelapor
        // jika pelapor == yang menindaklanjuti laporan, maka tidak perlu dikirimi notifikasi
        if (auth()->user()->id != $laporan->user_id) {
            $pesan = 'Laporan kamu atas definisi yang disubmit oleh ' . $laporan->user->nama . ' telah selesai ditangani (+' . $poin_pelapor . ' poin)';
            createNotification($laporan->user_id, 'laporan', $pesan, $url);
        }
        // untuk terlapor
        $pesan = 'Seseorang melaporkan kosakata yang kamu submit (-' . ($poin_dikurang ?? 0) . ' poin) ';
        createNotification($laporan->author->id, 'laporan', $pesan, $url);

        // kirimkan notifikasi email jika hukuman user adalah blokir permanen
        if ($this->pelanggaran == 1 && $this->hukuman == 'blokir') {
            $kontibusi = $laporan->definisi->definisi;
            $url = getUrl();
            Mail::to($laporan->author->email)->send(new UserDiblokir($laporan->author, $kontibusi, $laporan, $url));
        }

        // cek achievement
        // cek apakah pelapor mendapatkan achievement berdasarkan jumlah laporan yang didapat
        achievement($laporan->user_id, 'laporan');

        // render ulang halaman
        unset($this->details);
        // kembali ke halaman detail laporan
        $this->dispatch('notify', type: 'success', message: 'Tindakan berhasil disimpan (+' . $poin_pengurus . ' poin)');
        return;
    }
};
?>

<div class="space-y-5">
    {{-- data laporan --}}
    <div class="grid md:grid-cols-3 grid-cols-1 md:gap-2 gap-3">

        {{-- detail laporan --}}
        <x-report.detail :details="$this->details" />

        {{-- hasil tindak lanjut --}}
        @isset($this->details->status)
            <x-report.result :details="$this->details" />
        @endisset

        {{-- pelapor, terlapor, dan pengurus --}}
        @if (!empty($this->details->status))
            <x-report.related-users :details="$this->details" />
        @endif

        {{-- salinan definisi/kosakata dilaporkan --}}
        <x-report.definition-copy :details="$this->details" />

        {{-- tentang pelapor --}}
        @if (empty($this->details->status))
            <livewire:report.pelapor pelaporId="{{ $this->details->user_id }}" />
        @endif

        {{-- Tentang terlapor --}}
        @if (empty($this->details->status))
            <livewire:report.terlapor terlaporId="{{ $this->details->definisi->user_id }}" />
        @endif

        {{-- riwayat hukuman --}}
        @if (empty($this->details->status))
            <livewire:report.punishment-history terlaporId="{{ $this->details->definisi->user_id }}" />
        @endif

        {{-- banner ucapan terima kasih kepada pengurus/kontributor --}}
        @if (isset($this->details->status) &&
                ($this->details->pengurus_id == auth()->user()->id || $this->details->user->id == auth()->user()->id))
            <x-report.banner-thanks />
        @endif

        {{-- banner bantuan untuk user yang definisinya disembunyikan --}}
        @if (isset($this->details->status) &&
                $this->details->author->id == auth()->user()->id &&
                !empty($this->details->hukuman) &&
                $this->details->tindakan == 'edit')
            <x-report.banner-help />
        @endif

        {{-- banner jika definisi/kosakata dihapus --}}
        @if (isset($this->details->pengurus_id) &&
                $this->details->author->id == auth()->user()->id &&
                !empty($this->details->hukuman) &&
                $this->details->tindakan == 'hapus')
            <x-report.banner-deleted-definition />
        @endif
    </div>

    {{-- tindakan --}}
    @if (empty($this->details->status))
        <div class="space-y-2">
            <div class="">Tindakan</div>
            @if (
                (auth()->user()->role == 'pengurus' && $this->details->author->role != 'kontributor') ||
                    (auth()->user()->role == 'kepala' && $this->details->author->role != 'pengurus'))
                {{-- pengurus hanya boleh menangani laporan dgn author kontributor & pengurus hanya boleh menangani laporan dgn author kontributor --}}
                <x-errors.not-authorized text="Kamu tidak diizinkan menangani laporan ini" />
            @else
                {{-- tindakan untuk definisi --}}
                <form wire:submit='save' class="space-y-5">
                    {{-- menentukan pelanggaran --}}
                    <div class="space-y-2">
                        <div class="">Buat keputusan</div>
                        @error('pelanggaran')
                            <div class="text-sm text-red-600 -mt-2 mb-2">{{ $message }}</div>
                        @enderror
                        <div class="">
                            <div class="grid md:grid-cols-2 grid-cols-1 gap-2">
                                <x-report.action-item model="pelanggaran" id="false" value="0"
                                    text="Pelanggaran tidak ditemukan" icon="x" />
                                <x-report.action-item model="pelanggaran" id="true" value="1"
                                    text="Pelanggaran ditemukan" icon="check" />
                            </div>
                        </div>
                    </div>

                    @if ($pelanggaran)
                        {{-- Tindakan terhadap definisi --}}
                        <div class="space-y-2">
                            <div class="">Tindakan terhadap definisi</div>
                            @error('tindakanDefinisi')
                                <div class="text-sm text-red-600 -mt-2 mb-2">{{ $message }}</div>
                            @enderror
                            <div class="space-y-2">
                                {{-- edit --}}
                                <x-report.action-item model="tindakanDefinisi" id="edit" value="edit"
                                    text="Minta {{ $this->details->author->nama }} untuk mengedit definisi"
                                    icon="pencil" />
                                {{-- hapus definisi --}}
                                <x-report.action-item model="tindakanDefinisi" id="hapus" value="hapus"
                                    text="Hapus definisi" icon="trash" />
                            </div>
                        </div>

                        {{-- Tindakan terhadap terlapor --}}
                        <div class="">
                            <div class="mb-2">Hukuman untuk {{ $this->details->author->nama }}</div>
                            @error('hukuman')
                                <div class="text-sm text-red-600 -mt-2 mb-2">{{ $message }}</div>
                            @enderror

                            <div class="space-y-2">
                                {{-- Tidak ada --}}
                                <x-report.action-item model="hukuman" id="tidak-ada" value="tidak-ada" text="Tidak ada"
                                    icon="x" />
                                {{-- peringatan --}}
                                <x-report.action-item model="hukuman" id="peringatan" value="peringatan"
                                    text="Beri peringatan" icon="triangle-alert" />

                                {{-- kurangi poin --}}
                                {{-- peringatan --}}
                                <x-report.action-item model="hukuman" id="kurangiPoin002" value="kurangiPoin002"
                                    text="Kurangi poin sebesar 2% ({{ $this->details->author->poin }} → {{ $this->penaltySimulation[2] }} poin)"
                                    icon="arrow-down" />
                                {{-- peringatan --}}
                                <x-report.action-item model="hukuman" id="kurangiPoin005" value="kurangiPoin005"
                                    text="Kurangi poin sebesar 5% ({{ $this->details->author->poin }} → {{ $this->penaltySimulation[5] }} poin)"
                                    icon="arrow-down" />
                                {{-- peringatan --}}
                                <x-report.action-item model="hukuman" id="kurangiPoin008" value="kurangiPoin008"
                                    text="Kurangi poin sebesar 8% ({{ $this->details->author->poin }} → {{ $this->penaltySimulation[8] }} poin)"
                                    icon="arrow-down" />
                                {{-- peringatan --}}
                                <x-report.action-item model="hukuman" id="kurangiPoin010" value="kurangiPoin010"
                                    text="Kurangi poin sebesar 10% ({{ $this->details->author->poin }} → {{ $this->penaltySimulation[10] }} poin)"
                                    icon="arrow-down" />
                                {{-- peringatan --}}
                                <x-report.action-item model="hukuman" id="kurangiPoin015" value="kurangiPoin015"
                                    text="Kurangi poin sebesar 15% ({{ $this->details->author->poin }} → {{ $this->penaltySimulation[15] }} poin)"
                                    icon="arrow-down" />
                                {{-- peringatan --}}
                                <x-report.action-item model="hukuman" id="kurangiPoin020" value="kurangiPoin020"
                                    text="Kurangi poin sebesar 20% ({{ $this->details->author->poin }} → {{ $this->penaltySimulation[20] }} poin)"
                                    icon="arrow-down" />

                                {{-- suspend --}}
                                {{-- 3 hari --}}
                                <x-report.action-item model="hukuman" id="3hr" value="3hr"
                                    text="Cegah untuk berkontribusi selama 3 hari" icon="circle-pause" />
                                {{-- 7 hari --}}
                                <x-report.action-item model="hukuman" id="7hr" value="7hr"
                                    text="Cegah untuk berkontribusi selama 7 hari" icon="circle-pause" />
                                {{-- 14 hari --}}
                                <x-report.action-item model="hukuman" id="14hr" value="14hr"
                                    text="Cegah untuk berkontribusi selama 14 hari" icon="circle-pause" />
                                {{-- 30 hari --}}
                                <x-report.action-item model="hukuman" id="30hr" value="30hr"
                                    text="Cegah untuk berkontribusi selama 30 hari" icon="circle-pause" />

                                {{-- blokir --}}
                                <x-report.action-item model="hukuman" id="blokir" value="blokir"
                                    text="Blokir akun secara permanen" icon="ban" />
                            </div>
                        </div>
                    @endif

                    {{-- Catatan --}}
                    <x-input-textarea id="catatan" model="catatan" label="Catatan (opsional)"
                        placeholder="Ketik disini..." />

                    {{-- Tombol simpan --}}
                    <div id="save" class="">
                        <div class="w-full rounded-xl p-4 mb-5 flex justify-between items-center">
                            <div>
                                <div>Simpan tindakan?</div>
                                <div class="text-sm">Tindakan yang disimpan tidak dapat diubah.</div>
                            </div>
                            <x-button type="submit" target="save" text="Simpan" textLoading="Menyimpan..."
                                icon="save" />
                        </div>
                    </div>

                </form>
            @endif
        </div>
    @endif
</div>
