{{-- Profil pic untuk menampilkan foto semua user --}}

@if (isset($d))
    @if ($d['profile_pic'] != null)
        {{-- tampilkan foto profil user --}}
        <img class="w-full h-full object-cover {{ isset($d['statusUser']) && $d['statusUser'] == 'dihapus' ? 'grayscale' : '' }}"
            src="{{ asset('storage/' . $d['profile_pic']) }}" alt="Foto profil">
    @else
        {{-- gunakan foto profil default sesuai jenis kelamin user --}}
        @if ($d['jenis_kelamin'] == 'Perempuan')
            <img class="w-full h-full object-cover {{ isset($d['statusUser']) && $d['statusUser'] == 'dihapus' ? 'grayscale' : '' }}"
                src="{{ asset('storage/profile-pics/profile_pic-f.jpg') }}" alt="Foto profil (Freepik/gstudioimagen)">
        @else
            <img class="w-full h-full object-cover {{ isset($d['statusUser']) && $d['statusUser'] == 'dihapus' ? 'grayscale' : '' }}"
                src="{{ asset('storage/profile-pics/profile_pic-m.jpg') }}" alt="Foto profil (Freepik/gstudioimagen)">
        @endif
    @endif
@else
    <img class="w-full h-full object-cover {{ isset($d['statusUser']) && $d['statusUser'] == 'dihapus' ? 'grayscale' : '' }}"
        src="{{ asset('storage/profile-pics/profile_pic-m.jpg') }}" alt="Foto profil (Freepik/gstudioimagen)">
@endif
