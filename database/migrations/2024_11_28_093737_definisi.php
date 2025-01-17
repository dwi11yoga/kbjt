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
            $table->bigInteger('kosakata_id');
            $table->bigInteger('user_id');
            $table->integer('poin')->default(0);
            $table->text('definisi');
            $table->json('referensi')->nullable();
            $table->dateTime('verifikasi')->nullable();
            $table->bigInteger('verifikasi_oleh')->nullable();
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
