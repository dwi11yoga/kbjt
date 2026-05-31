<?php

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

new class extends Component {
    #[Title('Alih aksara')]
    #[Url]
    public $target = 'aksara-jawa';
    public $baseText, $result;

    public function changeMode()
    {
        if ($this->target == 'aksara-jawa') {
            $this->target = 'latin';
        } else {
            $this->target = 'aksara-jawa';
        }
        $temporary = $this->baseText;
        $this->baseText = $this->result;
        $this->result = $temporary;
    }

    // hapus teks di baseText
    public function clearText()
    {
        $this->baseText = $this->result = '';
    }
};
?>

<div class="space-y-7">
    {{-- judul --}}
    <div class="space-y-3">
        <h1>Alih aksara</h1>
        <p>Konversi teks latin ke aksara jawa dengan mudah.</p>
    </div>

    {{-- konverter --}}
    <div class="space-y-2">
        <button wire:ignore wire:click='changeMode'
            class="px-4 py-2 hover:bg-amber-300 rounded-full flex gap-1 items-center">
            <i data-lucide='arrow-right-left' class="size-5"></i>
            Tukar bahasa
        </button>
        <div class="flex md:flex-row flex-col gap-1 w-full">
            <div class="relative w-full">
                {{-- clear text --}}
                <button wire:ignore wire:click='clearText'
                    class="absolute top-3 right-3 flex items-center gap-1 p-2 rounded-full hover:bg-amber-400 group">
                    <div class="group-hover:block hidden text-sm">Hapus</div>
                    <i data-lucide='x' class="size-4 my-0.5"></i>
                </button>
                {{-- textarea --}}
                <label for="baseText"
                    class="absolute top-3 left-3 bg-amber-400 px-3 py-0.5 rounded-full first-letter:font-serif first-letter:font-bold first-letter:text-xl">
                    {{ $target == 'aksara-jawa' ? 'Latin' : 'Aksara Jawa' }}
                </label>
                <div class="{{ $target == 'latin' ? 'javanese text-lg' : '' }}">
                    <textarea wire:ignore.self wire:model.live.debounce.500ms='baseText' name="baseText" id="baseText"
                        class="min-h-32 p-4 pt-14 border border-neutral-200 rounded-2xl w-full resize-none focus:outline-amber-400"
                        autofocus placeholder="Ketik disini..."></textarea>
                </div>
            </div>
            <div class="relative w-full">
                <button wire:ignore
                    onclick="copyUrl(document.getElementById('result'), document.getElementById('copy'), document.getElementById('copy-success'))"
                    class="absolute top-3 right-3 flex items-center gap-1 p-2 rounded-full hover:bg-amber-400 group">
                    <div class="group-hover:block hidden text-sm">Salin</div>
                    <i id="copy" data-lucide='copy' class="size-4 my-0.5"></i>
                    <i id="copy-success" data-lucide='check' class="size-4 my-0.5 hidden"></i>
                </button>
                <label for="result"
                    class="absolute top-3 left-3 bg-white px-3 py-0.5 rounded-full first-letter:font-serif first-letter:font-bold first-letter:text-xl">
                    {{ $target == 'aksara-jawa' ? 'Aksara Jawa' : 'Latin' }}
                </label>
                <div class="{{ $target == 'aksara-jawa' ? 'javanese text-lg' : '' }}">
                    <textarea wire:ignore.self wire:model.live.debounce.500ms='result' name="result" id="result"
                        class="min-h-32 p-4 pt-14 bg-amber-100 rounded-xl w-full resize-none focus:outline-none" readonly
                        placeholder="Hasil..."></textarea>
                </div>
            </div>
        </div>
    </div>

    <script>
        const convertText = () => {
            const target = @this.get('target');
            const text = document.getElementById('baseText').value;
            // const hasil = target === 'aksara-jawa' ? convertToJavanese(text) :
            //     convertToLatin(text);

            // Pisah per baris, konversi, gabung kembali
            const hasil = text.split('\n').map(line => {
                if (line.trim() === '') return ''; // pertahankan baris kosong
                return target === 'aksara-jawa' ?
                    convertToJavanese(line) :
                    convertToLatin(line);
            }).join('\n');

            @this.set('result', hasil);
            // set ukuran textarea
            converterHeight(document.getElementById('baseText'), document.getElementById('result'));

        };
        document.getElementById('baseText').addEventListener('input', convertText);
    </script>

</div>
