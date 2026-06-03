@props(['details'])

{{-- salinan definisi/kosakata dilaporkan --}}
<x-bento-item title="Salinan definisi dilaporkan">
    @if (!empty($details->definisi_id))
        <x-slot:rightTitle>
            <a href="/kosakata/{{ $details->definisi->kosakata }}?id={{ $details->definisi_id }}"
                class="text-sm flex items-center hover:underline decoration-4 underline-offset-4 decoration-amber-400">
                <div class="">
                    {{ !empty($details->hukuman) && auth()->user()->id == $details->author->id && $details->tindakan == 'edit'
                        ? 'Perbaiki'
                        : 'Lihat' }}
                </div>
                <i data-lucide='arrow-right' class="size-4"></i>
            </a>
        </x-slot:rightTitle>
        <div class="space-y-2">
            <x-report-detail-item label="Kosakata" value="{{ ucfirst($details->definisi->kosakata) }}" />
            <x-report-detail-item label="Definisi" value="{!! strip_tags($details->def_dilaporkan, '<p><b><i><u><s><ol><ul><li>') !!}" />
            <x-report-detail-item label="Terakhir diperbarui" value="{{ dateFormat($details->waktu_definisi) }}" />
            <x-report-detail-item label="Bahasa" value="{{ Str::upper($details->definisi->bahasa) }}" />
        </div>
    @else
        <div>Definisi atau kosakata tidak dapat ditampilkan</div>
    @endif
</x-bento-item>
