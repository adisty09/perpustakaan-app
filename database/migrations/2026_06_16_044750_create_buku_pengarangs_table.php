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
        Schema::create('buku_pengarangs', function (Blueprint $table) {
            $table->char('idBuku', 5);
            $table->char('idPengarang', 5);
            $table->timestamps();

            $table->primary(['idBuku', 'idPengarang']);
            $table->foreign('idBuku')->references('idBuku')->on('bukus')->onDelete('cascade');
            $table->foreign('idPengarang')->references('idPengarang')->on('pengarangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_pengarangs');
    }
};
