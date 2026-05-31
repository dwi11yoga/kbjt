@props(['definition'])

<x-popup title="Bagikan" color="green">
    <x-share id="share" :separator="false" width="w-full"
        desc="Ikut berkontribusi dalam menyebarkan pengetahuan Bahasa Jawa dengan membagikan definisi ini kepada orang-orang di sekitar Anda."
        url="{{ request()->root() }}/kosakata/{{ $definition->kosakata }}?id={{ $definition->id }}"
        shareText="Cek definisi dari kosakata {{ $definition->kosakata }} ini!" />
    <div wire:click='$toggle("openShare")'>
        <x-button type="button" width="w-full" icon="x" color="hover:outline outline-2" text="Batal" />
    </div>
</x-popup>
