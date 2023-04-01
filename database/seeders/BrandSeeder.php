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
        $brands = [];
        $brandAmount = 10;

        for ($i = 1; $i <= $brandAmount; $i++) {
            $brandData = [
                'name' => 'Marca ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            //Adds brandData at the end of brands
            $brands[] = $brandData;
        }

        DB::table('brands')->insert($brands);
    }
}
