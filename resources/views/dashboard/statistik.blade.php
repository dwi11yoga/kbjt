@extends('layouts.dashboard')

@section('body')
    <div class="space-y-3">
        {{-- Pengunjung --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div class="mb-6 flex justify-between items-center">
                <div class="">Pengunjung</div>
                <div class="rounded-full px-3 py-1.5 bg-amber-100">2025</div>
            </div>

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
                    <div class="h-64 flex flex-col justify-end items-center space-y-1 z-10">
                        {{-- <div class="text-center">{{ $pengunjung[$i]['jumlah'] ?? 'T/A' }}</div> --}}
                        {{-- diagram bar --}}
                        <div class="bg-amber-{{ isset($pengunjung[$i]) ? '400' : '200' }} flex justify-center py-4 md:rounded-lg rounded-md md:w-10 w-5 cursor-pointer hover:bg-amber-500"
                            style="height: {{ $pengunjung[$i]['persentase'] ?? '5%' }};"
                            title="{{ $pengunjung[$i]['jumlah'] ?? 'T/A' }} pengunjung">
                            {{-- <span class="font-semibold md:hidden">{{ $pengunjung[$i]['jumlah'] ?? '' }}</span> --}}
                        </div>
                        {{-- keterangan bawah --}}
                        <div class="text-sm text-neutral-800">{{ $bln }}</div>
                        {{-- <div class="text-sm text-neutral-800">{{ $pengunjung[$i]['jumlah'] ?? 'T/A' }}</div> --}}
                    </div>
                @endforeach

                {{-- <div class="absolute left-0 bg-black" style="width: 100%; height: 2px; top: 0%;"></div>
                <div class="absolute left-0 bg-black" style="width: 100%; height: 2px; top: 22.5%;"></div>
                <div class="absolute left-0 bg-black" style="width: 100%; height: 2px; top: 45%;"></div>
                <div class="absolute left-0 bg-black" style="width: 100%; height: 2px; top: 67.5%;"></div>
                <div class="absolute left-0 bg-black" style="width: 100%; height: 2px; top: 90%;"></div> --}}
            </div>

        </div>
        <div class="grid grid-cols-3 md:gap-2 gap-3">


            {{-- Anggota --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2">Anggota</div>

                <div class="space-y-2">
                    <div>
                        {{-- <div class="text-sm">ID</div>
                <div class="">ID</div> --}}
                    </div>
                </div>

            </div>

            {{-- Kosakata --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2">Kosakata</div>

                <div class="space-y-2">
                    <div>
                        {{-- <div class="text-sm">ID</div>
                <div class="">ID</div> --}}
                    </div>
                </div>

            </div>

            {{-- Kosakata diedit --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2">Kosakata diedit</div>

                <div class="space-y-2">
                    <div>
                        {{-- <div class="text-sm">ID</div>
                <div class="">ID</div> --}}
                    </div>
                </div>

            </div>

            {{-- Definisi --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2">Definisi</div>

                <div class="space-y-2">
                    <div>
                        {{-- <div class="text-sm">ID</div>
                <div class="">ID</div> --}}
                    </div>
                </div>

            </div>

            {{-- Artikel baru --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2">Artikel baru</div>

                <div class="space-y-2">
                    <div>
                        {{-- <div class="text-sm">ID</div>
                <div class="">ID</div> --}}
                    </div>
                </div>

            </div>

            {{-- Laporan --}}
            <div
                class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                <div class="mb-2">Laporan</div>

                <div class="space-y-2">
                    <div>
                        {{-- <div class="text-sm">ID</div>
                <div class="">ID</div> --}}
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
