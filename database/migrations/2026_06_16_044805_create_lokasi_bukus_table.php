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
        Schema::create('lokasi_bukus', function (Blueprint $table) {
            $table->char('idBuku', 5);
            $table->char('idRak', 5);
            $table->integer('jumlah');
            $table->timestamps();

            $table->primary(['idBuku', 'idRak']);
            $table->foreign('idBuku')->references('idBuku')->on('bukus')->onDelete('cascade');
            $table->foreign('idRak')->references('idRak')->on('rak_bukus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_bukus');
    }
};
