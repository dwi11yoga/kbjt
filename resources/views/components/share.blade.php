@props([
    'id' => null,
    'title' => null,
    'desc' => null,
    'shareText' => null,
    'url' => request()->fullUrl(),
    'separator' => true,
    'width' => 'md:w-2/3 w-full',
])

<div id="{{ $id }}" class="w-full {{ $separator ? 'py-8 border-t border-b border-gray-200 dark:border-zinc-800' : '' }} space-y-5">

    <div class="space-y-1">
        <div class="font-semibold text-xl">{{ $title }}</div>
        <div class="{{ $width }}">{{ $desc }}</div>
    </div>

    {{-- bagikan --}}
    <div class="flex space-x-1">
        {{-- facebook --}}
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" target="_blank"
            title="Bagikan lewat facebook" class="bg-neutral-200 dark:bg-zinc-800 rounded-lg py-3 px-3 w-fit group hover:bg-blue-400">
            <i data-lucide='facebook' class="fill-blue-500 group-hover:fill-white stroke-none"></i>
        </a>

        {{-- twitter/x --}}
        <a href="https://twitter.com/intent/tweet?text={{ urlencode($shareText) }}&url={{ urlencode($url) }}"
            target="_blank" title="Bagikan lewat twitter/x"
            class="bg-neutral-200 dark:bg-zinc-800 rounded-lg py-3 px-3 w-fit group hover:bg-sky-400">
            {{-- <i data-lucide='bird' class="fill-sky-500 group-hover:fill-white stroke-none"></i> --}}
            <i data-lucide='twitter' class="fill-sky-500 group-hover:fill-white stroke-none"></i>
        </a>

        {{-- whatsapp --}}
        <a href="https://wa.me/?text={{ urlencode($shareText . ' ' . $url) }}" target="_blank"
            title="Bagikan lewat Whatsapp" class="bg-neutral-200 dark:bg-zinc-800 rounded-lg py-3 px-3 w-fit group hover:bg-green-500">
            <i data-lucide='whatsapp' class="fill-green-500 group-hover:fill-white stroke-none"></i>
        </a>

        {{-- telegram --}}
        <a href="https://t.me/share/url?url={{ urlencode($url) }}&text={{ urlencode($shareText) }}" target="_blank"
            title="Bagikan lewat telegram" class="bg-neutral-200 dark:bg-zinc-800 rounded-lg py-3 px-3 w-fit group hover:bg-blue-500">
            <i data-lucide='telegram' class="fill-blue-500 group-hover:fill-white stroke-none"></i>
        </a>
    </div>

    {{-- Bagikan link --}}
    <div class="bg-neutral-200 dark:bg-zinc-800 rounded-lg {{ $width }} py-3 px-4 flex justify-between gap-2">
        <div id="bagikanLink" class="line-clamp-1">
            {{ $url }}
        </div>
        <div class="flex items-center justify-end space-x-2">
            {{-- tombol salin --}}
            <button title="Salin url"
                onclick="copyUrl(document.getElementById('bagikanLink'), document.getElementById('copyBefore2'), document.getElementById('copyAfter2'))">
                <i data-lucide='copy' id="copyBefore2" class="w-5"></i>
                <i data-lucide='check' id="copyAfter2" class="w-5 hidden"></i>
            </button>
        </div>
    </div>

    {{-- <div class="col-span-1 md:block hidden">
                <img src="https://img.freepik.com/free-vector/woman-with-megaphone-screaming-concept_114360-16301.jpg"
                    alt="">
            </div> --}}
</div>
