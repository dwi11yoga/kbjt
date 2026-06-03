@props(['details'])

{{-- hasil tindak lanjut --}}
<x-bento-item title="Putusan">
    <div class="space-y-2">
        <x-report-detail-item label="Keputusan"
            value="{{ !empty($details->hukuman) ? 'Pelanggaran ditemukan' : 'Pelanggaran tidak ditemukan' }}" />
        <x-report-detail-item label="Tindakan untuk definisi"
            value="{{ !empty($details->tindakan)
                ? ($details->tindakan == 'edit'
                    ? 'definisi disembunyikan sampai diperbaiki oleh terlapor'
                    : 'Definisi dihapus secara permanen')
                : 'Tidak ada' }}" />
        <x-report-detail-item label="Hukuman untuk terlapor"
            value="{{ !empty($details->hukuman) ? $details->hukuman : 'Tidak ada' }}" />
        <x-report-detail-item label="Catatan" value="{{ $details->catatan_pengurus ?? 'Tidak ada' }}" />
        <x-report-detail-item label="Waktu" value="{{ dateFormat($details->status) }}" />
    </div>
</x-bento-item>
