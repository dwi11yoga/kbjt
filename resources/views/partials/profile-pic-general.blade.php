{{-- Profil pic untuk menampilkan foto semua user --}}

@if ($d->profile_pic != null)
    <img class="w-full h-full object-cover" src="{{ asset('storage/' . $d->profile_pic) }}" alt="Foto profil">
@else
    @if ($d->jenis_kelamin == 'Perempuan')
        <img class="w-full h-full object-cover" src="{{ asset('storage/profile-pics/profile_pic-f.jpg') }}"
            alt="Foto profil (Freepik/gstudioimagen)">
    @else
        <img class="w-full h-full object-cover" src="{{ asset('storage/profile-pics/profile_pic-m.jpg') }}"
            alt="Foto profil (Freepik/gstudioimagen)">
    @endif
@endif
