@extends('.../layouts/login')

{{-- Gambar sidebar --}}
@section('img')
    <img src="{{ asset('img/Relief Gandavyuha Borobudur (TWC) recolor.jpg') }}"
        alt="Relief Gandavyuha Borobudur (Rijks Museum)" class="w-full h-full md:mt-0 object-cover">
    <div
        class="bg-white rounded-full p-2 absolute bottom-2 left-2 group cursor-pointer hover:rounded-2xl hover:w-1/2 md:block hidden">
        <p class="hidden mb-2 group-hover:block text-gray-800">Relief Candi Borobudur yang menceritakan
            perjalanan Sudhana mengunjungi 110 kota untuk berguru kepada 110 guru, demi memahami dan menjalani
            cara hidup seorang Bodhisattva<a
                href="https://borobudur.kemdikbud.go.id/index.php/jurnalkonservasicagarbudaya/article/view/243"
                target="_blank" title="Lihat referensi" class="text-blue-600 align-super text-xs">[1]</a>.
        </p>
        <p class="hidden mb-2 group-hover:block text-sm text-gray-800">Gambar oleh PT. Taman Wisata Candi Borobudur Prambanan
            dan Ratu Boko, diambil dari
            <a target="_blank" title="Kunjungi Google Arts & Culture"
                class="text-blue-600 hover:underline hover:underline-offset-4 hover:decoration-amber-400 hover:decoration-2"
                href="https://artsandculture.google.com/asset/sudhana-and-goddess-of-the-night-pt-taman-wisata-candi-borobudur-prambanan-ratu-boko-persero/iQEbnyg1J3PQUQ">Google
                Arts & Culture<i data-feather='arrow-up-right' class="inline-block w-4"></i></a>.
        </p>
        <i data-feather='info' class="inline-block"></i>
        <div class="hidden group-hover:block group-hover:inline-block font-semibold">Relief Gandawyuha</div>
    </div>
    {{-- <img src="{{ asset('img/ekayana 2 (Ki Purbo ASmoro - Griya Seni Ekalaya) nobg crop.png') }}" alt="Bhatara Guru" class="w-full md:mt-0 -mt-14"> --}}
@endsection

{{-- Daftar --}}
@section('body')
    <a href="/"
        class="small-text items-center border border-white  p-2 -ml-2 hover:border-gray-500 hover:rounded-full active:bg-black active:text-white">
        <i data-feather='arrow-left' class="w-4 inline-block"></i> kembali</a>
    {{-- Judul --}}
    <h3 class="font-bold mb-3 mt-3">Buat akun</h3>
    <p id="deskripsi" class="mb-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit, soluta.</p>
    {{-- Form --}}
    <form action="/daftar" method="POST">
        @csrf
        <div id="pertama">
            <label for="nama">Nama</label>
            <input name="nama" id="nama" type="text" value="{{ old('nama') }}" placeholder=""
                class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 appearance-none
                @error('nama')
                    outline outline-2 outline-red-600
                    @else
                    focus:outline focus:outline-2 focus:outline-amber-400
                @enderror
                ">
            @error('nama')
                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
            @enderror

            <label for="email">Email</label>
            <input name="email" id="email" type="text" value="{{ old('email') }}" placeholder=""
                class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 appearance-none
                @error('email')
                    outline outline-2 outline-red-600
                    @else
                    focus:outline focus:outline-2 focus:outline-amber-400
                @enderror
                ">
            @error('email')
                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
            @enderror

            <label for="username">Username</label>
            <input name="username" id="username" type="text" value="{{ old('username') }}" placeholder=""
                class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 appearance-none
                @error('username')
                    outline outline-2 outline-red-600
                    @else
                    focus:outline focus:outline-2 focus:outline-amber-400
                @enderror
                ">
            @error('username')
                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
            @enderror

            <div id="next"
                class="mt-6 bg-gray-300 text-center p-3 w-full rounded-full cursor-pointer hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-gray-400 active:bg-gray-400">
                Selanjutnya</div>
        </div>

        <div id="kedua" class="hidden md:mt-[3.75rem]">
            <label for="password">Kata sandi</label>
            <input name="password" id="password" type="password" placeholder=""
                class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 appearance-none
                @error('password')
                    outline outline-2 outline-red-600
                    @else
                    focus:outline focus:outline-2 focus:outline-amber-400
                @enderror
                ">
            @error('password')
                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
            @enderror

            <label for="password2">Ulangi kata sandi</label>
            <input name="password2" id="password2" type="password" placeholder=""
                class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 appearance-none
                @error('password2')
                    outline outline-2 outline-red-600
                    @else
                    focus:outline focus:outline-2 focus:outline-amber-400
                @enderror
                ">
            @error('password2')
                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
            @enderror

            <input required {{ old('remember') != null ? 'checked' : '' }} value="checked" type="checkbox" name="eula"
                id="eula" class="mr-1 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <label for="eula"
                class="@error('eula')
                underline underline-offset-2 decoration-red-600 decoration-2
            @enderror">Dengan
                ini, saya telah membaca dan menyetujui syarat dan ketentuan yang berlaku dan siap mematuhinya.</label>

            <div class="grid grid-cols-7 space-x-3 mt-6">
                <div id="back"
                    class="col-span-1 bg-gray-300 rounded-full p-3 object-center cursor-pointer hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-gray-400 active:bg-gray-400">
                    <i data-feather='arrow-left' class=""></i>
                </div>
                <div class="col-span-6">
                    <input type="submit" value="Buat akun"
                        class="block bg-amber-400 text-center p-3 w-full rounded-full cursor-pointer hover:outline hover:outline-2 hover:outline-offset-2 hover:outline-amber-400 active:bg-amber-300">
                </div>
            </div>
        </div>
    </form>
    <p id="masuk" class="mt-3 hidden">Sudah punya akun? <a href="/masuk"
            class="text-blue-600 hover:underline hover:underline-offset-4 hover:decoration-amber-400 hover:decoration-[3px] active:text-blue-800">Masuk</a>.
    </p>

    {{-- Javascript --}}
    <script>
        const pertama = document.getElementById('pertama');
        const kedua = document.getElementById('kedua');
        const masuk = document.getElementById('masuk');
        const next = document.getElementById('next');
        const back = document.getElementById('back');
        const deskripsi = document.getElementById('deskripsi')

        next.addEventListener('click', () => {
            pertama.classList.add('hidden');
            kedua.classList.remove('hidden');
            masuk.classList.remove('hidden');
            deskripsi.classList.add('hidden');
        });
        back.addEventListener('click', () => {
            pertama.classList.remove('hidden');
            kedua.classList.add('hidden');
            masuk.classList.add('hidden');
            deskripsi.classList.remove('hidden');
        })
    </script>
@endsection
