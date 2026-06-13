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
        //
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('definisi_id')->nullable(); //definisi_id !null = definisi dilaporkan
            // $table->foreignId('kosakata_id')->nullable(); //kosakata_id !null = kosakata dilaporkan
            $table->foreignId('pengurus_id')->nullable();
            $table->dateTime('status')->nullable();
            $table->string('alasan');
            $table->text('catatan')->nullable();
            $table->text('catatan_pengurus')->nullable();
            $table->text('def_dilaporkan')->nullable();
            $table->dateTime('waktu_definisi')->nullable();
            $table->integer('poin_pelapor')->nullable(); // poin untuk pelapor jika di-acc
            $table->integer('poin_pengurus')->nullable(); // poin untuk pengurus jika menindaklanjuti
            $table->integer('poin_terlapor')->nullable(); // poin terlapor yang dikurang jika hukuman adalah pengurangan poin
            // tindakan & hukuman
            $table->string('tindakan')->nullable(); // tindakan untuk definisi dilaporakn
            $table->string('hukuman')->nullable(); // tindakan untuk pengguna
            $table->timestamps();

            $table->index('user_id');
            $table->index('pengurus_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('reports');
    }
};
