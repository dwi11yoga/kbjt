@extends('layouts.homepage')

@section('head')
    {{-- import trix editor 2.0.8 --}}
    <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
    <script src="{{ asset('js/trix.umd.min.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('body')
    {{-- Header profil --}}
    <section class="md:px-28 px-5 pt-14 mx-auto bg-neutral-100">
        <div class="container mx-auto">
            <div class="grid grid-cols-4 md:space-x-20 space-y-4">

                <div class="md:col-span-1 col-span-4">
                    <div class="relative">
                        {{-- Foto profil --}}
                        <div
                            class="overflow-hidden md:h-64 md:w-64 w-40 h-40 ml-2 rounded-full flex justify-center hover:outline hover:outline-amber-400 hover:outline-offset-4 hover:outline-4">
                            <?php $d = $user; ?>
                            @include('partials.profile-pic-general')
                        </div>
                        <div
                            class="absolute top-3 md:left-48 left-32 bg-amber-400 border-4 border-neutral-100 rounded-full py-2 px-4 font-semibold md:text-lg text-base">
                            Lv.{{ $user->level }}
                        </div>
                    </div>
                </div>

                <div class="md:col-span-3 col-span-4 flex items-center">
                    <div class="space-y-2">

                        {{-- Nama & username --}}
                        <div>
                            <div class="flex items-center space-x-2">
                                {{-- nama --}}
                                <h3 class="font-bold">{{ $user->nama }}</h3>

                                {{-- ikon pengaturan --}}
                                @if (isset(auth()->user()->id) && auth()->user()->id == $user->id)
                                    <a href="/pengaturan" title="Ke pengaturan"
                                        class="rounded-full w-9 h-9 -ml-1 inline-flex justify-center items-center hover:bg-neutral-200">
                                        <i data-feather='settings' class="inline-block w-5 stroke-neutral-700"></i>
                                    </a>
                                @endif

                                {{-- menu --}}
                                @if (isset(auth()->user()->role) && auth()->user()->role == 'kepala')
                                    <div class="relative">
                                        {{-- tombol menu --}}
                                        <button id="dropdownBtn" onclick="dropdown(this, 'dropdown')"
                                            class="p-2 rounded-full hover:bg-neutral-200">
                                            <i data-feather='more-horizontal'></i>
                                        </button>

                                        <div id="dropdown"
                                            class="absolute font-normal hidden bg-white right-0 z-40 p-2 rounded-xl border border-neutral-200 min-w-48 text-neutral-800">
                                            <ul>
                                                @if ($user->role == 'kontributor')
                                                    <li onclick="openWindow('promosikanUser')"
                                                        class="flex justify-between py-2 px-3 rounded-lg hover:bg-amber-100 cursor-pointer">
                                                        <div>Promosikan</div>
                                                        <i data-feather='arrow-up' class="w-5"></i>
                                                    </li>
                                                @elseif ($user->role == 'pengurus')
                                                    <li onclick="openWindow('demosiUser')"
                                                        class="flex justify-between py-2 px-3 rounded-lg text-red-500 hover:bg-red-100 cursor-pointer">
                                                        <div>Demosi</div>
                                                        <i data-feather='arrow-down' class="w-5"></i>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            </div>


                            <div>
                                &#64;{{ $user->username }}
                                @isset($user->kota)
                                    • {{ $user->kota }}
                                @endisset
                            </div>
                        </div>

                        {{-- Bio --}}
                        <div>
                            {{-- <h5>Bio</h5> --}}
                            <p class="line-clamp-3">
                                @isset($user->bio)
                                    {{ $user->bio }}
                                @else
                                    Bio belum ditambahkan.
                                @endisset
                            </p>
                        </div>

                        <div class="flex space-x-3 items-center">
                            <div class="flex space-x-1">
                                <i data-feather='heart' class="w-5 fill-amber-400"></i>
                                <span>{{ number_format($user->poin, 0, ',', '.') }} poin</span>
                            </div>
                            <div class="flex space-x-1">
                                <i data-feather='trending-up' class="w-5"></i>
                                <span>{{ number_format($user->view, 0, ',', '.') }} kunjungan</span>
                            </div>
                        </div>

                        {{-- Bergabung --}}
                        <div class="text-neutral-600">
                            <span class="capitalize">{{ $user->role }}</span> • Bergabung sejak
                            {{ $user->created_at->translatedFormat('d F Y') }}.
                        </div>

                        {{-- Website & Media sosial --}}
                        <div>
                            <div class="inline-flex items-center -ml-2 mt-1">
                                {{-- Website --}}
                                @include('partials.profil-medsos')

                                @if (!empty($user->donasi) && $user->donasi['metode'] != null && $user->donasi['rekening'] != null)
                                    {{-- donasi --}}
                                    <div onclick="modal(document.getElementById('donasiModal'))"
                                        class="rounded-md ml-1 cursor-pointer border text-neutral-700 border-neutral-500 flex items-center h-9 px-2 hover:bg-neutral-800 hover:text-white">
                                        Donasi
                                    </div>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            {{-- Tab --}}
            <div class="flex mt-7 space-x-7 border-b-2 border-neutral-200 md:overflow-hidden overflow-x-scroll">
                <a id="definisitab" href="#definisi" onclick="tab(this)"
                    class="-mb-0.5 py-3 hover:border-amber-400 hover:text-black">
                    Definisi
                </a>
                <a id="kosakatatab" href="#kosakata" onclick="tab(this)"
                    class="-mb-0.5 py-3 hover:border-amber-400 hover:text-black">
                    Kosakata
                </a>
                <a id="editkosakatatab" href="#editkosakata" onclick="tab(this)"
                    class="-mb-0.5 py-3 hover:border-amber-400 hover:text-black whitespace-nowrap">
                    Edit Kosakata
                </a>
                @if ($user->role == 'pengurus')
                    <a id="artikeltab" href="#artikel" onclick="tab(this)"
                        class="-mb-0.5 py-3 hover:border-amber-400 hover:text-black">
                        Artikel
                    </a>
                @endif
                <a id="achivementtab" href="#achivement" onclick="tab(this)"
                    class="-mb-0.5 py-3 hover:border-amber-400 hover:text-black">
                    Achievements
                </a>
                <a id="tentangtab" href="#tentang" onclick="tab(this)"
                    class="-mb-0.5 py-3 hover:border-amber-400 hover:text-black">
                    Tentang
                </a>
            </div>

        </div>
    </section>

    {{-- Detail user dan banner --}}
    <section class="md:px-28 px-5 my-8">
        <div class="container mx-auto">
            <div class="grid grid-cols-4 md:space-x-7 md:space-y-0 space-y-5 mt-2">

                {{-- detail user --}}
                <div class="md:col-span-3 col-span-4 text-justify">

                    {{-- Definisi --}}
                    <div id="definisipane" class="">
                        @if (!$definisi->isEmpty())
                            @foreach ($definisi as $d)
                                @include('partials.definisi')
                            @endforeach
                        @else
                            <?php $notFound = 'Belum ada definisi yang ditambahkan oleh pengguna.'; ?>
                            @include('partials.not-found')
                        @endif
                        <div>
                            {{ $definisi->links() }}
                        </div>
                    </div>

                    {{-- Kosakata --}}
                    <div id="kosakatapane" class="space-y-3">
                        @if (!$kosakata->isEmpty())
                            @foreach ($kosakata as $d)
                                <a href="/kosakata/{{ $d->slug }}" class="block">
                                    <div
                                        class="group bg-white p-5 rounded-2xl border border-neutral-200 hover:border-amber-100 hover:bg-amber-100 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-amber-300 active:bg-amber-200">
                                        <h5 class="capitalize">{{ $d->kosakata }} @if ($d->aksara)
                                                <span class="jawa text-sm">({{ $d->aksara }})</span>
                                            @endif
                                        </h5>

                                        {{-- Jumlah definisi --}}
                                        <div>26 definisi (4 definisi terverifikasi)</div>

                                        {{-- Kontributor --}}
                                        <div class="flex mt-1 items-center">
                                            <div class="flex -space-x-3">
                                                <div
                                                    class="overflow-hidden h-8 w-8 rounded-full z-20 border-white group-hover:border-amber-100 border-2">
                                                    @include('partials.profil-pic-general-array2')
                                                </div>
                                            </div>
                                            <div class="ml-2">{{ $d->user->nama }}</div>
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
                            <div>
                                {{ $kosakata->links() }}
                            </div>
                        @else
                            <?php $notFound = 'Belum ada kosakata yang ditambahkan oleh pengguna.'; ?>
                            @include('partials.not-found')
                        @endif
                    </div>

                    {{-- Edit Kosakata --}}
                    <div id="editkosakatapane" class="space-y-3">
                        @if (!$editKosakata->isEmpty())
                            @foreach ($editKosakata as $d)
                                <a href="/kosakata/{{ $d->kosakata->slug }}/riwayat"
                                    title="Lihat riwayat edit kosakata {{ strtolower($d->kosakata->kosakata) }}"
                                    class="rounded-2xl border border-neutral-200 p-5 md:flex md:justify-between hover:outline hover:outline-amber-400">
                                    <div class="font-semibold">Kosakata
                                        {{ $d->kosakata->kosakata ?? '[Kosakata dihapus]' }}</div>
                                    <div class="text-sm">— Disetujui oleh pengurus pada
                                        {{ $d->updated_at->translatedFormat('d F Y') }}</div>
                                </a>
                            @endforeach
                            <div>
                                {{ $editKosakata->links() }}
                            </div>
                        @else
                            <?php $notFound = 'Belum ada data edit kosakata yang ditambahkan oleh pengguna.'; ?>
                            @include('partials.not-found')
                        @endif
                    </div>

                    @if ($user->role == 'pengurus')
                        {{-- Artikel --}}
                        <div id="artikelpane" class="space-y-3">
                            @if (!$posts->isEmpty())
                                @foreach ($posts as $d)
                                    @include('partials.artikel-list')
                                @endforeach

                                {{-- paginate --}}
                                <div>
                                    {{ $posts->links() }}
                                </div>
                            @else
                                <?php $notFound = 'Belum ada artikel yang ditulis oleh pengguna.'; ?>
                                @include('partials.not-found')
                            @endif
                        </div>
                    @endif

                    {{-- Achivement --}}
                    <div id="achivementpane" class="">
                        @if (empty($achievement))
                            <?php $notFound = 'Belum ada achievement yang diperoleh pengguna.'; ?>
                            @include('partials.not-found')
                        @else
                            <div class="space-y-2">
                                @foreach ($achievement as $d)
                                    @include('partials.achievement-item')
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Tentang --}}
                    <div id="tentangpane" class="space-y-4">
                        {{-- Info akun --}}
                        <div class="p-4 border border-neutral-200 rounded-2xl space-y-2">
                            <div class="font-semibold">Informasi akun</div>
                            <div class="space-y-1.5">
                                <div>
                                    <div class="text-sm text-neutral-700">Nama lengkap</div>
                                    <div>{{ $user->nama ?? '-' }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-neutral-700">Username</div>
                                    <div>{{ $user->username ?? '-' }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-neutral-700">Tanggal lahir</div>
                                    <div>{{ isset($user->tgl_lahir) ? $user->tgl_lahir->Translatedformat('d F Y') : '-' }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm text-neutral-700">Jenis kelamin</div>
                                    <div>{{ $user->jenis_kelamin ?? '-' }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-neutral-700">Asal</div>
                                    <div>{{ $user->kota ?? '-' }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-neutral-700">Tautan akun</div>
                                    <div id="url" title="Salin url"
                                        onclick="copyUrl(this, document.getElementById('copyBefore'), document.getElementById('copyAfter'))"
                                        class="inline-block bg-neutral-50 rounded-full py-0.5 px-2 cursor-pointer">
                                        {{ $user->url }}<i id="copyBefore" data-feather='copy'
                                            class="w-4 ml-1 inline-block"></i><i id="copyAfter" data-feather='check'
                                            class="w-4 ml-1 hidden"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bio --}}
                        <div class="p-4 border border-neutral-200 rounded-2xl space-y-2">
                            <div class="font-semibold">Biografi</div>
                            <p>{{ $user->bio ?? 'Belum ada biografi.' }}</p>
                        </div>

                        @if (
                            !empty($user->media_sosial['fb']) ||
                                !empty($user->media_sosial['x']) ||
                                !empty($user->media_sosial['ig']) ||
                                !empty($user->media_sosial['tiktok']) ||
                                !empty($user->media_sosial['wa']) ||
                                !empty($user->media_sosial['telegram']) ||
                                !empty($user->media_sosial['linkedin']) ||
                                !empty($user->media_sosial['github']))
                            {{-- Media sosial --}}
                            <div class="p-4 border border-neutral-200 rounded-2xl space-y-2">
                                <div class="font-semibold">Media sosial</div>
                                <div class="space-y-1.5">
                                    @if (!empty($user->media_sosial['fb']))
                                        <div>
                                            <div class="text-sm text-neutral-700">Facebook</div>
                                            <a href="https://facebook.com/{{ $user->media_sosial['fb'] }}"
                                                target="_blank"
                                                class="inline-block bg-neutral-50 rounded-full py-0.5 px-2">
                                                {{ $user->media_sosial['fb'] }} <i data-feather='arrow-up-right'
                                                    class="w-4 inline-block"></i>
                                            </a>
                                        </div>
                                    @endif
                                    @if (!empty($user->media_sosial['x']))
                                        <div>
                                            <div class="text-sm text-neutral-700">Twitter/X</div>
                                            <a href="https://x.com/{{ $user->media_sosial['x'] }}" target="_blank"
                                                class="inline-block bg-neutral-50 rounded-full py-0.5 px-2">
                                                {{ $user->media_sosial['x'] }} <i data-feather='arrow-up-right'
                                                    class="w-4 inline-block"></i>
                                            </a>
                                        </div>
                                    @endif
                                    @if (!empty($user->media_sosial['ig']))
                                        <div>
                                            <div class="text-sm text-neutral-700">Instagram</div>
                                            <a href="https://www.instagram.com/{{ $user->media_sosial['ig'] }}"
                                                target="_blank"
                                                class="inline-block bg-neutral-50 rounded-full py-0.5 px-2">
                                                {{ $user->media_sosial['ig'] }} <i data-feather='arrow-up-right'
                                                    class="w-4 inline-block"></i>
                                            </a>
                                        </div>
                                    @endif
                                    @if (!empty($user->media_sosial['tiktok']))
                                        <div>
                                            <div class="text-sm text-neutral-700">Tiktok</div>
                                            <a href="https://www.tiktok.com/&#64;{{ $user->media_sosial['tiktok'] }}"
                                                target="_blank"
                                                class="inline-block bg-neutral-50 rounded-full py-0.5 px-2">
                                                {{ $user->media_sosial['tiktok'] }} <i data-feather='arrow-up-right'
                                                    class="w-4 inline-block"></i>
                                            </a>
                                        </div>
                                    @endif
                                    @if (!empty($user->media_sosial['wa']))
                                        <div>
                                            <div class="text-sm text-neutral-700">Whatsapp</div>
                                            <a href="https://wa.me/{{ $user->media_sosial['wa'] }}" target="_blank"
                                                class="inline-block bg-neutral-50 rounded-full py-0.5 px-2">
                                                {{ $user->media_sosial['wa'] }} <i data-feather='arrow-up-right'
                                                    class="w-4 inline-block"></i>
                                            </a>
                                        </div>
                                    @endif
                                    @if (!empty($user->media_sosial['telegram']))
                                        <div>
                                            <div class="text-sm text-neutral-700">Telegram</div>
                                            <a href="https://t.me/{{ $user->media_sosial['telegram'] }}" target="_blank"
                                                class="inline-block bg-neutral-50 rounded-full py-0.5 px-2">
                                                {{ $user->media_sosial['telegram'] }} <i data-feather='arrow-up-right'
                                                    class="w-4 inline-block"></i>
                                            </a>
                                        </div>
                                    @endif
                                    @if (!empty($user->media_sosial['linkedin']))
                                        <div>
                                            <div class="text-sm text-neutral-700">LinkedIn</div>
                                            <a href="https://www.linkedin.com/in/{{ $user->media_sosial['linkedin'] }}"
                                                target="_blank"
                                                class="inline-block bg-neutral-50 rounded-full py-0.5 px-2">
                                                {{ $user->media_sosial['linkedin'] }} <i data-feather='arrow-up-right'
                                                    class="w-4 inline-block"></i>
                                            </a>
                                            hapusDefinisi
                                        </div>
                                    @endif
                                    @if (!empty($user->media_sosial['github']))
                                        <div>
                                            <div class="text-sm text-neutral-700">Github</div>
                                            <a href="https://github.com/{{ $user->media_sosial['github'] }}"
                                                target="_blank"
                                                class="inline-block bg-neutral-50 rounded-full py-0.5 px-2">
                                                {{ $user->media_sosial['github'] }} <i data-feather='arrow-up-right'
                                                    class="w-4 inline-block"></i>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Kontak --}}
                        <div class="p-4 border border-neutral-200 rounded-2xl space-y-2">
                            <div class="font-semibold">Kontak</div>
                            <div class="md:flex block">
                                <div class="md:w-1/2 w-full">
                                    <div class="text-sm text-neutral-700">Email</div>
                                    @if (isset($user->sembunyikan_data['email']) && $user->sembunyikan_data['email'] == false)
                                        <a href="mailto:{{ $user->email }}" target="_blank"
                                            class="inline-block bg-neutral-50 rounded-full py-0.5 px-2">
                                            <i data-feather='mail' class="w-4 inline-block"></i>
                                            {{ $user->email }}
                                        </a>
                                    @else
                                        <div class="py-0.5 px-2">-</div>
                                    @endif
                                </div>
                                <div class="md:w-1/2 w-full">
                                    <div class="text-sm text-neutral-700">Telepon</div>
                                    @if (isset($user->telp) && isset($user->sembunyikan_data['telp']) && $user->sembunyikan_data['telp'] == false)
                                        <div class="py-0.5 px-2">{{ $user->telp }}</div>
                                    @else
                                        <div class="py-0.5 px-2">-</div>
                                    @endif
                                    {{-- <div>{{ $user->telp ?? '-' }}</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- banner --}}
                <div class="md:col-span-1 col-span-4">
                    <div class="sticky top-24 space-y-3">
                        <?php $i = [1, 2]; ?>
                        @foreach ($i as $idBanner)
                            @include('partials.banner')
                        @endforeach
                    </div>
                </div>

            </div>

        </div>
    </section>

    @if (!empty($user->donasi) && $user->donasi['metode'] != null && $user->donasi['rekening'] != null)
        {{-- Modal donasi --}}
        <div id="donasiModal" class="fixed inset-0 hidden bg-black bg-opacity-50 flex justify-center items-center z-50">
            <div class="md:w-1/2 w-11/12 relative">
                {{-- Tutup modal --}}
                <div title="Tutup" onclick="modal(document.getElementById('donasiModal'))"
                    class="absolute right-2 top-2 rounded-full p-2 text-red-500 cursor-pointer hover:bg-white"><i
                        data-feather='x'></i>
                </div>
                {{-- gambar --}}
                <div class="bg-amber-100 rounded-t-2xl aspect-video overflow-hidden">
                    <img class="object-cover w-full h-full" src="{{ asset('img/donasi-01.png') }}"
                        alt="Good team concept illustration (Freepik/storyset)">
                </div>
                {{-- Isi --}}
                <div class="bg-white w-full rounded-b-2xl p-5 space-y-3">
                    <div class="font-semibold">Berikan dukungan</div>
                    <div>Website ini ada berkat kontribusi kolektif semua pengguna. Dengan berdonasi, kamu bisa menunjukkan
                        apresiasi kepada <span class="capitalize">{{ $user->nama }}</span> yang telah memperkaya kamus
                        ini!
                    </div>
                    <div class="flex relative">
                        <span
                            class="inline-flex py-1 px-5 text-nowrap border border-neutral-200 justify-center items-center rounded-l-xl">{{ $user->donasi['metode'] }}</span>
                        <input id="rekening" type="text" readonly
                            class="rounded-r-xl border border-neutral-200 px-4 py-3 w-full"
                            value="{{ $user->donasi['rekening'] }}">
                        @if ($user->donasi['metode'] == 'QRIS' || $user->donasi['metode'] == 'Saweria' || $user->donasi['metode'] == 'Trakteer')
                            <a href="{{ $user->donasi['rekening'] }}" target="_blank"
                                class="absolute right-3 top-3 cursor-pointer"
                                title="Beralih ke {{ $user->donasi['metode'] }}">
                                <i data-feather='external-link' class="w-5"></i>
                            </a>
                        @else
                            <span
                                onclick="copyUrl(document.getElementById('rekening'), document.getElementById('copyBefore2'), document.getElementById('copyAfter2'))"
                                class="absolute right-3 top-3 cursor-pointer" title="Salin">
                                <i id="copyBefore2" data-feather='copy' class="w-5"></i>
                                <i id="copyAfter2" data-feather='check' class="w-5 hidden"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (isset(auth()->user()->role) && auth()->user()->role == 'kepala')
        @if ($user->role == 'kontributor')
            {{-- konfirmasi promosi --}}
            <div id="promosikanUser"
                class="fixed inset-0 m-auto z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6 space-y-4">

                    <h5 class="font-semibold">Promosikan sebagai pengurus</h5>

                    <div class="space-y-2">
                        <p>Kamu yakin ingin mempromosikan {{ $user->nama }} sebagai pengurus?</p>
                    </div>

                    <form action="/ubah-role/{{ $user->id }}" method="POST">
                        @method('put')
                        @csrf
                        {{-- Button --}}
                        <div class="flex space-x-2">
                            <div onclick="closeWindow('promosikanUser')"
                                class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                                Batal
                            </div>
                            <button type="submit"
                                class="w-full bg-amber-400 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-amber-500">Ya,
                                Yakin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @elseif ($user->role == 'pengurus')
            <div id="demosiUser"
                class="fixed inset-0 m-auto z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6 space-y-4">

                    <h5 class="font-semibold">Demosikan sebagai pengurus</h5>

                    <div class="space-y-2">
                        <p>Kamu yakin ingin mencaput status {{ $user->nama }} sebagai pengurus?</p>
                    </div>

                    <form action="/ubah-role/{{ $user->id }}" method="POST">
                        @method('put')
                        @csrf
                        {{-- Button --}}
                        <div class="flex space-x-2">
                            <div onclick="closeWindow('demosiUser')"
                                class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                                Batal
                            </div>
                            <button type="submit"
                                class="w-full bg-red-500 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-red-600">
                                Ya, Yakin
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endif


    <script>
        // Pindah-pindah tab
        var tabButtons = [
            document.getElementById('definisitab'),
            document.getElementById('kosakatatab'),
            document.getElementById('editkosakatatab'),
            document.getElementById('achivementtab'),
            document.getElementById('tentangtab')
        ];
        var tabPanes = [
            document.getElementById('definisipane'),
            document.getElementById('kosakatapane'),
            document.getElementById('editkosakatapane'),
            document.getElementById('achivementpane'),
            document.getElementById('tentangpane')
        ];

        function tab(tab) {
            // Ubah tampilan button
            tabButtons.forEach(element => {
                element.classList.remove('border-b-4', 'text-black', 'border-amber-400', 'font-semibold');
                element.classList.add('border-b-2', 'text-neutral-700', 'border-neutral-200');
            });

            tab.classList.remove('border-b-2', 'text-neutral-700', 'border-neutral-200')
            tab.classList.add('border-b-4', 'text-black', 'border-amber-400', 'font-semibold');

            // dapatkan hash dari button
            const hash = tab.getAttribute('href').substring(1);

            // Sembunyikan panel
            tabPanes.forEach(element => {
                element.classList.add('hidden');
            });

            const showPane = document.getElementById(`${hash}pane`);
            showPane.classList.remove('hidden');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const initialHash = window.location.hash.substring(1);
            if (initialHash) {
                tab(document.getElementById(`${initialHash}tab`));
            } else {
                tab(document.getElementById(`definisitab`));
            }
        });
    </script>
    @if ($user->role == 'pengurus')
        <script>
            tabButtons.push(document.getElementById('artikeltab'));
            tabPanes.push(document.getElementById('artikelpane'));
        </script>
    @endif
@endsection
