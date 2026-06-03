@props(['text' => 'Akses ditolak', 'border' => true])

<div
    class="p-12 rounded-2xl flex justify-center items-center text-center flex-col shadow-sm {{ $border ? 'border border-neutral-200' : '' }} w-full">
    <img class="w-56 mb-5" src="https://img.freepik.com/free-vector/403-error-forbidden-concept-illustration_114360-5571.jpg"
        alt="403 error forbidden concept illustration">
    <div class="">{{ $text }}</div>
</div>
