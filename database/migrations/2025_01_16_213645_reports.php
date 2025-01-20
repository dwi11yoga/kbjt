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
            $table->foreignId('definisi_id');
            $table->foreignId('pengurus_id')->nullable();
            $table->dateTime('status')->nullable();
            $table->string('alasan');
            $table->text('catatan')->nullable();
            $table->text('def_dilaporkan');
            $table->json('ref_dilaporkan')->nullable();
            $table->dateTime('waktu_definisi');
            $table->timestamps();
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
