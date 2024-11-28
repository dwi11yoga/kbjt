@extends('.../layouts/homepage-with-banner')
@section('body')
    {{-- Judul --}}
    <h3 class="font-bold mb-7">Daftar Kosakata</h3>
    {{-- Dropdown huruf --}}
    <form action="/daftar-kosakata" method="GET" class="relative justify-between">
        <select name="filter" id="filter"
            class="w-full py-3 px-5 rounded-md bg-white border border-gray-200 cursor-pointer font-bold appearance-none">
            <option value="A" {{ $filter == 'A' ? 'selected' : '' }}>A</option>
            <option value="B" {{ $filter == 'B' ? 'selected' : '' }}>B</option>
            <option value="C" {{ $filter == 'C' ? 'selected' : '' }}>C</option>
            <option value="D" {{ $filter == 'D' ? 'selected' : '' }}>D</option>
            <option value="E" {{ $filter == 'E' ? 'selected' : '' }}>E</option>
            <option value="F" {{ $filter == 'F' ? 'selected' : '' }}>F</option>
            <option value="G" {{ $filter == 'G' ? 'selected' : '' }}>G</option>
            <option value="H" {{ $filter == 'H' ? 'selected' : '' }}>H</option>
            <option value="I" {{ $filter == 'I' ? 'selected' : '' }}>I</option>
            <option value="J" {{ $filter == 'J' ? 'selected' : '' }}>J</option>
            <option value="K" {{ $filter == 'K' ? 'selected' : '' }}>K</option>
            <option value="L" {{ $filter == 'L' ? 'selected' : '' }}>L</option>
            <option value="M" {{ $filter == 'M' ? 'selected' : '' }}>M</option>
            <option value="N" {{ $filter == 'N' ? 'selected' : '' }}>N</option>
            <option value="O" {{ $filter == 'O' ? 'selected' : '' }}>O</option>
            <option value="P" {{ $filter == 'P' ? 'selected' : '' }}>P</option>
            <option value="Q" {{ $filter == 'Q' ? 'selected' : '' }}>Q</option>
            <option value="R" {{ $filter == 'R' ? 'selected' : '' }}>R</option>
            <option value="S" {{ $filter == 'S' ? 'selected' : '' }}>S</option>
            <option value="T" {{ $filter == 'T' ? 'selected' : '' }}>T</option>
            <option value="U" {{ $filter == 'U' ? 'selected' : '' }}>U</option>
            <option value="V" {{ $filter == 'V' ? 'selected' : '' }}>V</option>
            <option value="W" {{ $filter == 'W' ? 'selected' : '' }}>W</option>
            <option value="X" {{ $filter == 'X' ? 'selected' : '' }}>X</option>
            <option value="Y" {{ $filter == 'Y' ? 'selected' : '' }}>Y</option>
            <option value="Z" {{ $filter == 'Z' ? 'selected' : '' }}>Z</option>
        </select>

        <span class="absolute flex right-4 top-3"><i data-feather='chevron-down'></i></span>
    </form>
    {{-- memuat halaman ketika item dropdown dipilih --}}
    <script>
        const dropdown = document.getElementById('filter');
        dropdown.addEventListener('change', () => {
            dropdown.form.submit();
        });
    </script>

    @if ($kosakata->isEmpty())
        <div class="w-full text-center">
            <div>Belum ada data. <a href="#" class="text-blue-600">Tambahkan</a>
            </div>
        </div>
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
                            {{ $d->user->nama }})</span>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
