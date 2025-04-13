@extends('layouts.dashboard')

@section('body')
    <form action="/pengaturan/data-sensitif/simpan" method="POST" class="space-y-3">
        @method('put')
        @csrf

        <div class="flex items-center justify-between rounded-xl bg-white py-4 px-5">
            <div>Simpan perubahan?</div>
            <button type="submit" class="text-amber-600 flex">
                <i data-feather='check' class="w-5"></i>
                <span class="ml-1">Simpan</span>
            </button>
        </div>

        <?php
            $sembunyikan_data = auth()->user()->sembunyikan_data;
        ?>

        {{-- sembunyikan email --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label class="flex cursor-pointer justify-between items-center">
                <div>
                    <div>Sembunyikan email</div>
                    <div class="text-sm">Alamat email akan disembunyikan dari halaman profil kamu.</div>
                </div>
                <input type="checkbox" value="enabled" name="email" class="sr-only peer"
                    {{ isset($sembunyikan_data['email']) && $sembunyikan_data['email'] == true ? 'checked' : '' }}>
                <div
                    class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-amber-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500">
                </div>
            </label>
        </div>

        {{-- sembunyikan telepon --}}
        <div class="bg-white px-5 py-4 rounded-xl">
            <label class="flex cursor-pointer justify-between items-center">
                <div>
                    <div>Sembunyikan nomor telepon</div>
                    <div class="text-sm">Nomor telepon akan disembunyikan dari halaman profil kamu.</div>
                </div>
                <input type="checkbox" value="enabled" name="telp" class="sr-only peer"
                    {{ isset($sembunyikan_data['telp']) && $sembunyikan_data['telp'] == true ? 'checked' : '' }}>
                <div
                    class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-amber-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500">
                </div>
            </label>
        </div>
    </form>
@endsection
