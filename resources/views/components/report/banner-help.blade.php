{{-- banner bantuan untuk user yang definisinya disembunyikan --}}
<div class="md:col-span-2 col-span-1">
    <x-bento-item color="bg-amber-50 text-amber-700">
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                <div class="font-semibold text-lg">Bantuan</div>
                <div class="">
                    <span class="">Pelajari bagaimana cara agar definisi ini dapat kembali
                        ditampilkan
                        secara publik
                    </span>
                    <a href="/blog/mengembalikan-definisi-yang-disembunyikan-setelah-dilaporkan"
                        class="hover:underline decoration-4 underline-offset-4 decoration-amber-400">
                        disini<i data-lucide='arrow-right' class="w-5 inline"></i>
                    </a>
                </div>
                <div class="text-sm">
                    <div class="">Baca juga</div>
                    <a href="/blog/berkontribusi-sebagai-kontributor-di-kamus-bahasa-jawa-terbuka"
                        class="block hover:underline decoration-4 underline-offset-4 decoration-amber-400">
                        <span class="">Dokumentasi: Berkontribusi sebagai kontributor di Kamus Bahasa
                            Jawa Terbuka</span>
                        <i data-lucide='arrow-right' class="size-4 inline"></i>
                    </a>
                    <a href="/blog/tindaklanjut-terhadap-kontribusi-bermasalah"
                        class="block hover:underline decoration-4 underline-offset-4 decoration-amber-400">
                        <span class="">Dokumentasi: Tindaklanjut terhadap kontribusi
                            bermasalah</span>
                        <i data-lucide='arrow-right' class="size-4 inline"></i>
                    </a>
                </div>
            </div>
            <div class="w-[50%]">
                <img src="{{ asset('img/hand-holding-pen-by-storyset.png') }}" class="md:max-h-none max-h-52"
                    alt="Family protection concept illustration by storyset (freepik)">
            </div>
        </div>
    </x-bento-item>
</div>
