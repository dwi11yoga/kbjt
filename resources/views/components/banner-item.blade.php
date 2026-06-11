@props(['banner', 'modelEdit'])

{{-- banner 1 --}}
<div class="md:col-span-1 col-span-3 relative">

    <div class="absolute top-3 right-3 flex flex-wrap gap-1 items-center">
        {{-- jika banner disembunyikan  --}}
        @if (isset($banner['img']) && empty($banner['status']))
            <x-badge color="bg-red-200 group" gap="1">
                <i data-lucide='eye-off' class="size-5"></i>
                <div class="hidden group-hover:block">Disembunyikan</div>
            </x-badge>
        @endif
        {{-- author tarakhir yang mengedit --}}
        @if (isset($banner['user_id']))
            <x-badge padding="p-1 pr-2" gap="1">
                <x-avatar avatarUrl="{{ $banner['user']['profile_pic'] }}" size="5" rounded="full" />
                <div class="text-sm">
                    {{ $banner['user']['nama'] ?? ['Akun dihapus'] }}
                </div>
            </x-badge>
        @endif
    </div>

    {{-- gambar --}}
    @if (isset($banner['img']))
        <div class="w-full bg-neutral-200 dark:bg-zinc-800 rounded-t-xl text-neutral-400 dark:text-zinc-200">
            <img id="bannerPreview-1" src="{{ asset('storage/' . $banner['img']) }}" alt="Banner belum disetel"
                class="object-cover w-full rounded-t-xl">
        </div>
    @else
        <div class="w-full py-4 px-5 bg-neutral-200 dark:bg-zinc-800 rounded-t-xl text-neutral-400 dark:text-zinc-200">
            <div class="object-cover min-h-40 rounded-xl flex items-center justify-center">
                <img id="bannerPreview-1" src="" alt="Belum ada gambar">
            </div>
        </div>
    @endif

    <button wire:click='{{ $modelEdit }}'
        class="bg-neutral-100 dark:bg-zinc-800 w-full rounded-b-xl py-4 px-5 hover:bg-amber-300 dark:hover:bg-amber-800 cursor-pointer max-h-14 flex justify-between">
        <div>Edit</div>
        <i data-feather='edit-3' class="w-5"></i>
    </button>

    @error('emblem')
        <div class="text-xs text-red-600 mb-2">*{{ $message }}</div>
    @enderror
</div>
