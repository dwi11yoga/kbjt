{{-- $idBanner=id banner yang ditampilkan --}}

{{-- banner --}}
@if (isset($banner) && $banner[$idBanner]['status'] === 1 && isset($banner[$idBanner]['img']))
    <div class="rounded-xl bg-gray-200 w-full overflow-hidden">
        <a href="{{ $banner[$idBanner]['link'] }}">
            <img src="{{ asset('storage/' . $banner[$idBanner]['img']) }}" alt="Banner {{ $idBanner }}"
                class="w-full h-full">
        </a>
    </div>
@endif

{{-- banner 2 --}}
{{-- <div class="rounded-xl bg-gray-200 w-full overflow-hidden">
    <a href="{{ $banner[2]['link'] }}">
        <img src="{{ asset('storage/' . $banner[2]['img']) }}" alt="Banner" class="w-full h-full">
    </a>
</div> --}}
