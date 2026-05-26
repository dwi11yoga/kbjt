<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\Definisi;
use App\Models\Blog;
use App\Models\Report;

new class extends Component {
    //
    public $user;
    #[Computed]
    public function additionalInfo()
    {
        $data['definitionsCount'] = Definisi::where('user_id', $this->user->id)->count();
        if ($this->user->role == 'pengurus') {
            $data['articlesCount'] = Blog::where('user_id', $this->user->id)->whereNotNull('status')->count();
        }
        $data['reportsCount'] = Report::where('user_id', $this->user->id)->count();
        return $data;
    }
};
?>

<div class="space-y-6">
    {{-- donasi --}}
    @if (!empty($user->donasi))
        <div id="donasi" class="flex md:flex-row flex-col items-center bg-amber-100 rounded-xl p-5 gap-3">
            {{-- gambar --}}
            <div class="order-2 md:order-1 w-full md:w-2/3 translate-y-5 flex justify-center">
                <img class="object-cover md:w-full md:h-full max-w-96 max-h-96" src="{{ asset('img/donasi-01.png') }}"
                    alt="Good team concept illustration (Freepik/storyset)">
            </div>
            {{-- Isi --}}
            <div class="order-1 md:order-2 w-full rounded-b-2xl space-y-3">
                <h2 class="font-semibold">Berikan dukungan</h2>
                <div class="text-neutral-600">
                    Platform ini hadir berkat kontribusi seluruh penggunanya. Dengan berdonasi, Anda dapat memberikan
                    apresiasi kepada <span class="capitalize">{{ $user->nama }}</span> atas dedikasinya dalam
                    memperkaya
                    kamus ini.
                </div>
                <div class="flex items-center relative">
                    <div class="py-3 px-5 bg-white text-nowrap justify-center items-center rounded-l-xl">
                        {{ $user->donasi['metode'] }}
                    </div>
                    <input id="rekening" type="text" readonly class="rounded-r-xl px-4 py-3 w-full"
                        value="{{ $user->donasi['rekening'] }}">
                    @if ($user->donasi['metode'] == 'QRIS' || $user->donasi['metode'] == 'Saweria' || $user->donasi['metode'] == 'Trakteer')
                        <a href="{{ $user->donasi['rekening'] }}" target="_blank"
                            class="absolute right-3 top-3.5 cursor-pointer"
                            title="Beralih ke {{ $user->donasi['metode'] }}">
                            <i data-lucide='arrow-up-right' class="size-5"></i>
                        </a>
                    @else
                        <span
                            onclick="copyUrl(document.getElementById('rekening'), document.getElementById('copyBefore2'), document.getElementById('copyAfter2'))"
                            class="absolute right-3 top-3.5 cursor-pointer" title="Salin">
                            <i id="copyBefore2" data-lucide='copy' class="size-5"></i>
                            <i id="copyAfter2" data-lucide='check' class="size-5 hidden"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- Bio --}}
    <div class="space-y-4">
        <h2 class="font-semibold">Bio</h2>
        <p class="md:w-2/3 w-full">{{ $user->bio ?? 'Belum ditambahkan.' }}</p>
    </div>

    {{-- Info akun --}}
    <div class="space-y-4">
        <h2 class="font-semibold">Informasi lainnya</h2>
        <div class="space-y-2">
            {{-- <div>
                <div class="text-xs text-neutral-600">Nama lengkap</div>
                <div>{{ $user->nama ?? '-' }}</div>
            </div> --}}
            {{-- <div>
                <div class="text-xs text-neutral-600">Username</div>
                <div>{{ $user->username ?? '-' }}</div>
            </div> --}}
            <div class="flex gap-3 items-center">
                <i data-lucide='calendar-days' class="size-5"></i>
                <div class="">
                    <div class="text-xs text-neutral-600">Tanggal lahir</div>
                    <div>{{ isset($user->tgl_lahir) ? $user->tgl_lahir->Translatedformat('j F Y') : '-' }}</div>
                </div>
            </div>
            <div class="flex gap-3 items-center">
                <i data-lucide='venus-and-mars' class="size-5"></i>
                <div class="">
                    <div class="text-xs text-neutral-600">Jenis kelamin</div>
                    <div>{{ $user->jenis_kelamin ?? '-' }}</div>
                </div>
            </div>
            <div class="flex gap-3 items-center">
                <i data-lucide='map-pin' class="size-5"></i>
                <div class="">
                    <div class="text-xs text-neutral-600">Asal</div>
                    <div>{{ $user->kota ?? '-' }}</div>
                </div>
            </div>
            <div class="flex gap-3 items-center">
                <i data-lucide='clock' class="size-5"></i>
                <div class="">
                    <div class="text-xs text-neutral-600">Bergabung sejak</div>
                    <div>{{ $user->created_at->format('j F Y') }}</div>
                </div>
            </div>
            <div class="flex gap-3 items-center">
                <i data-lucide='message-circle-more' class="size-5"></i>
                <div class="">
                    <div class="text-xs text-neutral-600">Definisi disubmit</div>
                    <div>{{ $this->additionalInfo['definitionsCount'] }}</div>
                </div>
            </div>
            @if (!empty($this->additionalInfo['articlesCount']))
                <div class="flex gap-3 items-center">
                    <i data-lucide='file-text' class="size-5"></i>
                    <div class="">
                        <div class="text-xs text-neutral-600">Artikel dipublikasikan</div>
                        <div>{{ $this->additionalInfo['articlesCount'] }}</div>
                    </div>
                </div>
            @endif
            <div class="flex gap-3 items-center">
                <i data-lucide='flag-triangle-right' class="size-5"></i>
                <div class="">
                    <div class="text-xs text-neutral-600">Laporan disubmit</div>
                    <div>{{ $this->additionalInfo['reportsCount'] }}</div>
                </div>
            </div>
            {{-- <div>
                <div class="text-xs text-neutral-600">Tautan akun</div>
                <div id="url" title="Salin url"
                    onclick="copyUrl(this, document.getElementById('copyBefore'), document.getElementById('copyAfter'))"
                    class="inline-block bg-neutral-50 rounded-full py-0.5 px-2 cursor-pointer">
                    {{ $user->url }}<i id="copyBefore" data-feather='copy' class="w-4 ml-1 inline-block"></i><i
                        id="copyAfter" data-feather='check' class="w-4 ml-1 hidden"></i>
                </div>
            </div> --}}
        </div>
    </div>

    {{-- Kontak --}}
    <div class="space-y-4">
        <h2 class="font-semibold">Kontak</h2>
        <div class="space-y-2">
            <div class="flex gap-3 items-center">
                <i data-lucide='mail' class="size-5"></i>
                <div class="">
                    <div class="text-xs text-neutral-600">Email</div>
                    @if (isset($user->sembunyikan_data['email']) && $user->sembunyikan_data['email'] == false)
                        <a href="mailto:{{ $user->email }}" target="_blank"
                            class="hover:underline focus:underline focus:outline-none underline-offset-4 decoration-amber-400 decoration-4">
                            {{ $user->email }}
                        </a>
                    @else
                        <div class="">-</div>
                    @endif
                </div>
            </div>
            <div class="flex gap-3 items-center">
                <i data-lucide='phone' class="size-5"></i>
                <div class="">
                    <div class="text-xs text-neutral-600">Telepon</div>
                    <div class="">
                        {{ isset($user->telp) && isset($user->sembunyikan_data['telp']) && $user->sembunyikan_data['telp'] == false ? $user->telp : '-' }}
                    </div>
                    {{-- <div>{{ $user->telp ?? '-' }}</div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
