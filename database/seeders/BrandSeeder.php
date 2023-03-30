<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Table;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Marca 1',
            ],
            [
                'name' => 'Marca 2',
            ],
            [
                'name' => 'Marca 3',
            ],
        ];
        DB::table('brands')->insert($brands);
    }
}
