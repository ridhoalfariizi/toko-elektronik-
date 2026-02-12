<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Seed data awal produk.
     */
    public function run(): void
    {
        $data = [
            [
                'thumbnail' => null,
                'kategori'  => 'Iphone',
                'produk'    => 'Iphone 13 Pro',
                'harga'     => 12000000,
            ],
            [
                'thumbnail' => null,
                'kategori'  => 'Android',
                'produk'    => 'Samsung Z Flip',
                'harga'     => 20000000,
            ],
            [
                'thumbnail' => null,
                'kategori'  => 'Android',
                'produk'    => 'Xiaomi Redmi Note 11 Pro',
                'harga'     => 3200000,
            ],
        ];

        foreach ($data as $item) {
            Produk::create($item);
        }
    }
}
