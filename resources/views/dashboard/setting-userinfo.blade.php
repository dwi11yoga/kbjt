@extends('layouts.dashboard')

@section('body')
    <form action="/pengaturan/edit-user" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        {{-- Tombol simpan --}}
        <div id="save" class="hidden">
            <div class="w-full bg-white rounded-xl p-4 mb-5 flex justify-between items-center">
                <div>Simpan perubahan?</div>
                <button type="submit" class="text-blue-700 flex items-center">
                    <i data-feather='check' class="w-5"></i>
                    <span class="ml-1">Simpan</span>
                </button>
            </div>
        </div>

        {{-- Ganti profil --}}
        <div class="grid grid-cols-5 space-x-5">
            <div class="col-span-3 space-y-5">
                <div class="bg-white rounded-2xl p-5 text-neutral-800">
                    <div class="mb-3">Informasi akun</div>

                    {{-- Foto profil --}}
                    <div class="items-center">
                        <div class="flex">
                            <div
                                class="w-64 h-64 rounded-2xl overflow-hidden @error('profile_pic') border-4 border-red-500 @enderror">
                                @if (auth()->user()->profile_pic != null)
                                    <img class="w-full h-full object-cover" id="pp_preview"
                                        src="{{ asset('storage/' . auth()->user()->profile_pic) }}" alt="Profile picture">
                                    <input type="hidden" name="oldPP" value="{{ auth()->user()->profile_pic }}">
                                @else
                                    @if (auth()->user()->jenis_kelamin == 'Perempuan')
                                        <img class="w-full h-full object-cover" id="pp_preview"
                                            src="{{ asset('storage/profile-pics/profile_pic-f.jpg') }}"
                                            alt="Profile picture (Freepik/gstudioimagen)">
                                    @else
                                        <img class="w-full h-full object-cover" id="pp_preview"
                                            src="{{ asset('storage/profile-pics/profile_pic-m.jpg') }}"
                                            alt="Profile picture (Freepik/gstudioimagen)">
                                    @endif
                                @endif
                            </div>

                            <div class="ml-1">
                                {{-- Ganti foto profil --}}
                                <div class="group flex">
                                    <div id="pp_trigger"
                                        class="cursor-pointer bg-white hover:bg-amber-300 rounded-full p-4 ">
                                        <i data-feather='camera' class="w-5 h-5"></i>
                                    </div>
                                    <div id="hover-ganti-pp" class="group-hover:flex hidden items-center ml-2">
                                        <div class="bg-amber-300 w-4 h-4 rotate-45">
                                        </div>
                                        <div class="rounded-md bg-amber-300 p-3 -ml-3 z-10">
                                            Ganti foto profil
                                        </div>
                                    </div>
                                </div>

                                {{-- Hapus foto profil --}}
                                @if (auth()->user()->profile_pic != null)
                                    <div class="group flex">
                                        <div id="pp_remove_trigger"
                                            class="cursor-pointer hover:bg-amber-300 rounded-full p-4 ">
                                            <i data-feather='x' class="w-5 h-5"></i>
                                        </div>
                                        <div class="group-hover:flex hidden items-center ml-2">
                                            <div class="bg-amber-300 w-4 h-4 rotate-45">
                                            </div>
                                            <div class="rounded-md bg-amber-300 p-3 -ml-3 z-10">
                                                Hapus foto profil
                                            </div>
                                        </div>
                                    </div>
                                    {{-- remove pp --}}
                                    <input type="checkbox" id="pp_remove" name="pp_remove" class="hidden">
                                @endif
                            </div>
                        </div>

                        {{-- input file foto --}}
                        <input type="file" name="profile_pic" id="profile_pic" onchange="previewImage()" class="hidden">

                        @error('profile_pic')
                            <div class="text-xs mt-2 text-red-600">*{{ $message }}</div>
                        @else
                            <div class="text-xs mt-2">*Format gambar dengan ukuran max 1024KB.</div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        {{-- username --}}
                        <label for="username">Username</label>
                        <input type="text" value="{{ old('username', auth()->user()->username) }}" name="username"
                            id="username"
                            class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('username')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                        @error('username')
                            <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        {{-- Nama --}}
                        <label for="nama">Nama</label>
                        <input type="text" value="{{ old('nama', auth()->user()->nama) }}" name="nama" id="nama"
                            class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('nama')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                        @error('nama')
                            <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                        @enderror
                    </div>


                    <div>
                        {{-- tgl_lahir --}}
                        <label for="tgl_lahir">Tanggal lahir</label>
                        <input type="date" value="{{ old('tgl_lahir', auth()->user()->tgl_lahir) }}" name="tgl_lahir"
                            id="tgl_lahir"
                            class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('tgl_lahir')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                        @error('tgl_lahir')
                            <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        {{-- kota --}}
                        <label for="kota">Kota</label>
                        <input type="text" value="{{ old('kota', auth()->user()->kota) }}" name="kota" id="kota"
                            class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('kota')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                        @error('kota')
                            <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        {{-- jenis_kelamin --}}
                        <label for="jenis_kelamin">Jenis kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="px-4 py-3 w-full mt-1.5 border border-neutral-200 bg-white rounded-xl block mb-3 @error('jenis_kelamin')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                            <option {{ old('jenis_kelamin', '') == '' ? 'selected' : '' }} value="">
                                Pilih...</option>
                            <option
                                {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option
                                {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Kontak --}}
                <div class="bg-white p-5 rounded-2xl">
                    <div class="mb-3 text-black">Kontak</div>
                    <div>
                        {{-- telp --}}
                        <label for="telp">Nomor telepon</label>
                        <div class="text-xs">*Diawali kode negara tanpa simbol "+".</div>
                        <input type="text" value="{{ old('telp', auth()->user()->telp) }}" name="telp"
                            id="telp" placeholder="Contoh: 6289XXX..."
                            class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('telp')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                        @error('telp')
                            <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <div>Sosial media</div>
                        {{-- Facebook --}}
                        <div class="flex mt-1.5 mb-3">
                            <span
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-neutral-200 w-14"><i
                                    data-feather='facebook' class="fill-blue-700 stroke-none"></i></span>
                            <input type="text" id="fb" name="fb"
                                value="{{ old('fb', auth()->user()->media_sosial['fb'] ?? '') }}"
                                class="px-3 py-3 w-full border border-neutral-200 rounded-r-xl block @error('fb')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                            @error('fb')
                                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- X(Twitter) --}}
                        <div class="flex mt-1.5 mb-3">
                            <span
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-neutral-200 w-14"><i
                                    data-feather='twitter' class="fill-sky-600 stroke-none"></i></span>
                            <input type="text" id="x" name="x"
                                value="{{ old('x', auth()->user()->media_sosial['x'] ?? '') }}"
                                class="px-3 py-3 w-full border border-neutral-200 rounded-r-xl block @error('x')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                            @error('x')
                                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Instagram --}}
                        <div class="flex mt-1.5 mb-3">
                            <span
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-neutral-200 w-14">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                                    <rect class="fill-neutral-800 stroke-none" x="2" y="2" width="20" height="20"
                                        rx="5" ry="5"></rect>
                                    <path class="stroke-white" d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line class="stroke-white" x1="17.5" y1="6.5" x2="17.51"
                                        y2="6.5">
                                    </line>
                                </svg>
                            </span>
                            <input type="text" id="ig" name="ig"
                                value="{{ old('ig', auth()->user()->media_sosial['ig'] ?? '') }}"
                                class="px-3 py-3 w-full border border-neutral-200 rounded-r-xl block @error('ig')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                            @error('ig')
                                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- tiktok --}}
                        <div class="flex mt-1.5 mb-3">
                            <span
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-neutral-200 w-14">
                                <svg fill="currentColor" width="24" height="24" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                    <path
                                        d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.672a2.896 2.896 0 0 1-5.201 1.743l-.002-.001.002.001a2.895 2.895 0 0 1 3.183-4.51v-3.5a6.329 6.329 0 0 0-5.394 10.692 6.33 6.33 0 0 0 10.857-4.424V8.687a8.182 8.182 0 0 0 4.773 1.526V6.79a4.831 4.831 0 0 1-1.003-.104z" />
                                </svg>
                            </span>
                            <input type="text" id="tiktok" name="tiktok"
                                value="{{ old('tiktok', auth()->user()->media_sosial['tiktok'] ?? '') }}"
                                class="px-3 py-3 w-full border border-neutral-200 rounded-r-xl block @error('tiktok')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                            @error('tiktok')
                                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-span-2 space-y-5">
                <div class="bg-white rounded-2xl p-5">
                    {{-- bio --}}
                    <label for="bio" class="">Bio</label>
                    <textarea name="bio" id="bio" cols="30" rows="10"
                        class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('bio')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700 @enderror">{{ old('bio', auth()->user()->bio) }}</textarea>
                    @error('bio')
                        <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                    @enderror
                </div>

                {{-- Link pengguna --}}
                <div class="bg-white p-5 rounded-2xl">
                    <div class="text-black">Tautan</div>
                    <div class="text-xs mb-3">Tambahkan tautan kamu (YouTube, website, blog, toko online, dll.)</div>
                    <input type="text" id="tautan" name="tautan"
                        value="{{ old('tautan', auth()->user()->tautan) }}"
                        class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('tautan')
    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700 @enderror">
                    @error('tautan')
                        <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                    @enderror
                </div>

                {{-- Metode donasi --}}
                <div class="bg-white p-5 rounded-2xl">
                    <div class="text-black">Donasi</div>
                    <div class="text-xs mb-3">Izinkan pengguna menunjukkan terima kasih melalui donasi.</div>
                    <select name="metode_donasi" id="metode_donasi"
                        class="px-4 py-3 w-full mt-1.5 border border-neutral-200 bg-white rounded-xl block mb-3 @error('jenis_kelamin')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
                        <option value="">Pilih metode...</option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Allobank' ? 'selected' : '' }}>
                            Allobank</option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'BCA' ? 'selected' : '' }}>
                            BCA
                        </option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'BNI' ? 'selected' : '' }}>
                            BNI
                        </option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'BRI' ? 'selected' : '' }}>
                            BRI
                        </option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'BSI' ? 'selected' : '' }}>
                            BSI
                        </option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Commonwealth Bank' ? 'selected' : '' }}>
                            Commonwealth Bank</option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'DANA' ? 'selected' : '' }}>
                            DANA
                        </option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Gopay' ? 'selected' : '' }}>
                            Gopay
                        </option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Jago' ? 'selected' : '' }}>
                            Jago
                        </option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Jenius' ? 'selected' : '' }}>
                            Jenius</option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Mandiri' ? 'selected' : '' }}>
                            Mandiri</option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Octo Mobile' ? 'selected' : '' }}>
                            Octo Mobile</option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'OVO' ? 'selected' : '' }}>
                            OVO
                        </option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'QRIS' ? 'selected' : '' }}>
                            QRIS
                        </option>
                    </select>
                    <input id="rekening" name="rekening" type="text"
                        value="{{ old('rekening', auth()->user()->donasi['rekening'] ?? '') }}"
                        class="hidden px-4 py-3 w-full border border-neutral-200 rounded-xl mb-3 @error('rekening')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
                    @error('rekening')
                        <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="space-y-2"></div>
        </div>
    </form>

    {{-- Notifikasi sukses --}}
    @include('partials.toast')

    <script>
        // TAMPILKAN TOMBOL SIMPAN
        // button save
        const save = document.getElementById('save');
        // input
        const profile_pic = document.getElementById('profile_pic');
        const username = document.getElementById('username');
        const nama = document.getElementById('nama');
        const tgl_lahir = document.getElementById('tgl_lahir');
        const kota = document.getElementById('kota');
        const jenis_kelamin = document.getElementById('jenis_kelamin');
        const bio = document.getElementById('bio');
        const telp = document.getElementById('telp');
        const facebook = document.getElementById('fb');
        const twitter = document.getElementById('x');
        const instagram = document.getElementById('ig');
        const tiktok = document.getElementById('tiktok');
        const pp_remove = document.getElementById('pp_remove'); //Checkbox pp remove
        const tautan = document.getElementById('tautan');
        const rekening = document.getElementById('rekening');


        // array
        const arrayInput = [profile_pic, username, nama, tgl_lahir, kota, jenis_kelamin, bio, telp, facebook, twitter,
            instagram, tiktok, tautan, rekening
        ];

        // foreach
        function showSave(input) {
            const eventType = input.type === 'file' ? 'change' : 'input';
            input.addEventListener(eventType, () => {
                save.classList.remove('hidden');
            })
        };
        arrayInput.forEach(showSave);

        // TAMPILKAN GAMBAR YANG DIUPLOAD
        function previewImage() {
            const pp_preview = document.getElementById('pp_preview');
            const oFReader = new FileReader();

            oFReader.readAsDataURL(profile_pic.files[0]);

            oFReader.onload = function(oFREvent) {
                pp_preview.src = oFREvent.target.result;
            }
        }

        // TRIGGER INPUT FILE
        document.getElementById('pp_trigger').addEventListener('click', () => {
            document.getElementById('profile_pic').click();
        });

        // REMOVE PROFILE PICTURE
        const pp_remove_trigger = document.getElementById('pp_remove_trigger'); // Trigger checkbox
        // const pp_remove = document.getElementById('pp_remove'); //Checkbox
        const pp_preview = document.getElementById('pp_preview'); // Preview img
        const oFReader = new FileReader();

        // URL Gambar Default
        const originalImage = pp_preview.src; // Simpan URL gambar asli
        function removePP(defaultImage) {
            pp_remove.checked = !pp_remove.checked;
            pp_remove_trigger.classList.toggle('bg-amber-300');
            pp_preview.src = pp_remove.checked ? defaultImage : originalImage;
            save.classList.remove('hidden');
        }

        // Tampilkan input rekening
        const metode = document.getElementById('metode_donasi');

        function showRekening(rekening) {
            if (metode.value == '') {
                rekening.classList.add('hidden');
            } else {
                rekening.classList.remove('hidden');
                if (metode.value == 'Allobank' || metode.value == 'DANA' || metode.value == 'Gopay' || metode
                    .value ==
                    'OVO') {
                    rekening.placeholder = 'Nomor telepon';
                } else if (metode.value == 'QRIS') {
                    rekening.placeholder = 'Tautan/Link';
                } else {
                    rekening.placeholder = 'Nomor rekening';
                }
            }
        }

        if (metode.value != '' && rekening.value != '') {
            rekening.classList.remove('hidden');
        } else {
            document.addEventListener('DOMContentLoaded', () => {
                showRekening(rekening)
            })
            metode.addEventListener('change', () => {
                showRekening(rekening);
            });

        }
    </script>

    {{-- REMOVE PROFILE PICTURE --}}

    @if (auth()->user()->jenis_kelamin == 'Perempuan')
        <script>
            const defaultImage = "{{ asset('storage/profile-pics/profile_pic-f.jpg') }}"; // Path gambar default
            pp_remove_trigger.addEventListener('click', () => removePP(defaultImage));
        </script>
    @else
        <script>
            const defaultImage = "{{ asset('storage/profile-pics/profile_pic-m.jpg') }}"; // Path gambar default
            pp_remove_trigger.addEventListener('click', () => removePP(defaultImage));
        </script>
    @endif

@endsection
