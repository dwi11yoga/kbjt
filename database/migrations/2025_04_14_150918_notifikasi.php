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
        Schema::create("notifikasi", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->tinyInteger("dilihat")->default(0);
            $table->string("kategori")->nullable();
            $table->string("message");
            $table->string("url")->nullable();
            $table->datetimes();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists("notifikasi");
    }
};
