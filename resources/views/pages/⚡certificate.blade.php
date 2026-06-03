<?php

use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Models\User;
use App\Models\Sertifikat;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

new class extends Component {
    // dapatkan data dari url
    #[Title('Sertifikat')]
    #[Layout('layouts.certificate')]
    public $userId;
    public $sertifikatId;
    #[Computed]
    public function certificate()
    {
        // dapatkan data dari db
        $user = User::select('nama', 'username', 'id', 'sertifikat')->where('username', $this->userId)->first();
        $user->idZerofill = str_pad($user->id, 10, '0', STR_PAD_LEFT);

        // tampilkan halaman eerror jika user belum dapat sertifikat
        if (empty($user->sertifikat[$this->sertifikatId])) {
            abort(404, 'Sertifikat tidak ditemukan');
        }

        // dapatkan data sertifikat
        $sertifikat = Sertifikat::find($this->sertifikatId);
        $sertifikat->didapat = Carbon::parse($user->sertifikat[$sertifikat->id])
            ->setTimezone('Asia/Jakarta')
            ->translatedFormat('d F Y');

        // dapatkan data kepala
        $kepala = User::select('nama')->where('role', 'kepala')->first();

        // generate qr code menggunakan simple qrcode (untuk membuktikan bahwa sertifikatnya asli)
        $url = getUrl() . '/s/' . $user->username . '/' . $sertifikat->id;
        $qrcode = QrCode::size(112)->generate($url);
        $data = (object) [
            'sertifikat' => $sertifikat,
            'user' => $user,
            'kepala' => $kepala,
            'qrcode' => $qrcode,
        ];
        return $data;
    }
};
?>

{{-- sertifikat --}}
<div class="relative p-20 border overflow-hidden" style="width: 297mm; height: 210mm; background-color: #FDFDFD;">

    <div class="grid grid-rows-3 h-full">
        {{-- bag atas --}}
        <div class="grid grid-cols-10">
            <div class="col-span-9 space-y-0.5">
                <h4 class="font-bold underline decoration-amber-400 underline-offset-4 decoration-4">kbjt</h4>
                <div class="text-xl">Kamus Bahasa Jawa Terbuka</div>
                <div class="jawa text-xl">ꦥꦼꦥꦏ꧀ꦧꦱꦗꦮꦏꦧꦶꦏꦏ꧀</div>
            </div>

            <div class="col-span-1">
                {!! $this->certificate->qrcode !!}
                {{-- <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg"
                        alt="QR Code" class="w-28"> --}}
            </div>
        </div>

        {{-- bag tengah --}}
        <div class="flex items-center">
            <div class="space-y-1" style="max-width: 55%">
                <div class="text-5xl font-bold text-amber-700">Sertifikat</div>
                <div class="text-2xl capitalize">{{ $this->certificate->sertifikat->nama }}</div>
                <div class="jawa text-xl">ꦱꦺꦂꦠꦶꦥ꦳ꦶꦏꦠ꧀ꦥꦏꦸꦂꦩꦠꦤ꧀</div>
            </div>
        </div>

        {{-- bag bawah --}}
        <div class="grid grid-cols-2">
            <div class="flex items-end">
                <div class="max-w-[75%]">
                    <div class="jawa text-lg">ꦏꦥꦫꦶꦔꦏꦼꦤ꧀ꦝꦠꦼꦁ</div>
                    <div class="text-xl -mt-1">Diberikan kepada</div>
                    <div class="text-3xl font-bold">{{ $this->certificate->user->nama }}</div>
                    <div>ID:{{ $this->certificate->user->idZerofill }}</div>
                    <div class="mt-2">Valid sejak {{ $this->certificate->sertifikat->didapat }}</div>
                </div>
            </div>

            <div class="flex items-end justify-center">
                <div>
                    <div>
                        {{-- <img src="https://upload.wikimedia.org/wikipedia/id/b/b7/Tanda_Tangan_Sjachroedin_ZP.png"
                                alt="tanda tangan" class="w-40"> --}}
                        Diberikan oleh
                    </div>
                    <div class="font-medium text-xl">{{ $this->certificate->kepala->nama }}</div>
                    <div class="">Kepala KBJT</div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{ asset('img/yellow-flower.png') }}"
        class="absolute top-64 left-[28rem] h-[40rem] rotate-[33deg] opacity-60">

</div>
