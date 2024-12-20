@extends('.../layouts/homepage-with-banner')

@section('body')
    {{-- author & tanggal --}}
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
        {{ $post->updated_at->format('d F Y') }}
        <i data-feather='clock' class="w-5 ml-3 mr-1"></i>
        {{ $post->updated_at->format('h:iA') }}
    </div>

    {{-- <div class="mt-2 mb-5">Oleh <span class="font-bold">{{ $post->user->nama }}</span> •
        {{ $post->updated_at->format('d F Y') }}</div> --}}

    {{-- Thumbnail --}}
    <img alt="" class="aspect-video overflow-hidden object-cover w-full rounded-lg mb-5"
        src="https://www.agoda.com/wp-content/uploads/2024/07/Featured-image-Lawang-Sewu-Semarang-Indonesia.jpg">

    {{-- Iklan atas --}}
    <a href="#">
        <img alt="" class="overflow-hidden object-cover w-full h-44 rounded-lg"
            src="https://static.vecteezy.com/system/resources/thumbnails/017/554/214/small/black-and-blue-green-banner-with-waves-template-design-wavy-waves-design-vector.jpg">
    </a>

    {{-- Isi Blog --}}
    <div class="space-y-3 my-5">
        {!! $post->konten !!}
    </div>

    {{-- Iklan bawah --}}
    <a href="#">
        <img alt="" class="overflow-hidden object-cover w-full h-44 rounded-lg"
            src="https://media.istockphoto.com/id/1759419033/vector/white-and-blue-modern-abstract-wide-banner-with-geometric-shapes-dark-blue-and-white.jpg?s=612x612&w=is&k=20&c=luMW3Q60EtadjHxxOKWhKPf697DjSRlmz6_EA73hdD0=">
    </a>
@endsection
