@extends('layouts.dashboard')

@section('body')
    <div class="space-y-3">

        {{-- periode --}}
        <div class="flex justify-between items-center bg-white py-3 px-4 rounded-lg">
            <div class="">Periode</div>
            <div class="flex space-x-2 items-center">

                <?php
                // jika tahun sebelumnya  tidak ditemukan dalam $tahun, maka buat tahun sebelumnya jadi #
                if (in_array((request('tahun') ?? $tahun[0]) - 1, $tahun)) {
                    $tahunBefore = '/statistik?tahun=' . (request('tahun') ?? $tahun[0]) - 1;
                } else {
                    $tahunBefore = '#';
                }
                
                // jika tahun sesudahnya tidak ditemukan dalam $tahun, maka buat tahun sesudahnya jadi #
                if (in_array((request('tahun') ?? $tahun[0]) + 1, $tahun)) {
                    $tahunAfter = '/statistik?tahun=' . (request('tahun') ?? $tahun[0]) + 1;
                } else {
                    $tahunAfter = '#';
                }
                ?>

                <a href="{{ $tahunBefore }}"
                    class="rounded-full py-1.5 px-2 hover:bg-{{ $tahunBefore == '#' ? 'neutral' : 'amber' }}-300">
                    <i data-feather='chevron-left' class="w-5"></i>
                </a>
                <form action="" method="GEt">
                    <select name="tahun" id="tahun" class="bg-white cursor-pointer appearance-none"
                        onchange="muatDropdown(this)">
                        @foreach ($tahun as $d)
                            <option value="{{ $d }}" {{ request()->tahun == $d ? 'selected' : '' }}>
                                {{ $d }}
                            </option>
                        @endforeach

                        {{-- tambahkan opsi tahun yang diminta dari url (jika tahun tidak ada di database) --}}
                        @if (!empty(request('tahun')) && !in_array(request('tahun'), $tahun))
                            <option value="{{ request('tahun') }}" selected>
                                {{ request('tahun') }}
                            </option>
                        @endif
                    </select>
                </form>
                <a href="{{ $tahunAfter }}"
                    class="rounded-full py-1.5 px-2 hover:bg-{{ $tahunAfter == '#' ? 'neutral' : 'amber' }}-300">
                    <i data-feather='chevron-right' class="w-5"></i>
                </a>
            </div>
        </div>

        {{-- Pengunjung --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div class="mb-6">Pengunjung</div>

            <div class="flex justify-between relative pl-10">
                {{-- garis di background --}}
                @for ($i = 0; $i <= 4; $i++)
                    <div class="absolute left-0 flex items-center"
                        style="background-color: #e5e5e5; width: 100%; height: 1px; top: {{ ($i / 4) * (90 / 100) * 100 }}%;">
                        <span class="bg-white pr-5 text-sm text-neutral-800">
                            {{ $nilaiMax['pengunjung'] - $nilaiMax['pengunjung'] * ($i / 4) }}
                        </span>
                    </div>
                @endfor

                {{-- diagram bar --}}
                {{-- perulangan berdasarkan bulan --}}
                @foreach ($bulan as $i => $bln)
                    <div class="h-64 flex flex-col justify-end items-center space-y-1 z-10 {{ $bulanSekarang == $i ? 'bg-amber-100 md:px-4 px-2 rounded-md' : '' }}">
                        {{-- <div class="text-center">{{ $pengunjung[$i]['jumlah'] ?? 'T/A' }}</div> --}}

                        {{-- diagram bar --}}
                        <div class="bg-amber-{{ isset($pengunjung[$i]) ? '400' : '200' }} flex justify-center py-4 md:rounded-lg rounded-md md:w-10 w-5 cursor-pointer hover:bg-amber-500"
                            style="height: {{ $pengunjung[$i]['persentase'] ?? '5%' }};"
                            title="{{ $pengunjung[$i]['jumlah'] ?? 'T/A' }} pengunjung">
                            {{-- <span class="font-semibold md:hidden">{{ $pengunjung[$i]['jumlah'] ?? '' }}</span> --}}
                        </div>

                        {{-- keterangan bawah: nama bulan --}}
                        <div class="text-sm text-neutral-800">{{ $bln }}</div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- Tiga kolom --}}
        <div class="grid grid-cols-3 md:gap-2 gap-3">


            {{-- Anggota --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                {{-- judul --}}
                <div class="mb-4 flex justify-between">
                    <div class="">Anggota</div>
                    <div class="flex space-x-1 items-center text-xs">
                        <div class="w-3 h-3 bg-amber-400 rounded-sm"></div>
                        <div class="">Baru</div>
                        <div class="w-3 h-3 bg-red-400 rounded-sm"></div>
                        <div class="">Menghapus akun</div>
                    </div>
                </div>

                {{-- chart --}}
                <div class="space-y-1.5 overflow-hidden">
                    @foreach ($bulan as $i => $bln)
                        <div
                            class="grid grid-cols-12 space-x-1 items-center {{ $bulanSekarang == $i ? 'bg-amber-100 py-2 rounded-md' : '' }}">

                            {{-- @if ($bulanSekarang == $i)
                                <div class="absolute left-0 top-0 w-full h-full border-2 border-amber-500 z-20"></div>
                            @endif --}}

                            {{-- keterangan samping kiri --}}
                            <div class="col-span-1">
                                <div class="text-sm">{{ $bln }}</div>
                            </div>

                            {{-- bar chart --}}
                            <div class="col-span-11 space-y-0.5 relative">
                                {{-- garis dibelakang bar --}}
                                @for ($j = 0; $j <= 4; $j++)
                                    <div class="absolute flex items-end justify-center top-0"
                                        style="background-color: #e5e5e5; height: 200%; width: 1px; right: {{ ($j / 4) * 100 }}%;">
                                    </div>
                                @endfor

                                {{-- anggota baru --}}
                                <div class="z-10 relative bg-amber-{{ isset($anggota[$i]) ? '400' : '200' }} h-2 rounded-full cursor-pointer hover:bg-amber-500"
                                    style="width: {{ $anggota[$i]['persentaseAnggotaBaru'] ?? '5%' }};"
                                    title="{{ $anggota[$i]['jumlahAnggotaBaru'] ?? 'T/A' }} anggota baru">
                                </div>

                                {{-- anggota yang menghapus akun --}}
                                <div class="z-10 relative bg-red-{{ isset($anggota[$i]) ? '400' : '200' }} h-2 rounded-full cursor-pointer hover:bg-red-500"
                                    style="width: {{ $anggota[$i]['persentaseAnggotaHapusAkun'] ?? '5%' }};"
                                    title="{{ $anggota[$i]['jumlahAnggotaHapusAkun'] ?? 'T/A' }} anggota menghapus akunnya">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- keterangan dibawah --}}
                <div class="grid grid-cols-12 mt-7">
                    <div class="col-span-1"></div>
                    <div class="col-span-11 relative">
                        @for ($j = 0; $j <= 4; $j++)
                            <div class="text-sm text-neutral-800 absolute bottom-0" style="right: {{ ($j / 4) * 100 }}%;">
                                {{ $nilaiMax['anggota'] - $nilaiMax['anggota'] * ($j / 4) }}
                            </div>
                        @endfor
                    </div>
                </div>

            </div>

            {{-- Kosakata baru --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                {{-- judul --}}
                <div class="mb-4">Kosakata baru</div>

                {{-- chart --}}
                <div class="space-y-1.5 overflow-hidden">
                    @foreach ($bulan as $i => $bln)
                        <div class="grid grid-cols-12 space-x-1 items-center {{ $bulanSekarang == $i ? 'bg-amber-100 py-2 rounded-md' : '' }}">

                            {{-- keterangan samping kiri --}}
                            <div class="col-span-1">
                                <div class="text-sm">{{ $bln }}</div>
                            </div>

                            {{-- bar chart --}}
                            <div class="col-span-11 space-y-0.5 relative">
                                {{-- garis dibelakang bar --}}
                                @for ($j = 0; $j <= 4; $j++)
                                    <div class="absolute flex items-end justify-center top-0"
                                        style="background-color: #e5e5e5; height: 200%; width: 1px; right: {{ ($j / 4) * 100 }}%;">
                                    </div>
                                @endfor

                                {{-- kosakata baru --}}
                                <div class="z-10 relative bg-amber-{{ isset($kosakata[$i]) ? '400' : '200' }} h-4 rounded-full cursor-pointer hover:bg-amber-500"
                                    style="width: {{ $kosakata[$i]['persentase'] ?? '5%' }};"
                                    title="{{ $kosakata[$i]['jumlah'] ?? 'T/A' }} kosakata baru">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- keterangan dibawah --}}
                <div class="grid grid-cols-12 mt-7">
                    <div class="col-span-1"></div>
                    <div class="col-span-11 relative">
                        @for ($j = 0; $j <= 4; $j++)
                            <div class="text-sm text-neutral-800 absolute bottom-0" style="right: {{ ($j / 4) * 100 }}%;">
                                {{ $nilaiMax['kosakata'] - $nilaiMax['kosakata'] * ($j / 4) }}
                            </div>
                        @endfor
                    </div>
                </div>

            </div>

            {{-- Edit kosakata --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                {{-- judul --}}
                <div class="mb-4 flex justify-between">
                    <div class="">Edit kosakata</div>
                    <div class="flex space-x-1 items-center text-xs">
                        <div class="w-3 h-3 bg-amber-400 rounded-sm"></div>
                        <div class="">Baru</div>
                        <div class="w-3 h-3 bg-red-400 rounded-sm"></div>
                        <div class="">Disetujui</div>
                    </div>
                </div>

                {{-- chart --}}
                <div class="space-y-1.5 overflow-hidden">
                    @foreach ($bulan as $i => $bln)
                        <div class="grid grid-cols-12 space-x-1 items-center {{ $bulanSekarang == $i ? 'bg-amber-100 py-2 rounded-md' : '' }}">

                            {{-- keterangan samping kiri --}}
                            <div class="col-span-1">
                                <div class="text-sm">{{ $bln }}</div>
                            </div>

                            {{-- bar chart --}}
                            <div class="col-span-11 relative">
                                {{-- garis dibelakang bar --}}
                                @for ($j = 0; $j <= 4; $j++)
                                    <div class="absolute flex items-end justify-center top-0"
                                        style="background-color: #e5e5e5; height: 200%; width: 1px; right: {{ ($j / 4) * 100 }}%;">
                                    </div>
                                @endfor

                                {{-- edit kosakata --}}
                                <div class="z-10 relative -mb-4 bg-amber-{{ isset($editKosakata[$i]) ? '400' : '200' }} h-4 rounded-full cursor-pointer hover:bg-amber-500"
                                    style="width: {{ $editKosakata[$i]['persentaseKosakataEdit'] ?? '5%' }};"
                                    title="{{ $editKosakata[$i]['jumlahKosakataEdit'] ?? 'T/A' }} edit kosakata">
                                </div>

                                {{-- edit kosakata Disetujui --}}
                                <div class="z-10 relative -mt-4 bg-red-{{ isset($editKosakata[$i]) ? '400' : '200' }} h-4 rounded-full cursor-pointer hover:bg-red-500"
                                    style="width: {{ $editKosakata[$i]['persentaseKosakataEditDisetujui'] ?? '5%' }};"
                                    title="{{ $editKosakata[$i]['jumlahKosakataEditDisetujui'] ?? 'T/A' }} edit kosakata disetujui">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- keterangan dibawah --}}
                <div class="grid grid-cols-12 mt-7">
                    <div class="col-span-1"></div>
                    <div class="col-span-11 relative">
                        @for ($j = 0; $j <= 4; $j++)
                            <div class="text-sm text-neutral-800 absolute bottom-0" style="right: {{ ($j / 4) * 100 }}%;">
                                {{ $nilaiMax['editKosakata'] - $nilaiMax['editKosakata'] * ($j / 4) }}
                            </div>
                        @endfor
                    </div>
                </div>

            </div>

            {{-- Definisi --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                {{-- judul --}}
                <div class="mb-4 flex justify-between">
                    <div class="">Definisi</div>
                    <div class="flex space-x-1 items-center text-xs">
                        <div class="w-3 h-3 bg-amber-400 rounded-sm"></div>
                        <div class="">Baru</div>
                        <div class="w-3 h-3 bg-red-400 rounded-sm"></div>
                        <div class="">Diverifikasi</div>
                    </div>
                </div>

                {{-- chart --}}
                <div class="space-y-1.5 overflow-hidden">
                    @foreach ($bulan as $i => $bln)
                        <div class="grid grid-cols-12 space-x-1 items-center {{ $bulanSekarang == $i ? 'bg-amber-100 py-2 rounded-md' : '' }}">

                            {{-- keterangan samping kiri --}}
                            <div class="col-span-1">
                                <div class="text-sm">{{ $bln }}</div>
                            </div>

                            {{-- bar chart --}}
                            <div class="col-span-11 relative">
                                {{-- garis dibelakang bar --}}
                                @for ($j = 0; $j <= 4; $j++)
                                    <div class="absolute flex items-end justify-center top-0"
                                        style="background-color: #e5e5e5; height: 200%; width: 1px; right: {{ ($j / 4) * 100 }}%;">
                                    </div>
                                @endfor

                                {{-- definisi baru --}}
                                <div class="z-10 relative -mb-4 bg-amber-{{ isset($definisi[$i]) ? '400' : '200' }} h-4 rounded-full cursor-pointer hover:bg-amber-500"
                                    style="width: {{ $definisi[$i]['persentaseDefinisi'] ?? '5%' }};"
                                    title="{{ $definisi[$i]['jumlahDefinisi'] ?? 'T/A' }} definisi baru">
                                </div>

                                {{-- definisi baru Disetujui --}}
                                <div class="z-10 relative -mt-4 bg-red-{{ isset($definisi[$i]) ? '400' : '200' }} h-4 rounded-full cursor-pointer hover:bg-red-500"
                                    style="width: {{ $definisi[$i]['persentaseDefinisiDiverifikasi'] ?? '5%' }};"
                                    title="{{ $definisi[$i]['jumlahDefinisiDiverifikasi'] ?? 'T/A' }} definisi disetujui">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- keterangan dibawah --}}
                <div class="grid grid-cols-12 mt-7">
                    <div class="col-span-1"></div>
                    <div class="col-span-11 relative">
                        @for ($j = 0; $j <= 4; $j++)
                            <div class="text-sm text-neutral-800 absolute bottom-0"
                                style="right: {{ ($j / 4) * 100 }}%;">
                                {{ $nilaiMax['definisi'] - $nilaiMax['definisi'] * ($j / 4) }}
                            </div>
                        @endfor
                    </div>
                </div>

            </div>

            {{-- Artikel baru --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                {{-- judul --}}
                <div class="mb-4">Artikel baru</div>

                {{-- chart --}}
                <div class="space-y-1.5 overflow-hidden">
                    @foreach ($bulan as $i => $bln)
                        <div class="grid grid-cols-12 space-x-1 items-center {{ $bulanSekarang == $i ? 'bg-amber-100 py-2 rounded-md' : '' }}">

                            {{-- keterangan samping kiri --}}
                            <div class="col-span-1">
                                <div class="text-sm">{{ $bln }}</div>
                            </div>

                            {{-- bar chart --}}
                            <div class="col-span-11 space-y-0.5 relative">
                                {{-- garis dibelakang bar --}}
                                @for ($j = 0; $j <= 4; $j++)
                                    <div class="absolute flex items-end justify-center top-0"
                                        style="background-color: #e5e5e5; height: 200%; width: 1px; right: {{ ($j / 4) * 100 }}%;">
                                    </div>
                                @endfor

                                {{-- kosakata baru --}}
                                <div class="z-10 relative bg-amber-{{ isset($artikel[$i]) ? '400' : '200' }} h-4 rounded-full cursor-pointer hover:bg-amber-500"
                                    style="width: {{ $artikel[$i]['persentase'] ?? '5%' }};"
                                    title="{{ $artikel[$i]['jumlah'] ?? 'T/A' }} artikel dipublikasikan">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- keterangan dibawah --}}
                <div class="grid grid-cols-12 mt-7">
                    <div class="col-span-1"></div>
                    <div class="col-span-11 relative">
                        @for ($j = 0; $j <= 4; $j++)
                            <div class="text-sm text-neutral-800 absolute bottom-0"
                                style="right: {{ ($j / 4) * 100 }}%;">
                                {{ $nilaiMax['artikel'] - $nilaiMax['artikel'] * ($j / 4) }}
                            </div>
                        @endfor
                    </div>
                </div>

            </div>

            {{-- Laporan --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                {{-- judul --}}
                <div class="mb-4 flex justify-between">
                    <div class="">Laporan</div>
                    <div class="flex space-x-1 items-center text-xs">
                        <div class="w-3 h-3 bg-amber-400 rounded-sm"></div>
                        <div class="">Baru</div>
                        <div class="w-3 h-3 bg-blue-400 rounded-sm"></div>
                        <div class="">Ditangani</div>
                        <div class="w-3 h-3 bg-red-400 rounded-sm"></div>
                        <div class="">Bersalah</div>
                    </div>
                </div>

                {{-- chart --}}
                <div class="space-y-1.5 overflow-hidden">
                    @foreach ($bulan as $i => $bln)
                        <div class="grid grid-cols-12 space-x-1 items-center {{ $bulanSekarang == $i ? 'bg-amber-100 py-2 rounded-md' : '' }}">

                            {{-- keterangan samping kiri --}}
                            <div class="col-span-1">
                                <div class="text-sm">{{ $bln }}</div>
                            </div>

                            {{-- bar chart --}}
                            <div class="col-span-11 relative">
                                {{-- garis dibelakang bar --}}
                                @for ($j = 0; $j <= 4; $j++)
                                    <div class="absolute flex items-end justify-center top-0"
                                        style="background-color: #e5e5e5; height: 200%; width: 1px; right: {{ ($j / 4) * 100 }}%;">
                                    </div>
                                @endfor

                                {{-- laporan baru baru --}}
                                <div class="z-10 relative mb-0.5 bg-amber-{{ isset($laporan[$i]) ? '400' : '200' }} h-2 rounded-full cursor-pointer hover:bg-amber-500"
                                    style="width: {{ $laporan[$i]['persentaseLaporan'] ?? '5%' }};"
                                    title="{{ $laporan[$i]['jumlahLaporan'] ?? 'T/A' }} laporan baru">
                                </div>

                                {{-- laporan ditangani --}}
                                <div class="z-10 relative -mb-2 bg-blue-{{ isset($laporan[$i]) ? '400' : '200' }} h-2 rounded-full cursor-pointer hover:bg-blue-500"
                                    style="width: {{ $laporan[$i]['persentaseLaporanDitangani'] ?? '5%' }};"
                                    title="{{ $laporan[$i]['jumlahLaporanDitangani'] ?? 'T/A' }} laporan ditangani">
                                </div>

                                {{-- laporan dinyatakan bersalah --}}
                                <div class="z-10 relative -mt-2 bg-red-{{ isset($laporan[$i]) ? '400' : '200' }} h-2 rounded-full cursor-pointer hover:bg-red-500"
                                    style="width: {{ $laporan[$i]['persentaseLaporanBersalah'] ?? '5%' }};"
                                    title="{{ $laporan[$i]['jumlahLaporanBersalah'] ?? 'T/A' }} laporan bersalah">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- keterangan dibawah --}}
                <div class="grid grid-cols-12 mt-7">
                    <div class="col-span-1"></div>
                    <div class="col-span-11 relative">
                        @for ($j = 0; $j <= 4; $j++)
                            <div class="text-sm text-neutral-800 absolute bottom-0"
                                style="right: {{ ($j / 4) * 100 }}%;">
                                {{ $nilaiMax['laporan'] - $nilaiMax['laporan'] * ($j / 4) }}
                            </div>
                        @endfor
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
