<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE `barang` DROP FOREIGN KEY `barang_kategori_id_foreign`');
        DB::statement('ALTER TABLE `kategori` MODIFY `id` VARCHAR(36) NOT NULL');
        DB::statement('ALTER TABLE `barang` MODIFY `kategori_id` VARCHAR(36) NOT NULL');
        DB::statement('ALTER TABLE `barang` ADD CONSTRAINT `barang_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE');
    }

    public function down(): void
    {
        throw new RuntimeException('The kategori UUID migration cannot be reversed without risking data loss.');
    }
};
