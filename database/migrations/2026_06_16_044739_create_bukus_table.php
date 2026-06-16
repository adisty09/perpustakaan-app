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
        Schema::create('bukus', function (Blueprint $table) {
            $table->char('idBuku', 5)->primary();
            $table->string('judul', 100);
            $table->string('isbn', 20)->nullable();
            $table->year('tahunTerbit');
            $table->integer('stok_total');
            $table->integer('stok_tersedia');
            $table->char('idPenerbit', 5);
            $table->char('idJenis', 5);
            $table->timestamps();


            $table->foreign('idPenerbit')->references('idPenerbit')->on('penerbits')->onDelete('restrict');
            $table->foreign('idJenis')->references('idJenis')->on('jenis_bukus')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
