@extends('layouts.dashboard')

@section('body')
    {{-- Tab ke Level dan Poin --}}
    <div class="w-full rounded-2xl bg-white p-2 flex justify-between space-x-2">
        <button id="levelTab" onclick="changeTab(this)"
            class="bg-amber-300 hover:bg-amber-400 rounded-xl w-1/2 text-center py-3">Level</button>
        <button id="aktivitasTab" onclick="changeTab(this)"
            class="bg-neutral-100 hover:bg-neutral-200 rounded-xl w-1/2 text-center py-3">Poin
            Kontribusi</button>
    </div>

    {{-- Pindah-pindah tab --}}
    <script>
        function levelTabClick() {
            var levelTab = document.getElementById('levelTab');
            var aktivitasTab = document.getElementById('aktivitasTab');
            var levelContent = document.getElementById('levelContent');
            var aktivitasContent = document.getElementById('aktivitasContent');

            levelTab.classList.add('bg-amber-300', 'hover:bg-amber-400');
            levelTab.classList.remove('bg-neutral-100', 'hover:bg-neutral-200')
            levelContent.classList.remove('hidden');
            aktivitasTab.classList.remove('bg-amber-300', 'hover:bg-amber-400');
            aktivitasTab.classList.add('bg-neutral-100', 'hover:bg-neutral-200')
            aktivitasContent.classList.add('hidden');
        }

        function aktivitasTabClick() {
            var levelTab = document.getElementById('levelTab');
            var aktivitasTab = document.getElementById('aktivitasTab');
            var levelContent = document.getElementById('levelContent');
            var aktivitasContent = document.getElementById('aktivitasContent');

            levelTab.classList.remove('bg-amber-300', 'hover:bg-amber-400');
            levelTab.classList.add('bg-neutral-100', 'hover:bg-neutral-200')
            levelContent.classList.add('hidden');
            aktivitasTab.classList.remove('bg-neutral-100', 'hover:bg-neutral-200')
            aktivitasTab.classList.add('bg-amber-300', 'hover:bg-amber-400');
            aktivitasContent.classList.remove('hidden');
        }

        function changeTab(tab) {
            if (tab.innerText == "Level") {
                levelTabClick();
            } else if (tab.innerText == "Poin Kontribusi") {
                aktivitasTabClick();
            }
        }
    </script>

    {{-- <div class="flex cursor-pointer">
        <div class="py-3 rounded-l-xl bg-white" style="padding-left: 0.75rem">
            <svg width="24px" height="24px" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M5.00004 4.5C5.00004 3.11929 6.11933 2 7.50004 2H9.00004V4.5C9.00004 5.32843 9.67161 6 10.5 6H18V12.5C18 13.8807 16.8807 15 15.5 15H7.50004C6.11933 15 5.00004 13.8807 5.00004 12.5V4.5Z"
                    fill="#212121" />
                <path d="M10 4.5V2H15.5C16.8807 2 18 3.11929 18 4.5V5H10.5C10.2239 5 10 4.77614 10 4.5Z" fill="#212121" />
                <path
                    d="M12.5002 18C13.7097 18 14.7186 17.1411 14.9502 16H7.50025C5.56725 16 4.00025 14.433 4.00025 12.5V5.04999C2.85913 5.28162 2.00024 6.2905 2.00024 7.49998V14C2.00024 16.2091 3.79111 18 6.00024 18H12.5002Z"
                    fill="#212121" />
            </svg>
        </div>
        <select name="tab" id="tab" class="py-3 rounded-r-xl bg-white appearance-none cursor-pointer"
            style="padding-right: 1rem; padding-left: 0.75rem">
            <option>Level</option>
            <option>Aktivitas</option>
        </select>
    </div> --}}

    {{-- Level --}}
    <div id="levelContent" class="bg-white rounded-2xl p-5">
        <div class="space-y-2">

            {{-- Tambah level --}}
            <button onclick="openWindow('tambahLevel')"
                class="flex items-center justify-center py-4 px-5 w-full border-2 border-neutral-200 rounded-xl shadow-sm hover:bg-neutral-100 hover:outline hover:outline-2 hover:outline-amber-400">
                <i data-feather='plus' class="w-4 inline-block"></i> Tambah level
            </button>

            @foreach ($level as $d)
                <div onclick="editLevel('editLevel', 'lvl-{{ $d->id }}', 'min_poin-{{ $d->id }}')"
                    class="flex py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm justify-between cursor-pointer items-center hover:bg-neutral-100">
                    <div>Level <span id="lvl-{{ $d->id }}">{{ $d->lvl }}</span></div>
                    <div class="flex items-center space-x-2 text-neutral-700">
                        <div class="border rounded-lg py-1 px-2 flex items-center"><i data-feather='users'
                                class="w-4 inline-block mr-1"></i>{{ $d->user_total }}</div>
                        <div class="border rounded-lg py-1 px-2 flex items-center"><i data-feather='percent'
                                class="w-4 inline-block mr-1"></i>{{ $d->persentase }}</div>
                        <div class="flex items-center border py-1 px-2 rounded-lg">
                            <i data-feather='stop-circle' class="stroke-amber-400 w-5 inline-block mr-1"></i>
                            <div>Min.
                                <span id="min_poin-{{ $d->id }}">{{ $d->min_poin }}</span> Poin
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- Aktivitas --}}
    <div id="aktivitasContent" class="hidden space-y-5">
        <div class="bg-white rounded-2xl p-5 space-y-2">
            <div>Kontributor</div>
            @if (isset($kontribusiKontributor))
                @foreach ($kontribusiKontributor as $d)
                    <div onclick="editPoinKontribusi('editPoinKontribusi', 'editKontribusi-{{ $d->id }}', 'editDeskripsi-{{ $d->id }}', 'editPoin-{{ $d->id }}', '{{ $d->id }}')"
                        class="flex py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm justify-between cursor-pointer items-center hover:bg-neutral-100">
                        <div>
                            <div id="editKontribusi-{{ $d->id }}">{{ $d->kontribusi }}</div>
                            @isset($d->deskripsi)
                                <div class="text-sm text-neutral-700 line-clamp-2" id="editDeskripsi-{{ $d->id }}">
                                    {{ $d->deskripsi }}</div>
                            @endisset
                        </div>
                        <div class="flex items-center py-1 px-2 rounded-lg">
                            <i data-feather='stop-circle' class="stroke-amber-400 w-5 inline-block mr-1"></i>
                            <div class="min-w-14"><span id="editPoin-{{ $d->id }}">{{ $d->poin }}</span> Poin
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div
                    class="py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer text-center hover:bg-neutral-100">
                    Belum ada data.
                </div>
            @endif
        </div>

        <div class="bg-white rounded-2xl p-5 space-y-2">
            <div>Pengurus</div>
            @if (isset($kontribusiPengurus))
                @foreach ($kontribusiPengurus as $d)
                    <div onclick="editPoinKontribusi('editPoinKontribusi', 'editKontribusi-{{ $d->id }}', 'editDeskripsi-{{ $d->id }}', 'editPoin-{{ $d->id }}', '{{ $d->id }}')"
                        class="flex py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm justify-between cursor-pointer items-center hover:bg-neutral-100">
                        <div>
                            <div id="editKontribusi-{{ $d->id }}">{{ $d->kontribusi }}</div>
                            @isset($d->deskripsi)
                                <div class="text-sm text-neutral-700 line-clamp-2" id="editDeskripsi-{{ $d->id }}">
                                    {{ $d->deskripsi }}
                                </div>
                            @endisset
                        </div>
                        <div class="flex items-center py-1 px-2 rounded-lg">
                            <i data-feather='stop-circle' class="stroke-amber-400 w-5 inline-block mr-1"></i>
                            <div class="min-w-14"><span id="editPoin-{{ $d->id }}">{{ $d->poin }}</span> Poin
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div
                    class="py-4 px-5 w-full border bg-white border-gray-200 rounded-xl shadow-sm cursor-pointer text-center hover:bg-neutral-100">
                    Belum ada data.
                </div>
            @endif
        </div>
    </div>

    {{-- Popup tambah level --}}
    <div id="tambahLevel"
        class="fixed inset-0 m-auto z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6">

            <h5 class="font-semibold mb-5 capitalize">Tambah level</h5>

            <form action="/level/tambah" method="POST">
                @csrf
                <div class="overflow-auto max-h-[27rem]">
                    {{-- Level --}}
                    <label for="lvl" class="block">Level</label>
                    <input id="lvl" name="lvl" placeholder="Level baru..." type="number" min="0"
                        value="{{ old('lvl') }}"
                        class="w-full appearance-none resize-none text-neutral-800 focus:outline-none mb-3 h-auto max-h-52 py-1 @error('lvl')
        border-b border-red-600 @enderror">
                    @error('lvl')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror

                    {{-- poin --}}
                    <label for="min_poin" class="block">Poin Minimal</label>
                    <input id="min_poin" name="min_poin" placeholder="Poin minimal untuk mencapai level..." type="number"
                        value="{{ old('min_poin') }}" min="1"
                        class="w-full appearance-none resize-none text-neutral-800 focus:outline-none mb-3 h-auto max-h-52 py-1 @error('min_poin')
        border-b border-red-600 @enderror">
                    @error('min_poin')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror
                </div>

                {{-- Button --}}
                <div class="text-xs text-red-500 mb-2">*Pastikan level yang ditambahkan belum ada, dan poin minimum tidak
                    melebihi level di atasnya atau lebih rendah dari level di bawahnya.</div>
                <div class="flex space-x-2">
                    <div onclick="closeWindow('tambahLevel')"
                        class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                        Batal</div>
                    <button type="submit"
                        class="w-full bg-amber-400 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-amber-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    @if ($errors->has('lvl') || $errors->has('min_poin'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                openWindow('tambahLevel');
            });
        </script>
    @endif

    {{-- Popup edit level --}}
    <div id="editLevel" class="fixed inset-0 z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6">

            <h5 class="font-semibold mb-5 capitalize">Edit level</h5>

            <form action="/level/update" method="POST">
                @method('put')
                @csrf
                <div class="overflow-auto max-h-[27rem]">
                    {{-- Level --}}
                    <label for="editLvl" class="block">Level</label>
                    <input id="editLvl" name="editLvl" placeholder="Level baru..." type="number" min="0" readonly
                        value="{{ old('editLvl') }}"
                        class="w-full appearance-none resize-none text-neutral-800 focus:outline-none mb-3 h-auto max-h-52 py-1 @error('editLvl')
        border-b border-red-600 @enderror">
                    @error('editLvl')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror

                    {{-- poin --}}
                    <label for="editMinPoin" class="block">Poin Minimal</label>
                    <input id="editMinPoin" name="editMinPoin" placeholder="Poin minimal untuk mencapai level..."
                        type="number" value="{{ old('editMinPoin') }}" min="1"
                        class="w-full appearance-none resize-none text-neutral-800 focus:outline-none mb-3 h-auto max-h-52 py-1 @error('editMinPoin')
        border-b border-red-600 @enderror">
                    @error('editMinPoin')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror
                </div>

                {{-- Button --}}
                <div class="text-xs text-red-500 mb-2">*Pastikan level yang ditambahkan belum ada, dan poin minimum tidak
                    melebihi level di atasnya atau lebih rendah dari level di bawahnya.</div>
                <div class="flex space-x-2">
                    <div onclick="closeWindow('editLevel')"
                        class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                        Batal</div>
                    <button type="submit"
                        class="w-full bg-amber-400 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-amber-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Popup edit poin kontribusi --}}
    <div id="editPoinKontribusi"
        class="fixed inset-0 z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6">

            <h5 class="font-semibold mb-5 capitalize">Edit poin kontribusi</h5>

            <form action="/poin-kontribusi/update" method="POST">
                @method('put')
                @csrf
                <div class="overflow-auto max-h-[27rem]">
                    {{-- id --}}
                    <input class="hidden" id="idPoinKontribusi" name="idPoinKontribusi" type="text" value=""
                        hidden readonly>
                    {{-- kontribusi --}}
                    <label for="editKontribusi" class="block">Kontribusi</label>
                    <input id="editKontribusi" name="editKontribusi" placeholder="Nama kontribusi..." type="text"
                        readonly value="{{ old('editKontribusi') }}"
                        class="w-full appearance-none resize-none text-neutral-800 focus:outline-none mb-3 h-auto max-h-52 py-1 @error('editKontribusi')
        border-b border-red-600 @enderror">
                    @error('editKontribusi')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror

                    {{-- deskripsi --}}
                    <label for="editDeskripsi" class="block">Deskripsi</label>
                    <textarea id="editDeskripsi" name="editDeskripsi" placeholder="Tambahkan deskripsi..."
                        oninput="textareaHeight(this)"
                        class="w-full appearance-none resize-none text-neutral-800 focus:outline-none mb-3 h-auto max-h-52 @error('editDeskripsi')
                border-b border-red-600
            @enderror">{{ old('editDeskripsi') }}</textarea>
                    @error('editDeskripsi')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror

                    {{-- poin --}}
                    <label for="editPoinDiperoleh" class="block">Poin Diperoleh</label>
                    <input id="editPoinDiperoleh" name="editPoinDiperoleh" placeholder="Poin yang diperoleh user..."
                        type="number" value="{{ old('editPoinDiperoleh') }}" min="1"
                        class="w-full appearance-none resize-none text-neutral-800 focus:outline-none mb-3 h-auto max-h-52 py-1 @error('editPoinDiperoleh')
        border-b border-red-600 @enderror">
                    @error('editPoinDiperoleh')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror
                </div>

                {{-- Button --}}
                <div class="flex space-x-2">
                    <div onclick="closeWindow('editPoinKontribusi')"
                        class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                        Batal</div>
                    <button type="submit"
                        class="w-full bg-amber-400 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-amber-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // otomatis isi input edit level
        function editLevel(component, inputLevel, inputPoin) {
            var component = document.getElementById(component);
            component.classList.remove("invisible");

            var inputLevel = document.getElementById(inputLevel).innerText;
            var inputPoin = document.getElementById(inputPoin).innerText;
            document.getElementById('editLvl').value = inputLevel;
            document.getElementById('editMinPoin').value = inputPoin;
        }

        // otomatis isi input edit poin kontribusi
        function editPoinKontribusi(component, inputKontribusi, inputDeskripsi, inputPoin, inputId) {
            var component = document.getElementById(component);
            component.classList.remove('invisible');

            var inputKontribusi = document.getElementById(inputKontribusi).innerText;
            var inputPoin = document.getElementById(inputPoin).innerText;
            var inputDeskripsi = document.getElementById(inputDeskripsi);
            if (inputDeskripsi) {
                var inputDeskripsi = inputDeskripsi.innerText;
            } else {
                var inputDeskripsi = "";
            }
            document.getElementById('idPoinKontribusi').value = inputId;
            document.getElementById('editKontribusi').value = inputKontribusi;
            document.getElementById('editDeskripsi').value = inputDeskripsi;
            document.getElementById('editPoinDiperoleh').value = inputPoin;
        }
    </script>

    {{-- Otomatis buka popup edit level ketika ada error --}}
    @if ($errors->has('editLvl') || $errors->has('editMinPoin'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                openWindow('editLevel');
            });
        </script>
    @endif

    {{-- Otomatis buka popup edit poin kontribusi ketika ada error --}}
    @if (
        $errors->has('idPoinKontribusi') ||
            $errors->has('editKontribusi') ||
            $errors->has('editDeskripsi') ||
            $errors->has('editPoinDiperoleh'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                aktivitasTabClick();
                openWindow('editPoinKontribusi');
            });
        </script>
    @endif

    {{-- otomatis pindah ke tab poin kontribusi ketika berhasil edit --}}
    @if (session('success') == 'Poin kontribusi berhasil diedit')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                aktivitasTabClick();
            })
        </script>
    @endif
@endsection
