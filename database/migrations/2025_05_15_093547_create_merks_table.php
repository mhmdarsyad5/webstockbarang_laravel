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
        Schema::create('merks', function (Blueprint $table) {
            $table->bigIncrements('id'); // bigint(20) UNSIGNED PRIMARY KEY AUTO_INCREMENT
            $table->string('merk_nama', 255);
            $table->string('merk_keterangan', 255)->nullable(); // nullable karena tidak didefinisikan NOT NULL
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merks');
    }
};
