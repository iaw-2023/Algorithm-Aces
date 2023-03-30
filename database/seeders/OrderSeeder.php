<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'total_price' => 10000,
                'date'=>'2022-05-12',
                'client_id'=> 1,
            ],
            [
                'total_price' => 30000,
                'date'=>'2022-03-12',
                'client_id'=> 2,
            ],
            [
                'total_price' => 20000,
                'date'=>'2022-04-12',
                'client_id'=> 3,
            ],
        ];

        DB::table('orders')->insert($orders);
    }
}
