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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('role')->nullable();
            $table->string('nama')->unique();
            $table->text('deskripsi');
            $table->string('rule'); //bagian/grup reward (misal: kosakata, definisi, laporan, dll)
            $table->integer('requirement');
            $table->integer('reward');
            $table->text('emblem')->nullable();
            $table->dateTimes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
