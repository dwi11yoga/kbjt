{{-- $idBanner=id banner yang ditampilkan --}}

{{-- banner --}}
@if (isset($banner) && !empty($banner[$idBanner]['status']) && isset($banner[$idBanner]['img']))
    <div class="rounded-xl bg-gray-200 w-full overflow-hidden relative">
        <a href="{{ $banner[$idBanner]['url'] ?? '#' }}" title="{{ $banner[$idBanner]['hover_title'] }}" target="_blank">
            <img src="{{ asset('storage/' . $banner[$idBanner]['img']) }}" alt="Banner {{ $idBanner }}"
                class="w-full h-full">
        </a>
        {{-- keterangan iklan --}}
        @if ($banner[$idBanner]['iklan'] == 1)
            <div class="absolute top-2.5 right-2.5 text-xs bg-black bg-opacity-30 text-white  px-2 py-1 rounded-md">
                Ad
            </div>
        @endif
    </div>
@endif

{{-- banner 2 --}}
{{-- <div class="rounded-xl bg-gray-200 w-full overflow-hidden">
    <a href="{{ $banner[2]['link'] }}">
        <img src="{{ asset('storage/' . $banner[2]['img']) }}" alt="Banner" class="w-full h-full">
    </a>
</div> --}}
