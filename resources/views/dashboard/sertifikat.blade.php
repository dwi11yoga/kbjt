@extends('layouts.dashboard')

@section('body')
    {{-- daftar sertifikat --}}
    <div class="space-y-3">
        @if (auth()->user()->role == 'kepala')
            {{-- menu --}}
            {{-- Filter --}}
            <div class="md:flex md:justify-between">
                {{-- Buat artikel --}}
                <a href="/sertifikat/tambah">
                    <div class="md:mt-0 mt-2 py-4 px-5 bg-white rounded-xl hover:outline hover:outline-amber-200">
                        <i data-feather='plus' class="w-5 inline-block"></i>
                        <span>Tambah</span>
                    </div>
                </a>
            </div>
        @endif

        <div class="space-y-2">
            @foreach ($sertifikat as $d)
                {{-- tampilan untuk pengurus dan kontributor --}}
                <div class="grid grid-cols-10 md:space-x-2 md:space-y-0 space-y-1">
                    <a href="{{ auth()->user()->role == 'kepala' ? '/sertifikat/edit/' . $d->id : ($d->didapat == 1 ? '/s/' . auth()->user()->username . '/' . $d->id : '#') }}"
                        class="{{ auth()->user()->role != 'kepala' && $d->progress >= $d->requirement ? 'md:col-span-9' : 'md:col-span-10' }}  col-span-10 px-5 py-6 bg-white rounded-2xl grid md:grid-cols-12 grid-cols-10 space-x-4 hover:outline hover:outline-amber-400">

                        @if (auth()->user()->role != 'kepala' && isset($d->didapat) && $d->didapat == 1)
                            <div
                                class="md:col-span-1 col-span-3 flex items-center justify-center bg-amber-400 aspect-square rounded-xl">
                                <i data-feather='unlock'></i>
                            </div>
                        @else
                            <div
                                class="md:col-span-1 col-span-3 flex items-center justify-center bg-neutral-200 aspect-square rounded-xl">
                                <i data-feather='lock'></i>
                            </div>
                        @endif

                        {{-- detail --}}
                        <div class="md:col-span-11 col-span-7 flex items-center">
                            <div class="w-full space-y-2">
                                @if (auth()->user()->role == 'kepala')
                                    {{-- jika user=kepala --}}
                                    <div>
                                        <div class="capitalize font-medium">{{ $d->nama }}</div>
                                        <div class="text-sm mt-1">
                                            Dapat diperoleh oleh {{ isset($d->role) ? $d->role : 'semua pengguna' }} dengan
                                            {{ $d->rule == 'kontribusi' || $d->rule == 'kontribusiPengurus' ? 'total kontribusi' : $d->rule }}
                                            ≥
                                            {{ $d->rule == 'keanggotaan' ? $d->requirement / 360 . ' tahun' : $d->requirement }}.
                                        </div>
                                    </div>
                                @else
                                    {{-- jika user = pengurus/kontributor --}}
                                    <div>
                                        <div class="capitalize font-medium">{{ $d->nama }}</div>
                                        <div class="text-sm">
                                            {{ $d->persentase }}
                                            @isset($d->tglDiperoleh)
                                                — Diperoleh pada {{ $d->tglDiperoleh->translatedFormat('d F Y H:i') }} WIB.
                                            @else
                                                — {{ $d->progress }}/{{ $d->requirement }}
                                                {{ $d->rule == 'keanggotaan' ? ' hari' : ' kontribusi' }}
                                            @endisset
                                        </div>
                                    </div>
                                    {{-- progress --}}
                                    <div class="relative">
                                        <div class="absolute w-full bg-neutral-200 rounded-full py-1 "></div>
                                        <div class="absolute bg-amber-400 rounded-full py-1"
                                            style="width: {{ $d->persentase }}">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </a>

                    @if (auth()->user()->role != 'kepala' && $d->progress >= $d->requirement)
                        <form action="/sertifikat/klaim/{{ $d->id }}" method="POST"
                            class="md:col-span-1 col-span-10">
                            @csrf
                            <button type="submit"
                                class="w-full h-full bg-amber-400 hover:outline hover:outline-amber-400 hover:outline-offset-2 cursor-pointer md:rounded-xl rounded-xl flex justify-center items-center py-1">
                                Klaim
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="">
            {{ $sertifikat->links() }}
        </div>
    </div>
@endsection
