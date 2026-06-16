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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->char('idAnggota', 10)->primary();
            $table->string('nama', 50);
            $table->string('alamat', 100)->nullable();
            $table->char('no_telp', 15)->nullable();
            $table->string('email', 50)->nullable();
            $table->date('tgl_daftar');
            $table->string('status', 20)->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
