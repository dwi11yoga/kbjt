@extends('.../layouts/homepage-with-banner')
@section('body')
    <h3 class="font-bold mb-3">Hall of Fame 🔥</h3>
    <p class="mb-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio expedita hic aliquam laudantium
        adipisci harum!
        Facilis quam esse repellendus dolores, odit eligendi. Minima, blanditiis harum doloribus incidunt magnam ullam quam.
        Lorem ipsum dolor sit amet.
    </p>
    <div class="space-y-3">
        <a href="#"
            class="grid grid-cols-12 w-full bg-yellow-100 rounded-2xl py-2 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-yellow-300 active:bg-yellow-200">
            <div class="md:col-span-1 col-span-2 text-center mt-3 font-bold">#1</div>
            <div class="md:col-span-7 col-span-10 flex">
                <div class="w-10 h-10 rounded-full bg-yellow-300 mr-3 mt-1"></div>
                <div><span class="small-text text-gray-500">Username</span><br>moeklisuwu
                    <span class="py-0.5 px-2 rounded-full bg-yellow-300 small-text">Lv.34</span>
                </div>
            </div>
            <div class="md:col-span-2 col-start-3 col-span-3"><span class="small-text text-gray-500">Poin</span><br>34.000
            </div>
            <div class="md:col-span-2 col-span-7"><span class="small-text text-gray-500">Bergabung sejak</span><br>21
                Agustus 2024</div>
        </a>

        <a href="#"
            class="grid grid-cols-12 w-full bg-gray-100 rounded-2xl py-2 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-gray-300 active:bg-gray-200">
            <div class="md:col-span-1 col-span-2 text-center mt-3 font-bold">#2</div>
            <div class="md:col-span-7 col-span-10 flex">
                <div class="w-10 h-10 rounded-full bg-yellow-300 mr-3 mt-1"></div>
                <div><span class="small-text text-gray-500">Username</span><br>raihansipalingtampan
                    <span class="py-0.5 px-2 rounded-full bg-yellow-300 small-text">Lv.34</span>
                </div>
            </div>
            <div class="md:col-span-2 col-start-3 col-span-3"><span class="small-text text-gray-500">Poin</span><br>34.000
            </div>
            <div class="md:col-span-2 col-span-7"><span class="small-text text-gray-500">Bergabung sejak</span><br>21
                Agustus 2024</div>
        </a>

        <a href="#"
            class="grid grid-cols-12 w-full bg-amber-100 rounded-2xl py-2 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-amber-300 active:bg-amber-200">
            <div class="md:col-span-1 col-span-2 text-center mt-3 font-bold">#3</div>
            <div class="md:col-span-7 col-span-10 flex">
                <div class="w-10 h-10 rounded-full bg-yellow-300 mr-3 mt-1"></div>
                <div><span class="small-text text-gray-500">Username</span><br>radenbantermustikasari
                    <span class="py-0.5 px-2 rounded-full bg-yellow-300 small-text">Lv.34</span>
                </div>
            </div>
            <div class="md:col-span-2 col-start-3 col-span-3"><span class="small-text text-gray-500">Poin</span><br>34.000
            </div>
            <div class="md:col-span-2 col-span-7"><span class="small-text text-gray-500">Bergabung sejak</span><br>21
                Agustus 2024</div>
        </a>

        <?php for ($i=4; $i < 101; $i++) { 
            ?>
        <a href="#"
            class="grid grid-cols-12 w-full bg-gray-50 rounded-2xl py-2 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-gray-200 active:bg-gray-100">
            <div class="md:col-span-1 col-span-2 text-center mt-3">#{{ $i }}</div>
            <div class="md:col-span-7 col-span-10 flex">
                <div class="w-10 h-10 rounded-full bg-yellow-300 mr-3 mt-1"></div>
                <div><span class="small-text text-gray-500">Username</span><br>moeklisuwu
                    <span class="py-0.5 px-2 rounded-full bg-yellow-300 small-text">Lv.34</span>
                </div>
            </div>
            <div class="md:col-span-2 col-start-3 col-span-3"><span class="small-text text-gray-500">Poin</span><br>34.000
            </div>
            <div class="md:col-span-2 col-span-7"><span class="small-text text-gray-500">Bergabung sejak</span><br>21
                Agustus 2024</div>
        </a>
        <?php
        } ?>
    </div>

    {{-- <table class="w-full table table-auto">
        <thead>
            <tr>
                <td>#</td>
                <td>Anggota</td>
                <td>Poin</td>
                <td>Bergabung sejak</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td class="flex">
                    <div class="w-10 h-10 rounded-full bg-yellow-400"></div>
                    <div>moeklisuwu <span class="rounded-full py-2 px-3 bg-gray-300">Lv.100</span></div>
                </td>
                <td>34.000</td>
                <td>21 Agustus</td>
            </tr>
        </tbody>
    </table> --}}
@endsection
