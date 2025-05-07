<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('definisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kosakata_id');
            $table->foreignId('user_id');
            $table->integer('poin_kontributor')->default(0); // saat definisi disubmit
            $table->integer('poin_verifikasi')->default(value: 0); // khusus untuk poin setelah definisi diverifikasi
            $table->integer('poin_pengurus')->default(value: 0); // untuk kontributor karena telah memverifikasi
            $table->text('definisi');
            $table->json('referensi')->nullable();
            $table->string('bahasa');
            $table->dateTime('verifikasi')->nullable();
            $table->foreignId('verifikasi_oleh')->nullable();
            $table->tinyInteger('hukuman_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('definisi');
    }
};
