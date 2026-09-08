<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('transaksi')
            ->whereNotIn('status', ['diproses', 'diambil', 'selesai'])
            ->update(['status' => 'diproses']);

        Schema::table('transaksi', function (Blueprint $table) {
            $table->enum('status', ['diproses', 'diambil', 'selesai'])
                ->default('diproses')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('status')->change();
        });
    }
};