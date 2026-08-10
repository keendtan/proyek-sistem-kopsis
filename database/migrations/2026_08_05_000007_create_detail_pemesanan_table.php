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
        Schema::create('detail_pemesanan', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('transaksi_id', 36);
            $table->foreign('transaksi_id')->references('id')->on('transaksi')->onDelete('cascade');
            $table->string('barang_id', 36);
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->integer('jumlah')->default(0);
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->string('created_by', 36)->nullable();
            $table->string('updated_by', 36)->nullable();
            $table->string('deleted_by', 36)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pemesanan');
    }
};
