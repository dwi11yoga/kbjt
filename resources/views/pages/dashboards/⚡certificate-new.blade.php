<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use App\Models\Sertifikat;

new class extends Component {
    #[Title('Sertifikat')]
    #[Layout('layouts.dashboard')]
    public $nama;
    public $role = 'semua';
    public $rule;
    public $requirement;
    public $reward;

    // validasi
    public function rules()
    {
        // validasi
        $rules = [
            'nama' => 'required|min:6|max:255|unique:sertifikat,nama',
            'role' => 'required',
            'requirement' => 'required|numeric|min:1',
            'reward' => 'required|numeric|min:0',
        ];
        if ($this->role != 'pengurus') {
            $rules['rule'] = 'required|not_in:kontribusiPengurus';
        } else {
            $rules['rule'] = 'required';
        }

        return $rules;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }
    public function save()
    {
        // cek apakah pengguna adalah kepala
        if (auth()->user()->role != 'kepala') {
            abort(403, 'Akses ditolak');
        }

        // validasi
        $this->validate();

        // ubah role 'semua' jadi null
        $role = $this->role == 'semua' ? null : $this->role;

        // simpan di database
        Sertifikat::create([
            'nama' => $this->nama,
            'role' => $role,
            'rule' => $this->rule,
            'requirement' => $this->requirement,
            'reward' => $this->reward,
        ]);

        // kembali ke halaman sertifikat
        return redirect()->to('/sertifikat')->with('success', 'Sertifikat baru berhasil disimpan');
    }
};
?>

<form wire:submit='save' class="space-y-3">
    @csrf
    {{-- nama --}}
    <x-input id="nama" model="nama" label="Nama" :autofocus="true" placeholder="Masukkan nama deskriptif..." />

    {{-- Untuk role --}}
    <x-radio-group name="Untuk" model="role" rounded="rounded-2xl overflow-hidden">
        <x-input-radio style="2" id="role-semua" model="role" value="semua" text="Semua" />
        <x-input-radio style="2" id="role-kontributor" model="role" value="kontributor" text="Kontributor" />
        <x-input-radio style="2" id="role-pengurus" model="role" value="pengurus" text="Pengurus" />
    </x-radio-group>

    {{-- kategori/rule --}}
    <x-radio-group name="Kategori" model="rule" rounded="rounded-2xl overflow-hidden">
        <x-input-radio style="2" id="kategori-keanggotaan" model="rule" value="keanggotaan"
            text="Lama terdaftar sebagai anggota" />
        <x-input-radio style="2" id="kategori-kontribusi" model="rule" value="kontribusi"
            text="Total kontribusi anggota" />
        <x-input-radio style="2" id="kategori-kontribusiPengurus" model="rule" value="kontribusiPengurus"
            text="Total kontribusi anggota sebagai pengurus" />
    </x-radio-group>

    {{-- requirement --}}
    <x-input type="number" id="requirement" model="requirement"
        label="Nilai kontribusi minimal {{ $rule == 'keanggotaan' ? '(hari)' : '' }}" />

    {{-- reward --}}
    <x-input type="number" id="reward" model="reward" label="Poin bonus" />

    <div class="text-sm text-red-600">Sertifikat yang tersimpan tidak dapat dihapus. Lanjutkan?</div>

    {{-- button simpan --}}
    <x-button type="submit" target="save" icon="save" text="Simpan" textLoading="Menyimpan..." />
</form>
