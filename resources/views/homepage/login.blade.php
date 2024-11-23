@extends('.../layouts/login')

{{-- Gambar sidebar --}}
@section('img')
    <img src="{{ asset('img/Relief Gandavyuha Borobudur (Rijks Museum) crop.jpg') }}"
        alt="Relief Gandavyuha Borobudur (Rijks Museum)" class="w-full h-full md:mt-0 object-cover">
    <div
        class="bg-white rounded-full p-2 absolute bottom-2 left-2 group cursor-pointer hover:rounded-2xl hover:w-1/2 md:block hidden">
        <p class="hidden mb-2 group-hover:block text-gray-800">Relief Candi Borobudur yang menceritakan
            perjalanan Sudhana mengunjungi 110 kota untuk berguru kepada 110 guru, demi memahami dan menjalani
            cara hidup seorang Bodhisattva<a
                href="https://borobudur.kemdikbud.go.id/index.php/jurnalkonservasicagarbudaya/article/view/243"
                target="_blank" title="Lihat referensi" class="text-blue-600 align-super text-xs">[1]</a>.
        </p>
        <p class="hidden mb-2 group-hover:block text-sm text-gray-800">Gambar oleh Rijksmuseum, diambil dari
            <a target="_blank" title="Kunjungi Google Arts & Culture"
                class="text-blue-600 hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-2"
                href="https://artsandculture.google.com/asset/basreli%C3%ABf-in-de-muur-aan-de-zuidzijde-van-de-borobudur-met-een-gandavyuha-vertelling-kinsbergen-isidore/0AHdFTaZGHOyXg">Google
                Arts & Culture<i data-feather='arrow-up-right' class="inline-block w-4"></i></a>.
        </p>
        <i data-feather='info' class="inline-block"></i>
        <div class="hidden group-hover:block group-hover:inline-block font-semibold">Relief Gandawyuha</div>
    </div>
    {{-- <img src="{{ asset('img/ekayana 2 (Ki Purbo ASmoro - Griya Seni Ekalaya) nobg crop.png') }}" alt="Bhatara Guru" class="w-full md:mt-0 -mt-14"> --}}
@endsection

{{-- Login --}}
@section('body')
    <a href="/"
        class="small-text items-center border border-white  p-2 -ml-2 hover:border-gray-500 hover:rounded-full active:bg-black active:text-white">
        <i data-feather='arrow-left' class="w-4 inline-block"></i> kembali</a>
    {{-- Judul --}}
    <h3 class="font-bold mb-3 mt-3">Masuk</h3>
    <p class="mb-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, soluta.</p>

    {{-- Form --}}
    <form action="/masuk" method="POST">
        @csrf
        <label for="user">Username/Email</label>
        <input name="user" id="user" type="text" placeholder="" value="{{ old('user') }}"
            class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('user')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
        @error('user')
            <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
        @enderror

        <label for="password">Kata sandi</label>
        <input name="password" id="password" type="password" placeholder="" value="{{ old('password') }}"
            class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('password')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
        @error('password')
            <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
        @enderror

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
        {{-- <a href="/dashboard" class="block mt-6 bg-yellow-400 text-center p-3 w-full rounded-full cursor-pointer hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-yellow-400 active:bg-yellow-300">Masuk</a> --}}
        <input type="submit" value="Masuk"
            class="block mt-6 bg-yellow-400 text-center p-3 w-full rounded-full cursor-pointer hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-yellow-400 active:bg-yellow-300">
    </form>

    <p class="mt-3">Belum punya akun?
        <a href="/daftar"
            class="text-blue-600 hover:underline hover:underline-offset-4 hover:decoration-yellow-400 hover:decoration-[3px] active:text-blue-800">Daftar
            sekarang</a>
    </p>
@endsection

{{-- Pemberitahuan --}}
@include('partials.toast')
