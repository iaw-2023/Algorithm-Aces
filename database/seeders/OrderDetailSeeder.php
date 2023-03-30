<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderDetails = [
            [
                'product_amount' => 5,
                'product_id'=>1,
                'order_id'=> 1,
            ],
            [
                'product_amount' => 3,
                'product_id'=>2,
                'order_id'=> 2,
            ],
            [
                'product_amount' => 1,
                'product_id'=>3,
                'order_id'=> 3,
            ],
        ];

        DB::table('orders_detail')->insert($orderDetails);
    }
}
