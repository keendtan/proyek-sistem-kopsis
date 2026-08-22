<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('detail_pemesanan', 'deleted_at')) {
            Schema::table('detail_pemesanan', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('detail_pemesanan', 'deleted_at')) {
            Schema::table('detail_pemesanan', function (Blueprint $table) {
                $table->dropSoftDeletes();
            });
        }
    }
};