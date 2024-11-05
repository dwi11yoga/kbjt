@extends('.../layouts/login')

@section('body')
    <div class="container p-10 mx-auto flex justify-center h-screen items-center">
        <div class="grid grid-cols-3 space-x-2">
            {{-- Gambar --}}
            <div
                class="md:col-span-2 col-span-3 bg-yellow-500 overflow-hidden md:max-h-[35rem] max-h-32 md:rounded-2xl rounded-t-lg md:mt-0 mt-20">
                <img src="{{ asset('img/ekayana 2 (Ki Purbo ASmoro - Griya Seni Ekalaya) nobg crop.png') }}"
                    alt="Bhatara Guru" class="w-full md:mt-0 -mt-14">
            </div>
            <div class="md:col-span-1 col-span-3 md:p-5 p-0 pt-5">
                <a href="/"
                    class="small-text items-center border border-white  p-2 -ml-2 hover:border-gray-500 hover:rounded-full active:bg-black active:text-white">
                    <i data-feather='arrow-left' class="w-4 inline-block"></i> kembali</a>
                {{-- Judul --}}
                <h3 class="font-bold mb-3 mt-3">Masuk</h3>
                <p class="mb-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, soluta.</p>
                {{-- Form --}}
                <form action="" class="">
                    <label for="username">Username/Email</label>
                    <input name="username" id="username" type="text" placeholder=""
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3">
                    <label for="password">Kata sandi</label>
                    <input name="password" id="password" type="password" placeholder=""
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3">
                    <div class="columns-2">
                        <input type="checkbox" name="remember" id="remember"
                            class="mr-1 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <label for="remember">Ingat saya</label>
                        <div class="text-right">
                            <a href="#"
                                class="text-blue-600 hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-[3px] active:text-blue-800">Lupa
                                kata sandi</a>
                        </div>
                    </div>
                    <input type="submit" value="Masuk"
                        class="block mt-6 bg-yellow-400 text-center p-3 w-full rounded-full cursor-pointer hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-yellow-400 active:bg-yellow-300">
                </form>
                <p class="mt-3">Belum punya akun? <a href="#"
                        class="text-blue-600 hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-[3px] active:text-blue-800">Daftar
                        sekarang</a></p>
            </div>
        </div>
    </div>
@endsection
