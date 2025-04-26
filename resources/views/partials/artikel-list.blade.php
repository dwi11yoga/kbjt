<a href="/blog/post/{{ $d->slug }}"
    class="grid md:grid-cols-10 grid-cols-12 group w-full rounded-2xl border border-neutral-200 hover:border-yellow-100 hover:bg-yellow-100 hover:outline hover:outline-2 hover:outline-offset-4 hover:outline-yellow-300 active:bg-yellow-200">
    <div class="md:col-span-3 col-span-4">
        <div
            class="md:rounded-none md:rounded-l-2xl rounded-l-2xl w-full h-full md:aspect-video aspect-square overflow-hidden">
            <img src="{{ isset($d->thumbnail) ? asset('storage/' . $d->thumbnail) : asset('img/no-image.png') }}"
                class="w-full h-full object-cover" alt="">
        </div>
    </div>
    <div class="flex items-center md:col-span-7 col-span-7 md:ml-5 ml-3 md:my-0 my-5">
        <div class="">
            @if ($d->pinned == 1)
                <div
                    class="md:text-base text-sm rounded-md bg-yellow-100 inline-block px-2 text-gray-800 group-hover:bg-yellow-200 group-active:bg-yellow-300">
                    📌Dipin oleh pengurus
                </div>
            @endif
            <h5 class="mb-1 md:line-clamp-2 line-clamp-2 md:text-xl text-sm">{{ $d->judul }}</h5>
            <div class="text-gray-700 md:text-base text-xs"><span class="font-semibold">{{ $d->user->nama ?? '[Akun dihapus]' }}</span>
                • {{ $d->updated_at->format('d F Y') }}
            </div>
        </div>
    </div>
</a>
