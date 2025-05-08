{{-- petunjuk penggunaan --}}
<?php
// $alert=['warna'=>'red/green/blue/etc',
// 'pesan'=>'lorem',
// 'textsize'=>'sm'];
?>

<div
    class="md:flex md:justify-between bg-{{ $alert['warna'] }}-100 rounded-xl p-3 shadow-sm mb-4 text-{{ $alert['textsize'] ?? 'base' }}">
    {{ $alert['pesan'] }}
</div>
