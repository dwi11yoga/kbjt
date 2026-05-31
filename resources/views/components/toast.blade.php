@props(['type' => 'session'])

@if ($type === 'session')
    {{-- via session (pindah halaman/load ulang halaman) --}}
    @if (session()->has('success') || session()->has('failed'))
        <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
            class="z-50 fixed bottom-5 right-5 bg-neutral-800 text-white px-5 py-3 rounded-lg {{ session()->has('success') ? 'bg-neutral-800' : 'bg-red-600' }}">
            {{ session('success') ?? session('failed') }}
        </div>
    @endif
@else
    {{-- tanpa session, pakai dispatch --}}
    <div x-data="{ show: false, message: '', type: '' }"
        x-on:notify.window="show=true; message=$event.detail.message; type=$event.detail.type; setTimeout(()=>show=false,3000)">
        <div x-show="show" x-transition :class="type === 'success' ? 'bg-neutral-800' : 'bg-red-600'"
            class="z-50 fixed bottom-5 right-5 text-white px-5 py-3 rounded-lg" x-text="message">
        </div>
    </div>
@endif
