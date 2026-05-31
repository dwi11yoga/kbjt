<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new class extends Component {
    //
    #[Title('Akun anda tidak dapat diakses')]
    public $lorem;
};
?>

<div class="container mx-auto p-10 flex justify-center">
    <div class="p-12 rounded-2xl border border-neutral-200">
        <div class="grid grid-cols-3 md:space-x-3 md:space-y-0 space-y-3 items-center">

            <div class="md:order-1 order-2 md:col-span-1 col-span-3 flex justify-center">
                <img src="{{ asset('img/Apologize-by-storyset.png') }}" class="w-72" alt="">
            </div>

            <div class="md:order-2 order-1 md:col-span-2 col-span-3 space-y-3">
                <h2>Akun anda tidak dapat diakses</h2>
                <p>
                    Mohon maaf, akun Anda saat ini tidak lagi tersedia. Hal ini dapat disebabkan oleh pemblokiran akibat
                    pelanggaran kebijakan, atau karena akun telah dihapus atas permintaan Anda sendiri.
                </p>
                <p>
                    Apabila Anda merasa hal ini terjadi tanpa sepengetahuan Anda dan memerlukan bantuan, silakan hubungi
                    kami melalui email atau media sosial.
                </p>
                <div>— Terima kasih.</div>
            </div>

        </div>
    </div>
</div>
