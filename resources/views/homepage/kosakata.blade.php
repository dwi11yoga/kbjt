@extends('layouts.homepage-with-banner')

@section('body')

    @isset($data)
        <div
            class="bg-white border border-neutral-200 @if (isset($data->serupa) && $data->serupa != ['']) -mb-[1.3rem] @endif p-5 @isset($data->serupa)rounded-t-2xl @else rounded-2xl @endisset z-50">
            <div class="flex justify-between">
                <h4 class="capitalize">{{ $data->kosakata }} <span class="text-sm jawa">{{ $data->aksara }}</span></h4>

                {{-- Menu --}}
                <div class="relative">
                    @isset(auth()->user()->id)
                        <button id="dropdownBtn" onclick="dropdown(this, document.getElementById('dropdown'))"
                            class="p-2 rounded-full hover:bg-neutral-100"><i data-feather='more-horizontal'></i></button>
                        <div id="dropdown"
                            class="absolute hidden bg-white right-0 z-40 p-2 rounded-xl border border-neutral-200 min-w-48 text-neutral-800">
                            <ul>
                                <a href="{{ $data->slug }}/edit">
                                    <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100">
                                        <div>Edit</div>
                                        <i data-feather='edit-3' class="w-5"></i>
                                    </li>
                                </a>
                                <a href="#">
                                    <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100">
                                        <div>Riwayat edit</div>
                                        <i data-feather='clock' class="w-5"></i>
                                    </li>
                                </a>
                                <a href="#">
                                    <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 text-red-500">
                                        <div>Laporkan</div>
                                        <i data-feather='flag' class="w-5"></i>
                                    </li>
                                </a>
                            </ul>
                        </div>
                    @endisset

                </div>
            </div>
            @if ($data->notasi_fonetik)
                <div>/{{ $data->notasi_fonetik }}/</div>
            @endif
            <div>
                @if (isset($data->etimologi) && $data->etimologi != [''] && $data->etimologi[0] == 'Asli')
                    Kosakata asli dalam Bahasa Jawa.
                @elseif (isset($data->etimologi) && $data->etimologi != [''])
                    Kata serapan dari bahasa {{ $data->etimologi[0] }} "{{ $data->etimologi[1] }}"
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
                            str_replace(' ', '-', $d) .
                            "\" class=\"text-amber-950 capitalize\">{$d}<i data-feather='arrow-up-right' class='inline-block w-5'></i></a>",
                        $data->serupa,
                    ),
                ) !!}
            </div>
        @endif

        @auth
            @if (!$cekDefinisiUser == true)
                <div class="flex justify-end">
                    {{-- Tombol Tambah definisi --}}
                    <button id="newDefButton"
                        class="rounded-full py-2 px-4 flex items-center cursor-pointer hover:outline hover:outline-2 hover:outline-neutral-200">
                        <i data-feather='plus' class="w-5 inline-block"></i>Buat definisi
                    </button>
                </div>
            @endif
        @endauth

        <div class="space-y-1">
            @auth
                @if (!$cekDefinisiUser == true)
                    {{-- Buat definisi --}}
                    <form action="/kosakata/{{ $data->slug }}/buat-definisi" method="POST" id="newDefinition" class="hidden">
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
                    </script>
                @endif
            @endauth


            {{-- Definisi --}}
            @if ($definisi->isNotEmpty())
                @foreach ($definisi as $d)
                    @include('partials.definisi')
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
        $notFound = "Kosakata <span class='capitalize'>" . str_replace('-', ' ', $kosakata) . "</span> tidak ditemukan. <a href='/tambah/kosakata?keyword=" . $kosakata . "' class='text-blue-600' title='Tambah kosakata'>Tambahkan?</a>";
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
