<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use App\Models\Achievement;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

new class extends Component {
    use WithFileUploads;

    // id achievement dari url
    public $id;

    #[Title('Edit penghargaan')]
    #[Layout('layouts.dashboard')]
    public $nama;
    public $emblem; // icon baru
    public $emblemExisting; // icon achieement sebelumnya
    public $deskripsi;
    public $role;
    public $rule;
    public $requirement;
    public $reward;

    // dapatkan data achievement yang mau diedit
    public function mount()
    {
        $data = Achievement::find($this->id);
        $this->nama = $data->nama;
        $this->emblemExisting = $data->emblem;
        $this->deskripsi = $data->deskripsi;
        $this->role = empty($data->role) ? 'semua' : $data->role;
        $this->rule = $data->rule;
        $this->requirement = $data->requirement;
        $this->reward = $data->reward;
    }

    // set role yang dapat dipilih pengguna
    #[Computed]
    public function ruleOptions()
    {
        $rules = [
            '' => 'Pilih',
            'keanggotaan' => 'Lama terdaftar sebagai anggota',
            'definisi' => 'Jumlah definisi yang user buat',
            'laporan' => 'Jumlah laporan yang user kirim',
            'totalViewKosakata' => 'Total jumlah view pada semua kosakata user',
            'viewKosakata' => 'Jumlah view pada satu kosakata',
        ];
        if ($this->role == 'pengurus') {
            // tambahan rule khusus untuk pengurus
            $addRules = [];
            $rules = array_merge($rules, [
                'artikel' => 'Jumlah artikel yang user publikasikan', //
                'totalViewBlog' => 'Total jumlah view pada semua artikel user',
                'viewBlog' => 'Jumlah view pada satu artikel',
            ]);
        }
        return $rules;
    }

    // validasi
    public function rules()
    {
        $validationRules = [
            'nama' => 'required|min:3|unique:achievements,nama,' . $this->id . ',id',
            'role' => 'required',
            'deskripsi' => 'required',
            'rule' => ['required', Rule::in(array_keys($this->ruleOptions))],
            'requirement' => 'required|numeric|min:1',
            'reward' => 'required|numeric|min:0',
            'emblem' => 'nullable|mimes:png,jpg,webp,jpeg|image|max:1024|dimensions:ratio=1/1',
        ];
        return $validationRules;
    }

    // validasi input saat ada perubahan
    public function updated($field)
    {
        $this->validateOnly($field);
    }

    // simpan perubahan data achievement
    public function save()
    {
        // validasi
        $this->validate();
        $role = $this->role != 'semua' ? $this->role : null;

        // set nilai yang akan disimpan
        $data = [
            'nama' => $this->nama,
            'deskripsi' => $this->deskripsi,
            'role' => $role,
            'rule' => $this->rule,
            'requirement' => $this->requirement,
            'reward' => $this->reward,
        ];

        // jika emblem diisi
        if (!empty($this->emblem)) {
            // hapus gambar semelumnya
            Storage::disk('public')->delete($this->emblemExisting);
            // simpan gambar baru
            $data['emblem'] = $this->emblem->store('achievement', 'public');
        }

        // simpan data ke database
        Achievement::find($this->id)->update($data);

        // kembalikan ke halaman achieevement
        return redirect()->to('/achievement')->with('success', 'Achievement berhasil diedit');
    }
};
?>

<form wire:submit='save' class="space-y-3">
    @csrf
    {{-- nama --}}
    <x-input id="nama" model="nama" label="Nama" autofocus="true" />
    {{-- emblem --}}
    <x-input-file id="emblem" model="emblem" label="Icon" fileTypes="JPG, JPEG, PNG, WEBP" maxSize="500KB" ratio="1:1"
        fileName="{{ isset($emblem) ? $emblem->getClientOriginalName() : null }}"
        filePreviewUrl="{{ isset($emblem) && !$errors->has('emblem') ? $emblem->temporaryUrl() : ($emblemExisting ? asset('storage/' . $emblemExisting) : null) }}" />
    {{-- deskripsi --}}
    <x-input-textarea id="deskripsi" model="deskripsi" label="Deskripsi" />
    {{-- role --}}
    <x-radio-group name="Untuk" model="role" rounded="rounded-2xl">
        <x-input-radio style="2" model="role" id="semua" value="semua" text="Semua" />
        <x-input-radio style="2" model="role" id="kontributor" value="kontributor" text="Kontributor" />
        <x-input-radio style="2" model="role" id="pengurus" value="pengurus" text="Pengurus" />
    </x-radio-group>
    {{-- kategori --}}
    <x-input-select model="rule" id="kategori" label="Kategori" :options="$this->ruleOptions" />
    {{-- req --}}
    <x-input id="requirement" model="requirement"
        label="Nilai kontribusi minimal {{ $rule == 'keanggotaan' ? '(hari)' : '' }}" />
    {{-- reward --}}
    <x-input id="reward" model="reward" label="Poin bonus" />

    {{-- button simpan --}}
    <x-button type="submit" target="save" icon="save" text="Simpan" textLoading="Menyimpan..." />
</form>
