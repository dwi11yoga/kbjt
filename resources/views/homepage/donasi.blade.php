@extends('.../layouts/homepage-with-banner')

@section('body')
    <h3 class="mb-3 font-bold">Beri dukungan</h3>
    <p class="mb-7">Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis rerum, accusantium veniam quisquam
        doloremque quo quasi aliquid asperiores recusandae illum.</p>

    <div class="w-full border border-gray-200 rounded-2xl py-6 px-7">
        {{-- Select metode pembayaran --}}
        <label for="metode-pembayaran" class="block mb-2 text-sm font-medium text-gray-800">Metode
            donasi</label>
        <form action="/dukung" method="GET" class="relative justify-between">
            <select name="metode-pembayaran" id="metode-pembayaran" onchange="muatDropdown(this)"
                class="w-full py-3 px-5 rounded-md bg-white border border-gray-200 cursor-pointer appearance-none">
                @foreach ($metode as $d)
                    <option {{ request('metode-pembayaran') == $d->metode ? 'selected' : '' }}>{{ $d->metode }}</option>
                @endforeach
            </select>
            <span class="absolute flex right-4 top-3"><i data-feather='chevron-down'></i></span>
        </form>

        <div class="grid grid-cols-4 md:space-x-5 mt-5 md:space-y-0 space-y-5">
            {{-- barcode --}}
            <div class="md:col-span-1 col-span-4">
                <div class="rounded-2xl bg-neutral-200 w-full !aspect-square flex items-center justify-center overflow-hidden">
                    <img src="{{ isset($donasi->barcode)? 'storage/'.$donasi->barcode:'' }}" alt="Barcode tidak tersedia">
                </div>
            </div>
            {{-- deskripsi/cara donasi & link/rekening --}}
            <div class="md:col-span-3 col-span-4 space-y-3">

                <div class="">
                    {!! $donasi->cara_donasi ?? 'Deskripsi belum tersedia' !!}
                </div>

                @isset($donasi->rekening)
                {{-- rekening --}}
                    <div class="bg-neutral-200 rounded-lg py-3 px-4 grid grid-cols-12">
                        <div id="url" class="col-span-11">{{ $donasi->rekening }}</div>
                        <div class="col-span-1 flex items-center justify-end">
                            <button title="Salin url"
                                onclick="copyUrl(document.getElementById('url'), document.getElementById('copyBefore'), document.getElementById('copyAfter'))">
                                <i data-feather='copy' id="copyBefore" class="w-5"></i>
                                <i data-feather='check' id="copyAfter" class="w-5 hidden"></i>
                            </button>
                        </div>
                    </div>
                @endisset

                @isset($donasi->url)
                {{-- url donasi --}}
                    <div class="bg-neutral-200 rounded-lg py-3 px-4 grid grid-cols-12">
                        <div id="url2" class="col-span-11 line-clamp-1">{{ $donasi->url }}</div>
                        <div class="col-span-1 flex items-center justify-end space-x-2">
                            {{-- tombol salin --}}
                            <button title="Salin url"
                            onclick="copyUrl(document.getElementById('url2'), document.getElementById('copyBefore2'), document.getElementById('copyAfter2'))">
                            <i data-feather='copy' id="copyBefore2" class="w-5"></i>
                            <i data-feather='check' id="copyAfter2" class="w-5 hidden"></i>
                        </button>
                        {{-- tombol kunjungi link --}}
                        <a href="{{ $donasi->url }}" target="_blank" title="Kunjungi url">
                            <i data-feather='external-link' class="w-5"></i>
                        </a>
                        </div>
                    </div>
                @endisset

                {{-- <div id="url" title="Salin url"
                    onclick="copyUrl(this, document.getElementById('copyBefore'), document.getElementById('copyAfter'))"
                    class="inline-block bg-neutral-50 rounded-full py-0.5 px-2 cursor-pointer">
                    {{ $user->url }}<i id="copyBefore" data-feather='copy' class="w-4 ml-1 inline-block"></i><i
                        id="copyAfter" data-feather='check' class="w-4 ml-1 hidden"></i>
                </div> --}}

            </div>
        </div>
    </div>
@endsection
