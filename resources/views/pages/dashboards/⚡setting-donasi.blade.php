<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use App\Models\User;

new class extends Component {
    #[Title('Terima donasi')]
    #[Layout('layouts.dashboard')]
    public $terimaDonasi;
    public $metode_donasi;
    public $rekening;
    public $methods = ['Allobank', 'BCA', 'BNI', 'BRI', 'BSI', 'Commonwealth Bank', 'DANA', 'Gopay', 'Jago', 'Jenius', 'Mandiri', 'OVO', 'Saweria', 'Trakteer'];

    // muat data pengguna
    public function mount()
    {
        $donasi = auth()->user()->donasi;
        if (!empty($donasi)) {
            $this->terimaDonasi = 1;
            $this->metode_donasi = $donasi['metode'];
            $this->rekening = $donasi['rekening'];
        }
    }

    // tentukan nama label sesuai metode pembayaran yang dipilih
    #[Computed]
    public function rekeningLabel()
    {
        $rekening = ['Allobank', 'BCA', 'BNI', 'BRI', 'BSI', 'Commonwealth Bank', 'Jago', 'Jenius', 'Mandiri'];
        $telp = ['DANA', 'Gopay', 'OVO'];
        $url = ['Saweria', 'Trakteer'];
        if (in_array($this->metode_donasi, $url)) {
            $label = 'Tautan';
        } elseif (in_array($this->metode_donasi, $telp)) {
            $label = 'Nomor telepon';
        } else {
            $label = 'Rekening';
        }

        return $label;
    }

    // validasi
    public function rules()
    {
        // jika tidak menerima donasi, set menjadi nullable
        if (empty($this->terimaDonasi)) {
            return ['metode_donasi' => 'nullable', 'rekening' => 'nullable'];
        }

        $rules['metode_donasi'] = 'required';
        if ($this->rekeningLabel == 'Tautan') {
            $rules['rekening'] = 'required|url';
        } elseif ($this->rekeningLabel == 'Nomor telepon') {
            $rules['rekening'] = 'required|digits_between:10,13';
        } else {
            $rules['rekening'] = 'required|digits_between:10,16';
        }
        return $rules;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }
    // simpan
    public function save()
    {
        // validasi
        $this->validate();

        if (!empty($this->terimaDonasi)) {
            // jika donasi di-enable
            $data = [
                'metode' => $this->metode_donasi,
                'rekening' => $this->rekening,
            ];
        } else {
            // jika donasi di-disable
            $data = null;
        }

        // simpan data
        User::find(Auth::user()->id)->update(['donasi' => $data]);

        // kembalikan ke view
        // kembali ke view
        $this->dispatch('notify', type: 'success', message: 'Data berhasil diperbarui');
        return;
    }
};
?>

<form wire:submit='save' class="space-y-2">
    @csrf
    {{-- email --}}
    <x-input-toggle id="terimaDonasi" model="terimaDonasi" label="Terima donasi"
        footnote="Izinkan pengguna menunjukkan terima kasih melalui donasi." />
    @if ($terimaDonasi)
        <x-radio-group model="metode_donasi" name="Metode donasi" rounded="rounded-2xl grid md:grid-cols-4 grid-cols-1">
            @foreach ($methods as $method)
                <x-input-radio style="2" model="metode_donasi" id="{{ $method }}" value="{{ $method }}"
                    text="{{ $method }}" />
            @endforeach
        </x-radio-group>
        <x-input id="rekening" model="rekening" label="{{ $this->rekeningLabel }}" />
    @endif
    {{-- simpan --}}
    <x-button type="submit" icon="save" text="Simpan" textLoading="Menyimpan..." target="save" />
</form>
