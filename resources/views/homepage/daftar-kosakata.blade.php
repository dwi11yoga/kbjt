@extends('.../layouts/homepage-with-banner')
@section('body')
    @if (!empty(auth()->user()->role) && auth()->user()->role != 'kepala')
        <div class="md:flex md:items-center md:justify-between mb-7">
            {{-- Judul --}}
            <h3 class="font-bold md:mb-0 mb-3">Daftar Kosakata</h3>
            {{-- tambah --}}
            <a href="/tambah/kosakata" title="Tambah kosakata baru"
                class="rounded-xl border-2 border-amber-400 py-3 px-4 hover:outline hover:outline-amber-400 hover:outline-4">
                <i data-feather='plus' class="w-4 inline"></i>Tambah
            </a>
        </div>
    @else
        <h3 class="font-bold mb-7">Daftar Kosakata</h3>
    @endif

    {{-- Dropdown huruf --}}
    <form action="/daftar-kosakata" method="GET" class="relative justify-between">
        <div class="space-y-1">
            @foreach (range('A', 'Z') as $d)
                <button type="submit" name="filter" value="{{ $d }}"
                    class="w-10 h-10 rounded-md @if ((empty(request()->filter) && $d == 'A') || request()->filter == $d) bg-amber-400 @else bg-amber-200 @endif hover:bg-amber-300">
                    {{ $d }}
                </button>
            @endforeach
    </form>
    </div>

    @if ($kosakata->isEmpty())
        <?php $notFound = "Belum ada data. <a href='/tambah/kosakata' class='text-blue-500'>Tambahkan?</a>"; ?>
        @include('partials.not-found')
        {{-- <div class="w-full text-center">
            <div>Belum ada data. <a href="#" class="text-blue-600">Tambahkan</a>
            </div>
        </div> --}}
    @else
        <ul class="list-disc list-outside ml-4 flex flex-wrap mt-4 space-y-1">
            @foreach ($kosakata as $d)
                <li class="w-1/2">
                    <a href="/kosakata/{{ $d->slug }}"
                        class="hover:underline hover:decoration-yellow-400 hover:underline-offset-4 hover:decoration-2">
                        <span class="capitalize">
                            {{ $d->kosakata }}
                            @isset($d->ragam)
                                ({{ $d->ragam }})
                            @endisset
                        </span>
                        <br><span class="text-gray-500 small-text">(Ditambahkan oleh
                            {{ $d->user->nama ?? '[Akun dihapus]' }})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
