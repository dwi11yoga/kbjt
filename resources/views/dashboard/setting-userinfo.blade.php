@extends('layouts.dashboard')

@section('body')
    <form action="#">
        @csrf
        <div class="grid grid-cols-2 space-x-5">
            <div class="space-y-2">

                {{-- Foto profil --}}
                {{-- <div class="">Foto profil</div> --}}
                <div class="w-64 h-64 rounded-lg overflow-hidden inline-block">
                    <img class="w-full h-full object-cover"
                        src="https://cdn.thefairnews.co.kr/news/photo/202404/25369_59232_5627.jpg" alt="Foto profil">
                </div>
                {{-- <input class="inline-block" type="file" name="profile_pic" id="profile_pic"> --}}

                <div>
                    {{-- Nama --}}
                    <label for="nama">Nama</label>
                    <input type="text" value="{{ old('nama') != null ? old('nama') : auth()->user()->nama }}"
                        name="nama" id="nama"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('user')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
                </div>

                <div>
                    {{-- username --}}
                    <label for="username">Username</label>
                    <input type="text" value="{{ old('username') != null ? old('username') : auth()->user()->username }}"
                        name="username" id="username"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('username')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
                </div>

                <div>
                    {{-- tgl_lahir --}}
                    <label for="tgl_lahir">Tanggal lahir</label>
                    <input type="date"
                        value="{{ old('tgl_lahir') != null ? old('tgl_lahir') : auth()->user()->tgl_lahir }}"
                        name="tgl_lahir" id="tgl_lahir"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('tgl_lahir')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
                </div>

                <div>
                    {{-- kota --}}
                    <label for="kota">Kota</label>
                    <input type="text" value="{{ old('kota') != null ? old('kota') : auth()->user()->kota }}"
                        name="kota" id="kota"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('kota')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
                </div>

                <div>
                    {{-- jenis_kelamin --}}
                    <label for="jenis_kelamin">Jenis kelamin</label>
                    <input type="text"
                        value="{{ old('jenis_kelamin') != null ? old('jenis_kelamin') : auth()->user()->jenis_kelamin }}"
                        name="jenis_kelamin" id="jenis_kelamin"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('jenis_kelamin')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
                </div>

                <div>
                    {{-- bio --}}
                    <label for="bio">Bio</label>
                    <textarea name="bio" id="bio" cols="30" rows="10"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('bio')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700 @enderror">
                        {{ old('bio') != null ? old('bio') : auth()->user()->bio }}
                    </textarea>
                </div>

                <div>
                    {{-- telp --}}
                    <label for="telp">Nomor telepon</label>
                    <input type="text" value="{{ old('telp') != null ? old('telp') : auth()->user()->telp }}"
                        name="telp" id="telp"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('telp')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
                </div>

                <div>
                    {{-- medsos --}}
                    <label for="medsos">medsos</label>
                    <input type="text" value="{{ old('medsos') != null ? old('medsos') : auth()->user()->medsos }}"
                        name="medsos" id="medsos"
                        class="px-4 py-3 w-full mt-1.5 border border-gray-400 rounded-md block mb-3 @error('mesos')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
                </div>

            </div>

            <div class="space-y-2"></div>
        </div>
    </form>
@endsection
