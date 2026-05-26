@props(['word', 'desc' => null, 'url'])

<a href="/kosakata/{{ $url }}"
    class="block py-4 px-4 rounded-2xl ease-in-out transition-all hover:outline outline-2 bg-neutral-50 outline-amber-400 hover:bg-neutral-100 active:bg-neutral-200">
    <div class="first-letter:text-2xl first-letter:font-bold first-letter:font-serif">{{ $word }}</div>
    <div class="text-sm text-neutral-600">{{ $desc }}</div>
</a>
