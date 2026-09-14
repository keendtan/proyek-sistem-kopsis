<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->foreign('users_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->foreign('users_id')
                ->references('id')
                ->on('users_kita')
                ->onDelete('cascade');
        });
    }
};