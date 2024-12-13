<div class="md:col-start-2 md:col-span-3 col-span-6">
    <div
        class="bg-white rounded-2xl p-6 mb-4 border border-neutral-200 hover:outline hover:outline-2 hover:outline-amber-400">
        {{-- Kosakata --}}
        <h5 class="font-semibold mb-4 capitalize"><a href="/kosakata/{{ $d->slug }}">{{ $d->kosakata }}</a></h5>

        {{-- Definisi --}}
        <p class="mb-3">{{ $d->definisi }}</p>

        {{-- Contoh kalimat --}}
        @if (isset($d->contoh) && $d->contoh != [''])
            <p>Contoh kalimat:</p>
            <ul class=" list-inside italic">
                @foreach ($d->contoh as $c)
                    <li>{{ $c }}</li>
                @endforeach
            </ul>
        @endif

        {{-- Referensi --}}
        @if (isset($d->referensi) && $d->referensi != [''])
            <div class="italic font-light small-text mt-4">
                <p>Referensi</p>
                <ul class="list-decimal list-inside">
                    @foreach ($d->referensi as $r)
                        <li>
                            @if (filter_var($r, FILTER_VALIDATE_URL))
                                <a href="{{ $r }}" target="_blank"
                                    class="hover:underline hover:decoration-amber-400 hover:underline-offset-2 hover:decoration-2">{{ $r }}</a>
                            @else
                                {{ $r }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Author --}}
        <p class="mt-4 mb-2">Disubmit oleh</p>
        {{-- <div class="rounded-full w-12 h-12 bg-yellow-400 float-left mr-3"></div> --}}
        <div class="flex justify-between items-end">
            <div class="flex items-center">
                <a href="/u/{{ $d->user->username }}">
                    <div class="h-12 w-12 rounded-full overflow-hidden mr-3">
                        @include('partials.profil-pic-general-array2')
                    </div>
                </a>
                <a href="/u/{{ $d->user->username }}">
                    <div>{{ $d->user->nama }}</div>
                    <div class="small-text">{{ $d->created_at->format('d F Y') }}</div>
                </a>
            </div>

            {{-- Menu --}}
            <div class="relative">
                @isset(auth()->user()->id)
                    <button id="dropdownBtn"
                        onclick="dropdown(this, document.getElementById('dropdown{{ $d->id }}'))"
                        class="p-2 rounded-full hover:bg-neutral-100"><i data-feather='more-horizontal'></i></button>
                    <div id="dropdown{{ $d->id }}"
                        class="absolute hidden bg-white right-0 bottom-10 z-40 p-2 rounded-xl border border-neutral-200 min-w-48 text-neutral-800">
                        <ul>
                            @if ($d->user_id == auth()->user()->id)
                                <li onclick="openWindow('editDefinisi-{{ $d->id }}')"
                                    class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 cursor-pointer">
                                    <div>Edit</div>
                                    <i data-feather='edit-3' class="w-5"></i>
                                </li>
                                <li onclick="openWindow('hapusDefinisi-{{ $d->id }}')"
                                    class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 text-red-500">
                                    <div>Hapus</div>
                                    <i data-feather='trash' class="w-5"></i>
                                </li>
                            @endif
                            @if ($d->user_id != auth()->user()->id)
                                <a href="#">
                                    <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 text-red-500">
                                        <div>Laporkan</div>
                                        <i data-feather='flag' class="w-5"></i>
                                    </li>
                                </a>
                            @endif
                        </ul>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>

@if (isset(auth()->user()->id) && $d->user_id == auth()->user()->id)
    {{-- Edit definisi --}}
    <div id="editDefinisi-{{ $d->id }}"
        class="fixed inset-0 m-auto z-50 flex invisible items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6">

            <h5 class="font-semibold mb-5 capitalize">Edit definisi</h5>

            <form action="">
                @csrf
                <div class="overflow-auto max-h-[29rem]">
                    {{-- Definisi --}}
                    <label for="editDefinisi" class="block">Definisi</label>
                    <textarea id="editDefinisi" name="editDefinisi" placeholder="Definisi..." oninput="textareaHeight(this)"
                        class="w-full appearance-none resize-none text-neutral-800 focus:outline-none mb-3 h-auto max-h-52 @error('editDefinisi')
                border-b border-red-600
            @enderror">{{ old('editDefinisi', $d->definisi) }}</textarea>
                    @error('editDefinisi')
                        <div class="text-xs text-red-600 -mt-2 mb-2">*{{ $message }}</div>
                    @enderror

                    {{-- Contoh kalimat --}}
                    <label for="editContoh" class="block">Contoh kalimat</label>
                    <textarea id="editContoh" name="editContoh"
                        class="w-full appearance-none resize-none text-neutral-800 focus:outline-none mb-3 max-h-52 whitespace-pre-line"
                        placeholder="Pisahkan contoh dengan tanda titik koma (;)" oninput="textareaHeight(this)">{{ old('editContoh', isset($d->contoh) ? implode('; ', $d->contoh) : '') }}</textarea>

                    {{-- Referensi --}}
                    <label for="editReferensi" class="block">Referensi</label>
                    <textarea id="editReferensi" name="editReferensi"
                        class="w-full appearance-none resize-none text-neutral-800 focus:outline-none mb-3 max-h-52"
                        placeholder="Pisahkan referensi dengan tanda titik koma (;)" oninput="textareaHeight(this)">{{ old('editReferensi', isset($d->referensi) ? implode('; ', $d->referensi) : '') }}</textarea>
                </div>

                {{-- Button --}}
                <div class="flex space-x-2">
                    <div onclick="closeWindow('editDefinisi-{{ $d->id }}')"
                        class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                        Batal</div>
                    <button type="submit"
                        class="w-full bg-amber-400 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-amber-500">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            textareaHeight(document.getElementById('editDefinisi'));
            textareaHeight(document.getElementById('editContoh'));
            textareaHeight(document.getElementById('editReferensi'));
        });
    </script>

    {{-- hapus definisi --}}
    <div id="hapusDefinisi-{{ $d->id }}"
        class="fixed inset-0 m-auto z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6 space-y-4">

            <h5 class="font-semibold">Kamu yakin ingin menghapus definisi ini?</h5>

            <div class="space-y-2">
                <p>Definisi yang dihapus akan hilang secara permanen dan tidak dapat dipulihkan. Poin yang kamu
                    peroleh dari definisi ini juga akan ikut hilang.</p>
                <p>Yakin ingin melanjutkan?</p>
            </div>

            <form action="">
                @csrf
                {{-- Button --}}
                <div class="flex space-x-2">
                    <div onclick="closeWindow('hapusDefinisi-{{ $d->id }}')"
                        class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                        Batal</div>
                    <button type="submit"
                        class="w-full bg-red-500 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-red-600">Ya,
                        Yakin</button>
                </div>
            </form>
        </div>
    </div>
@endif
