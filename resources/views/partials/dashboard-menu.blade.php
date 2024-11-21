{{-- Menu --}}
<div class="">
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
                <i data-feather='grid'
                    class="{{ $group == 'dashboard' ? 'fill-neutral-800 text-neutral-800' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'dashboard' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Dashboard
                </div>
            </div>
        </a>

        {{-- Kontribusi --}}
        <a href="/kontribusi">
            <div class="flex group py-3 px-4 rounded-xl {{ $group == 'kontribusi' ? 'bg-amber-100' : '' }}">
                <i data-feather='edit-2'
                    class="{{ $group == 'kontribusi' ? 'fill-neutral-800 stroke-none' : 'text-neutral-700 group-hover:text-black' }}"></i>
                <div
                    class="inline-block ml-3 {{ $group == 'kontribusi' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Kontribusi
                </div>
            </div>
        </a>

        {{-- Achivement --}}
        <a href="/achivement">
            <div class="flex group py-3 px-4 rounded-xl {{ $group == 'achivement' ? 'bg-amber-100' : '' }}">
                {{-- <i data-feather='star' class="{{ $group == 'achivement' ? 'fill-neutral-800 stroke-none' : 'text-neutral-700 group-hover:text-black' }}"></i> --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-award">
                    <polyline
                        class="{{ $group == 'achivement' ? 'fill-neutral-800 stroke-none' : 'text-neutral-700 group-hover:text-black' }}"
                        points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                    <circle
                        class="{{ $group == 'achivement' ? 'fill-neutral-800 stroke-amber-100' : 'text-neutral-700 group-hover:text-black' }}"
                        cx="12" cy="8" r="7"></circle>
                </svg>
                <div
                    class="inline-block ml-3 {{ $group == 'achivement' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Achivement
                </div>
            </div>
        </a>

        {{-- sertifikat --}}
        <a href="/sertifikat">
            <div class="flex group py-3 px-4 rounded-xl {{ $group == 'sertifikat' ? 'bg-amber-100' : '' }}">
                {{-- <i data-feather='file-text' class="{{ $group == 'sertifikat' ? '' : 'text-neutral-700 group-hover:text-black' }}"></i> --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-file-text">
                    <path
                        class="{{ $group == 'sertifikat' ? 'fill-neutral-800 stroke-none' : 'text-neutral-700 group-hover:text-black' }}"
                        d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline
                        class="{{ $group == 'sertifikat' ? 'stroke-amber-100' : 'text-neutral-700 group-hover:text-black' }}"
                        points="10 9 9 9 8 9"></polyline>
                    <polyline
                        class="{{ $group == 'sertifikat' ? 'fill-amber-100 stroke-none' : 'text-neutral-700 group-hover:text-black' }}"
                        points="14 2 14 8 20 8"></polyline>
                    <line
                        class="{{ $group == 'sertifikat' ? 'stroke-amber-100' : 'text-neutral-700 group-hover:text-black' }}"
                        x1="16" y1="13" x2="8" y2="13"></line>
                    <line
                        class="{{ $group == 'sertifikat' ? 'stroke-amber-100' : 'text-neutral-700 group-hover:text-black' }}"
                        x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
                <div
                    class="inline-block ml-3 {{ $group == 'sertifikat' ? '' : 'text-neutral-700 group-hover:text-black' }}">
                    Sertifikat
                </div>
            </div>
        </a>

        {{-- Pengaturan --}}
        <a href="/pengaturan">
            <div class="flex group py-3 px-4 rounded-xl {{ $group == 'settings' ? 'bg-amber-100' : '' }}">
                {{-- <i data-feather='settings' class="{{ $group == 'settings' ? 'fill-neutral-800 stroke-none' : 'text-neutral-700 group-hover:text-black' }}"></i> --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-settings">
                    <path
                        class="{{ $group == 'settings' ? 'fill-neutral-800 stroke-none' : 'text-neutral-700 group-hover:text-black' }}"
                        d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                    </path>
                    <circle
                        class="{{ $group == 'settings' ? 'fill-amber-100 stroke-none' : 'text-neutral-700 group-hover:text-black' }}"
                        cx="12" cy="12" r="3"></circle>
                </svg>
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
