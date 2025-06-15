<div class="md:col-start-2 md:col-span-3 col-span-6">
    <div
        class="bg-white rounded-2xl p-6 mb-4 border border-neutral-200 
        @if (isset($d->selected) && $d->selected == 1) outline outline-2 outline-amber-500 hover:outline-amber-400 
        @else 
        hover:outline hover:outline-2 hover:outline-amber-400 @endif
        ">
        {{-- Kosakata --}}
        <div class="flex justify-between">
            <h5 class="font-semibold mb-4 capitalize"><a href="/kosakata/{{ $d->slug }}">{{ $d->kosakata }}</a></h5>
            @if (isset($d->copies) && $d->copies == 1)
                <div class="text-sm rounded-full py-1 px-3 bg-blue-300 h-fit">
                    📄 Salinan definisi
                </div>
            @elseif (isset($d->user->role) && $d->user->role == 'pengurus')
                <div class="text-sm rounded-full py-1 px-3 bg-purple-300 h-fit">
                    ⭐ Disubmit oleh pengurus
                </div>
            @elseif (isset($d->verifikasi_oleh))
                <div class="text-sm rounded-full py-1 px-3 bg-amber-300 h-fit">
                    📌 Terverifikasi
                </div>
            @elseif (isset($d->hukuman_edit) && $d->hukuman_edit == 1)
                <div class="text-sm rounded-full py-1 px-3 bg-neutral-300 h-fit">
                    <i data-feather='eye-off' class="w-4 inline"></i> Disembunyikan
                </div>
            @endif
        </div>

        {{-- Definisi --}}
        <div class="mb-3 trix jawa">
            <style>
                div.trix h1 {
                    font-size: 1.3rem;
                    font-weight: 600;
                }

                div.trix ul {
                    padding-left: 25px;
                    /* Space before list items */
                    list-style-type: disc;
                    /* Bullet (•) for items */
                }

                div.trix ol {
                    padding-left: 25px;
                    /* Space before list items */
                    list-style-type: decimal;
                    /* Numbers (1, 2, 3, ...) for items */
                }

                div.trix li {
                    display: list-item;
                    /* Default display for list items */
                }

                div.trix pre {
                    display: block;
                    /* Ditampilkan sebagai blok */
                    font-family: monospace;
                    /* Menggunakan font monospace */
                    white-space: pre;
                    /* Pertahankan spasi dan baris baru */
                    margin: 1em 0;
                    /* Margin atas dan bawah */
                    background-color: #e5e5e5;
                    padding: 0.5rem 0.5rem;
                    font-size: 1rem;
                    border-radius: 0.5rem;
                    overflow-inline: scroll;
                }

                div.trix blockquote {
                    display: block;
                    margin-top: 0.5rem;
                    padding-left: 0.5rem;
                    /* Margin atas */
                    margin-bottom: 0.5rem;
                    /* Margin bawah */
                    margin-inline-start: 0.5rem;
                    /* Indentasi kiri */
                    margin-inline-end: 0.5rem;
                    /* Indentasi kanan */
                    font-size: inherit;
                    /* Ukuran font sesuai elemen induk */
                    font-style: italic;
                    /* Teks miring */
                    border-left: 4px solid #fbbf24;
                }

                div.trix a {
                    text-decoration: underline;
                    text-decoration-color: #fbbf24;
                    text-decoration-thickness: 3px;
                    text-underline-offset: 2px;
                }

                div.trix a:hover {
                    color: #d97706;
                }
            </style>
            {!! $d->definisi !!}
        </div>

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
                @if (isset($d->user->username))
                    <a href="/u/{{ $d->user->username }}">
                        <div class="h-12 w-12 rounded-full overflow-hidden mr-3">
                            @include('partials.profil-pic-general-array2')
                        </div>
                    </a>
                    <a href="/u/{{ $d->user->username }}">
                        <div>{{ $d->user->nama }}</div>
                        <div class="small-text">{{ $d->updated_at->translatedformat('d F Y') }}</div>
                    </a>
                @else
                    <div>
                        <div class="h-12 w-12 rounded-full overflow-hidden mr-3">
                            @include('partials.profil-pic-general-array2')
                        </div>
                    </div>
                    <div>
                        <div>{{ $d->user->nama ?? '[Akun dihapus]' }}</div>
                        <div class="small-text">{{ $d->updated_at->translatedformat('d F Y') }}</div>
                    </div>
                @endif
            </div>

            {{-- Menu --}}
            @if (empty($d->menu) && isset($d->user->username)) {{-- sembunyikan jika tidak ada $d->menu (untuk halaman laporan) --}}
                <div class="relative">
                    @isset(auth()->user()->id)
                        <button id="dropdownBtn" onclick="dropdown(this, 'dropdown{{ $d->id }}')"
                            class="p-2 rounded-full hover:bg-neutral-100"><i data-feather='more-horizontal'></i></button>
                        <div id="dropdown{{ $d->id }}"
                            class="absolute hidden bg-white right-0 bottom-10 z-40 p-2 rounded-xl border border-neutral-200 min-w-48 text-neutral-800">
                            <ul>
                                @if ($d->user_id == auth()->user()->id)
                                    {{-- edit definisi --}}
                                    <li onclick="openWindow('editDefinisi-{{ $d->id }}')"
                                        class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 cursor-pointer">
                                        <div>Edit</div>
                                        <i data-feather='edit-3' class="w-5"></i>
                                    </li>
                                    {{-- hapus definisi --}}
                                    <li onclick="openWindow('hapusDefinisi-{{ $d->id }}')"
                                        class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 text-red-500 cursor-pointer">
                                        <div>Hapus</div>
                                        <i data-feather='trash' class="w-5"></i>
                                    </li>
                                @endif
                                @if ($d->user_id != auth()->user()->id)
                                    @if (auth()->user()->role != 'pengurus')
                                        {{-- laporkan definisi --}}
                                        <li onclick="openWindow('laporkan-{{ $d->id }}')"
                                            class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 text-red-500 cursor-pointer">
                                            <div>Laporkan</div>
                                            <i data-feather='flag' class="w-5"></i>
                                        </li>
                                    @else
                                        @if ($d->user->role != 'pengurus')
                                            {{-- hanya ditampilkan jika author = kontributor dan kepala --}}
                                            @if (empty($d->verifikasi_oleh))
                                                {{-- verifikasi laporan --}}
                                                <li onclick="openWindow('verifikasi-{{ $d->id }}')"
                                                    class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 cursor-pointer">
                                                    <div>Verifikasi</div>
                                                    <i data-feather='check' class="w-5"></i>
                                                </li>
                                            @else
                                                {{-- unverifikasi --}}
                                                <li onclick="openWindow('unverifikasi-{{ $d->id }}')"
                                                    class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 cursor-pointer">
                                                    <div>Un-verifikasi</div>
                                                    <i data-feather='x' class="w-5"></i>
                                                </li>
                                            @endif
                                        @endif

                                        {{-- tangani definisi salah --}}
                                        <li onclick="openWindow('laporkan-{{ $d->id }}')"
                                            class="flex justify-between py-2 px-3 rounded-lg hover:bg-neutral-100 text-red-500 cursor-pointer">
                                            <div>Definisi salah</div>
                                            <i data-feather='flag' class="w-5"></i>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    @endisset
                </div>
            @endif

        </div>
    </div>
</div>


{{-- POPUP --}}
<div class="">
    @if (empty($d->menu)) {{-- sembunyikan jika tidak ada $d->menu (untuk halaman laporan) --}}
        @if (isset(auth()->user()->id) && isset($d->user->username))

            {{-- popup laporkan definisi --}}
            <div id="laporkan-{{ $d->id }}"
                class="fixed inset-0 m-auto z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6">

                    <h5 class="font-semibold capitalize">
                        {{ auth()->user()->role != 'pengurus' ? 'Laporkan' : 'Form laporan' }}
                    </h5>
                    @if (auth()->user()->role != 'pengurus')
                        <div class="mb-5">Mengapa kamu melaporkan definisi yang disubmit oleh {{ $d->user->nama }}?
                        </div>
                    @else
                        <div class="mb-5">Deskripsikan kesalahan yang kamu temukan dalam definisi yang disubmit oleh
                            {{ $d->user->nama }}?</div>
                    @endif

                    <form action="/laporkan/definisi?id={{ $d->id }}" method="POST">
                        @csrf
                        <div class="overflow-auto max-h-[27rem] space-y-2">
                            {{-- Referensi --}}
                            <div>
                                <label for="alasan" class="block">Alasan</label>
                                <select name="alasan" id="alasan"
                                    class="w-full rounded-xl p-3 border bg-white focus:outline-none focus:border-amber-300 cursor-pointer @error('alasan')
                                border-red-400 @else border-neutral-400 @enderror">
                                    <option value="">Pilih</option>
                                    <option {{ old('alasan') == 'SPAM' ? 'selected' : '' }}>
                                        SPAM
                                    </option>
                                    <option {{ old('alasan') == 'Definisi tidak akurat' ? 'selected' : '' }}>
                                        Definisi tidak akurat
                                    </option>
                                    <option {{ old('alasan') == 'Kategori bahasa salah' ? 'selected' : '' }}>
                                        Kategori bahasa salah
                                    </option>
                                    <option {{ old('alasan') == 'Mengandung unsur SARA' ? 'selected' : '' }}>
                                        Mengandung unsur SARA
                                    </option>
                                    <option {{ old('alasan') == 'Scam/Penipuan' ? 'selected' : '' }}>
                                        Scam/Penipuan
                                    </option>
                                    <option {{ old('alasan') == 'Mempromosikan barang/jasa' ? 'selected' : '' }}>
                                        Mempromosikan barang/jasa
                                    </option>
                                    <option {{ old('alasan') == 'Melanggar hukum' ? 'selected' : '' }}>
                                        Melanggar hukum
                                    </option>
                                    <option {{ old('alasan') == 'Lain-lain' ? 'selected' : '' }}>
                                        Lain-lain
                                    </option>
                                </select>
                                @error('alasan')
                                    <div class="text-xs text-red-600 mt-1 mb-2">*{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="catatan">Catatan</label>
                                <textarea id="catatan" name="catatan"
                                    class="w-full resize-none text-neutral-800 focus:outline-none focus:border-amber-300 mb-3 max-h-52 border border-neutral-400 rounded-xl p-2"
                                    placeholder="Tambahkan catatan {{ auth()->user()->role != 'pengurus' ? 'untuk memperkuat laporan (opsional)' : '' }}"
                                    oninput="textareaHeight(this)">{{ old('catatan') }}</textarea>
                            </div>

                            {{-- alert jika user tersuspend --}}
                            @if (!empty($suspend) && $suspend->hukuman == true)
                                <div class="">
                                    <?php
                                    $alert = [
                                        'warna' => 'red',
                                        'pesan' => 'Untuk sementara, kamu tidak melaporkan definisi ini hingga ' . $suspend->hukumanBerakhir . ' karena akunmu sedang disuspend.',
                                        'textsize' => 'sm',
                                    ];
                                    ?>
                                    @include('partials.alert')
                                </div>
                            @endif

                        </div>

                        {{-- Button --}}
                        <div class="flex space-x-2">
                            <div onclick="closeWindow('laporkan-{{ $d->id }}')"
                                class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                                Batal</div>
                            @if (!empty($suspend) && $suspend->hukuman == true)
                                <div
                                    class="w-full bg-neutral-300 rounded-xl py-2.5 cursor-pointer text-center hover:outline hover:outline-offset-2 hover:outline-amber-500">
                                    Simpan
                                </div>
                            @else
                                <button type="submit"
                                    class="w-full bg-amber-400 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-amber-500">
                                    Simpan
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endif

    @if (empty($d->menu)) {{-- sembunyikan jika tidak ada $d->menu (untuk definisi) --}}
        @if (isset(auth()->user()->id) && $d->user_id == auth()->user()->id)
            {{-- popup Edit definisi --}}
            <div id="editDefinisi-{{ $d->id }}"
                class="fixed inset-0 m-auto z-50 flex invisible items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white border border-neutral-200 rounded-2xl md:w-1/3 w-5/6">

                    <h5 class="font-semibold mb-5 pt-6 px-6 capitalize">Edit definisi</h5>

                    <form action="/kosakata/{{ $d->slug }}/{{ $d->id }}/update" method="POST">
                        @method('put')
                        @csrf
                        <div class="overflow-auto max-h-[27rem] space-y-2">
                            {{-- Definisi --}}
                            <label for="editDefinisi" class="block px-6">Definisi</label>
                            <div style="padding: 0;">

                                <?php
                                $trixId = 'editDefinisi' . $d->id;
                                $trixImg = 0;
                                $trixUndoRedo = 1;
                                $trixBlockTool = 1;
                                $updateInput = $d->definisi;
                                $trixPlaceholder = 'Definisi, contoh penggunaan kata, dialek, dan informasi terkait lainnya..';
                                ?>
                                @include('partials.trix-editor')

                                @error('editDefinisi')
                                    <div class="text-xs text-red-600 mt-1 mb-2">*{{ $message }}</div>
                                @enderror

                            </div>

                            {{-- Referensi --}}
                            <div class="px-6">
                                <label for="editReferensi" class="block">Referensi<span
                                        class="text-xs text-red-500">*</span></label>
                                <textarea id="editReferensi" name="editReferensi"
                                    class="w-full resize-none text-neutral-800 focus:outline-none focus:outline-amber-300 focus:outline-offset-0 mb-3 max-h-52 border border-neutral-400 rounded-xl p-2"
                                    placeholder="Sumber referensi (opsional)..." oninput="textareaHeight(this)">{{ old('editReferensi', isset($d->referensi) ? implode('; ', $d->referensi) : '') }}</textarea>
                            </div>

                            {{-- alert jika user tersuspend --}}
                            @if (!empty($suspend) && $suspend->hukuman == true)
                                <div class="mx-6">
                                    <?php
                                    $alert = [
                                        'warna' => 'red',
                                        'pesan' => 'Untuk sementara, kamu tidak dapat mengedit definisi ini hingga ' . $suspend->hukumanBerakhir . ' karena akunmu sedang disuspend.',
                                        'textsize' => 'sm',
                                    ];
                                    ?>
                                    @include('partials.alert')
                                </div>
                            @endif

                        </div>

                        {{-- Button --}}
                        <div class="p-6">
                            @if (isset($d->verifikasi_oleh))
                                {{-- alert jika definisi terverifikasi --}}
                                <div class="">
                                    <?php $alert = ['warna' => 'red', 'pesan' => 'Status verifikasi akan dicabut jika definisi ini diedit.', 'textsize' => 'sm']; ?>
                                    @include('partials.alert')
                                </div>
                            @endif
                            <div class="flex space-x-2">
                                <div onclick="closeWindow('editDefinisi-{{ $d->id }}')"
                                    class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                                    Batal</div>
                                @if (!empty($suspend) && $suspend->hukuman == true)
                                    <div
                                        class="w-full bg-neutral-300 text-center cursor-pointer rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-amber-500">
                                        Simpan
                                    </div>
                                @else
                                    <button type="submit"
                                        class="w-full bg-amber-400 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-amber-500">
                                        Simpan
                                    </button>
                                @endif
                            </div>
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

            {{-- popup hapus definisi --}}
            <div id="hapusDefinisi-{{ $d->id }}"
                class="fixed inset-0 m-auto z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6 space-y-4">

                    <h5 class="font-semibold">Kamu yakin ingin menghapus definisi ini?</h5>

                    <div class="space-y-2">
                        <p>Definisi yang dihapus akan hilang secara permanen dan tidak dapat dipulihkan. Poin yang kamu
                            peroleh dari definisi ini juga akan ikut hilang.</p>
                        <p>Yakin ingin melanjutkan?</p>
                    </div>

                    {{-- alert jika user tersuspend --}}
                    @if (!empty($suspend) && $suspend->hukuman == true)
                        <div class="">
                            <?php
                            $alert = [
                                'warna' => 'red',
                                'pesan' => 'Untuk sementara, kamu tidak dapat menghapus definisi ini hingga ' . $suspend->hukumanBerakhir . ' karena akunmu sedang disuspend.',
                                'textsize' => 'sm',
                            ];
                            ?>
                            @include('partials.alert')
                        </div>
                    @endif

                    <form action="/kosakata/{{ $d->slug }}/{{ $d->id }}/delete" method="POST">
                        @method('delete')
                        @csrf
                        {{-- Button --}}
                        <div class="flex space-x-2">
                            <div onclick="closeWindow('hapusDefinisi-{{ $d->id }}')"
                                class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                                Batal</div>
                            @if (!empty($suspend) && $suspend->hukuman == true)
                                <div
                                    class="w-full bg-neutral-300 cursor-pointer text-center rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-red-600">
                                    Ya, Yakin
                                </div>
                            @else
                                <button type="submit"
                                    class="w-full bg-red-500 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-red-600">Ya,
                                    Yakin
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endif

    {{-- popup Verifikasi definisi --}}
    @if (isset($d->user) && auth()->user() && auth()->user()->role == 'pengurus' && $d->user->role != 'pengurus' && isset($d->id))
        {{-- pada if ditambahkan isset($d->id) agar tidak error saat ditampilkan di halaman laporan(hal. laporan tidak membutukan ini) --}}
        @if (empty($d->verifikasi_oleh))
            <div id="verifikasi-{{ $d->id }}"
                class="fixed inset-0 m-auto z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6 space-y-4">

                    <h5 class="font-semibold">Verifikasi defisini yang di-submit oleh {{ $d->user->nama }}?</h5>

                    <div class="space-y-2">
                        <p>Pastikan kamu sudah yakin bahwa definisi yang dikirim oleh {{ $d->user->nama }} memang benar
                            dan
                            sudah sesuai.</p>
                    </div>

                    <form action="/definisi/verifikasi/{{ $d->slug }}/{{ $d->id }}" method="POST">
                        @method('PUT')
                        @csrf
                        {{-- Button --}}
                        <div class="flex space-x-2">
                            <div onclick="closeWindow('verifikasi-{{ $d->id }}')"
                                class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                                Batal</div>
                            <button type="submit"
                                class="w-full bg-amber-400 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-amber-400">Lanjutkan</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div id="unverifikasi-{{ $d->id }}"
                class="fixed inset-0 m-auto z-50 invisible flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6 space-y-4">

                    <h5 class="font-semibold">Un-verifikasi defisini yang di-submit oleh {{ $d->user->nama }}?</h5>

                    <div class="space-y-2">
                        <p>Definisi ini sebelumnya diverifikasi oleh
                            {{ $d->verifikasi_oleh == auth()->user()->id ? 'kamu' : $d->pengurus->nama ?? '[Akun dihapus]' }}.
                            Pembatalan
                            verifikasi akan membuat definisi ini kembali berstatus belum terverifikasi. Lanjutkan?</p>
                    </div>

                    <form action="/definisi/verifikasi/{{ $d->slug }}/{{ $d->id }}" method="POST">
                        @method('PUT')
                        @csrf
                        {{-- Button --}}
                        <div class="flex space-x-2">
                            <div onclick="closeWindow('unverifikasi-{{ $d->id }}')"
                                class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                                Batal</div>
                            <button type="submit"
                                class="w-full bg-amber-400 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-amber-400">Lanjutkan</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endif
</div>
