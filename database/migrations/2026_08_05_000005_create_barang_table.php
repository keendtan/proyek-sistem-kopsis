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
        Schema::create('barang', function (Blueprint $table) {
            $table->string('id', 36)->primary();
            $table->string('nama');
            $table->string('kategori_id', 36);
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
            $table->integer('stok')->default(0);
            $table->decimal('harga', 15, 2)->default(0);
            $table->string('gambar')->nullable();
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
        Schema::dropIfExists('barang');
    }
};
