<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Product 1',
                'size' => 'S',
                'image' => 'product1.jpg',
                'price' => 10,
                'brand_id' => 1,
                'category_id' => 1,
            ],
            [
                'name' => 'Product 2',
                'size' => 'M',
                'image' => 'product2.jpg',
                'price' => 20,
                'brand_id' => 2,
                'category_id' => 2,
            ],
            [
                'name' => 'Product 3',
                'size' => 'L',
                'image' => 'product3.jpg',
                'price' => 30,
                'brand_id' => 3,
                'category_id' => 3,
            ],
        ];

        DB::table('products')->insert($products);
    }
}
