{{-- banner ucapan terima kasih kepada pengurus/kontributor --}}
<div class="md:col-span-2 col-span-1">
    <x-bento-item color="bg-amber-50 text-amber-700">
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                <div class="font-semibold text-lg">Terima kasih, {{ auth()->user()->nama }}!</div>
                <div class="">
                    Berkat dirimu, komunitas dapat terjaga dari definisi atau kosakata bahasa jawa yang
                    keliru.
                </div>
            </div>
            <div class="w-[50%]">
                <img src="{{ asset('img/Apologize-by-storyset.png') }}"
                    alt="Family protection concept illustration by storyset (freepik)">
            </div>
        </div>
    </x-bento-item>
</div>
