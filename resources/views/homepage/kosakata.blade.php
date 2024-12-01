@extends('layouts.homepage-with-banner')

@section('body')
    @isset($data)
        <div
            class="bg-white border border-neutral-200 p-5 @isset($data->serupa)rounded-t-2xl -mb-[1.3rem] @else rounded-2xl @endisset z-50">
            <div class="flex justify-between">
                <h4 class="capitalize">{{ $data->kosakata }} <span class="text-sm jawa">{{ $data->aksara }}</span></h4>
                <div><i data-feather='more-horizontal'></i></div>
            </div>
            @if ($data->notasi_fonetik)
                <div>/{{ $data->notasi_fonetik }}/</div>
            @endif
            <div>
                @if (isset($data->etimologi) && $data->etimologi != [''] && $data->etimologi[0] == 'Asli')
                    Kosakata asli dalam Bahasa Jawa.
                @elseif (isset($data->etimologi) && $data->etimologi != [''])
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
        @if (isset($data->serupa) && $data->serupa != [''])
            <div class="bg-amber-300 rounded-b-2xl px-5 py-2 flex">
                Lihat juga:&nbsp;
                {!! implode(
                    ',&nbsp;',
                    array_map(
                        fn($d) => "<a href=\"/kosakata/" .
                            str_replace(' ', '-', $d) .
                            "\" class=\"text-amber-950\">{$d}<i data-feather='arrow-up-right' class='inline-block w-5'></i></a>",
                        $data->serupa,
                    ),
                ) !!}
            </div>
        @endif

        @auth
            <div class="flex justify-end">
                {{-- Filter bahasa --}}
                {{-- <div class="relative">
        <form action="#">
            <select name="filter" id="filter"
                class="rounded-full py-2 pl-7 pr-4 appearance-none bg-white cursor-pointer hover:outline hover:outline-2 hover:outline-neutral-200">
                <option value="Semua">Semua</option>
                <option value="Bahasa Indonesia">Bahasa Indonesia</option>
                <option value="Bahasa Jawa">Bahasa Jawa</option>
            </select>
        </form>
        <span class="absolute flex left-2 top-2"><i data-feather='chevron-right' class="w-5"></i></span>
    </div> --}}

                {{-- Tombol Tambah definisi --}}
                <button id="newDefButton"
                    class="rounded-full py-2 px-4 flex items-center cursor-pointer hover:outline hover:outline-2 hover:outline-neutral-200">
                    <i data-feather='plus' class="w-5 inline-block"></i>Buat definisi
                </button>
            </div>
        @endauth

        <div class="space-y-1">
            @auth
                {{-- Buat definisi --}}
                <form action="{{ $data->slug }}/buat-definisi" method="POST" id="newDefinition" class="hidden">
                    @csrf
                    <div class="md:col-start-2 md:col-span-3 col-span-6">
                        <div
                            class="bg-white rounded-2xl p-6 mb-4 border border-neutral-200 hover:outline hover:outline-2 hover:outline-amber-400">
                            {{-- Kosakata --}}
                            <h5 class="font-semibold mb-4 capitalize">{{ $data->kosakata }}</h5>
                            <input type="number" name="kosakata_id" value="{{ $data->id }}" readonly hidden>

                            {{-- Definisi --}}
                            <textarea id="definisi" name="definisi" placeholder="Definisi baru..." oninput="textareaHeight(this)"
                                class="w-full appearance-none resize-none focus:outline-none mb-3 max-h-52 @error('definisi')
                                    border-b border-red-600
                                @enderror">{{ old('definisi') }}</textarea>
                            @error('definisi')
                                <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                            @enderror

                            {{-- Contoh kalimat --}}
                            <label for="contoh">Contoh kalimat</label>
                            <textarea id="contoh" name="contoh" class="w-full appearance-none resize-none focus:outline-none mb-3 max-h-52"
                                placeholder="Pisahkan contoh dengan tanda titik koma (;)" oninput="textareaHeight(this)">{{ old('contoh') }}</textarea>

                            {{-- Referensi --}}
                            <label for="referensi">Referensi</label>
                            <textarea id="referensi" name="referensi" class="w-full appearance-none resize-none focus:outline-none mb-3 max-h-52"
                                placeholder="Pisahkan referensi dengan tanda titik koma (;)" oninput="textareaHeight(this)">{{ old('referensi') }}</textarea>

                            {{-- Author --}}
                            <p class="mb-2">Disubmit oleh</p>
                            <div class="flex justify-between items-end">
                                <div class="flex items-center">
                                    <a href="#">
                                        <div class="h-12 w-12 rounded-full overflow-hidden mr-3">
                                            @isset(auth()->user()->profile_pic)
                                                <img class="w-full h-full object-cover"
                                                    src="{{ asset('storage/' . auth()->user()->profile_pic) }}" alt="Profile picture">
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
                                    </a>
                                    <a href="#">
                                        <div>{{ auth()->user()->nama }}</div>
                                        <div class="small-text">{{ now()->format('d F Y') }}</div>
                                    </a>
                                </div>
                                {{-- Simpan --}}
                                <button type="submit"
                                    class="rounded-full bg-amber-300 py-2 px-4 hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-amber-400">Submit</button>
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

                    // buat panjang textarea otomatis
                    function textareaHeight(id) {
                        id.style.height = 'auto';
                        id.style.height = `${id.scrollHeight}px`;
                    }
                </script>
            @endauth


            {{-- Definisi --}}
            @if ($definisi->isNotEmpty())
                @foreach ($definisi as $d)
                    <div class="md:col-start-2 md:col-span-3 col-span-6">
                        <div
                            class="bg-white rounded-2xl p-6 mb-4 border border-neutral-200 hover:outline hover:outline-2 hover:outline-amber-400">
                            {{-- Kosakata --}}
                            <h5 class="font-semibold mb-4 capitalize">{{ $data->kosakata }}</h5>

                            {{-- Definisi --}}
                            <p class="mb-3">{{ $d->definisi }}</p>

                            {{-- Contoh kalimat --}}
                            @if (isset($d->contoh) && $d->contoh != [''])
                                <p>Contoh kalimat:</p>
                                <ul class=" list-inside italic">
                                    @foreach ($d->contoh as $c)
                                        <li>{{ $c }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            {{-- Referensi --}}
                            @if (isset($d->referensi) && $d->referensi != [''])
                                <div class="italic font-light small-text mt-4">
                                    <p>Referensi</p>
                                    <ul class="list-decimal list-inside">
                                        @foreach ($d->referensi as $r)
                                            <li>
                                                @if (filter_var($r, FILTER_VALIDATE_URL))
                                                    <a href="{{ $r }}" target="_blank"
                                                        class="hover:underline hover:decoration-amber-400 hover:underline-offset-2 hover:decoration-2">{{ $r }}</a>
                                                @else
                                                    {{ $r }}
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{-- Author --}}
                            <p class="mt-4 mb-2">Disubmit oleh</p>
                            {{-- <div class="rounded-full w-12 h-12 bg-yellow-400 float-left mr-3"></div> --}}
                            <div class="flex justify-between items-end">
                                <div class="flex items-center">
                                    <a href="#">
                                        <div class="h-12 w-12 rounded-full overflow-hidden mr-3">
                                            @isset($d->user->profile_pic)
                                                <img class="w-full h-full object-cover"
                                                    src="{{ asset('storage/' . $d->user->profile_pic) }}" alt="Profile picture">
                                            @else
                                                @if (isset($d->user->jenis_kelamin) && $d->user->jenis_kelamin == 'Perempuan')
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
            @else
                {{-- Jika belum ada definisi --}}
                <?php $notFound = 'Belum ada definisi untuk kosakata ' . $data->kosakata . '.'; ?>
                @include('partials.not-found')
            @endif
        </div>
    @else
        {{-- Jika kosakata tidak ditemukan dalam database --}}
        <?php
        $notFound = "Kosakata <span class='capitalize'>" . str_replace('-', ' ', $kosakata) . "</span> tidak ditemukan. <a href='/kosakata/buat?kosakata=" . $kosakata . "' class='text-blue-600' title='Tambah kosakata'>Tambahkan?</a>";
        ?>
        <div class="h-3/5 w-3/5 mx-auto">
            @include('partials.not-found')
        </div>
    @endisset
@endsection

@section('toast')
    {{-- Import toast --}}
    @include('partials.toast')
@endsection
