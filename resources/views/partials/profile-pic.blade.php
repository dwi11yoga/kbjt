@if (auth()->user()->profile_pic != null)
    <img class="w-full h-full object-cover" src="{{ asset('storage/' . auth()->user()->profile_pic) }}"
        alt="Profile picture">
@else
    @if (auth()->user()->jenis_kelamin == 'Perempuan')
        <img class="w-full h-full object-cover" src="{{ asset('storage/profile-pics/profile_pic-f.jpg') }}"
            alt="Profile picture (Freepik/gstudioimagen)">
    @else
        <img class="w-full h-full object-cover" src="{{ asset('storage/profile-pics/profile_pic-m.jpg') }}"
            alt="Profile picture (Freepik/gstudioimagen)">
    @endif
@endif
