@props(['text'])

<div
    class="p-12 rounded-2xl flex justify-center items-center text-center flex-col shadow-sm border border-neutral-200 w-full">
    <img src="{{ asset('img/not-found.png') }}" alt="Lost concept illustration (Freepik/storyset)" class="w-56 mb-5">
    <div>{!! $text !!}</div>
</div>
