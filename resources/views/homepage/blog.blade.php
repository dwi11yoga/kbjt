@extends('.../layouts/homepage-with-banner')

@section('body')
    <h3 class="mb-7 font-bold">Blog</h3>

    {{-- List artikel --}}
    <div class="space-y-5">
        {{-- Artikel di pin --}}
        <a href="/blog/post"
            class="grid grid-cols-10 group w-full rounded-2xl border border-gray-200 hover:border-yellow-100 hover:bg-yellow-100 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-yellow-300 active:bg-yellow-200">
            <div class="col-span-3">
                <div class="bg-gray-400 rounded-l-2xl w-full aspect-video"></div>
            </div>
            <div class="flex items-center col-span-7 ml-5 ">
                <div>
                    <div
                        class="rounded-md bg-yellow-100 inline-block px-2 text-gray-800 group-hover:bg-yellow-200 group-active:bg-yellow-300">
                        📌Dipin oleh pengurus
                    </div>
                    <h4 class="mb-1">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</h4>
                    <div class="text-gray-700">Oleh <span class="font-bold">Muklis Diharja</span> • 20 Oktober 2024</div>
                </div>
            </div>
        </a>

        {{-- Artikel biasa --}}
        <?php for ($i=0; $i < 10; $i++) { 
            ?>
        <a href="#"
            class="grid grid-cols-10 w-full rounded-2xl border border-gray-200 hover:border-yellow-100 hover:bg-yellow-100 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-yellow-300 active:bg-yellow-200">
            <div class="col-span-3">
                <div class="bg-gray-400 rounded-l-2xl w-full aspect-video"></div>
            </div>
            <div class="flex items-center col-span-7 ml-5 ">
                <div>
                    <h4 class="mb-1">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</h4>
                    <div class="text-gray-700">Oleh <span class="font-bold">Muklis Diharja</span> • 20 Oktober 2024</div>
                </div>
            </div>
        </a>
        <?php
        } ?>
    </div>
@endsection
