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
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('role')->nullable();
            $table->string('rule');
            $table->integer('requirement')->default(0);
            $table->integer('reward')->default(0);
            $table->datetimes();


            $table->index('role');
            $table->index('rule');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('sertifikat');
    }
};
