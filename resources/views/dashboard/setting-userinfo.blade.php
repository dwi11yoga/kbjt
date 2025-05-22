@extends('layouts.dashboard')

@section('body')
    <form action="/pengaturan/edit-user" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf
        {{-- Tombol simpan --}}
        <div class="w-full bg-white rounded-xl p-4 mb-5 flex justify-between items-center">
            <div>Simpan perubahan?</div>
            <button type="submit" class="text-amber-600 flex items-center">
                <i data-feather='check' class="w-5"></i>
                <span class="ml-1">Simpan</span>
            </button>
        </div>

        <div class="">
            <div class="grid grid-cols-5 md:space-x-2 md:space-y-0 space-y-3">
                <div class="md:col-span-1 col-span-3 order-1">
                    {{-- foto profil --}}
                    <div
                        class="w-full bg-neutral-100 rounded-t-xl aspect-square text-neutral-400 border-8 border-white overflow-hidden">
                        <img id="thumbmailPreview"
                            src="{{ asset('storage/' . (auth()->user()->profile_pic ?? (auth()->user()->jenis_kelamin == 'Perempuan' ? 'profile-pics/profile_pic-f.jpg' : 'profile-pics/profile_pic-m.jpg'))) }}"
                            alt="Foto profil" class="object-cover">
                    </div>
                    <div class="bg-white rounded-b-xl pt-1 pb-2 px-3 max-h-14 flex items-center justify-between">
                        <div>Ganti*</div>
                        <div class="flex space-x-1">
                            @isset(auth()->user()->profile_pic)
                                <div id="pp_remove_trigger" title="Hapus foto profil"
                                    class="cursor-pointer flex items-center justify-center w-10 h-10 rounded-lg hover:bg-amber-400">
                                    <i data-feather='trash' class="w-5"></i>
                                </div>
                            @endisset
                            <div class="cursor-pointer flex items-center justify-center w-10 h-10 rounded-lg hover:bg-amber-400"
                                title="Pilih gambar" onclick="document.getElementById('profile_pic').click()">
                                <i data-feather='folder' class="w-5"></i>
                            </div>
                        </div>
                    </div>
                    <input type="file" accept="image/png, image/jpg, image/jpeg, image/webp" id="profile_pic"
                        name="profile_pic" onchange="previewImage(this,'thumbmailPreview')" class="hidden">
                    {{-- remove pp: checkbox untuk menghapus foto profil --}}
                    <input type="checkbox" id="pp_remove" name="pp_remove" class="hidden">
                </div>


                <div class="md:col-span-4 col-span-5 bg-white px-5 py-4 space-y-2 rounded-xl md:order-2 order-3">
                    {{-- nama --}}
                    <div class="">
                        <label for="nama" class="text-sm">Nama</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama"
                            title="Klik untuk edit" value="{{ old('nama', auth()->user()->nama) }}"
                            oninput="buatSlug(this, 'slug')"
                            class="w-full focus:outline-none focus:border-b-2 py-1 @error('nama')
                    border-red-600 text-red-600 @else focus:border-amber-400
                    @enderror">
                        @error('nama')
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- tgl_lahir --}}
                    <div class="">
                        <label for="tgl_lahir" class="text-sm">Tanggal lahir</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" placeholder="Masukkan tanggal lahir"
                            title="Klik untuk edit"
                            value="{{ old('tgl_lahir', auth()->user()->tgl_lahir?->format('Y-m-d')) ?? null }}"
                            oninput="buatSlug(this, 'slug')"
                            class="w-full cursor-pointer focus:outline-none focus:border-b-2 py-1 @error('tgl_lahir')
                    border-red-600 text-red-600 @else focus:border-amber-400
                    @enderror">
                        @error('tgl_lahir')
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- kota --}}
                    <div class="">
                        <label for="kota" class="text-sm">Kota asal</label>
                        <input type="text" id="kota" name="kota" placeholder="Masukkan kabupaten/kota"
                            title="Klik untuk edit" value="{{ old('kota', auth()->user()->kota) }}"
                            oninput="buatSlug(this, 'slug')"
                            class="w-full focus:outline-none focus:border-b-2 py-1 @error('kota')
                    border-red-600 text-red-600 @else focus:border-amber-400
                    @enderror">
                        @error('kota')
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- jenis_kelamin --}}
                    <div class="">
                        <label for="jenis_kelamin" class="text-sm">Jenis Kelamin</label>

                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="w-full bg-white cursor-pointer focus:outline-none focus:border-b-2 py-1 @error('jenis_kelamin')
                        border-red-600 text-red-600 @else focus:border-amber-400
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
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- error dan keterangan untuk foto profil --}}
                <div class="col-span-5 md:order-3 order-2 md:py-3">
                    @error('profile_pic')
                        <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                    @enderror
                    <div class="text-xs">*Pilih gambar berformat .jpg, .jpeg, .png, atau .webp (maks. 1024KB dengan rasio
                        1:1).
                    </div>
                </div>
            </div>
        </div>


        {{-- bio --}}
        <div class="bg-white rounded-2xl p-5">
            <label for="bio" class="">Bio</label>
            <textarea name="bio" id="bio" cols="30" rows="10"
                class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('bio')
            border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700 @enderror">{{ old('bio', auth()->user()->bio) }}</textarea>
            @error('bio')
                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
            @enderror
        </div>

    </form>

    <script>
        // Tampilkan input rekening
        function showRekening(metode) {
            const rekening = document.getElementById('rekening');
            if (metode.value == '') {
                rekening.classList.add('hidden');
                rekening.value = '';
            } else {
                rekening.classList.remove('hidden');
                if (metode.value == 'Allobank' || metode.value == 'DANA' || metode.value == 'Gopay' || metode
                    .value ==
                    'OVO') {
                    rekening.placeholder = 'Nomor telepon';
                } else if (metode.value == 'QRIS' || metode.value == 'Saweria' || metode.value == 'Trakteer') {
                    rekening.placeholder = 'Tautan/Link';
                } else {
                    rekening.placeholder = 'Nomor rekening';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            showRekening(document.getElementById('metode_donasi'));
        })

        // if (metode.value != '' && rekening.value != '') {
        //     rekening.classList.remove('hidden');
        // } else {
        //     document.addEventListener('DOMContentLoaded', () => {
        //         showRekening(rekening)
        //     })
        //     metode.addEventListener('change', () => {
        //         showRekening(rekening);
        //     });

        // }
    </script>

    {{-- REMOVE PROFILE PICTURE --}}
    <script>
        // REMOVE PROFILE PICTURE
        const pp_remove_trigger = document.getElementById('pp_remove_trigger'); // Trigger checkbox
        // const pp_remove = document.getElementById('pp_remove'); //Checkbox
        const thumbmailPreview = document.getElementById('thumbmailPreview'); // Preview img
        const oFReader = new FileReader();

        // URL Gambar Default
        const originalImage = thumbmailPreview.src; // Simpan URL gambar asli
        function removePP(defaultImage) {
            pp_remove.checked = !pp_remove.checked;
            pp_remove_trigger.classList.toggle('bg-amber-300');
            thumbmailPreview.src = pp_remove.checked ? defaultImage : originalImage;
            save.classList.remove('hidden');
        }
    </script>
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
