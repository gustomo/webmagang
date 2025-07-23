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
        Schema::create('transaksi_barang', function (Blueprint $table) {
            $table->string('id_transaksi');
            $table->string('id_brg');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->decimal('harga', 15, 2);
            $table->decimal('subtotal', 15, 2);
            
            // Relasi ke transaksi
            $table->foreign('id_transaksi')
                  ->references('id_transaksi')
                  ->on('tb_transaksi');
                  
            // Relasi ke barang
            $table->foreign('id_brg')
                  ->references('id_brg')
                  ->on('tb_barang');
            
            // Primary key gabungan
            $table->primary(['id_transaksi', 'id_brg']);
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_barang');
    }
};