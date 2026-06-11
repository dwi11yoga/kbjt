@props(['slug', 'image' => null, 'pinned' => null, 'title', 'desc', 'author', 'datetime' => null])

<a href="/blog/{{ $slug }}"
    class="grid md:grid-cols-10 grid-cols-12 pr-5 space-x-5 bg-neutral-50 dark:bg-zinc-800 rounded-2xl hover:overflow-hidden group w-full hover:bg-yellow-100 hover:outline outline-2 outline-yellow-300 active:bg-yellow-200 transition-all ease-in-out">
    <div class="md:col-span-3 col-span-4">
        <div class="rounded-md w-full h-full md:aspect-video aspect-square overflow-hidden">
            <img src="{{ isset($image) ? asset('storage/' . $image) : asset('img/no-image.png') }}"
                class="w-full h-full object-cover" alt="">
        </div>
    </div>
    <div class="flex flex-col justify-center gap-2 md:col-span-7 col-span-7">
        @if ($pinned == 1)
            <div class="w-fit">
                <x-badge color="bg-amber-200">
                    <i data-lucide='pin' class="size-4 fill-white dark:fill-black dark:stroke-black"></i>
                    <div class="dark:text-neutral-800">Disematkan</div>
                </x-badge>
            </div>
        @endif
        <h5 class="line-clamp-2 md:text-xl text-sm -mb-2 text-left">
            {{ $title }}
        </h5>

        @if (!$pinned)
            <p class="line-clamp-2 text-sm text-neutral-500">{{ strip_tags($desc) }}</p>
        @endif

        <div class="flex gap-1 text-sm items-center text-neutral-600">
            <div class="">Oleh</div>
            <div class="font-semibold">{{ $author }}</div>
            @if ($datetime)
                <div class="">•</div>
                <div class="text-neutral-500">{{ dateFormat($datetime) }}</div>
            @endif
        </div>
    </div>
</a>
