@extends('layouts.dashboard')

@section('body')
    {{-- Detail laporan --}}
    <div class="p-5 bg-white rounded-2xl">
        <div class="mb-3">Detail Laporan</div>
        <div class="grid md:grid-cols-2 grid-cols-1 md:space-x-4 space-x-0 md:space-y-0 space-y-8">

            {{-- detail --}}
            <div class="space-y-3">
                <div class="">
                    <div class="text-sm text-neutral-600">ID Laporan</div>
                    <div class="">#{{ $laporan->idZerofill }}</div>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Pelapor</div>
                    <a href="/u/{{ $laporan->author->username }}" class="">{{ $laporan->user->nama }}
                        (&#64;{{ $laporan->user->username }})</a>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Terlapor</div>
                    <a href="/u/{{ $laporan->author->username }}" class="">{{ $laporan->author->nama }}
                        (&#64;{{ $laporan->author->username }})</a>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Alasan</div>
                    <div class="">{{ $laporan->alasan }}</div>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Waktu</div>
                    <div class="">{{ $laporan->created_at->translatedformat('d F Y H:i') }} WIB</div>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Status</div>
                    <div class="">
                        @if (isset($laporan->status))
                            Ditangani
                        @else
                            Pending
                        @endif
                    </div>
                </div>
                <div class="">
                    <div class="text-sm text-neutral-600">Catatan</div>
                    <div class="">
                        @isset($laporan->catatan)
                            {{ $laporan->catatan }}
                        @else
                            Tidak ada
                        @endisset
                    </div>
                </div>
            </div>

            {{-- preview definisi dilaporkan --}}
            <div class="">

                <div class="sticky top-5">
                    <?php $d = $definisi; ?>
                    {{-- import tampilan definisi --}}
                    @include('partials.definisi')

                    {{-- kunjungi definisi --}}
                    <div class="flex justify-center">
                        <a href="/kosakata/{{ $laporan->kosakata->slug }}?definisi={{ $laporan->definisi_id }}"
                            class="rounded-full flex items-center space-x-1 py-2 px-4 border border-neutral-200 w-fit hover:bg-amber-400">
                            @if ($d->updated == 1)
                                <span>Lihat definisi asli</span>
                            @else
                                <span>Definisi asli sudah diubah, cek</span>
                            @endif
                            <i data-feather='arrow-right' class="w-5"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Tindakan --}}
    <div class="p-5 bg-white rounded-2xl">
        <div class="mb-3">Tindakan</div>
        @if (isset($laporan->status))
            <div class="grid md:grid-cols-2 grid-cols-1 md:space-x-4 space-x-0 md:space-y-0 space-y-4">
                <div class="col-span-1 space-y-3">
                    <div class="">
                        <div class="text-sm text-neutral-600">Ditangani oleh</div>
                        <div class="">{{ $laporan->pengurus->nama }}</div>
                    </div>
                    <div class="">
                        <div class="text-sm text-neutral-600">Waktu</div>
                        <div class="">{{ $laporan->status->translatedformat('d F Y H:i') }} WIB</div>
                    </div>
                    <div class="">
                        <div class="text-sm text-neutral-600">Keputusan</div>
                        <div class="">
                            {{ isset($laporan->hukuman) ? 'Pelanggaran ditemukan' : 'Pelanggaran tidak ditemukan' }}
                        </div>
                    </div>
                    <div class="">
                        <div class="text-sm text-neutral-600">Hukuman</div>
                        <ul class="list-disc list-inside">
                            <li>{{ isset($laporan->hukuman) && $laporan->hukuman->hukuman != 'Tidak ada' ? $laporan->hukuman->hukuman : 'Hukuman tidak diberikan untuk terlapor' }}
                            </li>
                            @if (isset($laporan->hukuman) && $laporan->hukuman->tindakan_definisi == 'edit')
                                <li>Definisi perlu diedit oleh terlapor</li>
                            @elseif (isset($laporan->hukuman) && $laporan->hukuman->tindakan_definisi == 'hapus')
                                <li>Definisi dihapus</li>
                            @endif
                        </ul>
                    </div>
                    <div class="">
                        <div class="text-sm text-neutral-600">Catatan dari pengurus</div>
                        <div class="">
                            {{ isset($laporan->catatan_pengurus) ? $laporan->catatan_pengurus : 'Tidak ada' }}
                        </div>
                    </div>
                </div>

                <div class="col-span-1">
                    <div class="sticky top-5">
                        <div class="flex justify-center">
                            <img src="https://img.freepik.com/free-vector/high-five-concept-illustration_114360-26757.jpg"
                                class="w-3/5" alt="High five concept illustration">
                        </div>
                        <div class="font-semibold text-center">Terima kasih atas laporannya!</div>
                        <div class="text-center">Situs ini jadi lebih aman berkat kamu.</div>
                    </div>
                </div>
            </div>
        @else
            @if (auth()->user()->role == 'pengurus')
                {{-- tindakan yang bisa diambil admin --}}
                <form action="/laporan/{{ $laporan->id }}/tindaklanjut" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="space-y-3">

                        {{-- menentukan pelanggaran --}}
                        <div>
                            <div class="mb-2">Buat keputusan</div>
                            @error('pelanggaran')
                                <div class="text-sm text-red-600 -mt-2 mb-2">{{ $message }}</div>
                            @enderror

                            <div class="flex gap-2">
                                <div class="w-1/2 flex">
                                    <input type="radio" name="pelanggaran" id="false" value="false"
                                        class="hidden peer" {{ old('pelanggaran') == 'false' ? 'checked' : '' }}
                                        onchange="document.getElementById('hukuman').classList.add('hidden')">
                                    <label for="false"
                                        class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                        <i data-feather='x' class="md:w-5 w-12"></i>
                                        <span>Tidak ditemukan adanya pelanggaran</span>
                                    </label>
                                </div>
                                <div class="w-1/2 flex">
                                    <input type="radio" name="pelanggaran" id="true" value="true"
                                        class="hidden peer" {{ old('pelanggaran') == 'true' ? 'checked' : '' }}
                                        onchange="document.getElementById('hukuman').classList.remove('hidden')">
                                    <label for="true"
                                        class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                        <i data-feather='check' class="md:w-5 w-12"></i>
                                        <span>Ditemukan adanya pelanggaran</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 hidden" id="hukuman">
                            {{-- Tindakan terhadap definisi --}}
                            <div class="">
                                <div class="mb-2">Tindakan terhadap definisi</div>
                                @error('tindakanDefinisi')
                                    <div class="text-sm text-red-600 -mt-2 mb-2">{{ $message }}</div>
                                @enderror
                                <div class="space-y-2">

                                    <div class="">
                                        <input type="radio" name="tindakanDefinisi" id="edit" value="edit"
                                            class="hidden peer" {{ old('tindakanDefinisi') == 'edit' ? 'checked' : '' }}>
                                        <label for="edit"
                                            class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                            <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                            <span>Minta {{ $laporan->author->nama }} untuk mengedit definisi</span>
                                        </label>
                                    </div>

                                    <div class="">
                                        <input type="radio" name="tindakanDefinisi" id="hapus" value="hapus"
                                            class="hidden peer" {{ old('tindakanDefinisi') == 'hapus' ? 'checked' : '' }}>
                                        <label for="hapus"
                                            class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                            <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                            <span>Hapus definisi</span>
                                        </label>
                                    </div>

                                </div>
                            </div>

                            {{-- Tindakan terhadap terlapor --}}
                            <div class="">
                                <div class="mb-2">Hukuman untuk {{ $laporan->author->nama }}</div>
                                @error('hukuman')
                                    <div class="text-sm text-red-600 -mt-2 mb-2">{{ $message }}</div>
                                @enderror

                                <div class="space-y-2">

                                    <div class="">
                                        <input type="radio" name="hukuman" id="peringatan" value="peringatan"
                                            class="hidden peer" {{ old('hukuman') == 'peringatan' ? 'checked' : '' }}>
                                        <label for="peringatan"
                                            class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                            <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                            <span>Beri peringatan</span>
                                        </label>
                                    </div>

                                    <div class="">
                                        <input type="radio" name="hukuman" id="3hr" value="3hr"
                                            class="hidden peer" {{ old('hukuman') == '3hr' ? 'checked' : '' }}>
                                        <label for="3hr"
                                            class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                            <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                            <span>Cegah untuk berkontribusi selama 3 hari</span>
                                        </label>
                                    </div>

                                    <div class="">
                                        <input type="radio" name="hukuman" id="7hr" value="7hr"
                                            class="hidden peer" {{ old('hukuman') == '7hr' ? 'checked' : '' }}>
                                        <label for="7hr"
                                            class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                            <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                            <span>Cegah untuk berkontribusi selama 7 hari</span>
                                        </label>
                                    </div>

                                    <div class="">
                                        <input type="radio" name="hukuman" id="14hr" value="14hr"
                                            class="hidden peer" {{ old('hukuman') == '14hr' ? 'checked' : '' }}>
                                        <label for="14hr"
                                            class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                            <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                            <span>Cegah untuk berkontribusi selama 14 hari</span>
                                        </label>
                                    </div>

                                    <div class="">
                                        <input type="radio" name="hukuman" id="30hr" value="30hr"
                                            class="hidden peer" {{ old('hukuman') == '30hr' ? 'checked' : '' }}>
                                        <label for="30hr"
                                            class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                            <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                            <span>Cegah untuk berkontribusi selama 30 hari</span>
                                        </label>
                                    </div>

                                    <div class="">
                                        <input type="radio" name="hukuman" id="blokir" value="blokir"
                                            class="hidden peer" {{ old('hukuman') == 'blokir' ? 'checked' : '' }}>
                                        <label for="blokir"
                                            class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                            <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                            <span>Blokir akun secara permanen</span>
                                        </label>
                                    </div>

                                    <div class="">
                                        <input type="radio" name="hukuman" id="tidak-ada" value="tidak-ada"
                                            class="hidden peer" {{ old('hukuman') == 'tidak-ada' ? 'checked' : '' }}>
                                        <label for="tidak-ada"
                                            class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                            <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                            <span>Tidak ada</span>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Catatan --}}
                        <div class="">
                            <div class="mb-2">Tambahkan catatan (opsional)</div>
                            <textarea id="catatan" name="catatan"
                                class="w-full border border-neutral-200 rounded-xl px-6 py-5 focus:outline focus:outline-2 focus:outline-amber-400 appearance-none resize-none focus:outline-none mb-3 max-h-52"
                                placeholder="Ketik disini..." oninput="textareaHeight(this)">{{ old('catatan') }}</textarea>
                        </div>
                    </div>

                    {{-- Tombol simpan --}}
                    <div id="save" class="">
                        <div class="w-full bg-white rounded-xl p-4 mb-5 flex justify-between items-center">
                            <div>
                                <div>Simpan tindakan?</div>
                                <div class="text-sm">Tindakan yang disimpan tidak dapat diubah.</div>
                            </div>
                            <button type="submit" class="text-blue-700 flex items-center">
                                <i data-feather='check' class="w-5"></i>
                                <span class="ml-1">Simpan</span>
                            </button>
                        </div>
                    </div>

    </div>
    </form>

    {{-- js --}}
    <script>
        // tampilkan/sembunyikan hukuman saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            var pelanggaranTrue = document.getElementById('true');
            var pelanggaranFalse = document.getElementById('false');
            var hukuman = document.getElementById('hukuman');

            if (pelanggaranTrue.checked == true) {
                hukuman.classList.remove('hidden');
            } else {
                hukuman.classList.add('hidden');
            }
        })
    </script>
@else
    {{-- jika belum ada tindakan yang diambil admin (untuk kontributor dan kapala) --}}
    <?php $notFound = 'Belum ada tindakan yang diambil'; ?>
    @include('partials.not-found')
    @endif
    @endif
    </div>
@endsection
