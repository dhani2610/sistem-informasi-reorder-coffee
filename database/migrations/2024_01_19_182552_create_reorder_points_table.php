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
        Schema::create('reorder_points', function (Blueprint $table) {
            $table->id();
            $table->integer('id_barang');
            $table->integer('jumlah_yang_harus_dipesan');
            $table->integer('nilai');
            $table->integer('safety_stok');
            $table->integer('status');
            $table->date('tanggal_hitung_reorder');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reorder_points');
    }
};
