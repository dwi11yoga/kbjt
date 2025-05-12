@extends('.../layouts/homepage-with-banner')

@section('body')

    @if (empty($post['status']))
        {{-- peringatan jika preview --}}
        <div
            class="bg-red-600 text-white w-full rounded-md py-3 uppercase inline-flex overflow-hidden justify-center font-semibold">
            @for ($i = 0; $i < 13; $i++)
                <div class="mr-5">Preview</div>
            @endfor
        </div>
    @endif
    {{-- author --}}
    <?php $d = $post; ?>
    <div class="flex items-center justify-between space-x-2 !-mb-3">
        @if (isset($post->user))
            {{-- jika user ditemukan --}}
            <a href="{{ '/u/' . $post->user->username }}" class="inline-flex items-center">
                <div class="h-8 w-8 overflow-hidden rounded-full">
                    @include('partials.profil-pic-general-array2')
                </div>
                <div class="ml-2">{{ $post->user->nama }}</div>
            </a>
        @else
            {{-- jika user dihapus/tidak ditemukan --}}
            <div class="inline-flex items-center">
                <div class="h-8 w-8 overflow-hidden rounded-full">
                    @include('partials.profil-pic-general-array2')
                </div>
                <div class="ml-2">{{ $post->user->nama ?? '[Akun dihapus]' }}</div>
            </div>
        @endif


    </div>

    {{-- Judul --}}
    <h3 class="font-bold leading-tight !-mb-3">{{ $post->judul }}</h3>
    {{-- subjudul --}}
    @isset($post->subjudul)
        <h5 class="text-neutral-800 !-mb-2">{{ $post->subjudul }}</h5>
    @endisset

    {{-- Waktu --}}
    <div class="text-neutral-800 inline-flex items-center space-x-3 md:text-base text-sm">
        <div class="flex space-x-1 items-center">
            <i data-feather='calendar' class="md:w-5 w-4"></i>
            <span>{{ !empty($post->status) ? $post->status->translatedFormat('d F Y') : $post->updated_at->translatedFormat('d F Y') }}</span>
        </div>
        <div class="flex space-x-1 items-center">
            <i data-feather='clock' class="md:w-5 w-4"></i>
            <span>{{ !empty($post->status) ? $post->status->format('h:i A') : $post->updated_at->format('h:i A') }}</span>
        </div>
        <div class="flex space-x-1 items-center">
            <i data-feather='eye' class="md:w-5 w-4"></i>
            <span>{{ number_format($post->view, 0, ',', '.') ?? 0 }}x dilihat</span>
        </div>
    </div>

    {{-- <div class="mt-2 mb-5">Oleh <span class="font-bold">{{ $post->user->nama }}</span> •
        {{ $post->updated_at->format('d F Y') }}</div> --}}

    {{-- Thumbnail --}}
    @isset($post->thumbnail)
        <img alt="" class="object-cover w-full rounded-xl mb-5" src="{{ asset('storage/' . $post->thumbnail) }}">
    @endisset

    {{-- banner atas/banner 3 --}}
    <?php $idBanner = 3; ?>
    @include('partials.banner')

    {{-- Isi Blog --}}
    <style>
        div.trix h1 {
            font-size: 1.3rem;
            font-weight: 600;
        }

        div.trix ul {
            padding-left: 25px;
            /* Space before list items */
            list-style-type: disc;
            /* Bullet (•) for items */
        }

        div.trix ol {
            padding-left: 25px;
            /* Space before list items */
            list-style-type: decimal;
            /* Numbers (1, 2, 3, ...) for items */
        }

        div.trix li {
            display: list-item;
            /* Default display for list items */
        }

        div.trix pre {
            display: block;
            /* Ditampilkan sebagai blok */
            font-family: monospace;
            /* Menggunakan font monospace */
            white-space: pre;
            /* Pertahankan spasi dan baris baru */
            margin: 1em 0;
            /* Margin atas dan bawah */
            background-color: #e5e5e5;
            padding: 0.5rem 0.5rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            overflow-inline: scroll;
        }

        div.trix blockquote {
            display: block;
            margin-top: 0.5rem;
            padding-left: 0.5rem;
            /* Margin atas */
            margin-bottom: 0.5rem;
            /* Margin bawah */
            margin-inline-start: 0.5rem;
            /* Indentasi kiri */
            margin-inline-end: 0.5rem;
            /* Indentasi kanan */
            font-size: inherit;
            /* Ukuran font sesuai elemen induk */
            font-style: italic;
            /* Teks miring */
            border-left: 4px solid #fbbf24;
        }

        div.trix a {
            text-decoration: underline;
            text-decoration-color: #fbbf24;
            text-decoration-thickness: 3px;
            text-underline-offset: 2px;
        }

        div.trix a:hover {
            color: #d97706;
        }
    </style>
    <div class="space-y-3 my-5 md:text-justify trix">
        {!! $post->konten !!}
    </div>

    {{-- jika artikel adalah dokumentasi --}}
    @if ($post->dokumentasi == true)
        <div class="w-full border border-gray-200 rounded-2xl py-6 px-7 space-y-3">
            <div><strong>📚 Dokumentasi lainnya</strong></div>
            <p>
                Kami telah menyiapkan berbagai artikel dan panduan tambahan yang mungkin bisa lebih membantumu memahami
                fitur dan cara kerja kamus bahasa jawa terbuka. Jangan lewatkan dokumentasi lainnya yang bisa memperkaya
                pengalamanmu saat menggunakan kamus ini. Yuk, cek beberapa artikel pilihan berikut!
            </p>
            <a href="/cari?keyword=dokumentasi%3A&filter=artikel">
                <button class="py-3 px-3 mt-3 rounded-lg bg-amber-400 hover:outline hover:outline-2 hover:outline-offset-2 outline-amber-400">Cek sekarang!</button>
            </a>
        </div>
    @endif


    {{-- banner bawah/banner 4 --}}
    <?php $idBanner = 4; ?>
    @include('partials.banner')

    {{-- bagikan --}}
    <div class="w-full border border-gray-200 rounded-2xl py-6 px-7 grid grid-cols-3 items-center">
        <div class="md:col-span-2 col-span-3">

            <div class="font-semibold">Bagikan ke teman</div>
            <div class="text-sm">
                Suka artikelnya? Jangan lupa share, ya!
            </div>

            {{-- bagikan --}}
            <div class="my-3 flex space-x-1">
                <?php $teks = 'Baca artikel "' . $post->judul . '" di kbjt sekarang juga!'; ?>
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

        <div class="col-span-1 md:block hidden">
            <img src="https://img.freepik.com/free-vector/woman-with-megaphone-screaming-concept_114360-16301.jpg"
                alt="">
        </div>
    </div>

    {{-- artikel lain --}}
    @if (!empty($artikelLain))
        <div class="">
            <div class="mb-3 font-semibold text-lg">Artikel lainnya</div>
            <div class="grid grid-cols-6 gap-2">
                @foreach ($artikelLain as $d)
                    <a href="/blog/post/{{ $d->slug }}"
                        class="md:col-span-2 col-span-3 overflow-hidden rounded-lg border border-neutral-200 hover:outline hover:outline-2 hover:outline-amber-400 hover:outline-offset-2">
                        {{-- gambar --}}
                        <div class="aspect-video overflow-hidden rounded-md">
                            <img src="{{ asset(isset($d->thumbnail) ? 'storage/' . $d->thumbnail : 'img/no-image.png') }}"
                                alt="Thumbnail" class="object-cover">
                        </div>
                        <div class="p-2">
                            {{-- judul --}}
                            <div class="line-clamp-2">{{ $d->judul }}</div>
                            {{-- penulis --}}
                            <div class="text-sm mt-1 text-neutral-700">{{ $d->user->nama }}</div>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    @endif
@endsection
