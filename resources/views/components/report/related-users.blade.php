@props(['details'])

{{-- pelapor, terlapor, dan pengurus --}}
<x-bento-item title="Pengguna terkait">
    <div class="space-y-2">
        {{-- pengguna pelapor --}}
        <x-report-detail-item label="Pelapor">
            <x-slot:value>
                <div class="flex flex-wrap items-center gap-1">
                    <x-avatar size="7"
                        avatarUrl="{{ $details->author->id == auth()->user()->id ? '#' : $details->user->profile_pic }}" />
                    <a href="{{ $details->author->id == auth()->user()->id ? '#' : '/u/' . $details->user->username }}"
                        class="hover:underline underline-offset-4 decoration-4 decoration-amber-400">
                        {{ $details->author->id == auth()->user()->id ? '[Pengguna dirahasiakan]' : $details->user->nama }}
                    </a>
                    @if (!empty($details->poin_pelapor) && auth()->user()->id != $details->author->id)
                        <x-badge color="bg-amber-200">
                            <i data-lucide='astroid' class="size-4 fill-black"></i>
                            <div class="">+{{ $details->poin_pelapor }} Poin</div>
                        </x-badge>
                    @endif
                </div>
            </x-slot:value>
        </x-report-detail-item>

        {{-- terlapor --}}
        <x-report-detail-item label="Terlapor {{ $details->author->trashed() ? '(akun dihapus)' : '' }}">
            <x-slot:value>
                <div class="flex flex-wrap items-center gap-1">
                    <x-avatar size="7" avatarUrl="{{ $details->author->profile_pic }}" />
                    <a href="/u/{{ $details->author->username }}"
                        class="hover:underline underline-offset-4 decoration-4 decoration-amber-400">
                        {{ $details->author->nama }}
                    </a>
                    @if (!empty($details->poin_terlapor))
                        <x-badge color="bg-red-100" hoverColor="bg-red-300">
                            <i data-lucide='astroid' class="size-4 fill-black"></i>
                            <div class="">-{{ $details->poin_terlapor }} Poin</div>
                        </x-badge>
                    @endif
                </div>
            </x-slot:value>
        </x-report-detail-item>

        {{-- penindaklanjut --}}
        @if (!empty($details->pengurus) && in_array(auth()->user()->role, ['pengurus', 'kepala']))
            <x-report-detail-item label="Penindaklanjut">
                <x-slot:value>
                    <div class="flex flex-wrap items-center gap-1">
                        <x-avatar size="7" avatarUrl="{{ $details->pengurus->profile_pic }}" />
                        <a href="/u/{{ $details->pengurus->username }}"
                            class="hover:underline underline-offset-4 decoration-4 decoration-amber-400">
                            {{ $details->pengurus->nama }}
                        </a>
                        @if (!empty($details->poin_pengurus))
                            <x-badge color="bg-amber-200">
                                <i data-lucide='astroid' class="size-4 fill-black"></i>
                                <div class="">+{{ $details->poin_pengurus }} Poin</div>
                            </x-badge>
                        @endif
                    </div>
                </x-slot:value>
            </x-report-detail-item>
        @endif
    </div>
</x-bento-item>
