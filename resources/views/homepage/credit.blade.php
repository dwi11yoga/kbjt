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

    {{-- logo instansi --}}
    <div class="flex">
        <img src="{{ asset('img/ti-umk.png') }}" class="md:h-24 h-20" alt="Logo Teknik Informatika UMK">
        <img src="{{ asset('img/disdikbud-pati.png') }}" class="md:h-24 h-20" alt="Logo Dinas Pendidikan dan Kebudayaan">
    </div>

    {{-- Media sosial --}}
    <div class="">
        <div class="">Kontak & media sosial</div>
        <div class="my-3 flex space-x-1">
            {{-- mail --}}
            <a href="mailto:kontak@kbjt.com" target="_blank" title="Hubungi kami via email">
                <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-blue-400">
                    <i data-feather='mail' class="fill-white stroke-black"></i>
                </div>
            </a>

            {{-- facebook --}}
            <a href="https://www.facebook.com/kbjt" target="_blank" title="Kunjungi akun kbjt di facebook">
                <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-blue-400">
                    <i data-feather='facebook' class="fill-blue-500 group-hover:fill-white stroke-none"></i>
                </div>
            </a>

            {{-- instagram --}}
            <a href="https://www.instagram.com/kbjt" target="_blank" title="Kunjungi akun kbjt di instagram">
                <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-sky-400">
                    <i data-feather='instagram' class="fill-neutral-800 group-hover:fill-neutral-200 stroke-neutral-200 group-hover:stroke-neutral-800" ></i>
                </div>
            </a>

            {{-- twitter/x --}}
            <a href="https://x.com/kbjt" target="_blank" title="Kunjungi akun kbjt di twitter/x">
                <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-sky-400">
                    <i data-feather='twitter' class="fill-sky-500 group-hover:fill-white stroke-none"></i>
                </div>
            </a>
            {{-- youtube/x --}}
            <a href="https://youtube.com/&#64;kbjt" target="_blank" title="Kunjungi akun kbjt di youtube">
                <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-red-500">
                    <i data-feather='youtube' class="fill-red-500 group-hover:fill-white"></i>
                </div>
            </a>

            {{-- whatsapp --}}
            {{-- <a href="https://wa.me/?text={{ urlencode($teks . ' ' . $urlweb) }}" target="_blank"
            title="Kunjungi akun kbjt di Whatsapp">
            <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-green-500">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 30 30" width="24px" height="24px">
                    <polygon class="fill-green-500 group-hover:fill-white"
                        points="4.796,20.836 3.107,27 9.415,25.344 " />
                    <path class="fill-green-500 group-hover:fill-white"
                        d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M20.924,19.143c-0.247,0.693-1.461,1.363-2.005,1.41c-0.549,0.051-1.061,0.247-3.568-0.74c-3.024-1.191-4.931-4.289-5.08-4.489c-0.149-0.195-1.21-1.61-1.21-3.07c0-1.465,0.768-2.182,1.037-2.48c0.274-0.298,0.595-0.372,0.795-0.372c0.195,0,0.395,0,0.568,0.009c0.214,0.005,0.447,0.019,0.67,0.512c0.265,0.586,0.842,2.056,0.916,2.205c0.074,0.149,0.126,0.326,0.023,0.521c-0.098,0.2-0.149,0.321-0.293,0.498c-0.149,0.172-0.312,0.386-0.447,0.516c-0.149,0.149-0.302,0.312-0.13,0.609s0.768,1.27,1.651,2.056c1.135,1.014,2.093,1.326,2.391,1.475s0.47,0.126,0.642-0.074c0.177-0.195,0.744-0.865,0.944-1.163c0.195-0.298,0.395-0.247,0.665-0.149c0.274,0.098,1.735,0.819,2.033,0.968s0.493,0.223,0.568,0.344C21.171,17.854,21.171,18.449,20.924,19.143z" />
                </svg>
            </div>
        </a> --}}

            {{-- telegram --}}
            {{-- <a href="https://t.me/share/url?url={{ urlencode($urlweb) }}&text={{ urlencode($teks) }}" target="_blank"
            title="Kunjungi akun kbjt di telegram">
            <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-blue-500">
                <svg width="24px" height="24px" viewBox="0 0 48 48" id="Layer_2" data-name="Layer 2"
                    xmlns="http://www.w3.org/2000/svg">
                    <path class="fill-blue-500 group-hover:fill-white"
                        d="M40.83,8.48c1.14,0,2,1,1.54,2.86l-5.58,26.3c-.39,1.87-1.52,2.32-3.08,1.45L20.4,29.26a.4.4,0,0,1,0-.65L35.77,14.73c.7-.62-.15-.92-1.07-.36L15.41,26.54a.46.46,0,0,1-.4.05L6.82,24C5,23.47,5,22.22,7.23,21.33L40,8.69a2.16,2.16,0,0,1,.83-.21Z" />
                </svg>
            </div>
        </a> --}}

        </div>
    </div>
@endsection
