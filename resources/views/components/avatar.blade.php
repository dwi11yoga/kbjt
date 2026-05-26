@props(['avatarUrl', 'size' => 8, 'rounded' => 'md'])

<div class="aspect-square w-{{ $size }} h-{{ $size }} rounded-{{ $rounded }} overflow-hidden">
    @if (!empty($avatarUrl))
        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $avatarUrl) }}" alt="Profile picture">
    @else
        <img class="w-full h-full object-cover" src="{{ asset('storage/profile-pics/profile_pic-m.jpg') }}"
            alt="Profile picture (Freepik/gstudioimagen)">
    @endisset
</div>
