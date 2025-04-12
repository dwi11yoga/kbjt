@extends('layouts.homepage')

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
                            <h3 class="font-bold">{{ $user->nama }}
                                @if (isset(auth()->user()->id) && auth()->user()->id == $user->id)
                                    <a href="/pengaturan/edit-user" title="Ke pengaturan"
                                        class="rounded-full w-9 h-9 -ml-1 inline-flex justify-center items-center hover:bg-neutral-200">
                                        <i data-feather='settings' class="inline-block w-5 stroke-neutral-700"></i>
                                    </a>
                                @endif
                            </h3>
                            <div>&#64;{{ $user->username }}
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

                        {{-- Bergabung --}}
                        <div class="text-neutral-600 capitalize">
                            {{ $user->role }} • Bergabung sejak {{ $user->created_at->translatedFormat('d F Y') }}.
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
                    Definisi</a>
                <a id="kosakatatab" href="#kosakata" onclick="tab(this)"
                    class="-mb-0.5 py-3 hover:border-amber-400 hover:text-black">
                    Kosakata</a>
                @if ($user->role == 'pengurus')
                    <a id="artikeltab" href="#artikel" onclick="tab(this)"
                        class="-mb-0.5 py-3 hover:border-amber-400 hover:text-black">
                        Artikel</a>
                @endif
                <a id="achivementtab" href="#achivement" onclick="tab(this)"
                    class="-mb-0.5 py-3 hover:border-amber-400 hover:text-black">
                    Achievements</a>
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
                        <?php $notFound = 'Belum ada achievement yang diperoleh pengguna.'; ?>
                        @include('partials.not-found')
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
                                    <div>{{ isset($user->tgl_lahir) ? $user->tgl_lahir->Translatedformat('d F Y') : '-' }}</div>
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
                                            <a href="https://facebook.com/{{ $user->media_sosial['fb'] }}" target="_blank"
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

    <script>
        // Pindah-pindah tab
        var tabButtons = [
            document.getElementById('definisitab'),
            document.getElementById('kosakatatab'),
            document.getElementById('achivementtab'),
            document.getElementById('tentangtab')
        ];
        var tabPanes = [
            document.getElementById('definisipane'),
            document.getElementById('kosakatapane'),
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
