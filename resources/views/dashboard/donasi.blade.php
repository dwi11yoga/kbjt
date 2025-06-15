@extends('layouts.dashboard')

@section('body')
    <div class="space-y-3">

        {{-- Filter --}}
        <div class="md:flex md:justify-between">
            {{-- Buat artikel --}}
            <a href="/metode-donasi/baru">
                <div class="md:mt-0 mt-2 py-4 px-5 bg-white rounded-xl hover:outline hover:outline-amber-200">
                    <i data-feather='plus' class="w-5 inline-block"></i>
                    <span>Tambah metode</span>
                </div>
            </a>
        </div>

        @if ($donasi->isEmpty())
            <?php $notFound = 'Tidak ada metode donasi yang dapat ditampilkan'; ?>
            @include('partials.not-found')
        @else
            @foreach ($donasi as $d)
                <div
                    class="relative grid grid-cols-12 items-center bg-white rounded-xl group hover:outline hover:outline-amber-200">
                    <a href="/metode-donasi/{{ $d->id }}/edit"
                        class="md:col-span-11 col-span-10 grid grid-cols-10 md:space-x-10 space-y-2 py-4 pl-5">
                        {{-- Judul --}}
                        <div class="col-span-5 line-clamp-2 flex items-center md:font-normal font-semibold">
                            {{ $d->metode }}
                        </div>

                        {{-- tgl --}}
                        <div class="col-span-5 flex justify-end items-center">
                            {{ $d->updated_at->translatedformat('d M Y ') }}
                        </div>
                    </a>

                    {{-- Tombol --}}
                    <div class="md:col-span-1 col-span-2 text-right py-4 pr-5">
                        <button class="hover:bg-neutral-200 rounded-full py-2 px-2.5"
                            onclick="dropdown(this, 'dropdown{{ $d->id }}')">
                            <i data-feather='more-vertical' class="w-5"></i>
                        </button>
                    </div>

                    {{-- Menu --}}
                    <div id="dropdown{{ $d->id }}"
                        class="absolute hidden bg-white right-14 z-40 p-2 rounded-xl border border-neutral-200 min-w-48 text-neutral-800">
                        <ul>
                            {{-- Lihat --}}
                            <a href="/dukung?metode-pembayaran={{ $d->metode }}">
                                <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100">
                                    <div>Lihat</div>
                                    <i data-feather='eye' class="w-5"></i>
                                </li>
                            </a>

                            {{-- Hapus --}}
                            <button type="submit" id="{{ $d->id }}"
                                onclick="deleteMessage(this,'hapusDonasi', 'formHapus')"
                                class="flex w-full justify-between py-2 px-3 rounded-lg text-red-500 hover:bg-neutral-100">
                                <div>Hapus</div>
                                <i data-feather='trash-2' class="w-5"></i>
                            </button>

                        </ul>
                    </div>
                </div>
            @endforeach

            {{-- popup hapus donasi --}}
            <div class="">
                <div id="hapusDonasi"
                    class="fixed inset-0 m-auto invisible z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6 space-y-4">

                        <h5 class="font-semibold">Kamu yakin ingin menghapus artikel ini?</h5>

                        <div class="space-y-2">
                            <p>Artikel yang dihapus akan hilang secara permanen dan tidak dapat dipulihkan.
                                Yakin ingin melanjutkan?</p>
                        </div>

                        <form id="formHapus" action="" method="POST">
                            @method('delete')
                            @csrf
                            {{-- Button --}}
                            <div class="flex space-x-2">
                                <div onclick="closeWindow('hapusDonasi')"
                                    class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                                    Batal</div>
                                <button type="submit"
                                    class="w-full bg-red-500 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-red-600">Ya,
                                    Yakin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                // fungsi untuk menampilkan pesan hapus
                function deleteMessage(artikel, component, formId) {
                    openWindow(component);

                    var artikel = artikel.id;
                    var form = document.getElementById(formId);
                    form.action = `/metode-donasi/${artikel}/hapus`;
                }
            </script>

            {{-- Pagination --}}
            <div class="">
                {{ $donasi->links() }}
            </div>
        @endif

    </div>
@endsection
