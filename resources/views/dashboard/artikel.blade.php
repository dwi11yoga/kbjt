@extends('layouts.dashboard')

@section('body')
    {{-- Pagination --}}
    <div class="">
        {{ $posts->links() }}
    </div>
    <div class="space-y-3">
        @foreach ($posts as $d)
            <div
                class="relative grid grid-cols-12 items-center py-4 px-5 bg-white rounded-xl group hover:bg-neutral-100 hover:outline hover:outline-amber-200">
                <a href="#" class="col-span-11 grid grid-cols-11 space-x-10">
                    {{-- Judul --}}
                    <div class="col-span-5 line-clamp-1">
                        @if ($d->pinned == 1)
                            <span>📌</span>
                        @endif
                        {{ $d->judul }}
                    </div>

                    {{-- author --}}
                    <div class="col-span-3 flex items-center space-x-1 text-neutral-700">
                        <div class="md:w-7 md:h-7 w-8 h-8 rounded-full overflow-hidden">
                            @include('partials.profil-pic-general-array2')
                        </div>
                        <div class="line-clamp-1">{{ $d->user->nama }}</div>
                    </div>

                    {{-- Status --}}
                    <div class="col-span-3">
                        @if ($d->status == 1)
                            Dipublikasikan
                        @else
                            Draft
                        @endif
                    </div>
                </a>

                {{-- Tombol --}}
                <div class="col-span-1 text-right">
                    <button class="hover:bg-neutral-200 rounded-full p-2"
                        onclick="dropdown(this, 'dropdown{{ $d->id }}')">
                        <i data-feather='more-vertical' class="w-5"></i>
                    </button>
                </div>

                {{-- Menu --}}
                <div id="dropdown{{ $d->id }}"
                    class="absolute hidden bg-white right-14 z-40 p-2 rounded-xl border border-neutral-200 min-w-48 text-neutral-800">
                    <ul>
                        <a href="#">
                            <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100">
                                <div>Edit</div>
                                <i data-feather='edit-3' class="w-5"></i>
                            </li>
                        </a>
                        <a href="#">
                            <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100">
                                <div>Riwayat edit</div>
                                <i data-feather='clock' class="w-5"></i>
                            </li>
                        </a>
                        <a href="#">
                            <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 text-red-500">
                                <div>Laporkan</div>
                                <i data-feather='flag' class="w-5"></i>
                            </li>
                        </a>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection
