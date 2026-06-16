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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->char('idPeminjaman', 10)->primary();
            $table->date('tglPinjam');
            $table->integer('lamaPinjam');
            $table->date('tgl_jatuh_tempo');
            $table->string('status_pinjam', 20)->default('Dipinjam');
            $table->char('idAnggota', 10);
            $table->char('idPustakawan', 5);
            $table->timestamps();

            $table->foreign('idAnggota')->references('idAnggota')->on('anggotas')->onDelete('restrict');
            $table->foreign('idPustakawan')->references('idPustakawan')->on('pustakawans')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
