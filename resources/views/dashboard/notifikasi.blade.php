@extends('layouts.dashboard')
@section('body')
    @foreach ($data as $key => $d)
        <div class="p-5 bg-white rounded-2xl" id="kosakata">
            <div>{{ $key }}</div>
            <div class="space-y-3">
                @foreach ($d as $i)
                    <a href="{{ $i->url ?? '#' }}"
                        class="border border-neutral-200 {{ $i->dilihat == 1 ? 'bg-neutral-200 text-neutral-700' : '' }} p-3 mt-3 rounded-xl flex justify-between md:space-y-0 space-y-1 hover:outline hover:outline-amber-400">
                        <div class="">{{ $i->message }}</div>
                        @if ($i->dilihat == 0)
                            <div class="text-red-600 flex items-center animate-pulse">⦁</div>
                        @endif
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
