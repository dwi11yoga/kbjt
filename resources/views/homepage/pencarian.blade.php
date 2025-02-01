@extends('layouts.homepage-with-banner')

@section('body')
    {{-- Hasil --}}
    <div>
        <h3 class="font-semibold">Pencarian</h3>
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
        @if ($jumlah > 0)
            <div>{{ $jumlah }} data berhasil ditemukan.</div>
        @else
            {{-- <div class="font-semibold mb-3">Kosakata</div> --}}
        @endif
    </div>

    <div class="space-y-3">
        @if ($jumlah <= 0)
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
                                <div class="line-clamp-1">Diinisialisasi oleh {{ $d->user->nama }}
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
        @if (request()->filter == 'kosakata' || request()->filter == 'artikel' || request()->filter == 'pengguna')
            <div>
                {{ $data->links() }}
            </div>
        @endif
    </div>
@endsection
