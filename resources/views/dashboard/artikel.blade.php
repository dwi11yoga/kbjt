@extends('layouts.dashboard')

@section('body')
    <div class="space-y-3">

        {{-- Filter --}}
        <div class="md:flex md:justify-between">
            <form action="/artikel" method="GET">
                <div class="inline-flex space-x-2">
                    {{-- Status --}}
                    <div class="relative">
                        <label for="status" class="absolute left-3 top-4"><i data-feather='filter' class="w-5"></i></label>
                        <select name="status" id="status" onchange="muatDropdown(this)"
                            class="py-4 pl-10 pr-5 bg-white rounded-xl appearance-none cursor-pointer hover:outline hover:outline-amber-200">
                            <option {{ isset($_GET['status']) && $_GET['status'] == '' ? 'selected' : '' }} value="">
                                Semua</option>
                            <option {{ isset($_GET['status']) && $_GET['status'] == 'dipublikasikan' ? 'selected' : '' }}
                                value="dipublikasikan">
                                Dipublikasikan
                            </option>
                            <option {{ isset($_GET['status']) && $_GET['status'] == 'draf' ? 'selected' : '' }}
                                value="draf">Draf</option>
                        </select>
                    </div>

                    @if (auth()->user()->role == 'pengurus')
                        {{-- Dibuat oleh --}}
                        <div class="relative">
                            <label for="author" class="absolute left-3 top-4">
                                <i data-feather='user' class="w-5"></i>
                            </label>
                            <select name="author" id="author" onchange="muatDropdown(this)"
                                class="py-4 pl-10 pr-5 bg-white rounded-xl appearance-none cursor-pointer hover:outline hover:outline-amber-200">
                                <option {{ isset($_GET['author']) && $_GET['author'] == '' ? 'selected' : '' }}
                                    value="">
                                    Semua</option>
                                <option
                                    {{ isset($_GET['author']) && $_GET['author'] == auth()->user()->username ? 'selected' : '' }}
                                    value="{{ auth()->user()->username }}">Artikelku</option>
                            </select>
                        </div>
                    @endif
                </div>
            </form>

            @if (auth()->user()->role == 'pengurus')
                {{-- Buat artikel --}}
                <a href="/artikel/baru">
                    <div class="md:mt-0 mt-2 py-4 px-5 bg-white rounded-xl hover:outline hover:outline-amber-200">
                        <i data-feather='plus' class="w-5 inline-block"></i>
                        <span>Buat Artikel</span>
                    </div>
                </a>
            @endif
        </div>

        @if ($posts->isEmpty())
            <?php $notFound = 'Tidak ada artikel yang dapat ditampilkan'; ?>
            @include('partials.not-found')
        @else
            <?php $artikelUser = 0; ?>
            @foreach ($posts as $d)
                <div
                    class="relative grid grid-cols-12 items-center py-4 px-5 bg-white rounded-xl group hover:outline hover:outline-amber-200">
                    <a href="{{ $d->user_id != auth()->user()->id || auth()->user()->role == 'kepala' ? (isset($d->status) ? '/blog/post/' . $d->slug : '/blog/preview/' . $d->slug) : '/artikel/edit/' . $d->id }}"
                        class="col-span-11 grid md:grid-cols-11 grid-cols-5 md:space-x-10 space-y-2">
                        {{-- Judul --}}
                        <div class="md:col-span-5 col-span-5 line-clamp-2 flex items-center md:font-normal font-semibold" title="Judul artikel">
                            @if ($d->pinned == 1)
                                <span title="Disematkan">📌</span>
                            @endif
                            {{ $d->judul }}
                        </div>

                        {{-- author --}}
                        <div class="md:col-span-3 col-span-5 flex items-center space-x-1 text-neutral-700" title="Ditulis oleh {{ $d->user->nama }} {{isset($d->user->statusUser) && $d->user->statusUser=='dihapus'?'(Akun dihapus)':''}}">
                            <div class="md:w-7 md:h-7 w-8 h-8 rounded-full overflow-hidden">
                                @include('partials.profil-pic-general-array2')
                            </div>
                            <div class="line-clamp-2">{{ $d->user->nama }}</div>
                        </div>

                        {{-- Status --}}
                        <div class="col-span-1 flex items-center">
                            @if (isset($d->status))
                                Rilis
                            @else
                                Draf
                            @endif
                        </div>

                        {{-- tgl --}}
                        <div class="col-span-2 flex md:justify-end items-center" title="Terakhir diedit">
                            {{ $d->updated_at->translatedformat('d M Y') }}
                        </div>
                    </a>

                    {{-- Tombol --}}
                    <div class="col-span-1 text-right">
                        <button class="hover:bg-neutral-200 rounded-full py-2 px-2.5"
                            onclick="dropdown(this, 'dropdown{{ $d->id }}')">
                            <i data-feather='more-vertical' class="w-5"></i>
                        </button>
                    </div>

                    {{-- Menu --}}
                    <div id="dropdown{{ $d->id }}"
                        class="absolute hidden bg-white right-14 z-40 p-2 rounded-xl border border-neutral-200 min-w-48 text-neutral-800">
                        <ul>
                            @if (isset($d->status))
                                {{-- Lihat --}}
                                <a href="/blog/post/{{ $d->slug }}">
                                    <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-amber-100">
                                        <div>Lihat</div>
                                        <i data-feather='eye' class="w-5"></i>
                                    </li>
                                </a>
                            @endif

                            @if (auth()->user()->role == 'kepala' || $d->user_id == auth()->user()->id)
                                <form action="/artikel/draf/{{ $d->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    @if (isset($d->status))
                                        {{-- jadikan draft --}}
                                        <button type="submit" class="flex w-full justify-between py-2 px-3 rounded-lg hover:bg-amber-100">
                                            <div>Jadikan draf</div>
                                            <i data-feather='archive' class="w-5"></i>
                                        </button>
                                    @else
                                        {{-- publikasikan --}}
                                        <button type="submit" class="flex w-full justify-between py-2 px-3 rounded-lg hover:bg-amber-100">
                                            <div>Publikasikan</div>
                                            <i data-feather='send' class="w-5"></i>
                                        </button>
                                    @endif
                                </form>
                            @elseif ((auth()->user()->role == 'kepala' && empty($d->status)) || ($d->user_id == auth()->user()->id && empty($d->status)))
                            @endif

                            @if (empty($d->status))
                                {{-- preview --}}
                                <a href="/blog/preview/{{ $d->slug }}">
                                    <li class="flex justify-between py-2 px-3 rounded-lg hover:bg-amber-100">
                                        <div>Preview</div>
                                        <i data-feather='eye' class="w-5"></i>
                                    </li>
                                </a>
                            @endif

                            {{-- Pin artikel --}}
                            @if (auth()->user()->role == 'kepala' && isset($d->status))
                                <form action="/artikel/sematkan/{{ $d->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    @if ($d->pinned == 0)
                                        {{-- Pin artikel --}}
                                        <button type="submit" class="flex w-full justify-between py-2 px-3 rounded-lg hover:bg-amber-100">
                                            <div>Sematkan</div>
                                            <div>
                                                <svg width="1.25rem" height="1.25rem" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" class="fill-neutral-900"
                                                        d="M16.4746 4.3747L19.6474 7.55072C20.6549 8.55917 21.4713 9.37641 21.9969 10.0856C22.5382 10.8161 22.8881 11.5853 22.6982 12.4634C22.5083 13.3415 21.8718 13.8972 21.0771 14.3383C20.3055 14.7665 19.2245 15.1727 17.8906 15.6738L15.9136 16.4166C15.1192 16.7151 14.9028 16.8081 14.742 16.9474C14.6611 17.0174 14.5887 17.0967 14.5263 17.1837C14.4021 17.3568 14.329 17.5812 14.1037 18.4L14.0914 18.4449C13.8627 19.2762 13.6739 19.9623 13.4671 20.4774C13.2573 21.0003 12.974 21.4955 12.465 21.786C12.1114 21.9878 11.7112 22.0936 11.3041 22.093C10.7179 22.0921 10.227 21.8014 9.78647 21.4506C9.35243 21.1049 8.8497 20.6016 8.24065 19.9919L6.65338 18.403L2.5306 22.53C2.23786 22.823 1.76298 22.8233 1.46994 22.5305C1.1769 22.2378 1.17666 21.7629 1.4694 21.4699L5.59326 17.3418L4.05842 15.8054C3.45318 15.1996 2.9536 14.6995 2.61002 14.2678C2.26127 13.8297 1.97215 13.3421 1.96848 12.7599C1.96586 12.3451 2.07354 11.9371 2.28053 11.5777C2.57116 11.0731 3.06341 10.7919 3.58296 10.5834C4.09477 10.3779 4.77597 10.1901 5.60112 9.96265L5.6457 9.95036C6.46601 9.7242 6.69053 9.65088 6.86346 9.52638C6.9526 9.4622 7.0337 9.38748 7.10499 9.30383C7.24338 9.14144 7.33502 8.92324 7.62798 8.12367L8.34447 6.16811C8.83874 4.819 9.23907 3.72629 9.66362 2.9461C10.1005 2.14324 10.654 1.49811 11.5357 1.30359C12.4175 1.10904 13.1908 1.46156 13.9246 2.0063C14.6375 2.53559 15.4597 3.35863 16.4746 4.3747ZM13.0304 3.21067C12.4277 2.76322 12.1086 2.71327 11.8588 2.76836C11.609 2.82349 11.3402 3.0033 10.9812 3.66306C10.6161 4.33394 10.2525 5.32066 9.73087 6.7443L9.03642 8.63971C9.02304 8.67621 9.00987 8.71226 8.99686 8.74786C8.76267 9.3886 8.58179 9.88351 8.24665 10.2768C8.09712 10.4522 7.92696 10.609 7.73987 10.7437C7.3205 11.0456 6.81257 11.1852 6.15537 11.3659C6.11884 11.3759 6.08184 11.3861 6.04438 11.3964C5.16337 11.6393 4.56523 11.8054 4.1418 11.9754C3.71693 12.146 3.615 12.2662 3.58038 12.3263C3.50616 12.4552 3.46751 12.6015 3.46845 12.7504C3.46889 12.8201 3.49835 12.9752 3.78366 13.3337C4.06799 13.6909 4.50615 14.1312 5.15229 14.778L9.26897 18.8989C9.91923 19.5498 10.3618 19.9912 10.721 20.2772C11.0814 20.5643 11.2369 20.5929 11.3064 20.593C11.4519 20.5933 11.595 20.5554 11.7215 20.4832C11.7821 20.4486 11.9033 20.3466 12.0751 19.9187C12.2462 19.4923 12.4133 18.8896 12.6574 18.0021C12.6677 17.9648 12.6778 17.9279 12.6878 17.8914C12.8678 17.2352 13.0069 16.7283 13.3075 16.3093C13.4384 16.1268 13.5903 15.9604 13.76 15.8134C14.15 15.4758 14.642 15.2914 15.2786 15.0527C15.314 15.0395 15.3498 15.0261 15.386 15.0124L17.3032 14.2921C18.7112 13.7631 19.6865 13.3946 20.3491 13.0268C21.0001 12.6655 21.178 12.3967 21.2321 12.1463C21.2863 11.8958 21.2353 11.5773 20.7917 10.9787C20.3403 10.3695 19.6045 9.63013 18.541 8.5656L15.4588 5.48018C14.3876 4.40792 13.6433 3.66571 13.0304 3.21067Z" />
                                                </svg>
                                            </div>
                                        </button>
                                    @elseif ($d->pinned == 1)
                                        {{-- Unpin artikel --}}
                                        <button type="submit" class="flex w-full justify-between py-2 px-3 rounded-lg hover:bg-amber-100">
                                            <div>Lepas semat</div>
                                            <div>
                                                <svg width="1.25rem" height="1.25rem" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <path
                                                            d="M17.1218 1.87023C15.7573 0.505682 13.4779 0.76575 12.4558 2.40261L9.75191 6.73289L11.1969 8.17793C11.2355 8.1273 11.2723 8.07415 11.3071 8.01845L14.1523 3.46191C14.493 2.91629 15.2528 2.8296 15.7076 3.28445L20.6359 8.21274C21.0907 8.66759 21.0041 9.42737 20.4584 9.76806L15.9019 12.6133C15.8462 12.6481 15.793 12.6848 15.7424 12.7234L17.1874 14.1684L21.5177 11.4645C23.1546 10.4424 23.4147 8.16307 22.0501 6.79852L17.1218 1.87023Z"
                                                            fill="#0F0F0F"></path>
                                                        <path
                                                            d="M3.56525 8.85242C3.6015 8.26612 3.84962 7.68582 4.32883 7.27422L5.77735 8.72274C5.75784 8.72967 5.73835 8.7368 5.71886 8.74414C5.64516 8.7719 5.61855 8.80285 5.60548 8.82181C5.58877 8.84604 5.56651 8.8937 5.56144 8.97583C5.55046 9.15333 5.62872 9.40686 5.82846 9.6066L14.3137 18.0919C14.5135 18.2916 14.767 18.3699 14.9445 18.3589C15.0266 18.3538 15.0743 18.3316 15.0985 18.3149C15.1175 18.3018 15.1484 18.2752 15.1762 18.2015C15.1835 18.182 15.1907 18.1625 15.1976 18.143L16.6461 19.5915C16.2345 20.0707 15.6542 20.3188 15.0679 20.3551C14.2853 20.4035 13.4808 20.0874 12.8995 19.5061L9.36397 15.9705L2.68394 22.6506C2.29342 23.0411 1.66025 23.0411 1.26973 22.6506C0.879206 22.26 0.879206 21.6269 1.26973 21.2363L7.94975 14.5563L4.41425 11.0208C3.83293 10.4395 3.51687 9.63502 3.56525 8.85242Z"
                                                            fill="#0F0F0F"></path>
                                                        <path
                                                            d="M2.00789 2.00786C1.61736 2.39838 1.61736 3.03155 2.00789 3.42207L20.5862 22.0004C20.9767 22.3909 21.6099 22.3909 22.0004 22.0004C22.391 21.6099 22.391 20.9767 22.0004 20.5862L3.4221 2.00786C3.03158 1.61733 2.39841 1.61733 2.00789 2.00786Z"
                                                            fill="#0F0F0F"></path>
                                                    </g>
                                                </svg>
                                            </div>
                                        </button>
                                    @endif
                                </form>
                            @endif

                            {{-- Hapus --}}
                            @if (auth()->user()->role == 'kepala' || $d->user_id == auth()->user()->id)
                                <button type="submit" id="{{ $d->id }}"
                                    onclick="deleteMessage(this,'hapusArtikel', 'formHapus')"
                                    class="flex w-full justify-between py-2 px-3 rounded-lg text-red-500 hover:bg-red-100">
                                    <div>Hapus</div>
                                    <i data-feather='trash-2' class="w-5"></i>
                                </button>

                                {{-- <form action="/artikel/hapus/{{ $d->id }}" method="POST">
                                    @method('delete')
                                    @csrf
                                    <button type="submit"
                                        class="flex w-full justify-between py-2 px-3 rounded-lg text-red-500">
                                        <div>Hapus</div>
                                        <i data-feather='trash-2' class="w-5"></i>
                                    </button>
                                </form> --}}
                            @endif

                        </ul>
                    </div>
                </div>

                {{-- untuk mengetahui apakah ada artikel buatan user --}}

                @if ($d->user_id == auth()->user()->id)
                    <?php $artikelUser += 1; ?>
                @endif
            @endforeach

            @if (auth()->user()->role == 'kepala' || $artikelUser > 0)
                {{-- hapus artikel --}}
                <div id="hapusArtikel"
                    class="fixed inset-0 m-auto invisible z-50 flex items-center justify-center bg-black bg-opacity-50">
                    <div class="bg-white border border-neutral-200 p-6 rounded-2xl md:w-1/3 w-5/6 space-y-4">

                        <h5 class="font-semibold">Kamu yakin ingin menghapus artikel ini?</h5>

                        <div class="space-y-2">
                            <p>Artikel yang dihapus akan hilang secara permanen dan tidak dapat dipulihkan.
                                Yakin ingin melanjutkan?</p>
                        </div>

                        <form id="formHapus" action="" method="POST">
                            @method('delete')
                            @csrf
                            {{-- Button --}}
                            <div class="flex space-x-2">
                                <div onclick="closeWindow('hapusArtikel')"
                                    class="w-full bg-neutral-300 rounded-xl py-2.5 text-center cursor-pointer hover:outline hover:outline-offset-2 hover:outline-neutral-400">
                                    Batal</div>
                                <button type="submit"
                                    class="w-full bg-red-500 rounded-xl py-2.5 hover:outline hover:outline-offset-2 hover:outline-red-600">Ya,
                                    Yakin</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    function deleteMessage(artikel, component, formId) {
                        openWindow(component);

                        var artikel = artikel.id;
                        var form = document.getElementById(formId);
                        form.action = `/artikel/hapus/${artikel}`;
                    }
                </script>
            @endif

            {{-- Pagination --}}
            <div class="">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
