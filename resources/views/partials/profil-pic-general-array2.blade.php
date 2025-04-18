@isset($d->user->profile_pic)
    <img class="w-full h-full object-cover {{ isset($d->user->statusUser) && $d->user->statusUser == 'dihapus' ? 'grayscale' : '' }}"
        src="{{ asset('storage/' . $d->user->profile_pic) }}" alt="Profile picture">
@else
    @if (isset($d->user->jenis_kelamin) && $d->user->jenis_kelamin == 'Perempuan')
        <img class="w-full h-full object-cover {{ isset($d->user->statusUser) && $d->user->statusUser == 'dihapus' ? 'grayscale' : '' }}" src="{{ asset('storage/profile-pics/profile_pic-f.jpg') }}"
            alt="Profile picture (Freepik/gstudioimagen)">
    @else
        <img class="w-full h-full object-cover {{ isset($d->user->statusUser) && $d->user->statusUser == 'dihapus' ? 'grayscale' : '' }}" src="{{ asset('storage/profile-pics/profile_pic-m.jpg') }}"
            alt="Profile picture (Freepik/gstudioimagen)">
    @endif
@endisset
