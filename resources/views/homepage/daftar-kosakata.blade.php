@extends('.../layouts/homepage-with-banner')
@section('body')
    {{-- Judul --}}
    <h3 class="font-bold mb-7">Daftar Kosakata</h3>
    {{-- Dropdown huruf --}}
    <form action="" class="relative justify-between">
        <select name="alphabet" id="alphabet"
            class="w-full py-3 px-5 rounded-md bg-white border border-gray-200 cursor-pointer font-bold appearance-none">
            <option value="A" selected>A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
            <option value="E">E</option>
            <option value="F">F</option>
            <option value="G">G</option>
            <option value="H">H</option>
            <option value="I">I</option>
            <option value="J">J</option>
            <option value="K">K</option>
            <option value="L">L</option>
            <option value="M">M</option>
            <option value="N">N</option>
            <option value="O">O</option>
            <option value="P">P</option>
            <option value="Q">Q</option>
            <option value="R">R</option>
            <option value="S">S</option>
            <option value="T">T</option>
            <option value="U">U</option>
            <option value="V">V</option>
            <option value="W">W</option>
            <option value="X">X</option>
            <option value="Y">Y</option>
            <option value="Z">Z</option>
        </select>

        <span class="absolute flex right-4 top-3"><i data-feather='chevron-down'></i></span>
    </form>

    <ul class="list-disc list-outside ml-4 columns-2 mt-4 space-y-1">
        <?php for ($i=0; $i < 100; $i++) { 
                        ?>
        <li>
            <a href="#"
                class="hover:underline hover:decoration-yellow-400 hover:underline-offset-4 hover:decoration-2">
                aba-aba
                (t.a.)<br><span class="text-gray-500 small-text">(Ditambahkan oleh moeklis, 27
                    Definisi)</span>
            </a>
        </li>
        <?php } ?>
    </ul>
@endsection
