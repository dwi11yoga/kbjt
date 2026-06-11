<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use App\Models\User;

new class extends Component {
    use WithFileUploads;
    #[Title('Ubah data diri')]
    #[Layout('layouts.dashboard')]
    #[Validate('required|max:255')]
    public $nama;
    #[Validate('required|date')]
    public $tgl_lahir;
    #[Validate('required')]
    public $jenis_kelamin;
    #[Validate('nullable')]
    public $kota;
    #[Validate('nullable')]
    public $bio;
    #[Validate('nullable|mimes:png,jpg,webp,jpeg|image|max:1024')]
    public $profile_pic;
    // profil pic lama
    public $oldProfile_pic;
    // hapus foto profil
    public $removeAvatar;

    // set data pengguna ke var form
    public function mount()
    {
        $this->nama = auth()->user()->nama;
        $this->tgl_lahir = !empty(auth()->user()->tgl_lahir) ? auth()->user()->tgl_lahir->format('Y-m-d') : null;
        $this->kota = auth()->user()->kota;
        $this->jenis_kelamin = auth()->user()->jenis_kelamin;
        $this->bio = auth()->user()->bio;
        $this->oldProfile_pic = auth()->user()->profile_pic ?? 'avatar/profile_pic-m.jpg';
    }

    // preview avatar
    #[Computed]
    public function avatarPreview()
    {
        if (isset($this->profile_pic) && !$this->getErrorBag()->has('profile_pic')) {
            // jika profil pic diupload
            $preview = $this->profile_pic->temporaryUrl();
        } elseif ($this->removeAvatar || !$this->oldProfile_pic || !Storage::disk('public')->exists($this->oldProfile_pic)) {
            // jika avatar dihapus
            $preview = asset('storage/avatar/profile_pic-m.jpg');
        } elseif ($this->oldProfile_pic && Storage::disk('public')->exists($this->oldProfile_pic)) {
            // selain itu, tampilkan avatar lama pengguna
            $preview = asset('storage/' . $this->oldProfile_pic);
        } else {
            $preview = asset('storage/avatar/profile_pic-m.jpg');
        }

        return $preview;
    }

    // update profil pengguna
    public function update()
    {
        sleep(1);
        // validasi
        $this->validate();

        $arraySimpan = [
            'nama' => $this->nama,
            'tgl_lahir' => $this->tgl_lahir,
            'kota' => $this->kota,
            'jenis_kelamin' => $this->jenis_kelamin,
            'bio' => $this->bio,
        ];

        if ($this->removeAvatar == 1) {
            // jika gambar dihapus
            // hapus foto lama
            if (!empty(auth()->user()->profile_pic)) {
                Storage::disk('public')->delete(auth()->user()->profile_pic);
            }
            $arraySimpan['profile_pic'] = null;
        } elseif (!empty($this->profile_pic)) {
            // jika pengguna upload gambar baru
            // hapus foto lama
            if (!empty(auth()->user()->profile_pic)) {
                Storage::disk('public')->delete(auth()->user()->profile_pic);
            }
            // simpan foto profil baru
            $arraySimpan['profile_pic'] = $this->profile_pic->store('avatar', 'public');
        }
        // jika tidak ada perubahan gambar, maka gambar tidak perlu diedit

        // simpan perubahan di db
        User::find(auth()->user()->id)->update($arraySimpan);

        // reset data auth user
        auth()->setUser(auth()->user()->fresh());

        // ubah toggle jadi off
        $this->removeAvatar = null;

        // kembali ke tampilan
        return redirect()->to('/pengaturan')->with('success', 'Profil berhasil diperbarui');
        // $this->dispatch('notify', type: 'success', message: 'Profil berhasil diperbarui');
        // return;
    }
};
?>

<form wire:submit='update' class="space-y-2">
    @csrf
    {{-- foto profil --}}
    <div class="space-y-1">
        <x-input-file id="profile_pic" model="profile_pic" label="Avatar" fileTypes="JPG, JPEG, PNG, WEBP" maxSize="1024KB"
            fileName="{{ isset($profile_pic) ? $profile_pic->getClientOriginalName() : null }}"
            filePreviewUrl="{{ $this->avatarPreview }}" />
        {{-- opsi hapus foto profil --}}
        @if (!empty(auth()->user()->profile_pic))
            <div class="flex justify-end">
                <x-input-toggle model='removeAvatar' id="removeAvatar" label='Hapus foto profil' />
            </div>
        @endif
    </div>
    {{-- nama --}}
    <x-input label="Nama" model="nama" id="nama" />
    {{-- Jenis kelamin --}}
    <x-radio-group name="Jenis kelamin" rounded="rounded-2xl" model="jenis_kelamin">
        <x-input-radio style="2" model="jenis_kelamin" id="laki-laki" text="Laki-laki" value="Laki-laki" />
        <x-input-radio style="2" model="jenis_kelamin" id="perempuan" text="Perempuan" value="Perempuan" />
    </x-radio-group>
    {{-- Tanggal lahir --}}
    <x-input label="Tanggal lahir" type="date" model="tgl_lahir" id="tgl_lahir" />
    {{-- Kota asal --}}
    <x-input label="Kota asal" model="kota" id="kota" />
    {{-- Bio --}}
    <x-input-textarea label="Bio" model="bio" id="bio" />
    {{-- Tombol simpan --}}
    <x-button type="submit" target="update" text="Simpan perubahan" textLoading="Menyimpan..." icon="save" />
    {{-- <div class="w-full bg-white rounded-xl mb-5 flex justify-between items-center">
        <div>Simpan perubahan?</div>
        <button type="submit" class="text-amber-600 flex items-center">
            <i data-lucide='check' class="w-5"></i>
            <span class="ml-1">Simpan</span>
        </button>
    </div> --}}
</form>
