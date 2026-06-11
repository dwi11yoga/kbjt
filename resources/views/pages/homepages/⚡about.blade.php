<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new class extends Component {
    //
    #[TItle('Tentang')]
    public $lorem;
};
?>

<div class="space-y-5">
    <h1 class="">Tentang</h1>
    <div class="space-y-4">
        <p>
            Kamus Bahasa Jawa Terbuka (KBJT) adalah sebuah sebuah situs web berbasis urun daya yang dibuat untuk
            membantu
            siapa
            saja dalam
            memahami, mempelajari, dan melestarikan bahasa Jawa. Aplikasi ini dirancang sebagai ruang kolaboratif tempat
            pengguna bisa mencari kosakata, memahami tingkat tutur, melihat aksara Jawa, dan bahkan ikut berkontribusi
            dalam
            memperkaya isi kamus.
        </p>
        <p>
            Kamus Bahasa Jawa Terbuka dibangun oleh Dwi Yoga Yulian Nugroho, mahasiswa semester 8 Universitas Muria
            Kudus,
            untuk
            memenuihi tugas akhir atau skripsi, dengan tujuan tidak hanya untuk
            memenuhi syarat akademik, tetapi juga memberikan kontribusi nyata dalam pelestarian dan pengembangan bahasa
            Jawa.
        </p>

        {{-- <h5 class="font-semibold">Terima kasih</h5> --}}
        <div class="space-y-4">
            <p>Ucapan terima kasih yang sebesar-besarnya saya haturkan kepada:</p>

            <div class="">
                <div class="">Dosen Pembimbing 1,</div>
                <div class="font-semibold">Ibu Rizkysari Mei Maharani, S.Kom., M.Kom</div>
            </div>
            <div class="">
                <div class="">Dosen Pembimbing 2,</div>
                <div class="font-semibold">Bapak Ir. Alif Catur Murti, S.Kom., M.Kom</div>
            </div>
            <div class="">
                <div class="capitalize">Dosen & Ahli bahasa jawa Universitas Muria Kudus,</div>
                <div class="font-semibold">Bapak Much Arsyad Fardani, S.Pd., M.Pd.</div>
            </div>
            <div class="">
                <div class="capitalize">Kasi Kurikulum SMP Dinas Pendidikan dan Kebudayaan Kabupaten Pati,</div>
                <div class="font-semibold">Bapak Anwar Mashudi, S.Pd., M.Pd.</div>
            </div>
            <div class="">
                <div class="capitalize">Ilustrasi,</div>
                <a href="https://www.freepik.com/author/stories" target="_blank"
                    class="font-semibold hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                    Storyset (Freepik) <i data-lucide='arrow-up-right' class="w-5 inline-block"></i>
                </a>
            </div>
        </div>

        {{-- logo instansi --}}
        <div class="md:space-x-2">
            <img src="{{ asset('img/disdikbud-pati.png') }}" class="md:h-24 h-20 inline"
                alt="Logo Dinas Pendidikan dan Kebudayaan">
            <img src="{{ asset('img/umk.png') }}" class="md:h-24 h-20 inline" alt="Logo Universitas Muria Kudus">
            <img src="{{ asset('img/ti-umk.png') }}" class="md:h-24 h-20 inline" alt="Logo Teknik Informatika UMK">
        </div>

        {{-- Media sosial --}}
        <div class="">
            <div class="">Kontak & media sosial</div>
            <div class="my-3 flex space-x-1">
                {{-- mail --}}
                <a href="#" target="_blank" title="Hubungi kami via email">
                    <div
                        class="bg-neutral-200 dark:bg-zinc-800 rounded-lg py-3 px-3 w-fit group dark:hover:bg-blue-400 hover:bg-blue-400">
                        <i data-lucide='mail' class="stroke-black dark:stroke-zinc-200"></i>
                    </div>
                </a>

                {{-- facebook --}}
                <a href="https://www.facebook.com/kbjt" target="_blank" title="Kunjungi akun kbjt di facebook">
                    <div
                        class="bg-neutral-200 dark:bg-zinc-800 rounded-lg py-3 px-3 w-fit group dark:hover:bg-blue-400 hover:bg-blue-400">
                        <i data-lucide='facebook' class="fill-blue-500 group-hover:fill-white stroke-none"></i>
                    </div>
                </a>

                {{-- instagram --}}
                <a href="https://www.instagram.com/kbjt" target="_blank" title="Kunjungi akun kbjt di instagram">
                    <div
                        class="bg-neutral-200 dark:bg-zinc-800 rounded-lg py-3 px-3 w-fit group dark:hover:bg-sky-400 hover:bg-sky-400">
                        <i data-lucide='instagram'
                            class="fill-neutral-800 group-hover:fill-neutral-200 stroke-neutral-200 group-hover:stroke-neutral-800"></i>
                    </div>
                </a>

                {{-- twitter/x --}}
                <a href="https://x.com/kbjt" target="_blank" title="Kunjungi akun kbjt di twitter/x">
                    <div
                        class="bg-neutral-200 dark:bg-zinc-800 rounded-lg py-3 px-3 w-fit group dark:hover:bg-sky-400 hover:bg-sky-400">
                        <i data-lucide='twitter' class="fill-sky-500 group-hover:fill-white stroke-none"></i>
                    </div>
                </a>
                {{-- discord --}}
                <a href="https://discord.com/invite/kbjt" target="_blank"
                    title="Bergabung dengan komunitas kbjt di discord">
                    <div
                        class="bg-neutral-200 dark:bg-zinc-800 rounded-lg py-3 px-3 w-fit group dark:hover:bg-blue-700 hover:bg-blue-700">
                        <i data-lucide='discord' class="fill-blue-700 group-hover:fill-white"></i>
                    </div>
                </a>

            </div>
        </div>
    </div>
</div>
