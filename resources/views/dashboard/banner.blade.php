@extends('layouts.dashboard')

@section('body')
    <form action="" method="POST" class="space-y-5">
        @csrf
        <div class="bg-white p-5 rounded-2xl">
            <div class="mb-3">Sidebar</div>
            <div class="grid grid-cols-6 space-x-4">
                {{-- konten --}}
                <div class="col-span-4 animate-pulse space-y-2">
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
                <div class="col-span-2 space-y-3">

                    {{-- banner 1 --}}
                    <div class="relative w-full rounded-xl overflow-hidden" onmouseover="toggleShowElement('side-1')"
                        onmouseout="toggleShowElement('side-1')">
                        @if (isset($banner['1']['img']))
                            <img class="object-cover" src="{{ asset('img/Relief Gandavyuha Borobudur (TWC) recolor.jpg') }}"
                                alt="Side banner 1">
                        @else
                            <div
                                class="w-full h-56 bg-neutral-200 uppercase flex items-center justify-center font-semibold">
                                gambar belum
                                disetel</div>
                        @endif
                        <div id="side-1" class="hidden absolute inset-0 flex items-center justify-center space-x-1">
                            <div class="bg-amber-300 rounded-full py-2 px-3 cursor-pointer flex space-x-3">
                                <i data-feather='edit-3' onclick="toggleShowElement('edit-side-1')" title="Edit"></i>
                                @if ($banner['1']['status'] == 1)
                                    <i id="ubahStatus" data-feather='eye-off' title="Sembunyikan"></i>
                                @else
                                    <i id="ubahStatus" data-feather='eye' title="Tampilkan"></i>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div id="edit-side-1" class="hidden flex space-x-1 bg-amber-300 rounded-b-xl !-mt-2 pt-5 px-2">
                        <input name="input-link-side-1" placeholder="Link" type="text" oninput="showElement('dialog')"
                            value="{{ old('input-link-side-1', $banner['1']['link']) }}"
                            class="px-3 py-2 w-full border border-gray-400 rounded-lg mb-3">
                        <div class="group p-2.5 max-h-11 bg-amber-300 hover:bg-amber-500 rounded-lg cursor-pointer"
                            onclick="document.getElementById('input-side-1').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-image">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"
                                    class="fill-gray-800 stroke-gray-800">
                                </rect>
                                <circle cx="8.5" cy="8.5" r="1.5"
                                    class="stroke-amber-300 group-hover:stroke-amber-500">
                                </circle>
                                <polyline points="21 15 16 10 5 21" class="stroke-amber-300 group-hover:stroke-amber-500">
                                </polyline>
                            </svg>
                        </div>
                    </div>
                    <input id="input-side-1" type="file" class="hidden">

                    {{-- banner 2 --}}
                    <div class="relative w-full rounded-xl overflow-hidden" onmouseover="toggleShowElement('side-2')"
                        onmouseout="toggleShowElement('side-2')">
                        @if (isset($banner['2']['img']))
                            <img class="object-cover"
                                src="{{ asset('img/Relief Gandavyuha Borobudur (TWC) recolor.jpg') }}"
                                alt="Side banner 1">
                        @else
                            <div
                                class="w-full h-56 bg-neutral-200 uppercase flex items-center justify-center font-semibold">
                                gambar belum
                                disetel</div>
                        @endif
                        <div id="side-2" class="hidden absolute inset-0 flex items-center justify-center space-x-1">
                            <div class="bg-amber-300 rounded-full py-2 px-3 cursor-pointer flex space-x-3">
                                <i data-feather='edit-3' onclick="toggleShowElement('edit-side-2')" title="Edit"></i>
                                @if ($banner['2']['status'] == 1)
                                    <i id="ubahStatus" data-feather='eye-off' title="Sembunyikan"></i>
                                @else
                                    <i id="ubahStatus" data-feather='eye' title="Tampilkan"></i>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div id="edit-side-2" class="hidden flex space-x-1 bg-amber-300 rounded-b-xl !-mt-2 pt-5 px-2">
                        <input name="input-link-side-2" placeholder="Link" type="text"
                            oninput="showElement('dialog')" value="{{ old('input-link-side-2', $banner['2']['link']) }}"
                            class="px-3 py-2 w-full border border-gray-400 rounded-lg mb-3">
                        <div class="group p-2.5 max-h-11 bg-amber-300 hover:bg-amber-500 rounded-lg cursor-pointer"
                            onclick="document.getElementById('input-side-2').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-image">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"
                                    class="fill-gray-800 stroke-gray-800">
                                </rect>
                                <circle cx="8.5" cy="8.5" r="1.5"
                                    class="stroke-amber-300 group-hover:stroke-amber-500">
                                </circle>
                                <polyline points="21 15 16 10 5 21" class="stroke-amber-300 group-hover:stroke-amber-500">
                                </polyline>
                            </svg>
                        </div>
                    </div>
                    <input id="input-side-2" type="file" class="hidden">

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

                {{-- banner 1 (atas) --}}
                <div class="relative w-full max-h-44 overflow-hidden rounded-xl"
                    onmouseover="toggleShowElement('artikel-1')" onmouseout="toggleShowElement('artikel-1')">
                    @if (isset($banner['3']['img']))
                        <img class="object-cover" src="{{ asset('img/Relief Gandavyuha Borobudur (TWC) recolor.jpg') }}"
                            alt="Side banner 1">
                    @else
                        <div class="w-full h-44 bg-neutral-200 uppercase flex items-center justify-center font-semibold">
                            gambar belum
                            disetel</div>
                    @endif
                    <div id="artikel-1" class="hidden absolute inset-0 flex items-center justify-center space-x-1">
                        <div class="bg-amber-300 rounded-full py-2 px-3 cursor-pointer flex space-x-3">
                            <i data-feather='edit-3' onclick="toggleShowElement('edit-artikel-1')" title="Edit"></i>
                            @if ($banner['3']['status'] == 1)
                                <i id="ubahStatus" data-feather='eye-off' title="Sembunyikan"></i>
                            @else
                                <i id="ubahStatus" data-feather='eye' title="Tampilkan"></i>
                            @endif
                        </div>
                    </div>
                </div>

                <div id="edit-artikel-1" class="hidden flex space-x-1 bg-amber-300 rounded-b-xl !-mt-2 pt-5 px-2">
                    <input name="input-link-artikel-1" placeholder="Link" type="text" oninput="showElement('dialog')"
                        value="{{ old('input-link-artikel-1', $banner['3']['link']) }}"
                        class="px-3 py-2 w-full border border-gray-400 rounded-lg mb-3">
                    <div class="group p-2.5 max-h-11 bg-amber-300 hover:bg-amber-500 rounded-lg cursor-pointer"
                        onclick="document.getElementById('input-artikel-1').click()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-image">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"
                                class="fill-gray-800 stroke-gray-800">
                            </rect>
                            <circle cx="8.5" cy="8.5" r="1.5"
                                class="stroke-amber-300 group-hover:stroke-amber-500">
                            </circle>
                            <polyline points="21 15 16 10 5 21" class="stroke-amber-300 group-hover:stroke-amber-500">
                            </polyline>
                        </svg>
                    </div>
                </div>
                <input id="input-artikel-1" type="file" class="hidden">

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

                {{-- banner 2 (bawah) --}}
                <div class="relative w-full max-h-44 overflow-hidden rounded-xl"
                    onmouseover="toggleShowElement('artikel-2')" onmouseout="toggleShowElement('artikel-2')">
                    @if (isset($banner['1']['img']))
                        <img class="object-cover" src="{{ asset('img/Relief Gandavyuha Borobudur (TWC) recolor.jpg') }}"
                            alt="Side banner 1">
                    @else
                        <div class="w-full h-44 bg-neutral-200 uppercase flex items-center justify-center font-semibold">
                            gambar belum
                            disetel</div>
                    @endif
                    <div id="artikel-2" class="hidden absolute inset-0 flex items-center justify-center space-x-1">
                        <div class="bg-amber-300 rounded-full py-2 px-3 cursor-pointer flex space-x-3">
                            <i data-feather='edit-3' onclick="toggleShowElement('edit-artikel-2')" title="Edit">
                            </i>
                            @if ($banner['4']['status'] == 1)
                                <i id="ubahStatus" data-feather='eye-off' title="Sembunyikan"></i>
                            @else
                                <i id="ubahStatus" data-feather='eye' title="Tampilkan"></i>
                            @endif
                        </div>
                    </div>
                </div>

                <div id="edit-artikel-2" class="hidden flex space-x-1 bg-amber-300 rounded-b-xl !-mt-2 pt-5 px-2">
                    <input name="input-link-artikel-2" placeholder="Link" type="text" oninput="showElement('dialog')"
                        value="{{ old('input-link-artikel-2', $banner['4']['link']) }}"
                        class="px-3 py-2 w-full border border-gray-400 rounded-lg mb-3">
                    <div class="group p-2.5 max-h-11 bg-amber-300 hover:bg-amber-500 rounded-lg cursor-pointer"
                        onclick="document.getElementById('input-artikel-2').click()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-image">
                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"
                                class="fill-gray-800 stroke-gray-800">
                            </rect>
                            <circle cx="8.5" cy="8.5" r="1.5"
                                class="stroke-amber-300 group-hover:stroke-amber-500">
                            </circle>
                            <polyline points="21 15 16 10 5 21" class="stroke-amber-300 group-hover:stroke-amber-500">
                            </polyline>
                        </svg>
                    </div>
                </div>
                <input id="input-artikel-2" type="file" class="hidden">

            </div>
        </div>

        {{-- tombol simpan --}}
        <div id="dialog"
            class="hidden fixed bottom-8 left-1/2 transform -translate-x-1/2 h-10 w-auto bg-neutral-900 flex justify-between items-center space-x-48 py-7 px-5 rounded-2xl">
            <div class="text-white">Simpan perubahan?</div>
            <button type="submit" class="text-amber-300">Simpan</button>
        </div>
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
