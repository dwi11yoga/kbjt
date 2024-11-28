@extends('layouts.homepage-with-banner')

@section('body')
    <div
        class="bg-white border border-neutral-200 p-5 @isset($data->serupa)rounded-t-2xl -mb-[1.3rem] @else rounded-2xl @endisset z-50">
        <div class="flex justify-between">
            <h4>{{ $data->kosakata }} <span class="text-sm jawa">{{ $data->aksara }}</span></h4>
            <div><i data-feather='more-horizontal'></i></div>
        </div>
        @if ($data->notasi_fonetik)
            <div>/{{ $data->notasi_fonetik }}/</div>
        @endif
        <div>
            @if (isset($data->etimologi) && $data->etimologi[0] == 'Asli')
                Kosakata asli dalam Bahasa Jawa.
            @elseif (isset($data->etimologi))
                Kata serapan dari bahasa {{ $data->etimologi[0] }} yang berarti {{ $data->etimologi[1] }}
            @endif
        </div>
        {{-- <div>Dalam Bahasa Indonesia, kata ini berarti "Perut".</div> --}}
        <div class="flex space-x-2 items-center mt-1">
            @isset($data->ragam)
                <div class="py-1 px-2 bg-blue-100 rounded-lg">{{ $data->ragam }}</div>
            @endisset
            @isset($data->jenis)
                <div class="py-1 px-2 bg-red-100 rounded-lg">{{ $data->jenis }}</div>
            @endisset
            <div class="flex -space-x-3">
                <div class="overflow-hidden h-8 w-8 rounded-full z-20 border-white border-2">
                    <img class="object-cover w-full h-full"
                        src="https://img.freepik.com/free-photo/portrait-volunteer-who-organized-donations-charity_23-2149230567.jpg?w=360"
                        alt="">
                </div>
                <div class="overflow-hidden h-8 w-8 rounded-full z-10 border-white border-2">
                    <img class="object-cover w-full h-full"
                        src="https://img.freepik.com/free-photo/portrait-interesting-young-man-winter-clothes_158595-914.jpg?w=360"
                        alt="">
                </div>
                <div class="overflow-hidden h-8 w-8 rounded-full border-white border-2">
                    <img class="object-cover w-full h-full"
                        src="https://img.freepik.com/free-photo/portrait-smiling-blonde-woman_23-2148316635.jpg?w=360"
                        alt="">
                </div>
            </div>
            <div class="ml-2">26 Kontributor</div>
        </div>
        @if ($dataNull > 3)
            <div class="mt-1 text-sm">Detail kosakata belum lengkap. <a href="#" class="text-blue-600">Bantu
                    lengkapi yuk</a>.</div>
        @endif
    </div>
    {{-- Lihat juga --}}
    @isset($data->serupa)
        <div class="bg-amber-300 rounded-b-2xl px-5 py-2 flex">
            Lihat juga:&nbsp;
            {!! implode(
                ',&nbsp;',
                array_map(
                    fn(
                        $d,
                    ) => "<a href=\"/kosakata/{$d}\" class=\"text-amber-950\">{$d}<i data-feather='arrow-up-right' class='inline-block w-5'></i></a>",
                    $data->serupa,
                ),
            ) !!}
        </div>
    @endisset

    <div class="space-y-1">
        {{-- Definisi --}}
        @foreach ($definisi as $d)
            <div class="md:col-start-2 md:col-span-3 col-span-6">
                <div
                    class="bg-white rounded-2xl p-6 mb-4 border border-neutral-200 hover:outline hover:outline-2 hover:outline-amber-400">
                    {{-- Kosakata --}}
                    <h5 class="font-semibold mb-4">{{ $data->kosakata }}</h5>

                    {{-- Definisi --}}
                    <p class="mb-3">{{ $d->definisi }}</p>

                    {{-- Contoh kalimat --}}
                    @isset($d->contoh)
                        <p>Contoh kalimat:</p>
                        <p>{{ $d->contoh }}</p>
                    @endisset

                    {{-- Referensi --}}
                    @isset($d->referensi)
                        <div class="italic font-light small-text mt-4">
                            <p>Referensi</p>
                            <ul class="list-decimal list-inside">
                                @foreach ($d->referensi as $r)
                                    <li>
                                        <a href="{{ $r }}" target="_blank"
                                            class="hover:underline hover:decoration-amber-400 hover:underline-offset-2 hover:decoration-2">{{ $r }}</a>
                                    </li>
                                @endforeach
                                {{-- {{ $d->referensi }} --}}
                                {{-- <li>Kitab Pranata Adicara (Purwadi, 2020)</li>
                            <li>https://www.cnnindoensia.com/bahasa-krama</li>
                            <li>https://brainly.co.id/tugas/17480360</li> --}}
                            </ul>
                        </div>
                    @endisset
                    {{-- Author --}}
                    <p class="mt-4 mb-2">Disubmit oleh</p>
                    {{-- <div class="rounded-full w-12 h-12 bg-yellow-400 float-left mr-3"></div> --}}
                    <div class="flex justify-between items-end">
                        <div class="flex items-center">
                            <a href="#">
                                <div class="h-12 w-12 rounded-full overflow-hidden mr-3">
                                    @isset(auth()->user()->profile_pic)
                                        <img class="w-full h-full object-cover"
                                            src="{{ asset('storage/' . $d->user->profile_pic) }}" alt="Profile picture">
                                    @else
                                        @if (auth()->user()->jenis_kelamin == 'Perempuan')
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
                            </a>
                            <a href="#">
                                <div>{{ $d->user->nama }}</div>
                                <div class="small-text">{{ $d->created_at->format('d F Y') }}</div>
                            </a>
                        </div>
                        <div><i data-feather='more-vertical'></i></div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- @for ($i = 0; $i < 10; $i++)
        @endfor --}}
    </div>
@endsection
