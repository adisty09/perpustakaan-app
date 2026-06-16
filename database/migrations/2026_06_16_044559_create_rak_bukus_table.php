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
        Schema::create('rak_bukus', function (Blueprint $table) {
            $table->char('idRak', 5)->primary();
            $table->string('kodeRak', 30);
            $table->string('lokasi', 100)->nullable();
            $table->integer('lantai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rak_bukus');
    }
};
