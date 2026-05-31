<?php

use Livewire\Component;
use Livewire\Attributes\Computed;

new class extends Component {
    // cek apakah data pengguna lengkap/tidak
    #[Computed]
    public function incompleteUserData()
    {
        $user = auth()->user();
        return empty($user->jenis_kelamin) || empty($user->tgl_lahir) ? true : false;
        // true jika tidak lengkap
    }
};
?>

<div class="mb-4 space-y-2">
    {{-- Pemberitahuan untuk melengkapi data diri --}}
    @if ($this->incompleteUserData)
        <div class="md:flex md:justify-between bg-white border border-neutral-200 rounded-xl p-3 shadow-sm">
            <div>Segera lengkapi profil kamu.</div>
            <a href="/pengaturan/edit-user" class="text-amber-600 md:text-base text-sm flex items-center gap-1">
                <div class="">Pergi ke pengaturan</div>
                <i data-lucide='arrow-right' class="md:size-5 size-4"></i>
            </a>
        </div>
    @endif

    {{-- jika user tersuspend untuk berkontribusi --}}
    @if (suspendedAccount())
        <div class="md:flex md:justify-between bg-red-100 border border-neutral-200 rounded-xl p-3 shadow-sm">
            <div>Saat ini kamu tidak dapat berkontribusi karena akunmu sedang ditangguhkan hingga
                {{ auth()->user()->suspended_time->format('j F Y H:i') }}.</div>
            <a href="#" class="text-red-600 md:text-base text-sm">Pelajari lebih lanjut<i
                    data-feather='arrow-up-right' class="inline-block md:w-5 w-4"></i></a>
        </div>
    @endif
</div>
