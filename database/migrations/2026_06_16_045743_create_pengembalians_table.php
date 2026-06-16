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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->char('idPengembalian', 10)->primary();
            $table->date('tglKembali_real');
            $table->integer('keterlambatanHari')->default(0);
            $table->decimal('dendaDibayar', 10, 2)->default(0);
            $table->char('idPeminjaman', 10)->unique();
            $table->char('idPustakawan', 5);
            $table->timestamps();

            $table->foreign('idPeminjaman')->references('idPeminjaman')->on('peminjamans')->onDelete('cascade');
            $table->foreign('idPustakawan')->references('idPustakawan')->on('pustakawans')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
