<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Kategori\Models\Kategori;
use App\Modules\Barang\Models\Barang;

class KeranjangSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID kategori berdasarkan nama
        $makananId = Kategori::where('nama_kategori', 'Makanan')->first()?->id;
        $minumanId = Kategori::where('nama_kategori', 'Minuman')->first()?->id;

        if (!$makananId || !$minumanId) {
            return; // Skip jika kategori tidak ada
        }

        $data = [
            [
                'nama' => 'Beef Steak',
                'harga' => 35000,
                'kategori_id' => $makananId,
                'gambar' => 'beef-steak.jpg',
                'stok' => 20,
            ],

            [
                'nama' => 'Biscoff Latte',
                'harga' => 17000,
                'kategori_id' => $minumanId,
                'gambar' => 'biscoff-latte.jpg',
                'stok' => 20,
            ],

            [
                'nama' => 'Chicken Katsu',
                'harga' => 20000,
                'kategori_id' => $makananId,
                'gambar' => 'chicken-katsu.jpg',
                'stok' => 15,
            ],

            [
                'nama' => 'French Fries',
                'harga' => 15000,
                'kategori_id' => $makananId,
                'gambar' => 'french-fries.jpg',
                'stok' => 25,
            ],

            [
                'nama' => 'Chocolate Milk',
                'harga' => 12000,
                'kategori_id' => $minumanId,
                'gambar' => 'chocolate-milk.jpg',
                'stok' => 20,
            ],
        ];

        foreach ($data as $item) {
            Barang::create($item);
        }
    }
}
