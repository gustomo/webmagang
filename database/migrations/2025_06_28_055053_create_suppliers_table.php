<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tb_supplier', function (Blueprint $table) {
            $table->string('id_sp')->primary(); // kamu pakai custom primary key
            $table->string('nama_supplier');
            $table->string('alamat');
            $table->string('kontak');
            $table->string('foto')->nullable();
            $table->timestamps(); // biasanya diletakkan di akhir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_supplier'); // ← harus sesuai nama tabel!
    }
};
