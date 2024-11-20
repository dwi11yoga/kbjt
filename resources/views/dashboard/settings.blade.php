@extends('layouts.dashboard')

@section('body')
    <div class="space-y-4">
        <div class="mb-3">Pengaturan akun</div>
        <div class="space-y-2">
            <a href="/pengaturan/edit-user"
                class="block py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer active:bg-yellow-200 hover:outline hover:outline-2 hover:outline-yellow-400 outline-offset-2">
                <i data-feather='user' class="inline-block w-5 mr-2"></i>Ubah data diri
            </a>
            <a href="#"
                class="block py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer active:bg-yellow-200 hover:outline hover:outline-2 hover:outline-yellow-400 outline-offset-2">
                <i data-feather='at-sign' class="inline-block w-5 mr-2"></i>Ubah alamat email
            </a>
            <a href="#"
                class="block py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer active:bg-yellow-200 hover:outline hover:outline-2 hover:outline-yellow-400 outline-offset-2">
                <i data-feather='eye-off' class="inline-block w-5 mr-2"></i>Sembunyikan alamat email
            </a>
            <a href="#"
                class="block py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer active:bg-yellow-200 hover:outline hover:outline-2 hover:outline-yellow-400 outline-offset-2">
                <i data-feather='key' class="inline-block w-5 mr-2"></i>Ubah kata sandi
            </a>
        </div>
        <div class="mb-3">Pengaturan lain</div>
        <div class="space-y-2">
            <a href="#"
                class="block py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer active:bg-yellow-200 hover:outline hover:outline-2 hover:outline-yellow-400 outline-offset-2">
                <i data-feather='user-x' class="inline-block w-5 mr-2"></i>Hapus akun
            </a>
            <form action="/logout" method="POST">
                @csrf
                <button type="submit"
                    class="block py-4 px-5 w-full text-left border text-red-600 bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer active:text-black active:bg-red-200 hover:outline hover:outline-2 hover:outline-red-500 outline-offset-2">
                    <i data-feather='log-out' class="inline-block w-5 mr-2"></i>Keluar
                </button>
            </form>
        </div>
    </div>
@endsection
