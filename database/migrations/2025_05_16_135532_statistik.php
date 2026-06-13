<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // statistik tiap bulan
        Schema::create('statistik', function(Blueprint $table){
            $table->id();
            $table->integer('tahun');
            $table->integer('bulan');
            $table->integer('pengunjung')->default(0);
            $table->integer('user_baru')->default(0);
            $table->integer('akun_dihapus')->default(0);
            $table->integer('kosakata_baru')->default(0);
            $table->integer('kosakata_edit')->default(0);
            $table->integer('kosakata_edit_disetujui')->default(0);
            $table->integer('definisi_baru')->default(0);
            $table->integer('definisi_diverifikasi')->default(0);
            $table->integer('artikel_dipublikasikan')->default(0);
            $table->integer('laporan_baru')->default(0);
            $table->integer('laporan_ditangani')->default(0);
            $table->integer('laporan_bersalah')->default(0);
            $table->datetimes();

            $table->index('tahun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('statistik');
    }
};
