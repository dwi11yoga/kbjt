<div class="md:col-start-2 md:col-span-3 col-span-6">
    <div
        class="bg-white rounded-2xl p-6 mb-4 border border-neutral-200 hover:outline hover:outline-2 hover:outline-amber-400">
        {{-- Kosakata --}}
        <h5 class="font-semibold mb-4 capitalize"><a href="/kosakata/{{ $d->slug }}">{{ $d->kosakata }}</a></h5>

        {{-- Definisi --}}
        <p class="mb-3">{{ $d->definisi }}</p>

        {{-- Contoh kalimat --}}
        @if (isset($d->contoh) && $d->contoh != [''])
            <p>Contoh kalimat:</p>
            <ul class=" list-inside italic">
                @foreach ($d->contoh as $c)
                    <li>{{ $c }}</li>
                @endforeach
            </ul>
        @endif

        {{-- Referensi --}}
        @if (isset($d->referensi) && $d->referensi != [''])
            <div class="italic font-light small-text mt-4">
                <p>Referensi</p>
                <ul class="list-decimal list-inside">
                    @foreach ($d->referensi as $r)
                        <li>
                            @if (filter_var($r, FILTER_VALIDATE_URL))
                                <a href="{{ $r }}" target="_blank"
                                    class="hover:underline hover:decoration-amber-400 hover:underline-offset-2 hover:decoration-2">{{ $r }}</a>
                            @else
                                {{ $r }}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- Author --}}
        <p class="mt-4 mb-2">Disubmit oleh</p>
        {{-- <div class="rounded-full w-12 h-12 bg-yellow-400 float-left mr-3"></div> --}}
        <div class="flex justify-between items-end">
            <div class="flex items-center">
                <a href="/u/{{ $d->user->username }}">
                    <div class="h-12 w-12 rounded-full overflow-hidden mr-3">
                        @include('partials.profil-pic-general-array2')
                    </div>
                </a>
                <a href="/u/{{ $d->user->username }}">
                    <div>{{ $d->user->nama }}</div>
                    <div class="small-text">{{ $d->created_at->format('d F Y') }}</div>
                </a>
            </div>
            <div><i data-feather='more-vertical'></i></div>
        </div>
    </div>
</div>
