@extends('layouts.dashboard')

@section('body')
    <form action="" method="POST" class="space-y-3">
        @csrf
        <div class="flex items-center justify-between rounded-xl bg-white py-4 px-5">
            <div>Simpan data?</div>
            <button type="submit" class="text-amber-600 flex">
                <i data-feather='check' class="w-5"></i>
                <span class="ml-1">Simpan</span>
            </button>
        </div>

        {{-- nama --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="nama" class="text-sm">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama" value="{{ old('nama') }}"
                class="w-full font-semibold focus:outline-none focus:border-b-2 py-1 @error('nama') 
                border-red-600 text-red-600 @else focus:border-amber-400
                @enderror">
            @error('nama')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
            <div class="text-xs">*Berikan nama yang deskripsif</div>
        </div>

        {{-- Untuk role --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="role" class="text-sm">Untuk role</label>
            <select name="role" id="role"
                class="w-full bg-white cursor-pointer focus:outline-none focus:border-b-2 @error('role')
    border-red-600 text-red-600 @else focus:border-amber-400
    @enderror">
                <option value="">Pilih</option>
                <option {{ old('role') == 'kontributor' ? 'selected' : '' }} value="kontributor">
                    Kontributor</option>
                <option {{ old('role') == 'pengurus' ? 'selected' : '' }} value="pengurus">
                    Pengurus
                </option>
                <option {{ old('role') == 'semua' ? 'selected' : '' }} value="semua">
                    Kontributor dan
                    pengurus</option>
            </select>

            @error('role')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- kategori/rule --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="rule" class="text-sm">Kategori</label>
            <select name="rule" id="rule" onchange="ketRequirement('rule', 'ketRequirement')"
                class="w-full bg-white cursor-pointer focus:outline-none focus:border-b-2 @error('role')
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
                <option value="">Pilih</option>
                <option {{ old('rule') == 'keanggotaan' ? 'selected' : '' }} value="keanggotaan">
                    Lama terdaftar sebagai anggota
                </option>
                <option {{ old('rule') == 'kontribusi' ? 'selected' : '' }} value="kontribusi">
                    Total kontribusi anggota
                </option>
                <option class="pengurus" {{ old('rule') == 'kontribusiPengurus' ? 'selected' : '' }}
                    value="kontribusiPengurus">
                    Total kontribusi anggota sebagai pengurus
                </option>

            </select>
            @error('rule')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>

        {{-- requirement --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="requirement" class="text-sm">Nilai kontribusi minimal</label>
            <input type="number" min="1" id="requirement" name="requirement" placeholder="Masukkan angka"
                value="{{ old('requirement') }}" oninput="buatSlug(this, 'slug')"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('requirement')
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('requirement')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
            <div id="ketRequirement" class="text-xs"></div>
        </div>

        {{-- reward --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label for="reward" class="text-sm">Poin bonus</label>
            <input type="number" min="0" id="reward" name="reward" placeholder="Masukkan angka"
                value="{{ old('reward') }}" oninput="buatSlug(this, 'slug')"
                class="w-full focus:outline-none focus:border-b-2 py-1 @error('reward')
        border-red-600 text-red-600 @else focus:border-amber-400
        @enderror">
            @error('reward')
                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
            @enderror
        </div>
    </form>

    <script>
        function ketRequirement(option, target) {
            var option = document.getElementById(option);
            var target = document.getElementById(target);

            if (option.value == '') {
                target.innerText = '';
            } else if (option.value == 'keanggotaan') {
                target.innerText = '*Masukkan dalam bentuk hari';
            } else {
                target.innerText = '*Masukkan total kontribusi minimal';
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            ketRequirement('rule', 'ketRequirement');
        })
    </script>
@endsection
