@extends('layouts.dashboard')

@section('body')
    <div class="space-y-4">
        <div class="bg-white p-5 rounded-2xl">
            <div class="mb-3">Profil</div>
            <div class="space-y-2">
                <a href="/pengaturan/edit-user"
                    class="block py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer hover:bg-neutral-100">
                    <i data-feather='user' class="inline-block w-5 mr-2"></i>Ubah data diri
                </a>
                <a href="#"
                    class="block py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer hover:bg-neutral-100">
                    <i data-feather='at-sign' class="inline-block w-5 mr-2"></i>Ubah alamat email
                </a>
                <a href="#"
                    class="block py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer hover:bg-neutral-100">
                    <i data-feather='eye-off' class="inline-block w-5 mr-2"></i>Sembunyikan data sensitif
                </a>
                <button onclick="openWindow('gantiPassword')"
                    class="block py-4 px-5 text-left w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer hover:bg-neutral-100">
                    <i data-feather='key' class="inline-block w-5 mr-2"></i>Ubah kata sandi
                </button>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-5">
            <div class="mb-3">Akun</div>
            <div class="space-y-2">
                <a href="#"
                    class="block py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer hover:bg-neutral-100">
                    <i data-feather='user-x' class="inline-block w-5 mr-2"></i>Hapus akun
                </a>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit"
                        class="block py-4 px-5 w-full text-left border text-red-600 bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer hover:bg-neutral-100">
                        <i data-feather='log-out' class="inline-block w-5 mr-2"></i>Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- POPUP --}}
    {{-- Ganti kata sandi --}}
    <div id="gantiPassword"
        class="fixed inset-0 invisible m-auto z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6 space-y-4">

            <h5 class="font-semibold">Ganti kata sandi</h5>

            <form action="/pengaturan/ganti-password" method="POST">
                @method('put')
                @csrf
                <div class="space-y-2">
                    <p>Perbarui kata sandi secara berkala untuk menjaga keamanan akun dan melindungi data pribadi kamu.
                        Pastikan
                        kata sandi baru kuat dan unik.</p>
                    <p>
                        <input name="oldPassword" id="oldPassword" type="password" placeholder="Kata sandi lama"
                            value="{{ old('oldPassword') }}"
                            class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('oldPassword')
                            border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                        @enderror">
                        @error('oldPassword')
                        <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                    @enderror

                    <input name="newPassword1" id="newPassword1" type="password" placeholder="Kata sandi baru"
                        value="{{ old('newPassword1') }}"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('newPassword1')
                            border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                        @enderror">
                    @error('newPassword1')
                        <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                    @enderror

                    <input name="newPassword2" id="newPassword2" type="password" placeholder="Ulangi kata sandi baru"
                        value="{{ old('newPassword2') }}"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('newPassword2')
                            border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                        @enderror">
                    @error('newPassword2')
                        <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                    @enderror
                    </p>
                </div>
                {{-- Button --}}
                <div class="text-xs text-red-500 mb-2">*Kata sandi minimal 6 karakter.</div>
                <div class="flex space-x-2">
                    <div onclick="closeWindow('gantiPassword')"
                        class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                        Batal</div>
                    <button type="submit"
                        class="w-full bg-red-500 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-red-600">Ganti</button>
                </div>
            </form>
        </div>
    </div>

    @if ($errors->has('oldPassword') || $errors->has('newPassword1') || $errors->has('newPassword2'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                openWindow('gantiPassword');
            });
        </script>
    @endif
@endsection
