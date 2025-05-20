<?php

namespace Database\Seeders;

use App\Models\Donasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Donasi::insert([
            [
                'metode' => 'Trakteer',
                'rekening' => null,
                'url' => 'https://www.trakteer.id/kbjt',
                'barcode' => 'donation-barcode/BuUqIRoNBitGDqXVHVQSSCdsm28NcRn6LUYDGVCd.png',
                'cara_donasi' => '
                    <ul>
                        <li>Kunjungi halaman Trakteer kami melalui tautan berikut</li>
                        <li>Masukkan nama (boleh anonim) dan pesan jika ada</li>
                        <li>Klik tombol "Send Support"</li>
                        <li>Pilih jumlah dukungan yang ingin diberikan</li>
                        <li>Pilih metode pembayaran (GoPay, QRIS, dll)</li>
                        <li>Ikuti instruksi hingga pembayaran berhasil</li>
                    </ul>
                ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'metode' => 'Gopay',
                'rekening' => '089765321436',
                'url' => null,
                'barcode' => 'donation-barcode/BuUqIRoNBitGDqXVHVQSSCdsm28NcRn6LUYDGVCd.png',
                'cara_donasi' => '
                    <ul>
                        <li>Buka aplikasi Gojek</li>
                        <li>Pilih menu "Bayar"</li>
                        <li>Pindai QR Code atau masukkan nomor tujuan kami: 08xxxxxxxxxx</li>
                        <li>Masukkan nominal uang yang ingin dikirim</li>
                        <li>Klik "Lanjut", lalu "Bayar"</li>
                    </ul>
                ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'metode' => 'Mandiri',
                'rekening' => '113-00-1522616-4',
                'url' => null,
                'barcode' => null,
                'cara_donasi' => '
                    <ul>
                        <li>Buka aplikasi Livin by Mandiri atau gunakan mesin ATM Mandiri</li>
                        <li>Pilih menu Transfer</li>
                        <li>Masukkan nomor rekening kami</li>
                        <li>Atas nama: Muklis Hartono</li>
                        <li>Masukkan nominal uang</li>
                        <li>Konfirmasi dan selesaikan transaksi</li>
                    </ul>
                ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // factory
        // Donasi::factory(11)->create();
    }
}
