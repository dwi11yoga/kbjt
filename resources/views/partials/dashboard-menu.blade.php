{{-- Menu --}}
<div class="sticky top-7">
    {{-- logo --}}
    <div class="ml-4">
        <a href="/">
            <h4 class="font-bold underline decoration-amber-400 underline-offset-4 decoration-4">kbjt</h4>
        </a>
    </div>

    <div class="space-y-1 mt-5">
        {{-- Dashboard --}}
        <a href="/dashboard">
            <div class="flex group py-3 px-4 rounded-xl {{ $group == 'dashboard' ? 'bg-amber-100' : '' }}">
                <i data-feather='home'
                    class="{{ $group == 'dashboard' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'dashboard' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Dashboard
                </div>
            </div>
        </a>

        {{-- Kontribusi --}}
        <a href="#">
            <div class="flex group py-3 px-4 rounded-xl {{ $group == 'kontribusi' ? 'bg-amber-100' : '' }}">
                <i data-feather='edit-2'
                    class="{{ $group == 'kontribusi' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'kontribusi' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Kontribusi
                </div>
            </div>
        </a>

        {{-- Achivement --}}
        <a href="#">
            <div class="flex group py-3 px-4 rounded-xl {{ $group == 'achivement' ? 'bg-amber-100' : '' }}">
                <i data-feather='award'
                    class="{{ $group == 'achivement' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'achivement' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Achivement
                </div>
            </div>
        </a>

        {{-- sertifikat --}}
        <a href="#">
            <div class="flex group py-3 px-4 rounded-xl {{ $group == 'sertifikat' ? 'bg-amber-100' : '' }}">
                <i data-feather='file-text'
                    class="{{ $group == 'sertifikat' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'sertifikat' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Sertifikat
                </div>
            </div>
        </a>

        {{-- Pengaturan --}}
        <a href="/pengaturan">
            <div class="flex group py-3 px-4 rounded-xl {{ $group == 'settings' ? 'bg-amber-100' : '' }}">
                <i data-feather='settings'
                    class="{{ $group == 'settings' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'settings' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Pengaturan
                </div>
                {{-- <i data-feather='tool' class="{{ $group == 'settings' ? 'fill-yellow-300' : '' }}"></i> --}}
            </div>
        </a>

        {{-- Beranda --}}
        <a href="/" class="">
            <div class=" flex group py-3 px-4 rounded-xl">
                <i data-feather='arrow-left' class="text-neutral-700 group-hover:text-black"></i>
                <div class="inline-block ml-3 text-neutral-700 group-hover:text-black">
                    Beranda
                </div>
            </div>
        </a>

        {{-- <hr class="h-px mx-auto w-3/5"> --}}

        {{-- Ke Beranda --}}
        {{-- <a href="/"
        class="group w-14 h-14 flex justify-center items-center rounded-xl hover:bg-yellow-300 active:bg-yellow-400">
        <i data-feather='arrow-left'></i>
    </a> --}}
    </div>
</div>
