@props(['details'])

{{-- detail laporan --}}
<x-bento-item title="Detail laporan">
    <x-slot:rightTitle>
        {{-- status --}}
        <x-badge gap="1" color="{{ isset($details->status) ? 'dark:bg-green-900 bg-green-100' : 'dark:bg-red-900 bg-red-100' }}" hoverColor="">
            <i data-lucide='{{ isset($details->status) ? 'check-circle' : 'circle-alert' }}' class="size-4"></i>
            <span>{{ !empty($details->status) ? 'Selesai' : 'Pending' }}</span>
        </x-badge>
    </x-slot:rightTitle>
    <div class="space-y-2">
        <x-report-detail-item label="ID" value="{{ $details->idZerofill }}" />
        <x-report-detail-item label="Waktu" value="{{ dateFormat($details->created_at) }}" />
        <x-report-detail-item label="Alasan" value="{{ ucfirst($details->alasan) }}" />
        <x-report-detail-item label="Catatan pelapor" value="{{ $details->catatan ?? 'Tidak ada' }}" />
    </div>
</x-bento-item>
