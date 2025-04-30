@extends('layouts.dashboard')
@section('body')
    {{-- data laporan --}}
    <div class="grid grid-cols-3 md:gap-2 gap-3">

        {{-- detail --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div class="mb-2 flex items-center justify-between">
                <div class="">Detail laporan</div>
                @if (!empty($laporan->pengurus_id))
                    <div class="py-1 px-2 flex items-center space-x-1 rounded-full bg-green-100 text-green-600 text-sm">
                        <i data-feather='check-circle' class="w-4"></i>
                        <div class="">Selesai</div>
                    </div>
                @else
                    <div class="py-1 px-2 flex items-center space-x-1 rounded-full bg-red-100 text-red-600 text-sm">
                        <i data-feather='clock' class="w-4"></i>
                        <div class="">Pending</div>
                    </div>
                @endif
            </div>
            <div class="space-y-2">
                <div>
                    <div class="text-sm">ID</div>
                    <div class="">{{ $laporan->idZerofill }}</div>
                </div>
                <div>
                    <div class="text-sm">Waktu</div>
                    <div class="">{{ $laporan->created_at->translatedFormat('d F Y H:i') }}</div>
                </div>
                <div>
                    <div class="text-sm">Alasan</div>
                    <div class="">{{ $laporan->alasan }}</div>
                </div>
                <div>
                    <div class="text-sm">Catatan pelapor</div>
                    <div class="">{{ $laporan->catatan }}</div>
                </div>
            </div>
        </div>

        {{-- hasil tindak lanjut --}}
        @if (!empty($laporan->pengurus_id))
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2 flex items-center justify-between">
                    <div class="">Tindak lanjut</div>
                    <div class="flex items-center space-x-1 text-sm">
                        <i data-feather='calendar' class="w-4"></i>
                        <div class="" title="Waktu laporan ditindak lanjuti">
                            {{ $laporan->status->translatedFormat('d F Y') }}</div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div>
                        <div class="text-sm">Keputusan</div>
                        <div class="">
                            {{ !empty($laporan->hukuman) ? 'Pelanggaran ditemukan' : 'Pelanggaran tidak ditemukan' }}</div>
                    </div>
                    <div>
                        <?php $objekLaporan = !empty($laporan->definisi) ? 'definisi' : 'kosakata'; ?>
                        <div class="text-sm">Tindakan terhadap {{ $objekLaporan }}
                        </div>
                        <div class="">
                            @if (!empty($laporan->hukuman))
                                @if ($laporan->hukuman->tindakan == 'edit')
                                    <span class="capitalize">{{ $objekLaporan }}</span> disembunyikan sampai diperbaiki oleh
                                    terlapor
                                @else
                                    <span class="capitalize">{{ $objekLaporan }}</span> dihapus secara permanen
                                @endif
                            @else
                                Tidak ada
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="text-sm">Hukuman untuk terlapor</div>
                        <div class="">
                            @if (!empty($laporan->hukuman))
                                {{ $laporan->hukuman->hukuman }}
                            @else
                                Tidak ada
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="text-sm">Catatan pengurus</div>
                        <div class="">{{ $laporan->catatan_pengurus }}</div>
                    </div>
                </div>
            </div>
        @endif

        {{-- pelapor & terlapor --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div class="mb-2">Pengguna terkait</div>
            <div class="space-y-2">
                <div class="space-y-1">
                    <div class="text-sm">Pengguna yang melaporkan
                        {{ !empty($laporan->user->statusUser) ? '(akun dihapus)' : '' }}</div>
                    @if ($laporan->author->id == auth()->user()->id)
                        <div class="flex space-x-2 items-center">
                            <div class="rounded-full overflow-hidden object-cover w-8">
                                <?php $d = null; ?>
                                @include('partials.profile-pic-general')
                            </div>
                            <div class="">[Pengguna dirahasiakan]</div>
                        </div>
                    @else
                        <a href="/u/{{ $laporan->user->username }}"
                            class="flex space-x-2 items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                            <div class="rounded-full overflow-hidden object-cover w-8">
                                <?php $d = $laporan->user; ?>
                                @include('partials.profile-pic-general')
                            </div>
                            <div class="">{{ $laporan->user->nama }}<i data-feather='arrow-up-right'
                                    class="w-5 inline"></i></div>
                        </a>
                    @endif
                </div>

                <div class="space-y-1">
                    <div class="text-sm">Pengguna yang dilaporkan
                        {{ !empty($laporan->author->statusUser) ? '(akun dihapus)' : '' }}</div>
                    <a href="/u/{{ $laporan->author->username }}"
                        class="flex space-x-2 items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                        <div class="rounded-full overflow-hidden object-cover w-8">
                            <?php $d = $laporan->author; ?>
                            @include('partials.profile-pic-general')
                        </div>
                        <div class="">{{ $laporan->author->nama }}<i data-feather='arrow-up-right'
                                class="w-5 inline"></i></div>
                    </a>
                </div>

                @if (!empty($laporan->pengurus))
                    <div class="space-y-1">
                        <div class="text-sm">Pengurus yang menindaklanjuti
                            {{ !empty($laporan->pengurus->statusUser) ? '(akun dihapus)' : '' }}</div>
                        @if ($laporan->author->id == auth()->user()->id)
                            <div class="flex space-x-2 items-center">
                                <div class="rounded-full overflow-hidden object-cover w-8">
                                    <?php $d = null; ?>
                                    @include('partials.profile-pic-general')
                                </div>
                                <div class="">[Pengguna dirahasiakan]</div>
                            </div>
                        @else
                            <a href="/u/{{ $laporan->pengurus->username }}"
                                class="flex space-x-2 items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                <div class="rounded-full overflow-hidden object-cover w-8">
                                    <?php $d = $laporan->pengurus; ?>
                                    @include('partials.profile-pic-general')
                                </div>
                                <div class="">{{ $laporan->pengurus->nama }}<i data-feather='arrow-up-right'
                                        class="w-5 inline"></i></div>
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        {{-- definisi/kosakata dilaporkan --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div class="mb-2 flex items-center justify-between">
                <div>Salinan definisi dilaporkan</div>
                @if (!empty($laporan->definisi))
                    @if ($laporan->hukuman->tindakan == 'edit')
                        <a href="/u/{{ $laporan->author->username }}#definisi"
                            title="Perbaiki definisi ini agar dapat kembali ditampilkan secara publik"
                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                            Perbaiki <i data-feather='arrow-up-right' class="w-4"></i>
                        </a>
                    @elseif ($laporan->hukuman->tindakan == 'hapus')
                        <div class="text-sm capitalize">{{ $laporan->kosakata->kosakata }}</div>
                    @else
                        <a href="/kosakata/{{ $laporan->kosakata->slug }}?definisi={{ $laporan->definisi->id }}"
                            title="Lihat definisi asli"
                            class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400 capitalize">
                            {{ $laporan->kosakata->kosakata }} <i data-feather='arrow-up-right' class="w-4"></i>
                        </a>
                    @endif
                @endif
            </div>
            <div class="space-y-1">
                <div>"{!! $laporan->definisi->definisi !!}"</div>
                <div class="text-sm">— {{ $laporan->author->nama }} pada
                    {{ $laporan->waktu_definisi->translatedFormat('d F Y H:i') }}.</div>
            </div>
        </div>

        {{-- ucapan terima kasih kepada user yang melaporkan --}}
        @if (isset($laporan->pengurus_id) && $laporan->user->id == auth()->user()->id)
            <div
                class="md:col-span-2 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2 flex items-center justify-between">
                    <div>Ucapan terima kasih (sesuk)</div>
            </div>
        @endif

        {{-- banner bantuan untuk usesr yang definisinya disembunyikan --}}
        @if (isset($laporan->pengurus_id) && $laporan->author->id == auth()->user()->id && $laporan->hukuman->tindakan == 'edit')
            <div
                class="md:col-span-2 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2 flex items-center justify-between">
                    <div>Bantuuan untuk mengembalikan definisi yang disembunyikan (sesuk)</div>
                </div>
            </div>
        @endif

        @if (empty($laporan->pengurus_id))
            {{-- tentang pelapor --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2">Tentang pelapor</div>
                <div class="flex items-center">
                    <div class="text-neutral-600 text-sm">Level</div>
                    <hr class="flex-grow  border-t border-neutral-200 mx-2">
                    <div class="text-sm">{{ $detailPelapor['lvl'] }}</div>
                </div>
                <div class="flex items-center">
                    <div class="text-neutral-600 text-sm">Definisi & Kosakata dilaporkan*</div>
                    <hr class="flex-grow  border-t border-neutral-200 mx-2">
                    <div class="text-sm">{{ $detailPelapor['totalLaporan'] }}</div>
                </div>

                <div class="flex items-center">
                    <div class="text-neutral-600 text-sm">Definisi & Kosakata terbukti bersalah*</div>
                    <hr class="flex-grow  border-t border-neutral-200 mx-2">
                    <div class="text-sm">{{ $detailPelapor['laporanBersalahDilaporkan'] }}</div>
                </div>

                <div class="flex items-center">
                    <div class="text-neutral-600 text-sm">Definisi & Kosakata dilaporkan bulan ini*</div>
                    <hr class="flex-grow  border-t border-neutral-200 mx-2">
                    <div class="text-sm">{{ $detailPelapor['jmlLaporanBlnIni'] }}</div>
                </div>

                <div class="flex items-center">
                    <div class="text-neutral-600 text-sm">Bergabung sejak</div>
                    <hr class="flex-grow  border-t border-neutral-200 mx-2">
                    <div class="text-sm">{{ $detailPelapor['bergabung'] }}</div>
                </div>
                <div class="text-xs text-neutral-600 mt-2">*Dilaporkan oleh pelapor</div>
            </div>

            {{-- Tentang terlapor --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2">Tentang terlapor</div>
                <div class="flex items-center">
                    <div class="text-neutral-600 text-sm">Level</div>
                    <hr class="flex-grow  border-t border-neutral-200 mx-2">
                    <div class="text-sm">{{ $detailTerlapor['lvl'] }}</div>
                </div>
                <div class="flex items-center">
                    <div class="text-neutral-600 text-sm">Definisi & kosakata dilaporkan*</div>
                    <hr class="flex-grow  border-t border-neutral-200 mx-2">
                    <div class="text-sm">{{ $detailTerlapor['totalLaporan'] }}</div>
                </div>

                <div class="flex items-center">
                    <div class="text-neutral-600 text-sm">Definisi & kosakata terbukti bersalah*</div>
                    <hr class="flex-grow  border-t border-neutral-200 mx-2">
                    <div class="text-sm">{{ $detailTerlapor['laporanBersalahDilaporkan'] }}</div>
                </div>

                <div class="flex items-center">
                    <div class="text-neutral-600 text-sm">Definisi & kosakata dilaporkan bulan ini*</div>
                    <hr class="flex-grow  border-t border-neutral-200 mx-2">
                    <div class="text-sm">{{ $detailTerlapor['jmlLaporanBlnIni'] }}</div>
                </div>

                <div class="flex items-center">
                    <div class="text-neutral-600 text-sm">Bergabung sejak</div>
                    <hr class="flex-grow  border-t border-neutral-200 mx-2">
                    <div class="text-sm">{{ $detailTerlapor['bergabung'] }}</div>
                </div>
                <div class="text-xs text-neutral-600 mt-2">*Disubmit oleh terlapor</div>
            </div>

            {{-- riwayat hukuman --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2">Riwayat hukuman terlapor</div>
                @if (!$riwayatHukuman->isEmpty())
                    @foreach ($riwayatHukuman as $d)
                        <div class="space-y-1">
                            <div class="flex items-center justify-between">
                                <div class="text-sm">
                                    @if (!empty($d->definisi))
                                        Definisi <span class="capitalize">{{ $d->definisi->kosakata }}</span>
                                        ({{ $d->created_at->translatedFormat('d F Y') }})
                                    @else
                                        Kosakata {{ $d->kosakata->kosakata }}
                                    @endif
                                </div>
                                <a href="/laporan/{{ $d->id }}" title="Lihat detail laporan"
                                    class="text-sm flex items-center hover:underline hover:decoration-4 hover:underline-offset-4 hover:decoration-amber-400">
                                    Detail <i data-feather='arrow-up-right' class="w-4"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="flex items-center justify-center h-full -mt-2">
                        Belum ada data
                    </div>
                @endif
            </div>
        @endif

    </div>


    {{-- tindak lanjut --}}
    @if (empty($laporan->pengurus_id) && auth()->user()->role == 'pengurus')
        <div class="p-5 bg-white rounded-2xl">
            <div class="mb-3">Tindakan</div>

            @if (auth()->user()->id == $laporan->author->id)
                {{-- jika user yang membuka tidak berhak untuk menagani laporan --}}
                <?php $notFound = 'Kamu tidak diizinkan menangani laporan ini'; ?>
                @include('partials.not-found')
            @else
                {{-- tindakan yang bisa diambil admin --}}
                @if (isset($laporan->definisi_id))
                    {{-- tindakan untuk definisi --}}
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
                                        ``
                                        <div class="text-sm text-red-600 -mt-2 mb-2">{{ $message }}</div>
                                    @enderror
                                    <div class="space-y-2">

                                        <div class="">
                                            <input type="radio" name="tindakanDefinisi" id="edit" value="edit"
                                                class="hidden peer"
                                                {{ old('tindakanDefinisi') == 'edit' ? 'checked' : '' }}>
                                            <label for="edit"
                                                class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                                <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                                <span>Minta {{ $laporan->author->nama }} untuk mengedit definisi</span>
                                            </label>
                                        </div>

                                        <div class="">
                                            <input type="radio" name="tindakanDefinisi" id="hapus" value="hapus"
                                                class="hidden peer"
                                                {{ old('tindakanDefinisi') == 'hapus' ? 'checked' : '' }}>
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

                                        {{-- Tidak ada --}}
                                        <div class="">
                                            <input type="radio" name="hukuman" id="tidak-ada" value="tidak-ada"
                                                class="hidden peer" {{ old('hukuman') == 'tidak-ada' ? 'checked' : '' }}>
                                            <label for="tidak-ada"
                                                class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                                <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                                <span>Tidak ada</span>
                                            </label>
                                        </div>

                                        {{-- peringatan --}}
                                        <div class="">
                                            <input type="radio" name="hukuman" id="peringatan" value="peringatan"
                                                class="hidden peer" {{ old('hukuman') == 'peringatan' ? 'checked' : '' }}>
                                            <label for="peringatan"
                                                class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                                <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                                <span>Beri peringatan</span>
                                            </label>
                                        </div>

                                        {{-- kurangi poin --}}
                                        {{-- 2% poin --}}
                                        <div class="">
                                            <input type="radio" name="hukuman" id="kurangiPoin002"
                                                value="kurangiPoin002" class="hidden peer"
                                                {{ old('hukuman') == 'kurangiPoin002' ? 'checked' : '' }}>
                                            <label for="kurangiPoin002"
                                                class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                                <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                                <span>Kurangi poin sebesar 2% ({{ $laporan->author->poin }} →
                                                    {{ $hasilPenguranganPoin[2] }} poin)</span>
                                            </label>
                                        </div>

                                        {{-- 5% poin --}}
                                        <div class="">
                                            <input type="radio" name="hukuman" id="kurangiPoin005"
                                                value="kurangiPoin005" class="hidden peer"
                                                {{ old('hukuman') == 'kurangiPoin005' ? 'checked' : '' }}>
                                            <label for="kurangiPoin005"
                                                class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                                <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                                <span>Kurangi poin sebesar 5% ({{ $laporan->author->poin }} →
                                                    {{ $hasilPenguranganPoin[5] }} poin)</span>
                                            </label>
                                        </div>

                                        {{-- 8% poin --}}
                                        <div class="">
                                            <input type="radio" name="hukuman" id="kurangiPoin008"
                                                value="kurangiPoin008" class="hidden peer"
                                                {{ old('hukuman') == 'kurangiPoin008' ? 'checked' : '' }}>
                                            <label for="kurangiPoin008"
                                                class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                                <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                                <span>Kurangi poin sebesar 8% ({{ $laporan->author->poin }} →
                                                    {{ $hasilPenguranganPoin[8] }} poin)</span>
                                            </label>
                                        </div>

                                        {{-- 10% poin --}}
                                        <div class="">
                                            <input type="radio" name="hukuman" id="kurangiPoin010"
                                                value="kurangiPoin010" class="hidden peer"
                                                {{ old('hukuman') == 'kurangiPoin010' ? 'checked' : '' }}>
                                            <label for="kurangiPoin010"
                                                class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                                <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                                <span>Kurangi poin sebesar 10% ({{ $laporan->author->poin }} →
                                                    {{ $hasilPenguranganPoin[10] }} poin)</span>
                                            </label>
                                        </div>

                                        {{-- 15% poin --}}
                                        <div class="">
                                            <input type="radio" name="hukuman" id="kurangiPoin015"
                                                value="kurangiPoin015" class="hidden peer"
                                                {{ old('hukuman') == 'kurangiPoin015' ? 'checked' : '' }}>
                                            <label for="kurangiPoin015"
                                                class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                                <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                                <span>Kurangi poin sebesar 15% ({{ $laporan->author->poin }} →
                                                    {{ $hasilPenguranganPoin[15] }} poin)</span>
                                            </label>
                                        </div>

                                        {{-- 20% poin --}}
                                        <div class="">
                                            <input type="radio" name="hukuman" id="kurangiPoin020"
                                                value="kurangiPoin020" class="hidden peer"
                                                {{ old('hukuman') == 'kurangiPoin020' ? 'checked' : '' }}>
                                            <label for="kurangiPoin020"
                                                class="w-full flex items-center rounded-xl border border-neutral-200 py-5 px-6 cursor-pointer space-x-2 peer-checked:outline peer-checked:outline-2 peer-checked:outline-amber-400 peer-checked:bg-amber-100 peer-checked:text-amber-700 hover:outline hover:outline-2 hover:outline-amber-400">
                                                <i data-feather='chevron-right' class="md:w-5 w-12"></i>
                                                <span>Kurangi poin sebesar 20% ({{ $laporan->author->poin }} →
                                                    {{ $hasilPenguranganPoin[20] }} poin)</span>
                                            </label>
                                        </div>

                                        {{-- Suspend --}}
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
                                <button type="submit" class="text-amber-600 flex items-center">
                                    <i data-feather='check' class="w-5"></i>
                                    <span class="ml-1">Simpan</span>
                                </button>
                            </div>
                        </div>

                    </form>
                @elseif (isset($laporan->kosakata_id))
                    {{-- tindakan untuk kosakata --}}
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
                                            <span>Hapus kosakata</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3 hidden" id="hukuman">
                                {{-- Tindakan terhadap terlapor --}}
                                <div class="space-y-2">
                                    <div class="mb-2">Hukuman untuk terlapor</div>
                                    @error('hukuman')
                                        <div class="text-sm text-red-600 -mt-2 mb-2">{{ $message }}</div>
                                    @enderror
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
                            <div class="w-full bg-white rounded-xl p-4 flex justify-between items-center">
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
                    </form>
                @endif
            @endif
        </div>
    @endif
@endsection
