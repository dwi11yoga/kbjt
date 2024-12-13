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
                        <input type="date" value="{{ old('tgl_lahir', auth()->user()->tgl_lahir?->format('Y-m-d')) }}"
                            name="tgl_lahir" id="tgl_lahir"
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

                    {{-- jenis_kelamin --}}
                    <div>
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

            </div>


            <div class="col-span-2 space-y-5">

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

                {{-- Kontak --}}
                <div class="bg-white p-5 rounded-2xl">
                    <div>
                        {{-- telp --}}
                        <label for="telp">Nomor telepon</label>
                        <div class="text-xs">*Diawali kode negara tanpa simbol "+".</div>
                        <input type="number" value="{{ old('telp', auth()->user()->telp) }}" name="telp"
                            id="telp" placeholder="6289XXX..."
                            class="px-4 py-3 w-full mt-1.5 border border-neutral-200 rounded-xl block mb-3 @error('telp')
                    border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                @enderror">
                        @error('telp')
                            <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Media sosial --}}
                <div class="bg-white p-5 rounded-2xl">
                    <div>Sosial media</div>
                    <div>
                        {{-- Facebook --}}
                        <div class="flex mt-1.5 mb-3">
                            <span title="Facebook"
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-blue-500 w-14 @error('fb')
                                    border border-red-600 border-r-0
                                @enderror"><i
                                    data-feather='facebook' class="fill-white stroke-none"></i></span>
                            <input type="text" id="fb" name="fb" placeholder="username"
                                value="{{ old('fb', auth()->user()->media_sosial['fb'] ?? '') }}"
                                class="px-3 py-3 w-full border border-l-0 border-neutral-200 rounded-r-xl block @error('fb')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                            @error('fb')
                                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- X(Twitter) --}}
                        <div class="flex mt-1.5 mb-3">
                            <span title="Twitter (X)"
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-blue-400 w-14 @error('x')
                                    border border-red-600 border-r-0
                                @enderror"><i
                                    data-feather='twitter' class="fill-white stroke-none"></i></span>
                            <input type="text" id="x" name="x" placeholder="username"
                                value="{{ old('x', auth()->user()->media_sosial['x'] ?? '') }}"
                                class="px-3 py-3 w-full border border-l-0 border-neutral-200 rounded-r-xl block @error('x')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                            @error('x')
                                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Instagram --}}
                        <div class="flex mt-1.5 mb-3">
                            <span title="Instagram"
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-neutral-800 w-14 @error('ig')
                                    border border-red-600 border-r-0
                                @enderror">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                                    <rect class="fill-white stroke-none" x="2" y="2" width="20" height="20"
                                        rx="5" ry="5"></rect>
                                    <path class="stroke-neutral-800" d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z">
                                    </path>
                                    <line class="stroke-neutral-800" x1="17.5" y1="6.5" x2="17.51"
                                        y2="6.5">
                                    </line>
                                </svg>
                            </span>
                            <input type="text" id="ig" name="ig" placeholder="username"
                                value="{{ old('ig', auth()->user()->media_sosial['ig'] ?? '') }}"
                                class="px-3 py-3 w-full border border-l-0 border-neutral-200 rounded-r-xl block @error('ig')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                            @error('ig')
                                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- tiktok --}}
                        <div class="flex mt-1.5 mb-3">
                            <span title="Tiktok"
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-neutral-800 w-14 @error('tiktok')
                                    border border-red-600 border-r-0
                                @enderror">
                                <svg fill="currentColor" width="24" height="24" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" xml:space="preserve">
                                    <path class="fill-white"
                                        d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.672a2.896 2.896 0 0 1-5.201 1.743l-.002-.001.002.001a2.895 2.895 0 0 1 3.183-4.51v-3.5a6.329 6.329 0 0 0-5.394 10.692 6.33 6.33 0 0 0 10.857-4.424V8.687a8.182 8.182 0 0 0 4.773 1.526V6.79a4.831 4.831 0 0 1-1.003-.104z" />
                                </svg>
                            </span>
                            <input type="text" id="tiktok" name="tiktok" placeholder="username"
                                value="{{ old('tiktok', auth()->user()->media_sosial['tiktok'] ?? '') }}"
                                class="px-3 py-3 w-full border border-l-0 border-neutral-200 rounded-r-xl block @error('tiktok')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                            @error('tiktok')
                                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Whatsapp --}}
                        <div class="flex mt-1.5 mb-3">
                            <span title="Whatsapp"
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-green-400 w-14 @error('wa')
                                    border border-red-600 border-r-0
                                @enderror">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    viewBox="0 0 30 30" width="24px" height="24px">
                                    <polygon class="fill-white" points="4.796,20.836 3.107,27 9.415,25.344 " />
                                    <path class="fill-white"
                                        d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M20.924,19.143c-0.247,0.693-1.461,1.363-2.005,1.41c-0.549,0.051-1.061,0.247-3.568-0.74c-3.024-1.191-4.931-4.289-5.08-4.489c-0.149-0.195-1.21-1.61-1.21-3.07c0-1.465,0.768-2.182,1.037-2.48c0.274-0.298,0.595-0.372,0.795-0.372c0.195,0,0.395,0,0.568,0.009c0.214,0.005,0.447,0.019,0.67,0.512c0.265,0.586,0.842,2.056,0.916,2.205c0.074,0.149,0.126,0.326,0.023,0.521c-0.098,0.2-0.149,0.321-0.293,0.498c-0.149,0.172-0.312,0.386-0.447,0.516c-0.149,0.149-0.302,0.312-0.13,0.609s0.768,1.27,1.651,2.056c1.135,1.014,2.093,1.326,2.391,1.475s0.47,0.126,0.642-0.074c0.177-0.195,0.744-0.865,0.944-1.163c0.195-0.298,0.395-0.247,0.665-0.149c0.274,0.098,1.735,0.819,2.033,0.968s0.493,0.223,0.568,0.344C21.171,17.854,21.171,18.449,20.924,19.143z" />
                                </svg>
                            </span>
                            <input type="number" id="wa" name="wa" placeholder="telepon"
                                value="{{ old('wa', auth()->user()->media_sosial['wa'] ?? '') }}"
                                class="px-3 py-3 w-full border border-l-0 border-neutral-200 rounded-r-xl block @error('wa')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                        </div>
                        @error('wa')
                            <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                        @enderror

                        {{-- Telegram --}}
                        <div class="flex mt-1.5 mb-3">
                            <span title="Telegram"
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-blue-500 w-14 @error('telegram')
                                    border border-red-600 border-r-0
                                @enderror">
                                <svg width="24px" height="24px" viewBox="0 0 48 48" id="Layer_2"
                                    data-name="Layer 2" xmlns="http://www.w3.org/2000/svg">
                                    <path class="fill-white"
                                        d="M40.83,8.48c1.14,0,2,1,1.54,2.86l-5.58,26.3c-.39,1.87-1.52,2.32-3.08,1.45L20.4,29.26a.4.4,0,0,1,0-.65L35.77,14.73c.7-.62-.15-.92-1.07-.36L15.41,26.54a.46.46,0,0,1-.4.05L6.82,24C5,23.47,5,22.22,7.23,21.33L40,8.69a2.16,2.16,0,0,1,.83-.21Z" />
                                </svg>
                            </span>
                            <input type="text" id="telegram" name="telegram" placeholder="username"
                                value="{{ old('telegram', auth()->user()->media_sosial['telegram'] ?? '') }}"
                                class="px-3 py-3 w-full border border-l-0 border-neutral-200 rounded-r-xl block @error('telegram')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                        </div>
                        @error('telegram')
                            <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                        @enderror

                        {{-- LinkedIn --}}
                        <div class="flex mt-1.5 mb-3">
                            <span title="LinkedIn"
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-blue-600 w-14 @error('linkedin')
                                    border border-red-600 border-r-0
                                @enderror">
                                <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path class="fill-white"
                                        d="M18.72 3.99997H5.37C5.19793 3.99191 5.02595 4.01786 4.86392 4.07635C4.70189 4.13484 4.55299 4.22471 4.42573 4.34081C4.29848 4.45692 4.19537 4.59699 4.12232 4.75299C4.04927 4.909 4.0077 5.07788 4 5.24997V18.63C4.01008 18.9901 4.15766 19.3328 4.41243 19.5875C4.6672 19.8423 5.00984 19.9899 5.37 20H18.72C19.0701 19.9844 19.4002 19.8322 19.6395 19.5761C19.8788 19.32 20.0082 18.9804 20 18.63V5.24997C20.0029 5.08247 19.9715 4.91616 19.9078 4.76122C19.8441 4.60629 19.7494 4.466 19.6295 4.34895C19.5097 4.23191 19.3672 4.14059 19.2108 4.08058C19.0544 4.02057 18.8874 3.99314 18.72 3.99997ZM9 17.34H6.67V10.21H9V17.34ZM7.89 9.12997C7.72741 9.13564 7.5654 9.10762 7.41416 9.04768C7.26291 8.98774 7.12569 8.89717 7.01113 8.78166C6.89656 8.66615 6.80711 8.5282 6.74841 8.37647C6.6897 8.22474 6.66301 8.06251 6.67 7.89997C6.66281 7.73567 6.69004 7.57169 6.74995 7.41854C6.80986 7.26538 6.90112 7.12644 7.01787 7.01063C7.13463 6.89481 7.2743 6.80468 7.42793 6.74602C7.58157 6.68735 7.74577 6.66145 7.91 6.66997C8.07259 6.66431 8.2346 6.69232 8.38584 6.75226C8.53709 6.8122 8.67431 6.90277 8.78887 7.01828C8.90344 7.13379 8.99289 7.27174 9.05159 7.42347C9.1103 7.5752 9.13699 7.73743 9.13 7.89997C9.13719 8.06427 9.10996 8.22825 9.05005 8.3814C8.99014 8.53456 8.89888 8.6735 8.78213 8.78931C8.66537 8.90513 8.5257 8.99526 8.37207 9.05392C8.21843 9.11259 8.05423 9.13849 7.89 9.12997ZM17.34 17.34H15V13.44C15 12.51 14.67 11.87 13.84 11.87C13.5822 11.8722 13.3313 11.9541 13.1219 12.1045C12.9124 12.2549 12.7546 12.4664 12.67 12.71C12.605 12.8926 12.5778 13.0865 12.59 13.28V17.34H10.29V10.21H12.59V11.21C12.7945 10.8343 13.0988 10.5225 13.4694 10.3089C13.84 10.0954 14.2624 9.98848 14.69 9.99997C16.2 9.99997 17.34 11 17.34 13.13V17.34Z" />
                                </svg>
                            </span>
                            <input type="text" id="linkedin" name="linkedin" placeholder="username"
                                value="{{ old('linkedin', auth()->user()->media_sosial['linkedin'] ?? '') }}"
                                class="px-3 py-3 w-full border border-l-0 border-neutral-200 rounded-r-xl block @error('linkedin')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                            @error('linkedin')
                                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Github --}}
                        <div class="flex mt-1.5 mb-3">
                            <span title="Github"
                                class="inline-flex py-1 px-1 justify-center items-center rounded-l-xl bg-neutral-800 w-14 @error('github')
                                    border border-red-600 border-r-0
                                @enderror">
                                <i data-feather='github' class="fill-white stroke-none"></i>
                            </span>
                            <input type="text" id="github" name="github" placeholder="username"
                                value="{{ old('github', auth()->user()->media_sosial['github'] ?? '') }}"
                                class="px-3 py-3 w-full border border-l-0 border-neutral-200 rounded-r-xl block @error('github')
                        border-red-600 focus:border-red-600 focus:outline-none focus:ring-1 focus:ring-red-600 text-red-700
                    @enderror">
                            @error('github')
                                <div class="text-xs text-red-600 -mt-2">*{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Metode donasi --}}
                <div class="bg-white p-5 rounded-2xl">
                    <div class="text-black">Donasi</div>
                    <div class="text-xs mb-3">Izinkan pengguna menunjukkan terima kasih melalui donasi.</div>
                    <select name="metode_donasi" id="metode_donasi" onchange="showRekening(this)"
                        class="px-4 py-3 w-full mt-1.5 border border-neutral-200 bg-white rounded-xl block mb-3">
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
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Saweria' ? 'selected' : '' }}>
                            Saweria
                        </option>
                        <option
                            {{ old('metode_donasi', auth()->user()->donasi['metode'] ?? '') == 'Trakteer' ? 'selected' : '' }}>
                            Trakteer
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
        const wa = document.getElementById('wa');
        const telegram = document.getElementById('telegram');
        const linkedin = document.getElementById('linkedin');
        const github = document.getElementById('github');
        const pp_remove = document.getElementById('pp_remove'); //Checkbox pp remove
        const tautan = document.getElementById('tautan');
        const metode_donasi = document.getElementById('metode_donasi');
        const rekening = document.getElementById('rekening');


        // array
        const arrayInput = [profile_pic, username, nama, tgl_lahir, kota, jenis_kelamin, bio, telp, facebook, twitter,
            instagram, tiktok, wa, telegram, linkedin, github, tautan, metode_donasi, rekening
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
