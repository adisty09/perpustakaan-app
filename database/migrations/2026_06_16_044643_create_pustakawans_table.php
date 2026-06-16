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
        Schema::create('pustakawans', function (Blueprint $table) {
            $table->char('idPustakawan', 5)->primary();
            $table->string('nama', 50);
            $table->string('alamat', 100)->nullable();
            $table->char('no_telp', 15)->nullable();
            $table->string('jabatan', 30);
            $table->decimal('gaji_pokok', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pustakawans');
    }
};
