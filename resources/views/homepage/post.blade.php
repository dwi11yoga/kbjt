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
        <a href="{{ $url . '/u/' . $post->user->username }}" class="inline-flex items-center">
            <div class="h-8 w-8 overflow-hidden rounded-full">
                @include('partials.profil-pic-general-array2')
            </div>
            <div class="ml-2">{{ $post->user->nama }}</div>
        </a>

    </div>

    {{-- Judul --}}
    <h3 class="font-bold leading-tight !-mb-3">{{ $post->judul }}</h3>
    {{-- subjudul --}}
    @isset($post->subjudul)
        <h5 class="text-neutral-800 !-mb-2">{{ $post->subjudul }}</h5>
    @endisset

    {{-- Waktu --}}
    <div class="text-neutral-800 inline-flex items-center">
        <i data-feather='calendar' class="w-5 mr-1"></i>
        {{ $post->updated_at->translatedformat('d F Y') }}
        <i data-feather='clock' class="w-5 ml-3 mr-1"></i>
        {{ $post->updated_at->format('h:i A') }}
    </div>

    {{-- <div class="mt-2 mb-5">Oleh <span class="font-bold">{{ $post->user->nama }}</span> •
        {{ $post->updated_at->format('d F Y') }}</div> --}}

    {{-- Thumbnail --}}
    @isset($post->thumbnail)
        <img alt="" class="aspect-video overflow-hidden object-cover w-full rounded-lg mb-5"
            src="{{ asset('storage/' . $post->thumbnail) }}">
    @endisset

    {{-- banner atas/banner 3 --}}
    <?php $idBanner=3 ?>
    @include('partials.banner')

    {{-- Isi Blog --}}
    <style>
        div.space-y-3.my-5 h1 {
            font-size: 1.3rem;
            font-weight: 600;
        }

        div.space-y-3.my-5 ul {
            padding-left: 25px;
            /* Space before list items */
            list-style-type: disc;
            /* Bullet (•) for items */
        }

        div.space-y-3.my-5 ol {
            padding-left: 25px;
            /* Space before list items */
            list-style-type: decimal;
            /* Numbers (1, 2, 3, ...) for items */
        }

        div.space-y-3.my-5 li {
            display: list-item;
            /* Default display for list items */
        }

        div.space-y-3.my-5 pre {
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

        div.space-y-3.my-5 blockquote {
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

        div.space-y-3.my-5 a {
            text-decoration: underline;
            text-decoration-color: #fbbf24;
            text-decoration-thickness: 3px;
            text-underline-offset: 2px;
        }

        div.space-y-3.my-5 a:hover {
            color: #d97706;
        }
    </style>
    <div class="space-y-3 my-5">
        {!! $post->konten !!}
    </div>

    {{-- banner bawah/banner 4 --}}
    <?php $idBanner=4 ?>
    @include('partials.banner')
@endsection
