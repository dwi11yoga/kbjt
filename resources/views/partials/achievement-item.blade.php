<div
    class="px-5 py-6 bg-white rounded-2xl grid md:grid-cols-12 grid-cols-10 space-x-4 hover:outline hover:outline-amber-400 border border-neutral-200">

    <div class="md:col-span-1 col-span-3 flex items-center justify-center rounded-md overflow-hidden">
        <img src="{{ asset(isset($d->emblem) ? 'storage/' . $d->emblem : 'storage/achievement/no-icon') }}"
            class="w-full @if ($d->achieved != 1 && auth()->user()->role != 'kepala') grayscale @endif" alt="Icon">
    </div>

    {{-- detail --}}
    <div class="md:col-span-11 col-span-7 flex items-center">
        <div class="w-full space-y-2">
            <div class="">
                <div class="capitalize font-medium">{{ $d->nama }}</div>
                <div class="text-sm line-clamp-2">{{ $d->deskripsi }}</div>
                <div class="text-sm flex items-center space-x-1">
                    <div class="flex space-x-0.5 items-center">
                        <i data-feather='heart' class="w-4 fill-amber-400"></i>
                        <div>{{ $d->reward }} •</div>
                    </div>
                    <div>{{ $d->progress }}</div>
                    @isset($d->date_achieved)
                        <div class="text-sm md:block hidden"></span>— Diperoleh pada {{ $d->date_achieved->translatedFormat('d F Y H:i') }}
                            WIB.</div>
                    @endisset
                </div>
                {{-- mobile --}}
                @isset($d->date_achieved)
                    <div class="text-sm md:hidden"></span>— Diperoleh pada {{ $d->date_achieved->translatedFormat('d F Y H:i') }} WIB.
                    </div>
                @endisset
            </div>
            {{-- progress --}}
            <div class="relative">
                <div class="absolute w-full bg-neutral-200 rounded-full py-1 "></div>
                <div class="absolute bg-amber-400 rounded-full py-1" style="width: {{ $d->progress }}">
                </div>
            </div>
        </div>
    </div>
</div>
