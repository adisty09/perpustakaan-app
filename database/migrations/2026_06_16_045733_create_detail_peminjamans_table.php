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
        Schema::create('detail_peminjamans', function (Blueprint $table) {
            $table->id();
             $table->char('idPeminjaman', 10);
            $table->char('idBuku', 5);
            $table->string('status_kembali', 20)->default('Belum');
            $table->timestamps();

            $table->foreign('idPeminjaman')->references('idPeminjaman')->on('peminjamans')->onDelete('cascade');
            $table->foreign('idBuku')->references('idBuku')->on('bukus')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_peminjamans');
    }
};
