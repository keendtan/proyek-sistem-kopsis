<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE `keranjang` DROP FOREIGN KEY `keranjang_barang_id_foreign`');
        DB::statement('ALTER TABLE `detail_pemesanan` DROP FOREIGN KEY `detail_pemesanan_barang_id_foreign`');
        DB::statement('ALTER TABLE `barang` MODIFY `id` VARCHAR(36) NOT NULL');
        DB::statement('ALTER TABLE `keranjang` MODIFY `barang_id` VARCHAR(36) NOT NULL');
        DB::statement('ALTER TABLE `detail_pemesanan` MODIFY `barang_id` VARCHAR(36) NOT NULL');
        DB::statement('ALTER TABLE `keranjang` ADD CONSTRAINT `keranjang_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE');
        DB::statement('ALTER TABLE `detail_pemesanan` ADD CONSTRAINT `detail_pemesanan_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE');
    }

    public function down(): void
    {
        throw new RuntimeException('The barang UUID migration cannot be reversed without risking data loss.');
    }
};
