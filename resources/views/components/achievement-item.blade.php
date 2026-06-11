@props(['achievement'])

<div
    class="p-5 rounded-xl grid md:grid-cols-12 grid-cols-10 space-x-4 hover:outline hover:outline-amber-400 border dark:border-zinc-800 border-neutral-200">

    <div class="md:col-span-1 col-span-3 flex items-center justify-center rounded-md overflow-hidden">
        <img src="{{ asset(isset($achievement->emblem) ? 'storage/' . $achievement->emblem : 'storage/achievement/no-icon.jpg') }}"
            class="w-full {{ $achievement->achieved != 1 && isset(auth()->user()->role) && auth()->user()->role != 'kepala' ? 'grayscale' : '' }}"
            alt="Icon">
    </div>

    {{-- detail --}}
    <div class="md:col-span-11 col-span-7 flex items-center">
        <div class="w-full space-y-2">
            <div class="">
                <div class="capitalize font-medium">{{ $achievement->nama }}</div>
                <div class="text-sm line-clamp-2 text-neutral-600 dark:text-zinc-400">{{ $achievement->deskripsi }}</div>
                <div class="text-sm flex items-center space-x-1">
                    <div class="flex space-x-0.5 items-center">
                        <i data-lucide='astroid' class="w-4 fill-black"></i>
                        <div>{{ $achievement->reward }} •</div>
                    </div>
                    <div>{{ $achievement->progress }}</div>
                    @isset($achievement->date_achieved)
                        <div class="text-sm md:block hidden"></span>• Diperoleh pada
                            {{ $achievement->date_achieved->translatedFormat('j F Y H:i') }}
                            WIB.</div>
                    @endisset
                </div>
                {{-- mobile --}}
                @isset($achievement->date_achieved)
                    <div class="text-sm md:hidden"></span>Diperoleh pada
                        {{ $achievement->date_achieved->translatedFormat('j F Y H:i') }} WIB.
                    </div>
                @endisset
            </div>
            {{-- progress --}}
            <div class="relative md:w-1/3 w-full">
                <div class="absolute w-full bg-neutral-200 rounded-full py-1 "></div>
                <div class="absolute bg-amber-400 rounded-full py-1" style="width: {{ $achievement->progress }}">
                </div>
            </div>
        </div>
    </div>
</div>
