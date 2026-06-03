<?php

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\Sertifikat;
use App\Models\User;
use App\Models\Notifikasi;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    // dapatkan data sertifikat
    #[Title('Sertifikat')]
    #[Layout('layouts.dashboard')]
    #[Computed]
    public function certificates()
    {
        if (auth()->user()->role == 'kepala') {
            $sertifikat = Sertifikat::select('*');
        } else {
            $sertifikat = Sertifikat::where('role', auth()->user()->role)->orWhereNull('role');
        }

        $sertifikat = $sertifikat->orderBy('rule', 'asc')->orderBy('requirement', 'asc')->paginate(20);

        if (auth()->user()->role == 'kepala') {
            return $sertifikat;
        }

        // cek apakah sudah didapat/belum & hitung progress
        $didapat = auth()->user()->sertifikat;
        foreach ($sertifikat as $d) {
            if (in_array($d->id, array_keys(is_array($didapat) ? $didapat : []))) {
                $d->didapat = 1;
                $d->tglDiperoleh = dateFormat(Carbon::parse($didapat[$d->id]));
                $d->persentase = '100%';
            }

            // jika sertifikat sudah didapat
            // skip iterasi ini, lanjut ke berikutnya
            if (!empty($d->didapat)) {
                continue;
            }

            // cek apakah pengguna bisa klaim sertifikat
            $nilai = userContributionTotal($d->rule, auth()->user()->id);
            $d->progress = round($nilai);

            // jika kontribusi memenuhi requirement
            if ($nilai > $d->requirement) {
                $d->persentase = '100%';

                // buat notifikasi, namun pastikan dulu agar notifikasi tidak dobel
                $pesan = 'Kamu berhak untuk meng-klaim sertifikat karena ' . strtolower($d->nama) . ' 🎉';
                $url = '/sertifikat';
                $cekNotifikasi = Notifikasi::where('user_id', auth()->user()->id)
                    ->where('message', $pesan)
                    ->orderBy('created_at', 'desc')
                    ->first();
                if (empty($cekNotifikasi)) {
                    createNotification(auth()->user()->id, 'sertifikat', $pesan, $url);
                }
            } else {
                $d->persentase = percentage($nilai, $d->requirement);
            }
        }
        return $sertifikat;
    }

    // klaim sertifikat
    public function claim(int $certificateId)
    {
        // cek apakah user sudah memiliki sertifikat tsb
        $sertifDimiliki = auth()->user()->sertifikat;
        if (in_array($certificateId, array_keys(is_array($sertifDimiliki) ? $sertifDimiliki : []))) {
            $this->dispatch('notify', type: 'failed', message: 'Tidak dapat mengklaim kembali sertifikat yang sudah dimiliki');
            return;
        }

        // cek kembali apakah user memenuhi syarat untuk mendapat sertifikat
        $sertifikat = Sertifikat::find($certificateId);
        // cek apakah role user berhak mendapatkan sertifikat
        // jika sertifikat rule diset, hanya role tsb berhak
        if (!empty($sertifikat->role) && auth()->user()->role != $sertifikat->role) {
            $this->dispatch('notify', type: 'failed', message: 'Anda tidak berhak untuk mengklaim sertifikat ini');
            return;
        }
        // apakan kontribusi pengguna > requirement
        $totalKontribusi = userContributionTotal($sertifikat->rule, auth()->user()->id);
        if (round($totalKontribusi) < $sertifikat->requirement) {
            $this->dispatch('notify', type: 'failed', message: 'Kamu belum memenuhi syarat untuk mengklaim sertifikat ini');
            return;
        }

        // simpan sertifikat
        $sertifDimiliki[$certificateId] = now();
        User::find(auth()->user()->id)->update(['sertifikat' => $sertifDimiliki]);

        // tambah poin pengguna yang mengklaim
        User::find(auth()->user()->id)->increment('poin', $sertifikat->reward);

        // kirimkan notifikasi
        $pesan = 'Kamu berhasil meng-klaim sertifikat ' . strtolower($sertifikat->nama) . '(+' . $sertifikat->reward . ' poin)';
        $url = '/sertifikat';
        createNotification(auth()->user()->id, 'sertifikat', $pesan, $url);

        // tampilkan hal. detail sertifikat
        // return redirect()->to('/report')->with('success', 'Sertifikat berhasil diklaim');
        // refresh auth user agar computed dapat data terbaru
        auth()->setUser(auth()->user()->fresh());
        unset($this->certificates);
        $this->dispatch('notify', type: 'success', message: 'Sertifikat berhasil diklaim');
    }
};
?>

<div class="space-y-5">
    {{-- tambah sertifikat --}}
    @if (auth()->user()->role == 'kepala')
        <div class="md:flex md:justify-between">
            {{-- Buat artikel --}}
            <a href="/sertifikat/tambah">
                <div class="md:mt-0 mt-2 py-4 px-5 bg-white rounded-xl hover:outline hover:outline-amber-200">
                    <i data-lucide='plus' class="w-5 inline-block"></i>
                    <span>Tambah</span>
                </div>
            </a>
        </div>
    @endif
    {{-- daftar sertifikat --}}
    <div class="space-y-2">
        @foreach ($this->certificates as $d)
            <x-list-item type="{{ auth()->user()->role == 'kepala' || $d->didapat == 1 ? 'url' : 'div' }}"
                url="{{ auth()->user()->role == 'kepala' ? '/sertifikat/edit/' . $d->id : ($d->didapat == 1 ? '/s/' . auth()->user()->username . '/' . $d->id : '#') }}">
                <x-slot:leftText>
                    <div class="flex item-center gap-5 w-full">
                        {{-- icon --}}
                        <div
                            class="p-8 flex items-center justify-center {{ auth()->user()->role != 'kepala' && isset($d->didapat) && $d->didapat == 1 ? 'bg-amber-400' : 'bg-neutral-200' }} aspect-square rounded-xl">
                            <i
                                data-lucide='{{ auth()->user()->role != 'kepala' && isset($d->didapat) && $d->didapat == 1 ? 'lock-open' : 'lock' }}'></i>
                        </div>
                        {{-- detail --}}
                        <div class="flex flex-col gap-2 justify-center w-full">
                            {{-- nama --}}
                            <div class="capitalize font-medium">{{ $d->nama }}</div>
                            {{-- progress --}}
                            <div class="text-sm flex flex-wrap items-center gap-1">
                                <div class="flex gap-0.5 items-center">
                                    <i data-lucide='astroid' class="w-4 fill-black"></i>
                                    <div>{{ $d->reward }}</div>
                                    <div class="md:block hidden">•</div>
                                </div>
                                @if (auth()->user()->role == 'kepala')
                                    <div class="">
                                        Dapat diperoleh oleh {{ isset($d->role) ? $d->role : 'semua pengguna' }}
                                        dengan
                                        {{ $d->rule == 'kontribusi' || $d->rule == 'kontribusiPengurus' ? 'total kontribusi' : $d->rule }}
                                        ≥
                                        {{ $d->rule == 'keanggotaan' ? $d->requirement / 360 . ' tahun' : $d->requirement }}.
                                    </div>
                                @else
                                    <div>{{ $d->persentase }}</div>
                                    <div class="">
                                        @isset($d->tglDiperoleh)
                                            — Diperoleh pada
                                            {{ $d->tglDiperoleh }}
                                        @else
                                            — {{ $d->progress }}/{{ $d->requirement }}
                                            {{ $d->rule == 'keanggotaan' ? ' hari' : ' kontribusi' }}
                                        @endisset
                                    </div>
                                @endif
                            </div>
                            {{-- progress --}}
                            @if (auth()->user()->role != 'kepala')
                                <div class="relative">
                                    <div class="absolute w-full bg-neutral-200 rounded-full py-1 "></div>
                                    <div class="absolute bg-amber-400 rounded-full py-1"
                                        style="width: {{ $d->persentase }}">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </x-slot:leftText>
                @if (auth()->user()->role != 'kepala' && $d->progress >= $d->requirement)
                    <x-slot:rightText>
                        <form wire:submit='claim({{ $d->id }})'
                            class="py-3 pl-3 w-full h-full flex items-center">
                            <x-button target="claim({{ $d->id }})" type="submit" text="Klaim"
                                textLoading="Mengklaim..." width="w-full" color="bg-amber-200 hover:bg-amber-400" />
                        </form>
                    </x-slot:rightText>
                @endif
            </x-list-item>
        @endforeach
    </div>

    <div class="">
        {{ $this->certificates->links() }}
    </div>
</div>
