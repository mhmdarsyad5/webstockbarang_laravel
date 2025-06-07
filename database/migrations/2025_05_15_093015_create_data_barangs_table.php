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
        Schema::create('data_barangs', function (Blueprint $table) {
            $table->increments('id_barang');
            $table->string('nama_barang', 255);
            $table->string('barang_kode', 255);
            $table->unsignedBigInteger('id_merk');
            $table->string('stock_barang', 255)->nullable();
            $table->string('harga_barang', 255)->nullable();
            $table->string('gambar_barang', 255);
            $table->unsignedBigInteger('jenisbarang_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_barangs');
    }
};
