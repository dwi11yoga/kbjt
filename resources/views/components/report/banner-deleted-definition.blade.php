{{-- banner jika definisi/kosakata dihapus --}}
<div class="md:col-span-2 col-span-1">
    <x-bento-item color="bg-amber-50 text-amber-700">
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                {{-- <div class="font-semibold text-lg">Terima kasih, {{ auth()->user()->nama }}!</div> --}}
                <div class="">
                    Yuk, pastikan definisi atau kosakata yang kamu kirim sesuai dengan kebijakan komunitas.
                    Baca
                    artikel berikut sebagai panduan untuk kontribusi kamu selanjutnya!
                </div>
                {{-- rekomendasikan artikel agar bisa jadi lebih baik --}}
                <div class="text-sm">
                    <a href="#" class="block hover:underline decoration-4 underline-offset-4 decoration-amber-400">
                        <span>Cara berkontribusi dengan baik</span>
                        <i data-lucide='arrow-right' class="size-4 inline"></i>
                    </a>
                    <a href="#"
                        class="block hover:underline decoration-4 underline-offset-4 decoration-amber-400">
                        <span>Contoh definisi & kosakata yang baik</span>
                        <i data-lucide='arrow-right' class="size-4 inline"></i>
                    </a>
                </div>
            </div>
            <div class="w-[80%]">
                <img src="{{ asset('img/hand-holding-pen-by-storyset.png') }}" class="md:max-h-none max-h-52"
                    alt="Family protection concept illustration by storyset (freepik)">
            </div>
        </div>
    </x-bento-item>
</div>
