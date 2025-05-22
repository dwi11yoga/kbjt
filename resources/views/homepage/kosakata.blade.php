@extends('layouts.homepage-with-banner')

@section('head')
    {{-- import trix editor 2.0.8 --}}
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="{{ asset('js/trix.umd.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body')

    @isset($data)
        <div
            class="bg-white border border-neutral-200 @if (isset($data->serupa) && $data->serupa != ['']) -mb-[1.3rem] @endif p-5 @isset($data->serupa)rounded-t-2xl @else rounded-2xl @endisset z-50">
            <div class="flex justify-between">
                <h4 class="capitalize">{{ $data->kosakata }} <span class="text-sm jawa">{{ $data->aksara }}</span></h4>

                <div class="relative flex items-center space-x-2">
                    {{-- total view --}}
                    <div title="Jumlah tayangan"
                        class="cursor-pointer space-x-1 items-center mt-1 hover:bg-neutral-100 rounded-full px-3 py-2  md:flex hidden">
                        <i data-feather='eye' class="w-4 inline"></i>
                        <div class="">{{ $data->view }}</div>
                    </div>

                    {{-- Menu --}}
                    <button id="dropdownBtn" onclick="dropdown(this, 'dropdown')"
                        class="p-2 rounded-full hover:bg-neutral-100"><i data-feather='more-horizontal'></i></button>
                    <div id="dropdown"
                        class="absolute hidden bg-white right-0 top-0 z-40 p-2 rounded-xl border border-neutral-200 min-w-48 text-neutral-800">
                        <ul>
                            @if (!empty(auth()->user()->role) && auth()->user()->role != 'kepala')
                                <a href="{{ $data->slug }}/edit">
                                    <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-amber-100">
                                        <div>Edit</div>
                                        <i data-feather='edit-3' class="w-5"></i>
                                    </li>
                                </a>
                            @endif

                            {{-- bagikan --}}
                            <li onclick="openWindow('bagikan')"
                                class="flex justify-between py-2 px-3 rounded-lg hover:bg-amber-100 cursor-pointer">
                                <div>Bagikan</div>
                                <i data-feather='share-2' class="w-5"></i>
                            </li>

                            {{-- riwayat edit --}}
                            <a href="/kosakata/{{ $data->slug }}/riwayat">
                                <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-amber-100">
                                    <div>Riwayat edit</div>
                                    <i data-feather='clock' class="w-5"></i>
                                </li>
                            </a>
                            <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-red-100 text-red-500 cursor-pointer"
                                onclick="openWindow('hapausKosakata')">
                                <div>
                                    {{ isset(auth()->user()->role) && auth()->user()->role == 'pengurus' ? 'Hapus' : 'Minta hapus' }}
                                </div>
                                <i data-feather='trash' class="w-5"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- notasi fonetik --}}
            @if ($data->notasi_fonetik)
                <div>/{{ $data->notasi_fonetik }}/</div>
            @endif

            {{-- etimologi --}}
            <div>
                @if (isset($data->etimologi) && $data->etimologi != [''] && $data->etimologi[0] == 'Asli')
                    Kosakata asli dalam Bahasa Jawa.
                @elseif (isset($data->etimologi) && $data->etimologi != [''])
                    Kata serapan dari bahasa {{ $data->etimologi[0] }} "{{ $data->etimologi[1] }}"
                @endif
            </div>

            {{-- <div>Dalam Bahasa Indonesia, kata ini berarti "Perut".</div> --}}
            <div class="md:flex block md:space-x-2 space-x-0 md:space-y-0 space-y-2 items-center mt-1">
                <div class="flex space-x-2">
                    {{-- ragam/kelas kata --}}
                    @isset($data->ragam)
                        <div class="py-1 px-2 bg-blue-100 rounded-lg">{{ $data->ragam }}</div>
                    @endisset
                    {{-- jenis kata --}}
                    @isset($data->jenis)
                        <div class="py-1 px-2 bg-red-100 rounded-lg capitalize">{{ $data->jenis }}</div>
                    @endisset
                </div>

            </div>

            <div class="mt-2">
                {{-- yang mengedit kosakata --}}
                @if (!empty($data->totalEdit))
                    <a title="Lihat riwayat edit" href="/kosakata/{{ $data->kosakata }}/riwayat"
                        class="flex space-x-2 items-center w-fit">
                        <div class="flex -space-x-5">
                            @foreach ($data->pengedit as $d)
                                <?php $d = $d->user; ?>
                                <div class="overflow-hidden h-8 w-8 rounded-full border-white border-2">
                                    @include('partials.profile-pic-general')
                                </div>
                            @endforeach
                        </div>
                        <div class="line-clamp-1">Diedit oleh
                            {{ $data->totalEdit > 1 ? $data->totalEdit . ' pengguna' : $d->nama }}</div>
                    </a>
                @endif

                {{-- yang menamahkan kosakata --}}
                <div class="flex space-x-2 items-center">
                    <div class="overflow-hidden h-8 w-8 rounded-full border-white border-2">
                        <?php $d = $data->user; ?>
                        @include('partials.profile-pic-general')
                    </div>
                    <div class="line-clamp-1">Ditambahkan oleh
                        @if (isset($d))
                            <a href='/u/{{ $d->username }}'>{{ $d->nama }}</a>
                        @else
                            [Akun dihapus]
                        @endif

                    </div>
                </div>
            </div>

            {{-- total view --}}
            <div class="flex space-x-1 items-center mt-1 md:hidden">
                <i data-feather='eye' class="w-4 inline"></i>
                <div class="">Jumlah tayangan {{ $data->view }}</div>
            </div>

            @if ($dataNull > 3)
                <div class="mt-1 text-sm">Detail kosakata belum lengkap. <a href="{{ $data->slug }}/edit"
                        class="text-blue-600">Bantu
                        lengkapi yuk</a>.</div>
            @endif
        </div>
        {{-- Lihat juga --}}
        @if (isset($data->serupa) && $data->serupa != [''])
            <div class="bg-amber-300 rounded-b-2xl px-5 py-2 flex">
                Lihat juga:&nbsp;

                {!! implode(
                    ',&nbsp;',
                    array_map(
                        fn($d) => "<a href=\"/kosakata/" .
                            str_replace(' ', '-', strtolower($d)) .
                            "\" class=\"text-amber-950 capitalize\">{$d}<i data-feather='arrow-up-right' class='inline-block w-5'></i></a>",
                        $data->serupa,
                    ),
                ) !!}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <div class="flex">
                {{-- Filter bahasa  --}}
                <form action="" method="GET" class="relative" title="Bahasa definisi">
                    <svg width="1.5rem" height="1.5rem" viewBox="0 0 24 24" fill="none" class="absolute left-2 top-2"
                        xmlns="http://www.w3.org/2000/svg">
                        {{-- icon dari svg repo (MIT License) --}}
                        <path
                            d="M20.58 19.37L17.59 11.01C17.38 10.46 16.91 10.12 16.37 10.12C15.83 10.12 15.37 10.46 15.14 11.03L12.16 19.37C12.02 19.76 12.22 20.19 12.61 20.33C13 20.47 13.43 20.27 13.57 19.88L14.19 18.15H18.54L19.16 19.88C19.27 20.19 19.56 20.38 19.87 20.38C19.95 20.38 20.04 20.37 20.12 20.34C20.51 20.2 20.71 19.77 20.57 19.38L20.58 19.37ZM14.74 16.64L16.38 12.05L18.02 16.64H14.74ZM12.19 7.85C9.92999 11.42 7.89 13.58 5.41 15.02C5.29 15.09 5.16 15.12 5.04 15.12C4.78 15.12 4.53 14.99 4.39 14.75C4.18 14.39 4.3 13.93 4.66 13.73C6.75999 12.51 8.48 10.76 10.41 7.86H4.12C3.71 7.86 3.37 7.52 3.37 7.11C3.37 6.7 3.71 6.36 4.12 6.36H7.87V4.38C7.87 3.97 8.21 3.63 8.62 3.63C9.02999 3.63 9.37 3.97 9.37 4.38V6.36H13.12C13.53 6.36 13.87 6.7 13.87 7.11C13.87 7.52 13.53 7.86 13.12 7.86H12.18L12.19 7.85ZM12.23 15.12C12.1 15.12 11.97 15.09 11.85 15.02C11.2 14.64 10.57 14.22 9.97999 13.78C9.64999 13.53 9.58 13.06 9.83 12.73C10.08 12.4 10.55 12.33 10.88 12.58C11.42 12.99 12.01 13.37 12.61 13.72C12.97 13.93 13.09 14.39 12.88 14.75C12.74 14.99 12.49 15.12 12.23 15.12Z"
                            fill="#000000" />
                    </svg>
                    <select name="bahasa" id="bahasa" oninput="muatDropdown(this)"
                        class="rounded-full appearance-none ps-8 py-2 px-4 flex items-center cursor-pointer hover:outline hover:outline-2 hover:outline-neutral-200 bg-white">
                        <option value="semua">Semua bahasa</option>
                        <option value="jawa" {{ request()->bahasa == 'jawa' ? 'selected' : '' }}>Bahasa Jawa</option>
                        <option value="indonesia" {{ request()->bahasa == 'indonesia' ? 'selected' : '' }}>Bahasa Indonesia
                        </option>
                    </select>
                </form>
            </div>

            @auth
                {{-- tampilkan tombol tambah definisi jika user belum submit definisi ini dan bukan kepala --}}
                @if (auth()->user()->role != 'kepala')
                    <div class="flex">
                        {{-- Tombol Tambah definisi --}}
                        <button id="newDefButton"
                            class="rounded-full py-2 px-4 flex items-center cursor-pointer hover:outline hover:outline-2 hover:outline-neutral-200">
                            <i data-feather='plus' class="w-5 inline-block"></i>Tambah definisi
                        </button>
                    </div>
                @endif
            @endauth
        </div>

        {{-- tambah definisi --}}
        <div class="space-y-1">
            @auth
                {{-- jika user belum menunggah definisi dan bukan kepala --}}
                @if (auth()->user()->role != 'kepala')
                    {{-- Buat definisi --}}
                    <form action="/kosakata/{{ $data->slug }}/buat-definisi" method="POST" id="newDefinition" class="hidden">
                        @csrf
                        <div class="md:col-start-2 md:col-span-3 col-span-6">
                            <div
                                class="bg-white rounded-2xl mb-4 border border-neutral-200 hover:outline hover:outline-2 hover:outline-amber-400 space-y-3">
                                {{-- Kosakata --}}
                                <div class="px-6 pt-6">
                                    <h5 class="font-semibold mb-4 capitalize">{{ $data->kosakata }}</h5>
                                    <input type="number" name="kosakata_id" value="{{ $data->id }}" readonly hidden>
                                </div>

                                {{-- Definisi --}}
                                <div>
                                    <?php
                                    $trixId = 'definisi';
                                    $trixImg = 0;
                                    $trixUndoRedo = 1;
                                    $trixBlockTool = 0;
                                    $updateInput = null;
                                    $trixPlaceholder = 'Definisi, contoh penggunaan kata, dialek, dan informasi terkait lainnya..';
                                    ?>

                                    @include('partials.trix-editor')

                                    @error('definisi')
                                        <div class="text-xs text-red-600 mt-2 mb-2 mx-6">*{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Referensi --}}
                                <div class="px-6">
                                    <label for="referensi">Referensi</label>
                                    <textarea id="referensi" name="referensi"
                                        class="w-full resize-none rounded-xl max-h-52 focus:outline-none focus:outline-amber-400 focus:outline-offset-0 p-2 border border-neutral-400"
                                        placeholder="Pisahkan referensi dengan tanda titik koma (;)" oninput="textareaHeight(this)">{{ old('referensi') }}</textarea>
                                </div>

                                {{-- Bahasa --}}
                                <div class="px-6 space-y-1">
                                    <label for="bahasa">Dijelaskan dalam</label><br>
                                    <select name="bahasa" id="bahasa"
                                        class="rounded-xl focus:outline-none focus:outline-amber-400 focus:outline-offset-0 p-3 border border-neutral-400 bg-white">
                                        <option value="jawa" {{ old('bahasa') == 'jawa' ? 'selected' : '' }}>Bahasa Jawa
                                        </option>
                                        <option value="indonesia" {{ old('bahasa') == 'indonesia' ? 'selected' : '' }}>Bahasa
                                            Indonesia
                                        </option>
                                    </select>
                                    @error('bahasa')
                                        <div class="text-xs text-red-600 mt-1 mb-2">*{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Author --}}
                                <p class="mb-2 px-6">Disubmit oleh</p>
                                <div class="px-6 pb-6 space-y-3">
                                    <div class="flex justify-between items-end">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="h-12 w-12 rounded-full overflow-hidden mr-3">
                                                    @isset(auth()->user()->profile_pic)
                                                        <img class="w-full h-full object-cover"
                                                            src="{{ asset('storage/' . auth()->user()->profile_pic) }}"
                                                            alt="Profile picture">
                                                    @else
                                                        @if (isset(auth()->user()->jenis_kelamin) && auth()->user()->jenis_kelamin == 'Perempuan')
                                                            <img class="w-full h-full object-cover"
                                                                src="{{ asset('storage/profile-pics/profile_pic-f.jpg') }}"
                                                                alt="Profile picture (Freepik/gstudioimagen)">
                                                        @else
                                                            <img class="w-full h-full object-cover"
                                                                src="{{ asset('storage/profile-pics/profile_pic-m.jpg') }}"
                                                                alt="Profile picture (Freepik/gstudioimagen)">
                                                        @endif
                                                    @endisset
                                                </div>
                                            </div>
                                            <div>
                                                <div>{{ auth()->user()->nama }}</div>
                                                <div class="small-text">{{ now()->format('d F Y') }}</div>
                                            </div>
                                        </div>
                                        {{-- Simpan --}}
                                        @if ($suspend->hukuman == false)
                                            {{-- user tidak tersuspend --}}
                                            <button type="submit"
                                                class="rounded-full bg-amber-300 py-2 px-4 hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-amber-400">
                                                Submit
                                            </button>
                                        @else
                                            {{-- jika user tersuspend --}}
                                            <div
                                                class="rounded-full bg-neutral-300 py-2 px-4 hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-amber-400 cursor-pointer">
                                                Submit
                                            </div>
                                        @endif
                                    </div>
                                    @if ($suspend->hukuman == true)
                                        <?php
                                        $alert = [
                                            'warna' => 'red',
                                            'pesan' => 'Sementara kamu tidak dapat mensubmit definisi baru sampai ' . $suspend->hukumanBerakhir . ' karena akun sedang disuspend.',
                                            'textsize' => 'sm',
                                        ];
                                        ?>
                                        @include('partials.alert')
                                    @endif
                                </div>


                            </div>
                        </div>
                    </form>

                    <script>
                        // Tampilkan dan semunyikan tambah definisi
                        const newDefButton = document.getElementById('newDefButton');
                        const newDefinition = document.getElementById('newDefinition');

                        newDefButton.addEventListener('click', () => {
                            newDefinition.classList.toggle('hidden');
                        })
                    </script>
                @endif
            @endauth


            {{-- Definisi --}}
            @if ($definisi->isNotEmpty())
                {{-- tampilkan banner 5 --}}
                <?php $idBanner = 5; ?>
                @include('partials.banner')
                <div class="py-1"></div>

                {{-- tampilkan definisi --}}
                @foreach ($definisi as $d)
                    @include('partials.definisi')
                @endforeach

                {{-- tampilkan banner 6 --}}
                <?php $idBanner = 6; ?>
                @include('partials.banner')
            @else
                {{-- Jika belum ada definisi --}}
                <?php $notFound = 'Belum ada definisi untuk kosakata ' . $data->kosakata . '.'; ?>
                @include('partials.not-found')
            @endif
        </div>

        {{-- popup --}}
        <div class="">
            {{-- Popup bagikan kosakata --}}
            <div id="bagikan"
                class="fixed inset-0 -mt-24 z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6">
                    <div class="flex items-center justify-between">
                        <h5 class="font-semibold capitalize">
                            Bagikan
                        </h5>
                        <div onclick="closeWindow('bagikan')"
                            class="px-2 py-1.5 border border-white hover:border-neutral-600 cursor-pointer hover:rounded-full">
                            <i data-feather='x' class="w-5"></i>
                        </div>
                    </div>

                    <div class="">
                        Sebarkan kosakata <span class="capitalize">{{ $data->kosakata }}</span> ke teman-teman & saudara kamu
                        yuk!
                    </div>

                    {{-- bagikan --}}
                    <div class="my-3 flex space-x-1">
                        <?php $teks = 'Yuk pelajari kosakata Jawa bersama! 🌾 Temukan arti kata ' . strtolower($data->kosakata) . ' dan bantu lestarikan bahasa Jawa lewat kbjt. Cek di sini 👉'; ?>
                        {{-- facebook --}}
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url . request()->getRequestUri()) }}"
                            target="_blank" title="Bagikan lewat facebook">
                            <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-blue-400">
                                <i data-feather='facebook' class="fill-blue-500 group-hover:fill-white stroke-none"></i>
                            </div>
                        </a>

                        {{-- twitter/x --}}
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($teks) }}&url={{ urlencode($url . request()->getRequestUri()) }}"
                            target="_blank" title="Bagikan lewat twitter/x">
                            <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-sky-400">
                                <i data-feather='twitter' class="fill-sky-500 group-hover:fill-white stroke-none"></i>
                            </div>
                        </a>

                        {{-- whatsapp --}}
                        <a href="https://wa.me/?text={{ urlencode($teks . ' ' . $url . request()->getRequestUri()) }}"
                            target="_blank" title="Bagikan lewat Whatsapp">
                            <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-green-500">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 30 30" width="24px" height="24px">
                                    <polygon class="fill-green-500 group-hover:fill-white"
                                        points="4.796,20.836 3.107,27 9.415,25.344 " />
                                    <path class="fill-green-500 group-hover:fill-white"
                                        d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M20.924,19.143c-0.247,0.693-1.461,1.363-2.005,1.41c-0.549,0.051-1.061,0.247-3.568-0.74c-3.024-1.191-4.931-4.289-5.08-4.489c-0.149-0.195-1.21-1.61-1.21-3.07c0-1.465,0.768-2.182,1.037-2.48c0.274-0.298,0.595-0.372,0.795-0.372c0.195,0,0.395,0,0.568,0.009c0.214,0.005,0.447,0.019,0.67,0.512c0.265,0.586,0.842,2.056,0.916,2.205c0.074,0.149,0.126,0.326,0.023,0.521c-0.098,0.2-0.149,0.321-0.293,0.498c-0.149,0.172-0.312,0.386-0.447,0.516c-0.149,0.149-0.302,0.312-0.13,0.609s0.768,1.27,1.651,2.056c1.135,1.014,2.093,1.326,2.391,1.475s0.47,0.126,0.642-0.074c0.177-0.195,0.744-0.865,0.944-1.163c0.195-0.298,0.395-0.247,0.665-0.149c0.274,0.098,1.735,0.819,2.033,0.968s0.493,0.223,0.568,0.344C21.171,17.854,21.171,18.449,20.924,19.143z" />
                                </svg>
                            </div>
                        </a>

                        {{-- telegram --}}
                        <a href="https://t.me/share/url?url={{ urlencode($url . request()->getRequestUri()) }}&text={{ urlencode($teks) }}"
                            target="_blank" title="Bagikan lewat telegram">
                            <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-blue-500">
                                <svg width="24px" height="24px" viewBox="0 0 48 48" id="Layer_2" data-name="Layer 2"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path class="fill-blue-500 group-hover:fill-white"
                                        d="M40.83,8.48c1.14,0,2,1,1.54,2.86l-5.58,26.3c-.39,1.87-1.52,2.32-3.08,1.45L20.4,29.26a.4.4,0,0,1,0-.65L35.77,14.73c.7-.62-.15-.92-1.07-.36L15.41,26.54a.46.46,0,0,1-.4.05L6.82,24C5,23.47,5,22.22,7.23,21.33L40,8.69a2.16,2.16,0,0,1,.83-.21Z" />
                                </svg>
                            </div>
                        </a>

                    </div>

                    {{-- Bagikan link --}}
                    <div class="bg-neutral-200 rounded-lg py-3 px-4 grid grid-cols-12">
                        <div id="bagikanLink" class="col-span-11 line-clamp-1">{{ $url . request()->getRequestUri() }}</div>
                        <div class="col-span-1 flex items-center justify-end space-x-2">

                            {{-- tombol salin --}}
                            <button title="Salin url"
                                onclick="copyUrl(document.getElementById('bagikanLink'), document.getElementById('copyBefore2'), document.getElementById('copyAfter2'))">
                                <i data-feather='copy' id="copyBefore2" class="w-5"></i>
                                <i data-feather='check' id="copyAfter2" class="w-5 hidden"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Popup hapus/Minta hapus kosakata --}}
            <div id="hapausKosakata"
                class="fixed inset-0 m-auto z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6">

                    <h5 class="font-semibold capitalize">
                        {{ isset(auth()->user()->role) && auth()->user()->role == 'pengurus' ? 'Form hapus kosakata' : 'Minta pengurus menghapus kosakata' }}
                    </h5>
                    <div class="mb-5">Apa alasan kamu ingin menghapus kosakata ini?</div>

                    <form action="/kosakata/{{ $data->slug }}/laporkan" method="POST">
                        @csrf
                        <div class="overflow-auto max-h-[27rem] space-y-2">
                            {{-- alasan --}}
                            <div>
                                <label for="alasan" class="block">Alasan</label>
                                <select name="alasan" id="kosakata_alasan"
                                    class="w-full rounded-xl p-3 border bg-white focus:outline-none focus:border-amber-300 cursor-pointer @error('alasan')
                                border-red-400 @else border-neutral-400 @enderror">
                                    <option value="">Pilih</option>
                                    <option {{ old('alasan') == 'SPAM' ? 'selected' : '' }}>SPAM</option>
                                    <option {{ old('alasan') == 'Duplikasi' ? 'selected' : '' }}>Duplikasi</option>
                                    <option {{ old('alasan') == 'Bukan kosakata jawa' ? 'selected' : '' }}>Bukan kosakata jawa
                                    </option>
                                    <option {{ old('alasan') == 'Lain-lain' ? 'selected' : '' }}>Lain-lain
                                    </option>
                                </select>
                                @error('alasan')
                                    <div class="text-xs text-red-600 mt-1 mb-2">*{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="catatan">Catatan</label>
                                <textarea id="kosakata_catatan" name="catatan"
                                    class="w-full resize-none text-neutral-800 focus:outline-none focus:border-amber-300 mb-3 max-h-52 border border-neutral-400 rounded-xl p-2"
                                    placeholder="Tambahkan catatan untuk memperkuat laporan (opsional)" oninput="textareaHeight(this)">{{ old('catatan') }}</textarea>
                            </div>
                        </div>

                        {{-- alert --}}
                        <?php
                        $alert = [
                            'warna' => 'green',
                            'pesan' => 'Jika masih bisa diperbaiki, cukup klik (•••) dan pilih "Edit" — tak perlu buat permintaan hapus.',
                            'textsize' => 'sm',
                        ];
                        ?>
                        @include('partials.alert')

                        {{-- alert jika user tersuspend --}}
                        @if (!empty(auth()->user()->id) && $suspend->hukuman == true)
                            <?php
                            $alert = [
                                'warna' => 'red',
                                'pesan' => 'Untuk sementara, kamu tidak dapat meminta pengurus menghapus kosakata ini hingga ' . $suspend->hukumanBerakhir . ' karena akunmu sedang disuspend.',
                                'textsize' => 'sm',
                            ];
                            ?>
                            @include('partials.alert')
                        @endif

                        {{-- Button --}}
                        <div class="flex space-x-2">
                            <div onclick="closeWindow('hapausKosakata')"
                                class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                                Batal</div>
                            @if (!empty(auth()->user()->id) && $suspend->hukuman == true)
                                <div
                                    class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-amber-500">
                                    Simpan
                                </div>
                            @else
                                <button type="submit"
                                    class="w-full bg-amber-400 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-amber-500">
                                    Simpan
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        {{-- Jika kosakata tidak ditemukan dalam database --}}
        <?php
        $notFound = "Kosakata <span class='capitalize'>" . str_replace('-', ' ', $kosakata) . "</span> tidak ditemukan. <a href='/tambah/kosakata?keyword=" . $kosakata . "' class='text-blue-600' title='Tambah kosakata'>Tambahkan?</a>";
        ?>
        <div class="h-3/5 w-full mx-auto">
            @include('partials.not-found')
        </div>
    @endisset
@endsection
