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
        Schema::create('editkosakata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kosakata_id');
            $table->string('slug', length: 100);
            $table->enum('ragam', ['Krama', 'Ngoko'])->nullable();
            $table->string('aksara')->nullable();
            $table->string('jenis', 50)->nullable();
            $table->string('notasi_fonetik')->nullable();
            $table->string('arti_indo')->nullable();
            $table->json('etimologi')->nullable();
            $table->json('serupa')->nullable();
            $table->enum('status', ['accepted', 'rejected'])->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::drop('editkosakata');
    }
};
