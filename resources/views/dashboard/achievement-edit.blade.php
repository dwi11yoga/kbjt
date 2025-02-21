@extends('layouts.dashboard')

@section('body')
    <form action="/achievement/{{ $achievement->id }}/edit" method="POST" class="space-y-3">
        @csrf
        @method('PUT')
        <div class="flex items-center justify-between rounded-xl bg-white py-4 px-5">
            <div>Simpan perubahan?</div>
            <button type="submit">Simpan</button>
        </div>

        <div class="">
            <div class="grid grid-cols-5 space-x-2">
                <div class="md:col-span-1 col-span-3">
                    {{-- emblem --}}
                    <div
                        class="w-full py-4 px-5 bg-neutral-100 rounded-t-xl aspect-square text-neutral-400 border-8 border-white">
                        <img id="thumbmailPreview" src="" alt="Emblem/Icon achievement"
                            class="object-cover max-h-72 rounded-xl">
                    </div>
                    <div onclick="document.getElementById('emblem').click()" title="Pilih gambar"
                        class="bg-white rounded-b-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14 flex justify-end">
                        <i data-feather='folder' class="w-5"></i>
                    </div>
                    @error('emblem')
                        <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                    @enderror
                    <input type="file" accept="image/png, image/jpg, image/jpeg, image/webp" id="emblem"
                        name="emblem" onchange="previewImage(this,'thumbmailPreview')" class="hidden">
                </div>

                <div class="md:col-span-4 col-span-5 bg-white px-5 py-4 space-y-2 rounded-xl">
                    {{-- nama --}}
                    <div class="">
                        <label for="nama" class="text-sm">Nama</label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama"
                            value="{{ old('nama', $achievement->nama) }}" oninput="buatSlug(this, 'slug')"
                            class="w-full font-semibold focus:outline-none focus:border-b-2 py-1 @error('nama')
                    border-red-600 text-red-600 @else focus:border-amber-400
                    @enderror">
                        @error('nama')
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- deskripsi --}}
                    <div class="">
                        <label for="deskripsi" class="text-sm">Deskripsi</label>
                        <input type="text" id="deskripsi" name="deskripsi" placeholder="Masukkan deskripsi singkat"
                            value="{{ old('deskripsi', $achievement->deskripsi) }}" oninput="buatSlug(this, 'slug')"
                            class="w-full focus:outline-none focus:border-b-2 py-1 @error('deskripsi')
                    border-red-600 text-red-600 @else focus:border-amber-400
                    @enderror">
                        @error('deskripsi')
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Untuk role --}}
                    <div class="">
                        <label for="role" class="text-sm">Untuk role</label>
                        <select name="role" id="role"
                            class="w-full bg-white cursor-pointer focus:outline-none focus:border-b-2 @error('role')
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
                            <option value="">Pilih</option>
                            <option {{ old('role', $achievement->role) == 'kontributor' ? 'selected' : '' }}
                                value="kontributor">
                                Kontributor</option>
                            <option {{ old('role', $achievement->role) == 'pengurus' ? 'selected' : '' }} value="pengurus">
                                Pengurus
                            </option>
                            <option {{ old('role', $achievement->role) == 'semua' ? 'selected' : '' }} value="semua">
                                Kontributor dan
                                pengurus</option>
                        </select>

                        @error('role')
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                </div>

            </div>
        </div>

        {{-- kategori/rule --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="rule" class="text-sm">Kategori</label>
            <select name="rule" id="rule"
                class="w-full bg-white cursor-pointer focus:outline-none focus:border-b-2 @error('role')
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
                <option value="">Pilih</option>
                <option {{ old('rule', $achievement->rule) == 'keanggotaan' ? 'selected' : '' }} value="keanggotaan">Lama
                    terdaftar
                    sebagai anggota
                </option>
                <option {{ old('rule', $achievement->rule) == 'definisi' ? 'selected' : '' }} value="definisi">Jumlah
                    definisi yang user
                    buat
                </option>
                <option {{ old('rule', $achievement->rule) == 'kosakata' ? 'selected' : '' }} value="kosakata">Jumlah
                    kosakata yang user
                    tambahkan</option>
                <option {{ old('rule', $achievement->rule) == 'editKosakata' ? 'selected' : '' }} value="editKosakata">
                    Jumlah kosakata
                    yang user
                    edit</option>
                <option {{ old('rule', $achievement->rule) == 'laporan' ? 'selected' : '' }} value="laporan">Jumlah laporan
                    yang user
                    kirim
                </option>
                <option {{ old('rule', $achievement->rule) == 'artikel' ? 'selected' : '' }} value="artikel">Jumlah artikel
                    yang user
                    publikasikan</option>
                <option {{ old('rule', $achievement->rule) == 'totalViewKosakata' ? 'selected' : '' }}
                    value="totalViewKosakata">Total
                    jumlah view pada
                    semua kosakata user</option>
                <option {{ old('rule', $achievement->rule) == 'viewKosakata' ? 'selected' : '' }} value="viewKosakata">
                    Jumlah view pada
                    satu
                    kosakata</option>
                <option {{ old('rule', $achievement->rule) == 'totalViewBlog' ? 'selected' : '' }} value="totalViewBlog">
                    Total jumlah
                    view pada
                    semua artikel user</option>
                <option {{ old('rule', $achievement->rule) == 'viewBlog' ? 'selected' : '' }} value="viewBlog">Jumlah view
                    pada satu
                    artikel
                </option>
            </select>
            @error('rule')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- requirement --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="requirement" class="text-sm">Nilai minimal</label>
            <input type="number" min="0" id="requirement" name="requirement" placeholder="Masukkan angka"
                value="{{ old('requirement', $achievement->requirement) }}" oninput="buatSlug(this, 'slug')"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('requirement')
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('requirement')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- reward --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="reward" class="text-sm">Poin bonus</label>
            <input type="number" min="0" id="reward" name="reward" placeholder="Masukkan angka"
                value="{{ old('reward', $achievement->reward) }}" oninput="buatSlug(this, 'slug')"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('reward')
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('reward')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // textareaHeight(document.getElementById('konten'));
        })
    </script>
@endsection
