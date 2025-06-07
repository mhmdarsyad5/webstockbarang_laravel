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
        // Add foreign keys to data_barangs table
        Schema::table('data_barangs', function (Blueprint $table) {
            $table->foreign('jenisbarang_id', 'fk_databarang_jenisbarang')->references('id')->on('jenis_barangs')->onDelete('cascade');
            $table->foreign('id_merk', 'fk_databarang_merk')->references('id')->on('merks')->onDelete('cascade');
        });

        // Add foreign keys to barang_masuks table
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->foreign('id_barang', 'fk_barangmasuk_databarang')->references('id_barang')->on('data_barangs')->onDelete('cascade');
            $table->foreign('id_staff', 'fk_barangmasuk_staff')->references('id')->on('staff')->onDelete('cascade');
        });

        // Add foreign keys to barang_keluars table
        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->foreign('id_barang', 'fk_barangkeluar_databarang')->references('id_barang')->on('data_barangs')->onDelete('cascade');
            $table->foreign('id_staff', 'fk_barangkeluar_staff')->references('id')->on('staff')->onDelete('cascade');
        });

        // Add foreign keys to pengajuans table
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->foreign('id_staff', 'fk_pengajuan_staff')->references('id')->on('staff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove foreign keys from data_barangs table
        Schema::table('data_barangs', function (Blueprint $table) {
            $table->dropForeign('fk_databarang_jenisbarang');
            $table->dropForeign('fk_databarang_merk');
        });

        // Remove foreign keys from barang_masuks table
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->dropForeign('fk_barangmasuk_databarang');
            $table->dropForeign('fk_barangmasuk_staff');
        });

        // Remove foreign keys from barang_keluars table
        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->dropForeign('fk_barangkeluar_databarang');
            $table->dropForeign('fk_barangkeluar_staff');
        });

        // Remove foreign keys from pengajuans table
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropForeign('fk_pengajuan_staff');
        });
    }
}; 