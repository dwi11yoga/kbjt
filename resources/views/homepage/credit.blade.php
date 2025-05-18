@extends('layouts.homepage-with-banner')
@section('body')
    <h3 class="font-bold mb-7">Tentang</h3>
    <p>
        Kamus Bahasa Jawa Terbuka (KBJT) adalah sebuah sebuah situs web berbasis urun daya yang dibuat untuk membantu siapa
        saja dalam
        memahami, mempelajari, dan melestarikan bahasa Jawa. Aplikasi ini dirancang sebagai ruang kolaboratif tempat
        pengguna bisa mencari kosakata, memahami tingkat tutur, melihat aksara Jawa, dan bahkan ikut berkontribusi dalam
        memperkaya isi kamus.
    </p>
    <p>
        Kamus Bahasa Jawa Terbuka dibangun oleh Dwi Yoga Yulian Nugroho, mahasiswa semester 8 Universitas Muria Kudus, untuk
        memenuihi tugas akhir atau skripsi, dengan tujuan tidak hanya untuk
        memenuhi syarat akademik, tetapi juga memberikan kontribusi nyata dalam pelestarian dan pengembangan bahasa Jawa.
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
                Storyset (Freepik) <i data-feather='arrow-up-right' class="w-5 inline-block"></i>
            </a>
        </div>
    </div>

    {{-- gambar --}}
    <div class="flex">
        <img src="{{ asset('img/ti-umk.png') }}" class="md:h-24 h-20" alt="Logo Teknik Informatika UMK">
        <img src="{{ asset('img/disdikbud-pati.png') }}" class="md:h-24 h-20" alt="Logo Dinas Pendidikan dan Kebudayaan">
    </div>
@endsection
