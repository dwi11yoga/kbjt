@extends('layouts.dashboard')
@section('body')
    @foreach ($data as $key => $d)
        <div class="p-5 bg-white rounded-2xl" id="kosakata">
            <div class="md:flex md:justify-between md:space-y-0 space-y-1">
                <div>{{ $key }}</div>
                <div class="flex space-x-2">
                    <div class="flex space-x-1 items-center">
                        <div class="w-2 h-2 bg-amber-400"></div>
                        <div class="text-xs">Achievement</div>
                    </div>
                    <div class="flex space-x-1 items-center">
                        <div class="w-2 h-2 bg-blue-400"></div>
                        <div class="text-xs">Sertifikat</div>
                    </div>
                    <div class="flex space-x-1 items-center">
                        <div class="w-2 h-2 bg-green-400"></div>
                        <div class="text-xs">Definisi</div>
                    </div>
                    <div class="flex space-x-1 items-center">
                        <div class="w-2 h-2 bg-red-400"></div>
                        <div class="text-xs">Laporan</div>
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                @foreach ($d as $i)
                    <a href="{{ $i->url ?? '#' }}" title="{{ $i->dilihat==0?'Belum dibaca':'' }}"
                        class="border border-neutral-200 {{ $i->dilihat == 1 ? 'bg-neutral-200 text-neutral-700' : '' }} p-3 mt-3 rounded-xl flex justify-between md:space-y-0 space-y-1 hover:outline hover:outline-amber-400">
                        <div class="flex space-x-2 items-center">
                            <div class="w-1 h-3 bg-amber-400 rounded-full shrink-0"></div>
                            <div>
                                {{ $i->message }}
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="">{{$i->created_at->format('H:m')}}</div>
                            @if ($i->dilihat == 0)
                            <div class="bg-red-600 animate-pulse w-1.5 h-1.5 rounded-full"></div>
                        @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach

    {{-- jika data kosong --}}
    @if (empty($data))
        <div class="border border-neutral-200 p-3 mt-3 rounded-xl">Tidak ada data</div>
    @endif

    {{-- paginate --}}
    {{-- <div class="mt-3">
            {{ $data['kosakata']->links() }}
        </div> --}}
@endsection
