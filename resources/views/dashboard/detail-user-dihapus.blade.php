{{-- View detail user yang menghapus akunnya sendiri  --}}
@extends('layouts.dashboard')
@section('body')
    <div class="grid grid-cols-3 md:gap-2 gap-3">
        {{-- tentang user --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div class="mb-2 flex items-center">
                Tentang {{ $user->role }}
            </div>
            <div class="space-y-2">
                <div>
                    <div class="text-sm">ID</div>
                    <div class="">{{ $user->idZeroFill }}</div>
                </div>
                <div>
                    <div class="text-sm">Nama</div>
                    <div class="">{{ $user->nama }}</div>
                </div>
                <div>
                    <div class="text-sm">Username</div>
                    <div class="">&#64;{{ $user->username }}</div>
                </div>
                <div>
                    <div class="text-sm">Tanggal lahir</div>
                    <div class="">{{ $user->tgl_lahir?->translatedFormat('d F Y') ?? 'T/A' }}</div>
                </div>
                <div>
                    <div class="text-sm">Kota asal</div>
                    <div class="">{{ $user->kota ?? 'T/A' }}</div>
                </div>
            </div>
        </div>

        {{-- kontribusi user --}}
        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            <div class="mb-2 flex items-center">
                Kontribusi
            </div>
            <div class="space-y-2">
                <div>
                    <div class="text-sm">Level</div>
                    <div class="">{{ $user->level }}</div>
                </div>
                <div>
                    <div class="text-sm">Poin</div>
                    <div class="">{{ number_format($user->poin, 0, ',', '.') }}</div>
                </div>
                <div>
                    <div class="text-sm">Total kontribusi</div>
                    <div class="">{{ $user->kontribusi }}</div>
                </div>
                <div>
                    <div class="text-sm">Total Achievement</div>
                    <div class="">{{ $user->totalAchievement }}</div>
                </div>
                <div>
                    <div class="text-sm">Total Sertifikat</div>
                    <div class="">{{ $user->totalSertifikat }}</div>
                </div>
            </div>
        </div>

        <div
            class="md:col-span-1 col-span-3 border bg-white border-neutral-200 rounded-xl px-4 py-5 hover:outline hover:outline-offset-2 hover:outline-amber-400 hover:decoration-1">
            {{-- definisi --}}
            <div class="mb-2 flex items-center">Alasan akun dihapus</div>
            <div class="space-y-1">
                <div>"{{ $alasan->alasan ?? 'Tidak ada' }}"</div>
                <div class="text-sm">— pada
                    {{ $alasan->created_at->translatedFormat('d F Y') }} pukul {{ $alasan->created_at->format('H:i') }}.</div>
            </div>
        </div>
    </div>
@endsection
