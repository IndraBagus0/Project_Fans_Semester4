<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();
        $data = [
            [
                'name_product' => 'Paket All in One',
                'price' => 1250000,
                'speed' => '200 Mbps',
                'bandwith' => 'Unlimited',
            ],
            [
                'name_product' => 'Paket Gamers',
                'price' => 750000,
                'speed' => '100 Mbps',
                'bandwith' => 'Unlimited',
            ],
            [
                'name_product' => 'Paket Streaming',
                'price' => 500000,
                'speed' => "70 Mbps",
                'bandwith' => 'TB',
            ],
            [
                'name_product' => 'Paket Bersahabat',
                'price' => 200000,
                'speed' => '30 Mbps',
                'bandwith' => '500 Gb',
            ],
        ];

        foreach ($data as $item) {
            Product::create($item);
        }
    }
}
