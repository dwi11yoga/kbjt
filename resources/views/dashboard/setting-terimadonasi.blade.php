@extends('layouts.dashboard')

@section('body')
    <form action="/pengaturan/donasi/simpan" method="POST" class="space-y-3">
        @method('put')
        @csrf

        <div class="flex items-center justify-between rounded-xl bg-white py-4 px-5">
            <div>Simpan perubahan?</div>
            <button type="submit" class="text-amber-600 flex">
                <i data-feather='check' class="w-5"></i>
                <span class="ml-1">Simpan</span>
            </button>
        </div>

        {{-- enable donasi --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label class="flex cursor-pointer justify-between items-center">
                <div>
                    <div>Terima donasi</div>
                    <div class="text-sm">Izinkan pengguna menunjukkan terima kasih melalui donasi.</div>
                </div>
                <input id="donasiToggle" type="checkbox" value="enabled" name="donasi" class="sr-only peer" onchange="showElement(this, 'inputDonasi')"
                    {{ old('donasi') || isset(auth()->user()->donasi) == true ? 'checked' : '' }}>
                <div
                    class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-amber-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500">
                </div>
            </label>
        </div>

        <div id="inputDonasi">
            {{-- metode donasi --}}
            <div class="bg-white px-5 py-4 rounded-xl">
                <label for="metode_donasi" class="text-sm">Metode donasi</label>
                <select name="metode_donasi" id="metode_donasi" title="Klik untuk edit"
                    class="w-full bg-white cursor-pointer focus:outline-none focus:border-b-2 @error('metode_donasi')
    border-red-600 text-red-600 @else focus:border-amber-400
    @enderror">
                    <option value="">Pilih metode</option>
                    <option
                        {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Allobank' ? 'selected' : '' }}>
                        Allobank</option>
                    <option {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'BCA' ? 'selected' : '' }}>
                        BCA
                    </option>
                    <option {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'BNI' ? 'selected' : '' }}>
                        BNI
                    </option>
                    <option {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'BRI' ? 'selected' : '' }}>
                        BRI
                    </option>
                    <option {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'BSI' ? 'selected' : '' }}>
                        BSI
                    </option>
                    <option
                        {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Commonwealth Bank' ? 'selected' : '' }}>
                        Commonwealth Bank</option>
                    <option {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'DANA' ? 'selected' : '' }}>
                        DANA
                    </option>
                    <option {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Gopay' ? 'selected' : '' }}>
                        Gopay
                    </option>
                    <option {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Jago' ? 'selected' : '' }}>
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
                    <option {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'OVO' ? 'selected' : '' }}>
                        OVO
                    </option>
                    <option
                        {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Saweria' ? 'selected' : '' }}>
                        Saweria
                    </option>
                    <option
                        {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Trakteer' ? 'selected' : '' }}>
                        Trakteer
                    </option>
                </select>

                @error('metode_donasi')
                    <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                @enderror
            </div>

            {{-- rekening --}}
            <div class="bg-white px-5 py-4 rounded-xl">
                <label for="rekening" class="text-sm">Nomor rekening/tautan</label>
                <input type="text" id="rekening" name="rekening" placeholder="Masukkan nomor rekening"
                    title="Klik untuk edit" value="{{ old('rekening', auth()->user()->donasi['rekening'] ?? '') }}"
                    class="w-full focus:outline-none focus:border-b-2 py-1 @error('rekening') 
                border-red-600 text-red-600 @else focus:border-amber-400
                @enderror">
                @error('rekening')
                    <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                @enderror
            </div>
        </div>
    </form>

    <script>
        // fungsi untuk menyembunyikan input
        function showElement(idCheckbox, idTarget) {
            idtarget=document.getElementById(idTarget);
            if (idCheckbox.checked) {
                idtarget.classList.remove('hidden');
            } else {
                idtarget.classList.add('hidden');
            }
        }

        // jalankan ketika halaman dimuat
        document.addEventListener('DOMContentLoaded', ()=>{
            showElement(document.getElementById('donasiToggle'), 'inputDonasi');
        })

        // ubah warna teks dan garis input error jadi normal ketika user menginput
        var validatedInput = ['metode_donasi', 'rekening'];
        document.addEventListener('DOMContentLoaded', () => {
            removeErrorIndicators(validatedInput);
        })
    </script>
@endsection
