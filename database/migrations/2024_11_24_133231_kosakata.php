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
        Schema::create('kosakata', function (Blueprint $table) {
            $table->id();
            $table->string('kosakata', 100);
            $table->string('slug', length: 100);
            $table->enum('ragam', ['Krama', 'Ngoko'])->nullable();
            $table->string('aksara')->nullable();
            $table->string('jenis', 50)->nullable();
            $table->string('notasi_fonetik')->nullable();
            $table->string('arti_indo')->nullable();
            $table->json('etimologi')->nullable();
            $table->integer('view')->default(0);
            $table->json('serupa')->nullable();
            $table->bigInteger('dibuat_oleh');
            $table->json('diedit_oleh')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kosakata');
    }
};
