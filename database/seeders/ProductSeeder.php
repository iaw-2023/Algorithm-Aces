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
        $products = [];
        $productAmount = 10;

        $sizes = ['S', 'M', 'L', 'XL'];
        $maxSizeIndex = count($sizes) - 1;

        for ($i = 1; $i <= $productAmount; $i++) {
            $productData = [
                'name' => 'Product ' . $i,
                'size' => $sizes[rand(0, $maxSizeIndex)],
                'image' => 'product' . $i . '.jpg',
                'price' => rand(10,50),
                'stock'=>rand (10,5000),
                'brand_id' => $i,
                'category_id' => $i,
                'created_at' => now(),
                'updated_at' => now(),
                'enable' => boolval(random_int(0, 1)),
            ];
            //Adds productData at the end of products
            $products[] = $productData;
        }

        DB::table('products')->insert($products);
    }
}
