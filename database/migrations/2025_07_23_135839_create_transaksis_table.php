<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->string('id_transaksi')->primary();
            $table->string('id_sp'); // Relasi ke supplier
            $table->date('tanggal_transaksi');
            $table->decimal('total_harga', 15, 2);
            $table->timestamps();
            
            // Relasi ke tabel supplier
            $table->foreign('id_sp')
                  ->references('id_sp')
                  ->on('tb_supplier');
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};