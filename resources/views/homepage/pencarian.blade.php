@extends('layouts.homepage-with-banner')

@section('body')
    <div>
        <h3 class="font-semibold">Pencarian</h3>
        {{-- kolom pencarian (untuk tampilan mobile) --}}
            <form action="/cari" method="GET" class="my-3 md:hidden">
                <div class="relative">
                    <input value="{{ request('keyword') }}" required
                        class="bg-neutral-100 w-full px-5 py-2.5 pr-12 rounded-full hover:bg-white hover:outline hover:outline-2 hover:outline-amber-400 focus:outline focus:outline-amber-400 focus:outline-2 focus-within:bg-white"
                        name="keyword" id="keyword" type="text" placeholder="Cari...">
                    <button type="submit" class="absolute right-4 top-2.5 text-neutral-500 hover:text-amber-400"
                        title="Cari"><i data-feather='search'></i></button>
                </div>
            </form>

        {{-- filter --}}
        <form action="" method="GET">
            @foreach (request()->except('filter') as $d => $value)
                <input type="hidden" name="{{ $d }}" value="{{ $value }}">
            @endforeach
            <div class="relative">
                <label for="filter" class="absolute left-3 top-3"><i data-feather='filter' class="w-5"></i></label>
                <select name="filter" id="filter" onchange="muatDropdown(this)"
                    class="py-3 pl-10 pr-5 bg-white rounded-xl appearance-none cursor-pointer border border-neutral-200 hover:outline hover:outline-amber-200">
                    <option {{ request()->filter == 'kosakata' ? 'selected' : '' }} value="kosakata">Kosakata</option>
                    <option {{ request()->filter == 'artikel' ? 'selected' : '' }} value="artikel">Artikel</option>
                    <option {{ request()->filter == 'pengguna' ? 'selected' : '' }} value="pengguna">Pengguna</option>
                </select>
            </div>
        </form>

    </div>

    <div>
        {{-- Jumlah data ditemukan --}}
        @if ($jumlah > 0)
            <div>{{ $jumlah }} data berhasil ditemukan.</div>
        @endif
    </div>

    <div class="space-y-3">
        @if (request()->keyword == null)
            <div
                class="p-12 rounded-2xl flex justify-center items-center text-center flex-col shadow-sm border border-neutral-200 w-full">
                <img src="https://img.freepik.com/free-vector/children-looking-concept-illustration_114360-21682.jpg"
                    alt="Lost concept illustration (Freepik/storyset)" class="w-56 mb-5">
                <div>Silakan ketik kata kunci untuk memulai pencarian</div>
            </div>
        @elseif ($jumlah <= 0)
            {{-- Jika tidak ada data --}}
            <?php
            if (request()->filter == 'kosakata' || empty(request()->filter)) {
                $notFound = 'Kosakata dengan kata kunci "' . request()->keyword . '" tidak ditemukan. <a href="/tambah/kosakata?keyword=' . request()->keyword . '" title="Tambahkan kosakata" class="text-blue-600">Tambahkan?</a>';
            } elseif (request()->filter == 'artikel') {
                $notFound = 'Artikel dengan kata kunci "' . request()->keyword . '" tidak ditemukan.';
            } elseif (request()->filter == 'pengguna') {
                $notFound = 'Pengguna dengan kata kunci "' . request()->keyword . '" tidak ditemukan.';
            } else {
                $notFound = 'Pencarian dengan kata kunci "' . request()->keyword . '" tidak ditemukan.';
            }
            ?>
            @include('partials.not-found')
        @else
            @if (request()->filter == 'kosakata' || empty(request()->filter))
                @foreach ($data as $d)
                    <a href="/kosakata/{{ $d->slug }}" class="block">
                        <div
                            class="group bg-white p-5 rounded-2xl border border-neutral-200 hover:border-amber-100 hover:bg-amber-100 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-amber-300 active:bg-amber-200">
                            <h5 class="capitalize">{{ $d->kosakata }} @if ($d->aksara)
                                    <span class="jawa text-sm">({{ $d->aksara }})</span>
                                @endif
                            </h5>

                            {{-- Jika keyword mirip dengan arti indo --}}
                            {{-- stripos digunakan untuk pencocokan kata dari request dengan arti_indo. ada=bernilai posisi string yang sama. tidak ada=false --}}
                            @if (isset($d->arti_indo) && stripos($d->arti_indo, request('keyword')) !== false)
                                <div>
                                    Dalam Bahasa Indonesia, kosakata ini berarti <span
                                        class="font-semibold capitalize">{{ $d->arti_indo }}</span>.
                                </div>
                            @endif

                            {{-- Jumlah definisi --}}
                            <div>
                                @if ($d->jmlDefinisi > 0)
                                    {{ $d->jmlDefinisi }}
                                    definisi{{ $d->jmlTerverifikasi > 0 ? ' (' . $d->jmlTerverifikasi . ' terverifikasi)' : '' }}.
                                @else
                                    Definisi belum ditambahkan.
                                @endif
                            </div>

                            {{-- Kontributor --}}
                            <div class="flex space-x-2 items-center">
                                <div class="overflow-hidden h-8 w-8 rounded-full z-20 border-white border-2">
                                    <?php
                                    $sementara = $d;
                                    $d = $d->user;
                                    ?>
                                    @include('partials.profil-pic-general-array2')
                                    <?php $d = $sementara; ?>
                                </div>
                                <div class="line-clamp-1">Diinisialisasi oleh {{ $d->user->nama ?? '[Akun dihapus]' }}
                                </div>
                            </div>

                            {{-- Ragam dan jenis kosakata --}}
                            <div class="text-sm mt-2">
                                @if ($d->ragam)
                                    <span class="py-1 px-2 bg-blue-100 rounded-lg">{{ $d->ragam }}</span>
                                @endif
                                @if ($d->jenis)
                                    <span class="py-1 px-2 bg-red-100 rounded-lg">{{ $d->jenis }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            @elseif (request()->filter == 'artikel')
                {{-- Artikel --}}
                @foreach ($data as $d)
                    @include('partials.artikel-list')
                @endforeach
            @elseif (request()->filter == 'pengguna')
                @foreach ($data as $d)
                    <a href="/u/{{ $d->username }}" class="block">
                        <div
                            class="group flex items-center bg-white p-5 rounded-2xl border border-neutral-200 hover:border-amber-100 hover:bg-amber-100 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-amber-300 active:bg-amber-200">
                            {{-- Foto profil --}}
                            <div class="h-10 w-10 rounded-full overflow-hidden mr-3">
                                @isset($d->profile_pic)
                                    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $d->profile_pic) }}"
                                        alt="Profile picture">
                                @else
                                    @if (isset($d->jenis_kelamin) && $d->jenis_kelamin == 'Perempuan')
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

                            <div>
                                {{-- Nama --}}
                                <div class="">{{ $d->nama }}</div>
                                <div class="text-neutral-700 text-sm">&#64;{{ $d->username }} <span
                                        class="bg-amber-100 rounded-full px-2 py-0.5 group-hover:bg-amber-200">Lv.{{ $d->level }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif

        @endif

        {{-- paginate --}}
        @if (
            !empty($data) &&
                (request()->filter == 'kosakata' || request()->filter == 'artikel' || request()->filter == 'pengguna'))
            <div>
                {{ $data->links() }}
            </div>
        @endif
    </div>
@endsection
