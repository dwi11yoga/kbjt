@extends('layouts.dashboard')

@section('body')
    <form action="" method="POST" class="space-y-5" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex items-center justify-between rounded-xl bg-white py-4 px-5">
            <div>Simpan perubahan?</div>
            <button type="submit" class="text-amber-600 flex">
                <i data-feather='check' class="w-5"></i>
                <span class="ml-1">Simpan</span>
            </button>
        </div>

        {{-- sidebar --}}
        <div class="bg-white p-5 rounded-2xl">
            <div class="mb-3">Sidebar</div>
            <div class="grid grid-cols-6 md:space-x-4 md:space-y-0 space-y-4">
                {{-- konten --}}
                <div class="md:col-span-4 col-span-6 animate-pulse space-y-2">
                    <div class="w-full h-52 bg-gray-200 rounded-xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-image">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"
                                class="fill-gray-400 stroke-gray-400">
                            </rect>
                            <circle cx="8.5" cy="8.5" r="1.5" class="stroke-gray-200">
                            </circle>
                            <polyline points="21 15 16 10 5 21" class="stroke-gray-200">
                            </polyline>
                        </svg>
                    </div>
                    <div class="h-5 mb-5 w-1/2 bg-gray-200 rounded-full"></div>
                    <div class="h-4 bg-gray-200 rounded-full"></div>
                    <div class="h-4 bg-gray-200 rounded-full"></div>
                    <div class="h-4 bg-gray-200 rounded-full"></div>
                    <div class="h-4 w-3/4 bg-gray-200 rounded-full"></div>

                    <div class="flex space-x-3">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="w-1/3 h-52 bg-gray-200 rounded-xl flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-image">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"
                                        class="fill-gray-400 stroke-gray-400">
                                    </rect>
                                    <circle cx="8.5" cy="8.5" r="1.5" class="stroke-gray-200">
                                    </circle>
                                    <polyline points="21 15 16 10 5 21" class="stroke-gray-200">
                                    </polyline>
                                </svg>
                            </div>
                        @endfor
                    </div>
                </div>

                {{-- iklan/banner --}}
                <div class="md:col-span-2 col-span-6 space-y-3">

                    {{-- banner 1 --}}
                    <div class="md:col-span-1 col-span-3 relative">

                        {{-- author tarakhir yang mengedit --}}
                        @if (isset($banner[1]['user_id']))
                            <div
                                class="absolute top-3 right-3 rounded-lg py-1.5 px-2 flex items-center bg-amber-100 space-x-2 w-fit">

                                <?php $d = (object) $banner[1]['user']; ?> {{-- convert array jadi object --}}
                                <div class="rounded-full w-6 h-6 overflow-hidden object-cover">
                                    @include('partials.profile-pic-general')
                                </div>

                                <div class="text-sm">
                                    {{ auth()->user()->id == $d->id ? 'Terakhir diedit oleh kamu' : $d->username }}</div>
                            </div>
                        @endif

                        {{-- jika banner disembunyikan  --}}
                        @if (isset($banner[1]['img']) && $banner[1]['status'] == 0)
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer"
                                title="Banner Disembunyikan">
                                <i data-feather='eye-off' class="stroke-white"></i>
                            </div>
                        @endif

                        {{-- gambar --}}
                        @if (isset($banner[1]['img']))
                            <div class="w-full bg-neutral-200 rounded-t-xl text-neutral-400">
                                <img id="bannerPreview-1" src="{{ asset('storage/' . $banner[1]['img']) }}"
                                    alt="Banner belum disetel" class="object-cover w-full rounded-t-xl">
                            </div>
                        @else
                            <div class="w-full py-4 px-5 bg-neutral-200 rounded-t-xl text-neutral-400">
                                <div class="object-cover min-h-40 rounded-xl flex items-center justify-center"><img
                                        id="bannerPreview-1" src="" alt="Belum ada gambar"></div>
                            </div>
                        @endif

                        <div onclick="openWindow('edit-1')" title="Edit"
                            class="bg-neutral-100 rounded-b-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14 flex justify-between">
                            <div>Edit</div>
                            <i data-feather='edit-3' class="w-5"></i>
                        </div>

                        @error('emblem')
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- banner 2 --}}
                    <div class="md:col-span-1 col-span-3 relative">

                        {{-- author tarakhir yang mengedit --}}
                        @if (isset($banner[2]['user_id']))
                            <div
                                class="absolute top-3 right-3 rounded-lg py-1.5 px-2 flex items-center bg-amber-100 space-x-2 w-fit">

                                <?php $d = (object) $banner[2]['user']; ?> {{-- convert array jadi object --}}
                                <div class="rounded-full w-6 h-6 overflow-hidden object-cover">
                                    @include('partials.profile-pic-general')
                                </div>

                                <div class="text-sm">
                                    {{ auth()->user()->id == $d->id ? 'Terakhir diedit oleh kamu' : $d->username }}</div>
                            </div>
                        @endif

                        {{-- jika banner disembunyikan  --}}
                        @if (isset($banner[2]['img']) && $banner[2]['status'] == 0)
                            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer"
                                title="Banner Disembunyikan">
                                <i data-feather='eye-off' class="stroke-white"></i>
                            </div>
                        @endif

                        @if (isset($banner[2]['img']))
                            <div class="w-full bg-neutral-200 rounded-t-xl text-neutral-400">
                                <img id="bannerPreview-2" src="{{ asset('storage/' . $banner[2]['img']) }}"
                                    alt="Banner belum disetel" class="object-cover w-full rounded-t-xl">
                            </div>
                        @else
                            <div class="w-full py-4 px-5 bg-neutral-200 rounded-t-xl text-neutral-400">
                                <div class="object-cover min-h-40 rounded-xl flex items-center justify-center">
                                    <img id="bannerPreview-2" src="" alt="Belum ada gambar">
                                </div>
                            </div>
                        @endif
                        <div onclick="openWindow('edit-2')" title="Edit"
                            class="bg-neutral-100 rounded-b-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14 flex justify-between">
                            <div>Edit</div>
                            <i data-feather='edit-3' class="w-5"></i>
                        </div>
                        @error('emblem')
                            <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- banner artikel --}}
        <div class="bg-white p-5 rounded-2xl">
            <div class="mb-3">Artikel</div>
            <div class="space-y-3">

                <div class="w-full animate-pulse">
                    {{-- author --}}
                    <div class="flex items-center space-x-2 !mb-3">
                        <div class="h-8 w-8 rounded-full bg-gray-200"></div>
                        <div class="ml-2 w-32 h-4 bg-gray-200 rounded-full"></div>
                    </div>

                    {{-- Judul --}}
                    <div class="mb-2 rounded-full h-6 w-full bg-gray-200"></div>
                    <div class="!mb-3 rounded-full h-6 w-2/3 bg-gray-200"></div>
                    {{-- subjudul --}}
                    <div class="rounded-full h-4 w-1/2 bg-gray-200 mb-2"></div>

                    {{-- Waktu --}}
                    <div class="flex items-center space-x-2">
                        <div class="rounded-full h-4 w-24 bg-gray-200"></div>
                        <div class="rounded-full h-4 w-24 bg-gray-200"></div>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="w-full h-52 bg-gray-200 rounded-xl flex items-center justify-center mb-5 mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-image">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"
                                class="fill-gray-400 stroke-gray-400">
                            </rect>
                            <circle cx="8.5" cy="8.5" r="1.5" class="stroke-gray-200">
                            </circle>
                            <polyline points="21 15 16 10 5 21" class="stroke-gray-200">
                            </polyline>
                        </svg>
                    </div>
                </div>

                {{-- banner 3 (artikel atas) --}}
                <div class="md:col-span-1 col-span-3 relative">

                    {{-- author tarakhir yang mengedit --}}
                    @if (isset($banner[3]['user_id']))
                        <div
                            class="absolute top-3 right-3 rounded-lg py-1.5 px-2 flex items-center bg-amber-100 space-x-2 w-fit">

                            <?php $d = (object) $banner[3]['user']; ?> {{-- convert array jadi object --}}
                            <div class="rounded-full w-6 h-6 overflow-hidden object-cover">
                                @include('partials.profile-pic-general')
                            </div>

                            <div class="text-sm">
                                {{ auth()->user()->id == $d->id ? 'Terakhir diedit oleh kamu' : $d->username }}</div>
                        </div>
                    @endif

                    {{-- jika banner disembunyikan  --}}
                    @if (isset($banner[3]['img']) && $banner[3]['status'] == 0)
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer"
                            title="Banner Disembunyikan">
                            <i data-feather='eye-off' class="stroke-white"></i>
                        </div>
                    @endif

                    @if (isset($banner[3]['img']))
                        <div class="w-full bg-neutral-200 rounded-t-xl text-neutral-400">
                            <img id="bannerPreview-3" src="{{ asset('storage/' . $banner[3]['img']) }}"
                                alt="Banner belum disetel" class="object-cover w-full rounded-t-xl">
                        </div>
                    @else
                        <div
                            class="w-full py-4 px-5 bg-neutral-200 rounded-t-xl text-neutral-400 border-8 border-neutral-200">
                            <div class="object-cover min-h-36 rounded-xl flex items-center justify-center">
                                <img id="bannerPreview-3" class="rounded-xl" src="" alt="Belum ada gambar">
                            </div>
                        </div>
                    @endif
                    <div onclick="openWindow('edit-3')" title="Edit"
                        class="bg-neutral-100 rounded-b-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14 flex justify-between">
                        <div>Edit</div>
                        <i data-feather='edit-3' class="w-5"></i>
                    </div>
                    @error('emblem')
                        <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-full animate-pulse">
                    {{-- Isi Blog --}}
                    <div class="space-y-3 my-5">
                        @for ($i = 0; $i < 4; $i++)
                            <div class="h-4 bg-gray-200 rounded-full"></div>
                        @endfor
                        <div class="h-4 bg-gray-200 w-1/2 rounded-full !mb-4"></div>
                        @for ($i = 0; $i < 3; $i++)
                            <div class="h-4 bg-gray-200 rounded-full"></div>
                        @endfor
                        <div class="h-4 bg-gray-200 w-1/3 rounded-full !mb-4"></div>
                    </div>
                </div>

                {{-- banner 4 (artikel bawah) --}}
                <div class="md:col-span-1 col-span-3 relative">

                    {{-- author tarakhir yang mengedit --}}
                    @if (isset($banner[4]['user_id']))
                        <div
                            class="absolute top-3 right-3 rounded-lg py-1.5 px-2 flex items-center bg-amber-100 space-x-2 w-fit">

                            <?php $d = (object) $banner[4]['user']; ?> {{-- convert array jadi object --}}
                            <div class="rounded-full w-6 h-6 overflow-hidden object-cover">
                                @include('partials.profile-pic-general')
                            </div>

                            <div class="text-sm">
                                {{ auth()->user()->id == $d->id ? 'Terakhir diedit oleh kamu' : $d->username }}</div>
                        </div>
                    @endif

                    {{-- jika banner disembunyikan  --}}
                    @if (isset($banner[4]['img']) && $banner[4]['status'] == 0)
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer"
                            title="Banner Disembunyikan">
                            <i data-feather='eye-off' class="stroke-white"></i>
                        </div>
                    @endif

                    @if (isset($banner[4]['img']))
                        <div class="w-full bg-neutral-200 rounded-t-xl text-neutral-400">
                            <img id="bannerPreview-4" src="{{ asset('storage/' . $banner[4]['img']) }}"
                                alt="Banner belum disetel" class="object-cover w-full rounded-t-xl">
                        </div>
                    @else
                        <div
                            class="w-full py-4 px-5 bg-neutral-200 rounded-t-xl text-neutral-400 border-8 border-neutral-200">
                            <div class="object-cover min-h-36 rounded-xl flex items-center justify-center">
                                <img id="bannerPreview-4" class="rounded-xl" src="" alt="Belum ada gambar">
                            </div>
                        </div>
                    @endif
                    <div onclick="openWindow('edit-4')" title="Edit"
                        class="bg-neutral-100 rounded-b-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14 flex justify-between">
                        <div>Edit</div>
                        <i data-feather='edit-3' class="w-5"></i>
                    </div>
                    @error('emblem')
                        <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        {{-- definisi kosakata --}}
        <div class="bg-white p-5 rounded-2xl">
            <div class="mb-3">Definisi kosakata</div>
            <div class="space-y-3">

                <div class="w-full animate-pulse">

                    <div class="border-neutral-200 border rounded-xl p-5 space-y-3">
                        <div class="flex justify-between">
                            <h4 class="bg-neutral-200 rounded-full w-1/2"></h4>
                            <div class="p-2 rounded-full bg-neutral-200 w-8 h-8"></div>
                        </div>

                        <div class="p-2 rounded-full bg-neutral-200 w-1/6"></div>
                        <div class="p-2 rounded-full bg-neutral-200 w-1/3"></div>

                        <div class="md:flex block md:space-x-2 space-x-0 md:space-y-0 space-y-2 items-center mt-1">
                            <div class="flex space-x-2">
                                <div class="p-2 rounded-full bg-neutral-200 h-8 w-16"></div>
                                <div class="p-2 rounded-full bg-neutral-200 h-8 w-16"></div>
                            </div>

                            <div class="flex space-x-2 items-center">
                                <div class="h-8 w-8 rounded-full z-20 bg-neutral-200"></div>
                                <div class="p-2 rounded-full bg-neutral-200 w-20"></div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- banner 5 (kosakata atas) --}}
                <div class="md:col-span-1 col-span-3 relative">

                    {{-- author tarakhir yang mengedit --}}
                    @if (isset($banner[5]['user_id']))
                        <div
                            class="absolute top-3 right-3 rounded-lg py-1.5 px-2 flex items-center bg-amber-100 space-x-2 w-fit">

                            <?php $d = (object) $banner[5]['user']; ?> {{-- convert array jadi object --}}
                            <div class="rounded-full w-6 h-6 overflow-hidden object-cover">
                                @include('partials.profile-pic-general')
                            </div>

                            <div class="text-sm">
                                {{ auth()->user()->id == $d->id ? 'Terakhir diedit oleh kamu' : $d->username }}</div>
                        </div>
                    @endif

                    {{-- jika banner disembunyikan  --}}
                    @if (isset($banner[5]['img']) && $banner[5]['status'] == 0)
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer"
                            title="Banner Disembunyikan">
                            <i data-feather='eye-off' class="stroke-white"></i>
                        </div>
                    @endif

                    @if (isset($banner[5]['img']))
                        <div class="w-full bg-neutral-200 rounded-t-xl text-neutral-400">
                            <img id="bannerPreview-5" src="{{ asset('storage/' . $banner[5]['img']) }}"
                                alt="Banner belum disetel" class="object-cover w-full rounded-t-xl">
                        </div>
                    @else
                        <div
                            class="w-full py-4 px-5 bg-neutral-200 rounded-t-xl text-neutral-400 border-8 border-neutral-200">
                            <div class="object-cover min-h-36 rounded-xl flex items-center justify-center">
                                <img id="bannerPreview-5" class="rounded-xl" src="" alt="Belum ada gambar">
                            </div>
                        </div>
                    @endif
                    <div onclick="openWindow('edit-5')" title="Edit"
                        class="bg-neutral-100 rounded-b-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14 flex justify-between">
                        <div>Edit</div>
                        <i data-feather='edit-3' class="w-5"></i>
                    </div>
                    @error('emblem')
                        <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                    @enderror
                </div>

                {{-- definisi --}}
                @for ($i = 0; $i < 3; $i++)
                    <div class="w-full animate-pulse">

                        <div class="border-neutral-200 border rounded-xl p-5 space-y-3">
                            {{-- Kosakata --}}
                            <div class="bg-neutral-200 h-6 rounded-full w-1/2"></div>

                            {{-- Definisi --}}
                            <div class="mb-3 space-y-1">
                                <div class="bg-neutral-200 h-4 rounded-full w-3/4"></div>
                                <div class="bg-neutral-200 h-4 rounded-full w-1/3"></div>
                            </div>

                            {{-- Referensi --}}
                            <div class="mt-4 space-y-1">
                                <div class="bg-neutral-200 h-4 rounded-full w-16"></div>
                                <ul class="list-inside  space-y-2">
                                    <li class="bg-neutral-200 h-4 rounded-full w-1/4"></li>
                                </ul>
                            </div>

                            {{-- Author --}}
                            <div class="space-y-1">
                                <div class="bg-neutral-200 h-4 rounded-full w-20"></div>
                                <div class="flex items-center space-x-2">
                                    <div class="bg-neutral-200 h-10 w-10 rounded-full"></div>
                                    <div class="bg-neutral-200 h-4 rounded-full w-24"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor

                {{-- banner 6 (kosakata bawah) --}}
                <div class="md:col-span-1 col-span-3 relative">

                    {{-- author tarakhir yang mengedit --}}
                    @if (isset($banner[6]['user_id']))
                        <div
                            class="absolute top-3 right-3 rounded-lg py-1.5 px-2 flex items-center bg-amber-100 space-x-2 w-fit">

                            <?php $d = (object) $banner[6]['user']; ?> {{-- convert array jadi object --}}
                            <div class="rounded-full w-6 h-6 overflow-hidden object-cover">
                                @include('partials.profile-pic-general')
                            </div>

                            <div class="text-sm">
                                {{ auth()->user()->id == $d->id ? 'Terakhir diedit oleh kamu' : $d->username }}</div>
                        </div>
                    @endif

                    {{-- jika banner disembunyikan  --}}
                    @if (isset($banner[6]['img']) && $banner[6]['status'] == 0)
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer"
                            title="Banner Disembunyikan">
                            <i data-feather='eye-off' class="stroke-white"></i>
                        </div>
                    @endif

                    @if (isset($banner[6]['img']))
                        <div class="w-full bg-neutral-200 rounded-t-xl text-neutral-400">
                            <img id="bannerPreview-6" src="{{ asset('storage/' . $banner[6]['img']) }}"
                                alt="Banner belum disetel" class="object-cover w-full rounded-t-xl">
                        </div>
                    @else
                        <div
                            class="w-full py-4 px-5 bg-neutral-200 rounded-t-xl text-neutral-400 border-8 border-neutral-200">
                            <div class="object-cover min-h-36 rounded-xl flex items-center justify-center">
                                <img id="bannerPreview-6" class="rounded-xl" src="" alt="Belum ada gambar">
                            </div>
                        </div>
                    @endif
                    <div onclick="openWindow('edit-6')" title="Edit"
                        class="bg-neutral-100 rounded-b-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14 flex justify-between">
                        <div>Edit</div>
                        <i data-feather='edit-3' class="w-5"></i>
                    </div>
                    @error('emblem')
                        <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        {{-- dashboard --}}
        <div class="bg-white p-5 rounded-2xl">
            <div class="mb-3">Dashboard</div>
            <div class="space-y-3">

                {{-- banner 7 (dashboard atas) --}}
                <div class="md:col-span-1 col-span-3 relative">

                    {{-- author tarakhir yang mengedit --}}
                    @if (isset($banner[7]['user_id']))
                        <div
                            class="absolute top-3 right-3 rounded-lg py-1.5 px-2 flex items-center bg-amber-100 space-x-2 w-fit">

                            <?php $d = (object) $banner[7]['user']; ?> {{-- convert array jadi object --}}
                            <div class="rounded-full w-6 h-6 overflow-hidden object-cover">
                                @include('partials.profile-pic-general')
                            </div>

                            <div class="text-sm">
                                {{ auth()->user()->id == $d->id ? 'Terakhir diedit oleh kamu' : $d->username }}</div>
                        </div>
                    @endif

                    {{-- jika banner disembunyikan  --}}
                    @if (isset($banner[7]['img']) && $banner[7]['status'] == 0)
                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 cursor-pointer"
                            title="Banner Disembunyikan">
                            <i data-feather='eye-off' class="stroke-white"></i>
                        </div>
                    @endif

                    @if (isset($banner[7]['img']))
                        <div class="w-full bg-neutral-200 rounded-t-xl text-neutral-400">
                            <img id="bannerPreview-7" src="{{ asset('storage/' . $banner[7]['img']) }}"
                                alt="Banner belum disetel" class="object-cover w-full rounded-t-xl">
                        </div>
                    @else
                        <div
                            class="w-full py-4 px-5 bg-neutral-200 rounded-t-xl text-neutral-400 border-8 border-neutral-200">
                            <div class="object-cover min-h-36 rounded-xl flex items-center justify-center">
                                <img id="bannerPreview-7" class="rounded-xl" src="" alt="Belum ada gambar">
                            </div>
                        </div>
                    @endif
                    <div onclick="openWindow('edit-7')" title="Edit"
                        class="bg-neutral-100 rounded-b-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14 flex justify-between">
                        <div>Edit</div>
                        <i data-feather='edit-3' class="w-5"></i>
                    </div>
                    @error('emblem')
                        <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-full animate-pulse mt-2">
                    <div class="space-y-3">
                        <div class="rounded-full h-4 bg-neutral-200 w-1/4"></div>
                        <div class="grid grid-cols-3 gap-3 ">
                            @for ($i = 0; $i < 3; $i++)
                                <div class="md:col-span-1 col-span-3 border border-neutral-200 rounded-xl space-y-1 p-5">
                                    <div class="rounded-full h-4 bg-neutral-200 w-1/3"></div>
                                    <div class="rounded-full h-12 bg-neutral-200 w-1/5"></div>
                                    <div class="rounded-full h-3 bg-neutral-200 w-1/2"></div>
                                </div>
                            @endfor
                        </div>

                        <div class="border border-neutral-200 rounded-xl space-y-3 p-5">
                            <div class="rounded-full h-4 bg-neutral-200 w-1/4"></div>
                            <div class="rounded-full h-6 bg-neutral-200 w-full"></div>
                            <div class="rounded-full h-6 bg-neutral-200 w-full"></div>
                            <div class="rounded-full h-6 bg-neutral-200 w-full"></div>
                            <div class="rounded-full h-6 bg-neutral-200 w-full"></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


        {{-- Window/popup --}}
        @for ($i = 1; $i <= 7; $i++)
            <div id="edit-{{ $i }}"
                class="fixed inset-0 m-auto invisible z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6">

                    {{-- judul & subjudul --}}
                    <div class="flex justify-between">
                        <div>
                            <h5 class="font-semibold capitalize">{{ $banner[$i]['name'] }}</h5>
                            <div class="mb-5">{{ $banner[$i]['catatan'] }}</div>
                        </div>
                        <div>
                            <div class="rounded-full p-2 hover:bg-neutral-200 hover:text-red-500 cursor-pointer"
                                onclick="closeWindow('edit-{{ $i }}')">
                                <i data-feather='x'></i>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-auto max-h-[27rem] space-y-3">

                        {{-- keterangan tambahan jika banner ditampilkan namun gambar belum diupload  --}}
                        @if ($banner[$i]['status'] == 1 && (empty($banner[$i]['img']) || $banner[$i]['img'] == null))
                            <?php
                            $alert = [
                                'warna' => 'green',
                                'pesan' => 'Meskipun banner diatur untuk ditampilkan, banner tidak akan muncul jika belum ada gambar yang diunggah',
                                'textsize' => 'sm',
                            ];
                            ?>
                            @include('partials.alert')
                        @endif

                        {{-- gambar --}}
                        <div>
                            <div onclick="document.getElementById('img-{{ $i }}').click()"
                                title="Pilih gambar"
                                class="bg-neutral-100 rounded-xl py-4 px-5 hover:bg-amber-300 cursor-pointer max-h-14 flex justify-between">
                                <div id="upload-{{ $i }}" class="line-clamp-1 md:max-w-80 max-w-64">Pilih
                                    gambar
                                </div>
                                <i data-feather='folder' class="w-5"></i>
                            </div>
                            @error('img-' . $i)
                                <div class="text-xs text-red-600 mt-2">*{{ $message }}</div>
                            @enderror

                            <input type="file" accept="image/png, image/jpg, image/jpeg, image/webp, image/gif"
                                id="img-{{ $i }}" name="img-{{ $i }}"
                                onchange="previewImage(this,'bannerPreview-{{ $i }}'); previewImageDir(this, 'upload-{{ $i }}')"
                                class="hidden">
                        </div>

                        {{-- radiobutton status --}}
                        <div>
                            <div class="mb-1 text-sm">Tampilan banner</div>
                            <div class="flex space-x-3">
                                <div>
                                    <input type="radio" class="peer/show cursor-pointer"
                                        name="status-{{ $i }}" id="show-{{ $i }}" value="1"
                                        {{ old('status-' . $i, $banner[$i]['status']) == 1 ? 'checked' : '' }}>
                                    <label for="show-{{ $i }}"
                                        class="peer-checked/show:text-blue-600 cursor-pointer">Tampilkan</label>
                                </div>

                                <div>
                                    <input type="radio" class="peer/hide cursor-pointer"
                                        name="status-{{ $i }}" id="hide{{ $i }}" value="0"
                                        {{ old('status-' . $i, $banner[$i]['status']) == 0 ? 'checked' : '' }}>
                                    <label for="hide{{ $i }}"
                                        class="peer-checked/hide:text-blue-600 cursor-pointer">Sembunyikan</label>
                                </div>
                            </div>
                            @error('status-' . $i)
                                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- url --}}
                        <div>
                            <label for="url-{{ $i }}" class="text-sm">URL</label>
                            <input type="text" id="url" name="url-{{ $i }}"
                                placeholder="Masukkan tautan..." title="URL"
                                value="{{ old('url-' . $i, $banner[$i]['url']) }}"
                                class="w-full hover:border-b-2 focus:outline-none focus:border-b-2 py-1 @error('url-' . $i) 
                border-red-600 text-red-600 hover:border-red-300 @else hover:border-amber-200 focus:border-amber-400
                @enderror">
                            @error('url-' . $i)
                                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- hover teks --}}
                        <div>
                            <label for="hover_title-{{ $i }}" class="text-sm">Teks tooltip</label>
                            <input type="text" id="hover_title" name="hover_title-{{ $i }}"
                                placeholder="Masukkan teks tooltip..." title="Teks tooltip"
                                value="{{ old('hover_title-' . $i, $banner[$i]['hover_title']) }}"
                                class="w-full hover:border-b-2 focus:outline-none focus:border-b-2 py-1 @error('hover_title-' . $i) 
                            border-red-600 text-red-600 hover:border-red-300 @else hover:border-amber-200 focus:border-amber-400
                            @enderror">
                            <div class="text-xs">*Keterangan saat banner dihover</div>
                            @error('hover_title-' . $i)
                                <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- author tarakhir yang mengedit --}}
                        @if (isset($banner[$i]['user_id']))
                            <div class="rounded-xl py-2 px-3 bg-amber-100 flex items-center space-x-2 w-fit">

                                <?php $d = (object) $banner[$i]['user']; ?> {{-- convert array jadi object --}}
                                <div class="rounded-full w-8 h-8 overflow-hidden object-cover">
                                    @include('partials.profile-pic-general')
                                </div>

                                <div class="text-sm">
                                    Terakhir diedit oleh <a
                                        href="/u/{{ $d->username }}">{{ auth()->user()->id == $d->id ? 'kamu' : $d->username }}</a>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endfor

    </form>

    <script>
        function toggleShowElement(element) {
            var object = document.getElementById(element);
            object.classList.toggle('hidden');
        }

        function showElement(element) {
            var object = document.getElementById(element);
            object.classList.remove('hidden');
        }
    </script>
@endsection
