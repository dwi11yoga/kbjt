@extends('layouts.dashboard')

@section('body')
    {{-- Overview --}}
    @if (auth()->user()->role != 'kepala')
        <div class="">
            <div class="mb-3">Overview</div>
            <div class="grid grid-cols-3 gap-3 ">
                {{-- total achievement --}}
                <div
                    class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
                    <div>Achievement diperoleh<br>
                        <div class="flex items-baseline">
                            <h1 class="font-bold -mt-2">{{ $overview['achievement'] }}</h1>
                            <div class="">/{{ $overview['total'] }}</div>
                        </div>
                    </div>
                    <div class="text-sm">
                        {{ $overview['persentase'] }} achievement telah kamu dapatkan
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- daftar achievement --}}
    <div class="space-y-3">
        @if (auth()->user()->role != 'kepala')
            <div class="flex items-center">Daftar achievement</div>
        @else
            {{-- menu --}}
            {{-- Filter --}}
            <div class="md:flex md:justify-between">
                {{-- Buat artikel --}}
                <a href="/achievement/baru">
                    <div class="md:mt-0 mt-2 py-4 px-5 bg-white rounded-xl hover:outline hover:outline-amber-200">
                        <i data-feather='plus' class="w-5 inline-block"></i>
                        <span>Tambah</span>
                    </div>
                </a>
            </div>
        @endif

        <div class="space-y-2">
            @foreach ($achievement as $d)
                @if (auth()->user()->role != 'kepala')
                    {{-- tampilan untuk pengurus dan kontributor --}}
                    <div
                        class="px-5 py-6 bg-white rounded-2xl grid md:grid-cols-12 grid-cols-10 space-x-4 hover:outline hover:outline-amber-400">

                        <div class="md:col-span-1 col-span-3 flex items-center justify-center rounded-md overflow-hidden">
                            <img src="{{ asset(isset($d->emblem)? 'storage/'.$d->emblem:'storage/achievement/no-icon') }}"
                                class="w-full @if ($d->achieved != 1 && auth()->user()->role != 'kepala') grayscale @endif" alt="Icon">
                        </div>

                        {{-- detail --}}
                        <div class="md:col-span-11 col-span-7 flex items-center">
                            <div class="w-full space-y-2">
                                <div class="">
                                    <div class="capitalize font-medium">{{ $d->nama }}</div>
                                    <div class="text-sm line-clamp-2">{{ $d->deskripsi }}</div>
                                    <div class="text-sm">{{ $d->progress }}
                                        @isset($d->date_achieved)
                                            — Diperoleh pada {{ $d->date_achieved->translatedFormat('d F Y H:i') }} WIB.
                                        @endisset
                                    </div>
                                </div>
                                {{-- progress --}}
                                <div class="relative">
                                    <div class="absolute w-full bg-neutral-200 rounded-full py-1 "></div>
                                    <div class="absolute bg-amber-400 rounded-full py-1" style="width: {{ $d->progress }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    {{-- tampilan untuk kepala --}}
                    <a href="/achievement/{{ $d->id }}/edit"
                        class="px-5 py-6 bg-white rounded-2xl grid md:grid-cols-12 grid-cols-10 space-x-4 hover:outline hover:outline-amber-400">

                        <div class="md:col-span-1 col-span-3 flex items-center justify-center rounded-md overflow-hidden">
                            <img src="{{ asset(isset($d->emblem)? 'storage/'.$d->emblem:'storage/d/no-icon') }}"
                                class="w-full @if ($d->achieved != 1 && auth()->user()->role != 'kepala') grayscale @endif" alt="Icon">
                        </div>

                        {{-- detail --}}
                        <div class="md:col-span-11 col-span-7 flex items-center">
                            <div class="w-full">
                                <div class="capitalize font-medium">{{ $d->nama }}</div>
                                <div class="text-sm line-clamp-2">{{ $d->deskripsi }}</div>
                                {{-- <div class="text-sm">{{ $d->progress }}
                                        @isset($d->date_achieved)
                                            — Diperoleh pada {{ $d->date_achieved->translatedFormat('d F Y H:i') }} WIB.
                                        @endisset
                                    </div> --}}
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>

        <div class="">
            {{ $achievement->links() }}
        </div>
    </div>
@endsection
