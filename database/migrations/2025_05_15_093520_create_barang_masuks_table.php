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
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->bigIncrements('id'); // bigint(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('bm_kode', 255);
            $table->unsignedInteger('id_barang'); // int(10) UNSIGNED
            $table->unsignedBigInteger('id_staff'); // bigint(20) UNSIGNED
            $table->string('bk_tanggal', 255);
            $table->string('bk_jumlah', 255)->nullable(); // nullable karena tidak didefinisikan NOT NULL
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
