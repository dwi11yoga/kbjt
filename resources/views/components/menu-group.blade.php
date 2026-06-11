@props(['menuIcon' => 'more', 'menuId' => null])

<div class="relative">
    <button onclick="toggleClass('{{ $menuId }}', 'hidden')"
        class="p-2 rounded-full hover:bg-neutral-100 dark:hover:bg-zinc-800">
        <i data-lucide='{{ $menuIcon }}' class="size-5"></i>
    </button>
    <div id="{{ $menuId }}"
        class="absolute hidden bg-white dark:bg-zinc-800 right-0 top-10 z-40 p-2 rounded-xl border border-neutral-100 dark:border-zinc-700 min-w-48">
        {{ $slot ?? '' }}
    </div>
</div>
