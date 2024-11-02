@extends('.../layouts/homepage')
@section('body')
    <div class="container mx-auto p-10">
        {{-- Judul --}}
        <h3 class="font-bold mb-7">Daftar Kosakata</h3>

        <div class="grid grid-cols-4 space-x-3 space-y-10">
            {{-- Konten --}}
            <div class="md:col-span-3 col-span-4">
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
                    <a href="#"
                        class="hover:underline hover:decoration-yellow-400 hover:underline-offset-4 hover:decoration-2">
                        <li>
                            aba-aba
                            (t.a.)<br><span class="text-gray-500 small-text">(Ditambahkan oleh moeklis, 27
                                Definisi)</span>
                        </li>
                    </a>
                    <?php
                    } ?>
                </ul>
            </div>

            {{-- banner --}}
            <div class="col-span-4 md:col-span-1">
                <hr class="sm:hidden mb-10 w-1/3 border-2 align-middle mx-auto ">
                <div class="sticky top-24 space-y-3">
                    {{-- banner 1 --}}
                    <div class="rounded-2xl bg-gray-200 w-full h-60"></div>
                    {{-- banner 2 --}}
                    <div class="rounded-2xl bg-gray-200 w-full h-96"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
