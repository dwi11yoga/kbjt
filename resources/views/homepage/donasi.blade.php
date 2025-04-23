@extends('.../layouts/homepage-with-banner')

@section('body')
    <h3 class="mb-3 font-bold">Beri dukungan</h3>
    <p class="mb-7">Satu langkah kecil untukmu, satu lompatan besar bagi komunitas! Beri dukungan lewat donasi atau bagikan situs ini
        ke taman dan saudaramu!</p>

    {{-- donais --}}
    @if (isset($metode))
        <div class="w-full border border-gray-200 rounded-2xl py-6 px-7">
            <div class="font-semibold">Donasi</div>
            {{-- Select metode pembayaran --}}
            <label for="metode-pembayaran" class="block mb-2 text-sm font-medium text-gray-800">Metode
                donasi</label>
            <form action="/dukung" method="GET" class="relative justify-between">
                <select name="metode-pembayaran" id="metode-pembayaran" onchange="muatDropdown(this)"
                    class="w-full py-3 px-5 rounded-md bg-white border border-gray-200 cursor-pointer appearance-none">
                    @foreach ($metode as $d)
                        <option {{ request('metode-pembayaran') == $d->metode ? 'selected' : '' }}>{{ $d->metode }}
                        </option>
                    @endforeach
                </select>
                <span class="absolute flex right-4 top-3"><i data-feather='chevron-down'></i></span>
            </form>

            <div class="grid grid-cols-4 md:space-x-5 mt-5 md:space-y-0 space-y-5">
                {{-- barcode --}}
                <div class="md:col-span-1 col-span-4">
                    <div
                        class="rounded-2xl bg-neutral-200 w-full !aspect-square flex items-center justify-center overflow-hidden">
                        <img src="{{ isset($donasi->barcode) ? 'storage/' . $donasi->barcode : '' }}"
                            alt="Barcode tidak tersedia">
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
    @endif

    {{-- dukung dengan membagikan ke teman --}}
    <div class="w-full border border-gray-200 rounded-2xl py-6 px-7 grid grid-cols-3 items-center">
        <div class="md:col-span-2 col-span-3">

            <div class="font-semibold">Bagikan ke teman</div>
            <div class="text-sm">Bantu lestarikan Bahasa Jawa—ajak temanmu untuk mengunjungi dan berkontribusi di Kamus
                Besar Bahasa Jawa!
            </div>

            {{-- bagikan --}}
            <div class="my-3 flex space-x-1">
                <?php $teks = 'Temukan kekayaan bahasa Jawa dengan menjelajahi Kamus Bahasa Jawa Terbuka sekarang!'; ?>
                {{-- facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($urlweb) }}" target="_blank"
                    title="Bagikan lewat facebook">
                    <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-blue-400">
                        <i data-feather='facebook' class="fill-blue-500 group-hover:fill-white stroke-none"></i>
                    </div>
                </a>

                {{-- twitter/x --}}
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($teks) }}&url={{ urlencode($urlweb) }}"
                    target="_blank" title="Bagikan lewat twitter/x">
                    <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-sky-400">
                        <i data-feather='twitter' class="fill-sky-500 group-hover:fill-white stroke-none"></i>
                    </div>
                </a>

                {{-- whatsapp --}}
                <a href="https://wa.me/?text={{ urlencode($teks . ' ' . $urlweb) }}" target="_blank"
                    title="Bagikan lewat Whatsapp">
                    <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 30 30" width="24px" height="24px">
                            <polygon class="fill-green-500 group-hover:fill-white"
                                points="4.796,20.836 3.107,27 9.415,25.344 " />
                            <path class="fill-green-500 group-hover:fill-white"
                                d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M20.924,19.143c-0.247,0.693-1.461,1.363-2.005,1.41c-0.549,0.051-1.061,0.247-3.568-0.74c-3.024-1.191-4.931-4.289-5.08-4.489c-0.149-0.195-1.21-1.61-1.21-3.07c0-1.465,0.768-2.182,1.037-2.48c0.274-0.298,0.595-0.372,0.795-0.372c0.195,0,0.395,0,0.568,0.009c0.214,0.005,0.447,0.019,0.67,0.512c0.265,0.586,0.842,2.056,0.916,2.205c0.074,0.149,0.126,0.326,0.023,0.521c-0.098,0.2-0.149,0.321-0.293,0.498c-0.149,0.172-0.312,0.386-0.447,0.516c-0.149,0.149-0.302,0.312-0.13,0.609s0.768,1.27,1.651,2.056c1.135,1.014,2.093,1.326,2.391,1.475s0.47,0.126,0.642-0.074c0.177-0.195,0.744-0.865,0.944-1.163c0.195-0.298,0.395-0.247,0.665-0.149c0.274,0.098,1.735,0.819,2.033,0.968s0.493,0.223,0.568,0.344C21.171,17.854,21.171,18.449,20.924,19.143z" />
                        </svg>
                    </div>
                </a>

                {{-- telegram --}}
                <a href="https://t.me/share/url?url={{ urlencode($urlweb) }}&text={{ urlencode($teks) }}" target="_blank"
                    title="Bagikan lewat telegram">
                    <div class="bg-neutral-200 rounded-lg py-3 px-3 w-fit group hover:bg-blue-500">
                        <svg width="24px" height="24px" viewBox="0 0 48 48" id="Layer_2" data-name="Layer 2"
                            xmlns="http://www.w3.org/2000/svg">
                            <path class="fill-blue-500 group-hover:fill-white"
                                d="M40.83,8.48c1.14,0,2,1,1.54,2.86l-5.58,26.3c-.39,1.87-1.52,2.32-3.08,1.45L20.4,29.26a.4.4,0,0,1,0-.65L35.77,14.73c.7-.62-.15-.92-1.07-.36L15.41,26.54a.46.46,0,0,1-.4.05L6.82,24C5,23.47,5,22.22,7.23,21.33L40,8.69a2.16,2.16,0,0,1,.83-.21Z" />
                        </svg>
                    </div>
                </a>

            </div>

            {{-- Bagikan link --}}
            <div class="bg-neutral-200 rounded-lg py-3 px-4 grid grid-cols-12">
                <div id="bagikanLink" class="col-span-11 line-clamp-1">{{ $urlweb }}</div>
                <div class="col-span-1 flex items-center justify-end space-x-2">

                    {{-- tombol salin --}}
                    <button title="Salin url"
                        onclick="copyUrl(document.getElementById('bagikanLink'), document.getElementById('copyBefore2'), document.getElementById('copyAfter2'))">
                        <i data-feather='copy' id="copyBefore2" class="w-5"></i>
                        <i data-feather='check' id="copyAfter2" class="w-5 hidden"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="md:col-span-1 col-span-3">
            <img src="https://img.freepik.com/free-vector/woman-with-megaphone-screaming-concept_114360-16301.jpg"
                alt="">
        </div>
    </div>
@endsection
