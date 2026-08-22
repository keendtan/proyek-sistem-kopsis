<?php

namespace Database\Seeders;

use App\Modules\Kategori\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriTableSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Makanan', 'Snack', 'Minuman'] as $namaKategori) {
            Kategori::updateOrCreate(
                ['nama_kategori' => $namaKategori],
                ['nama_kategori' => $namaKategori]
            );
        }
    }
}
