@extends('layouts.homepage-with-banner')

@section('body')
    <h3 class="font-semibold">Edit kosakata <span class="lowercase">{{ $data->kosakata }}</span></h3>
    <div class="p-8 border border-neutral-200 rounded-2xl">
        <form action="/kosakata/{{ $data->slug }}/edit" method="POST">
            @csrf
            {{-- <label for="kosakata">Kosakata</label>
            <input type="text" name="kosakata" id="kosakata" oninput="slug()" value="{{ old('kosakata', $data->kosakata) }}"
                class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('kosakata')
            border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
            @enderror">
            @error('slug')
                <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
            @enderror --}}

            <label for="aksara">Aksara Jawa</label>
            <input type="text" name="aksara" id="aksara" value="{{ old('aksara', $data->aksara) }}"
                class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 jawa">

            <label for="notasi_fonetik">Notasi Fonetik</label>
            <input type="text" name="notasi_fonetik" id="notasi_fonetik"
                value="{{ old('notasi_fonetik', $data->notasi_fonetik) }}"
                class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 ">

            <div class="grid grid-cols-2 space-x-3">
                <div class="relative">
                    <label for="ragam">Ragam</label>
                    <select name="ragam" id="ragam"
                        class="px-4 appearance-none bg-white py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3">
                        <option {{ old('ragam', $data->ragam) == 'Krama' ? 'selected' : '' }}>Krama</option>
                        <option {{ old('ragam', $data->ragam) == 'Ngoko' ? 'selected' : '' }}>Ngoko</option>
                    </select>
                    <i data-feather='chevron-down' class="absolute top-11 right-3 w-5"></i>
                    @error('ragam')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror
                </div>
                <div class="relative">
                    <label for="jenis">Jenis</label>
                    <select name="jenis" id="jenis" onchange="deskripsiJenis(this)"
                        class="px-4 appearance-none bg-white py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3">
                        <option value="">Pilih</option>
                        <option value="Nomina" {{ old('jenis', $data->jenis) == 'Nomina' ? 'selected' : '' }}>Nomina (kata
                            benda)</option>
                        <option value="Verba" {{ old('jenis', $data->jenis) == 'Verba' ? 'selected' : '' }}>Verba (kata
                            kerja)</option>
                        <option value="Adjektiva" {{ old('jenis', $data->jenis) == 'Adjektiva' ? 'selected' : '' }}>
                            Adjektiva (kata
                            sifat)
                        </option>
                        <option value="Adverbia" {{ old('jenis', $data->jenis) == 'Adverbia' ? 'selected' : '' }}>Adverbia
                            (kata
                            keterangan)
                        </option>
                        <option value="Pronomina" {{ old('jenis', $data->jenis) == 'Pronomina' ? 'selected' : '' }}>
                            Pronomina (kata
                            ganti)</option>
                        <option value="Numeralia" {{ old('jenis', $data->jenis) == 'Numeralia' ? 'selected' : '' }}>
                            Numeralia (kata
                            bilangan)
                        </option>
                        <option value="Konjungsi" {{ old('jenis', $data->jenis) == 'Konjungsi' ? 'selected' : '' }}>
                            Konjungsi (kata
                            penghubung)
                        </option>
                        <option value="Interjeksi" {{ old('jenis', $data->jenis) == 'Interjeksi' ? 'selected' : '' }}>
                            Interjeksi (kata
                            seru)
                        </option>
                        <option value="Preposisi" {{ old('jenis', $data->jenis) == 'Preposisi' ? 'selected' : '' }}>
                            Preposisi (kata
                            depan)
                        </option>
                        <option value="Partikel" {{ old('jenis', $data->jenis) == 'Partikel' ? 'selected' : '' }}>Partikel
                        </option>
                        <option value="Onomatope" {{ old('jenis', $data->jenis) == 'Onomatope' ? 'selected' : '' }}>
                            Onomatope</option>
                        <option value="Paribasan" {{ old('jenis', $data->jenis) == 'Paribasan' ? 'selected' : '' }}>
                            Paribasan
                            (Peribahasa)
                        </option>
                        <option value="Saloka" {{ old('jenis', $data->jenis) == 'Saloka' ? 'selected' : '' }}>Saloka
                        </option>
                        <option value="Sanepa" {{ old('jenis', $data->jenis) == 'Sanepa' ? 'selected' : '' }}>Sanepa
                        </option>
                        <option value="Sesanti" {{ old('jenis', $data->jenis) == 'Sesanti' ? 'selected' : '' }}>Sesanti
                        </option>

                    </select>
                    <i data-feather='chevron-down' class="absolute top-11 right-3 w-5"></i>
                </div>
            </div>
            {{-- Deskripsi jenis --}}
            <div id="jenis_deskripsi" class="text-xs -mt-2 mb-2 italic"></div>

            <label for="serupa" id="labelSerupa">Kosakata terkait*</label>
            <input type="text" name="serupa" id="serupa" value="{{ old('serupa', $data->serupa) }}"
                class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3">
            <div class="text-sm mb-3">*Kosakata dalam ngoko/krama, kosakata serupa, dan sebagainya (pisahkan dengan ";")</div>

            <label for="arti_indo">Arti dalam Bahasa Indonesia</label>
            <input type="text" name="arti_indo" id="arti_indo" value="{{ old('arti_indo', $data->arti_indo) }}"
                class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3">

            <label for="etimologi">Etimologi</label>
            <div class="relative w-full">
                <select name="etimologi" id="etimologi" onchange="showEtimologiInput(this)"
                    class="px-4 appearance-none bg-white py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3">
                    <option {{ old('etimologi', $data->etimologi) == '' ? 'selected' : '' }} value="">Pilih
                    </option>
                    <option {{ old('etimologi', $data->etimologi) == 'Asli' ? 'selected' : '' }}>Asli</option>
                    <option
                        {{ old('etimologi', $data->etimologi) != '' && old('etimologi', $data->etimologi) != 'Asli' ? 'selected' : '' }}
                        value="Serapan">Serapan dari bahasa asing</option>
                </select>
                <i data-feather='chevron-down' class="absolute top-3.5 right-3 w-5"></i>
            </div>
            <div class="grid grid-cols-2 space-x-3">
                <div>
                    <input type="text" name="bahasa" id="bahasa" oninput="disabledEtimologi(this)"
                        placeholder="Diserap dari bahasa..." value="{{ old('bahasa', $data->bahasa) }}"
                        class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('bahasa')
                            border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                        @enderror">
                    @error('bahasa')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <input type="text" name="kata_diserap" on id="kata_diserap" disabled
                        placeholder="Kosakata yang diserap..." value="{{ old('kata_diserap', $data->kata_diserap) }}"
                        class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 bg-neutral-100 @error('kata_diserap')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                    @error('kata_diserap')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror
                </div>

                {{-- Atur etimologi di disabled ketika bahasa null --}}
                <script>
                    function showEtimologiInput(item) {
                        const kata_diserap = document.getElementById('kata_diserap');
                        const bahasa = document.getElementById('bahasa');
                        if (item.value == '' || item.value == 'Asli') {
                            bahasa.disabled = true;
                            bahasa.classList.add('hidden');
                            kata_diserap.classList.add('hidden');
                        } else {
                            bahasa.disabled = false;
                            bahasa.classList.remove('hidden');
                            kata_diserap.classList.remove('hidden');
                        }
                    }

                    function disabledEtimologi(id) {
                        const kata_diserap = document.getElementById('kata_diserap');
                        if (id.value == "") {
                            kata_diserap.disabled = true;
                            kata_diserap.classList.add('bg-neutral-100');
                            kata_diserap.value = '';
                        } else {
                            kata_diserap.disabled = false;
                            kata_diserap.classList.remove('bg-neutral-100');
                        }
                    }
                </script>
            </div>

            <div>
                <label for="catatan">Catatan (Opsional)</label>
                <textarea name="catatan" id="catatan" cols="30" rows="5" placeholder="Ketik disini..."
                    class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('catatan')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700 @enderror">{{ old('catatan') }}</textarea>
                @error('catatan')
                    <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                @enderror
            </div>

            <div class="">
                @if ($suspend->hukuman == false)
                    {{-- jika user tidak tersuspend --}}
                    <button type="submit"
                        class=" rounded-full bg-amber-300 py-2 px-4 hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-amber-400">
                        Submit
                    </button>
                @else
                    <?php
                    $alert = [
                        'warna' => 'red',
                        'pesan' => 'Untuk sementara, kamu tidak dapat mensubmit perubahan detail kosakata hingga ' . $suspend->hukumanBerakhir . ' karena akunmu sedang disuspend.',
                        'textsize' => 'sm',
                    ];
                    ?>
                    @include('partials.alert')
                    {{-- jika user tersuspend --}}
                    <div
                        class="mb-3 w-fit cursor-pointer rounded-full bg-neutral-300 py-2 px-4 hover:outline hover:outline-offset-2 hover:outline-2 hover:outline-amber-400">
                        Submit
                    </div>
                @endif
            </div>
        </form>

        {{-- Jalankan fungsi js --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                // tampilkan deskripsi
                deskripsiJenis(document.getElementById('jenis'));

                // Atur agar bahasa dan kata asli disembunyikan ketika etimologi bernilai null
                showEtimologiInput(document.getElementById('etimologi'));
                // Atur kata_asli di disabled ketika bahasa null
                disabledEtimologi(document.getElementById('bahasa'));
            });
        </script>
    </div>
@endsection
