@extends('layouts.homepage-with-banner')

@section('body')
    <h3 class="font-semibold">Tambah kosakata</h3>
    <div class="p-8 border border-neutral-200 rounded-2xl">
        <form action="/kosakata/buat" method="POST">
            @csrf
            <label for="kosakata">Kosakata</label>
            <input type="text" name="kosakata" id="kosakata"
                value="{{ old('kosakata', str_replace('-', ' ', request()->kosakata)) }}"
                class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-xl block mb-3 @error('kosakata')
            border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
            @enderror">
            @error('kosakata')
                <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
            @enderror

            <label for="aksara">Aksara</label>
            <input type="text" name="aksara" id="aksara" value="{{ old('aksara') }}"
                class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-xl block mb-3 jawa">

            <label for="notasi_fonetik">Notasi Fonetik</label>
            <input type="text" name="notasi_fonetik" id="notasi_fonetik" value="{{ old('notasi_fonetik') }}"
                class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-xl block mb-3 ">

            <div class="grid grid-cols-2 space-x-3">
                <div class="relative">
                    <label for="ragam">Ragam</label>
                    <select name="ragam" id="ragam" onchange="ubahSerupa(this)"
                        class="px-4 appearance-none bg-white py-3 w-full mt-1.5 border border-gray-400 rounded-xl block mb-3">
                        <option {{ old('ragam') == 'Krama' ? 'selected' : '' }}>Krama</option>
                        <option {{ old('ragam') == 'Ngoko' ? 'selected' : '' }}>Ngoko</option>
                    </select>
                    <i data-feather='chevron-down' class="absolute top-11 right-3 w-5"></i>
                    @error('ragam')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror
                </div>
                <div class="relative">
                    <label for="jenis">Jenis</label>
                    <select name="jenis" id="jenis" onchange="deskripsi(this)"
                        class="px-4 appearance-none bg-white py-3 w-full mt-1.5 border border-gray-400 rounded-xl block mb-3">
                        <option value="">Pilih</option>
                        <option value="Nomina" {{ old('jenis') == 'Nomina' ? 'selected' : '' }}>Nomina (kata benda)</option>
                        <option value="Verba" {{ old('jenis') == 'Verba' ? 'selected' : '' }}>Verba (kata kerja)</option>
                        <option value="Adjektiva" {{ old('jenis') == 'Adjektiva' ? 'selected' : '' }}>Adjektiva (kata sifat)
                        </option>
                        <option value="Adverbia" {{ old('jenis') == 'Adverbia' ? 'selected' : '' }}>Adverbia (kata
                            keterangan)
                        </option>
                        <option value="Pronomina" {{ old('jenis') == 'Pronomina' ? 'selected' : '' }}>Pronomina (kata
                            ganti)</option>
                        <option value="Numeralia" {{ old('jenis') == 'Numeralia' ? 'selected' : '' }}>Numeralia (kata
                            bilangan)
                        </option>
                        <option value="Konjungsi" {{ old('jenis') == 'Konjungsi' ? 'selected' : '' }}>Konjungsi (kata
                            penghubung)
                        </option>
                        <option value="Interjeksi" {{ old('jenis') == 'Interjeksi' ? 'selected' : '' }}>Interjeksi (kata
                            seru)
                        </option>
                        <option value="Preposisi" {{ old('jenis') == 'Preposisi' ? 'selected' : '' }}>Preposisi (kata
                            depan)
                        </option>
                        <option value="Partikel" {{ old('jenis') == 'Partikel' ? 'selected' : '' }}>Partikel</option>
                        <option value="Onomatope" {{ old('jenis') == 'Onomatope' ? 'selected' : '' }}>Onomatope</option>
                        <option value="Paribasan" {{ old('jenis') == 'Paribasan' ? 'selected' : '' }}>Paribasan
                            (Peribahasa)
                        </option>
                        <option value="Saloka" {{ old('jenis') == 'Saloka' ? 'selected' : '' }}>Saloka</option>
                        <option value="Sanepa" {{ old('jenis') == 'Sanepa' ? 'selected' : '' }}>Sanepa</option>
                        <option value="Sesanti" {{ old('jenis') == 'Sesanti' ? 'selected' : '' }}>Sesanti</option>

                    </select>
                    <i data-feather='chevron-down' class="absolute top-11 right-3 w-5"></i>
                </div>
            </div>
            {{-- Deskripsi jenis --}}
            <div id="jenis_deskripsi" class="text-xs -mt-2 mb-2 italic"></div>

            <script>
                // Deskripsi jenis kosakata
                function deskripsi(id) {
                    const jenis_deskripsi = document.getElementById('jenis_deskripsi');
                    if (id.value == 'Nomina') {
                        jenis_deskripsi.innerText =
                            "*Nomina: Kata yang menyatakan nama orang, tempat, benda, atau konsep abstrak (Contoh: wong, bumi, asep).";
                    } else if (id.value == 'Verba') {
                        jenis_deskripsi.innerText =
                            "*Verba: Kata yang menyatakan tindakan, perbuatan, atau proses (Contoh: mangan, mlaku, turu).";
                    } else if (id.value == 'Adjektiva') {
                        jenis_deskripsi.innerText =
                            "*Adjektiva: Kata yang menjelaskan sifat atau keadaan suatu benda (Contoh: gedhe, apik, cendhek).";
                    } else if (id.value == 'Adverbia') {
                        jenis_deskripsi.innerText =
                            "Adverbia: Kata yang memberikan informasi tambahan tentang verba, adjektiva, atau adverbia lainnya (Contoh: saiki, enggal, bagean.).";
                    } else if (id.value == 'Pronomina') {
                        jenis_deskripsi.innerText =
                            "*Pronomina: Kata yang menggantikan nomina (Contoh: aku, kowe, panjenengan).";
                    } else if (id.value == 'Numeralia') {
                        jenis_deskripsi.innerText =
                            "*Numeralia: Kata yang menyatakan jumlah atau urutan (Contoh: siji, pitu, sepuluh).";
                    } else if (id.value == 'Konjungsi') {
                        jenis_deskripsi.innerText =
                            "*Konjungsi: Kata yang menghubungkan klausa, kalimat, atau frasa (Contoh: lan, nanging, supaya).";
                    } else if (id.value == 'Interjeksi') {
                        jenis_deskripsi.innerText =
                            "*Interjeksi: Kata yang digunakan untuk mengungkapkan perasaan atau emosi (Contoh: aduh, nah, loh).";
                    } else if (id.value == 'Preposisi') {
                        jenis_deskripsi.innerText =
                            "*Preposisi: Kata yang menunjukkan hubungan antara nomina atau pronomina dengan kata lain (Contoh: ing, kanthi, marang).";
                    } else if (id.value == 'Partikel') {
                        jenis_deskripsi.innerText =
                            "*Partikel: Kata tugas yang memberikan nuansa tertentu pada kalimat (Contoh: to, kok, lha.";

                    } else if (id.value == 'Onomatope') {
                        jenis_deskripsi.innerText =
                            "*Onomatope: Kata atau kumpulan kata yang meniru bunyi atau suara dari benda, binatang, atau manusia yang bukan kata (Contoh: bruk, meong, tok tok tok).";
                    } else if (id.value == 'Paribasan') {
                        jenis_deskripsi.innerText =
                            "*Paribasan: Ungkapan atau peribahasa yang sifatnya tetap, sering digunakan untuk menggambarkan situasi umum dengan cara figuratif atau metaforis (Contoh: Kaya asu digebug gelung).";
                    } else if (id.value == 'Saloka') {
                        jenis_deskripsi.innerText =
                            "*Saloka: Ungkapan tetap yang lebih simbolis dan kerap digunakan untuk menyindir atau menggambarkan karakter seseorang (Contoh: Mburu uceng kelangan deleg).";
                    } else if (id.value == 'Sanepa') {
                        jenis_deskripsi.innerText =
                            "*Sanepa: Bahasa kiasan yang digunakan untuk menyampaikan suatu maksud dengan cara tersirat (Contoh:  Kaya wedhus ilang wedhuse).";
                    } else if (id.value == 'Sesanti') {
                        jenis_deskripsi.innerText =
                            "*Sesanti: Ungkapan berupa semboyan atau motto yang berisi nilai-nilai luhur, petuah, atau filosofi hidup (Contoh: Urip iku urup).";
                    } else if (id.value == "") {
                        jenis_deskripsi.innerText = "";
                    }
                }

                // Ubah teks bagian serupa/arti
                function ubahSerupa(id) {
                    const labelSerupa = document.getElementById('labelSerupa');
                    if (id.value == 'Krama') {
                        labelSerupa.innerText = "Arti dalam bahasa ngoko";
                    } else if (id.value == "Ngoko") {
                        labelSerupa.innerText = "Arti dalam bahasa krama";
                    }
                }
            </script>

            <label for="serupa" id="labelSerupa">Arti dalam bahasa ngoko</label>
            <input type="text" name="serupa" id="serupa" value="{{ old('serupa') }}"
                class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-xl block mb-3">

            <label for="arti_indo">Arti dalam Bahasa Indonesia</label>
            <input type="text" name="arti_indo" id="arti_indo" value="{{ old('arti_indo') }}"
                class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-xl block mb-3">

            <label for="etimologi">Etimologi</label>
            <div class="grid grid-cols-2 space-x-3">
                <div>
                    <input type="text" name="bahasa" id="bahasa" oninput="disabledEtimologi(this)"
                        placeholder="Diserap dari bahasa..." value="{{ old('bahasa') }}"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-xl block mb-3 @error('bahasa')
                            border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                        @enderror">
                    @error('bahasa')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <input type="text" name="etimologi" on id="etimologi" disabled placeholder="Kosakata yang diserap..."
                        value="{{ old('etimologi') }}"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-xl block mb-3 bg-neutral-100 @error('etimologi')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                    @error('etimologi')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror
                </div>

                {{-- Atur etimologi di disabled ketika bahasa null --}}
                <script>
                    function disabledEtimologi(id) {
                        const etimologi = document.getElementById('etimologi');
                        if (id.value == "") {
                            etimologi.disabled = true;
                            etimologi.classList.add('bg-neutral-100');
                            etimologi.value = '';
                        } else {
                            etimologi.disabled = false;
                            etimologi.classList.remove('bg-neutral-100');
                        }
                    }
                </script>
            </div>

            <button type="submit"
                class="mt-3 rounded-full bg-amber-300 py-2 px-4 hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-amber-400">Submit</button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                // tampilkan deskripsi
                deskripsi(document.getElementById('jenis'));
                // Ubah teks bagian serupa/arti
                ubahSerupa(document.getElementById('ragam'));

                // Atur etimologi di disabled ketika bahasa null
                disabledEtimologi(document.getElementById('bahasa'));
            });
        </script>
    </div>
@endsection
