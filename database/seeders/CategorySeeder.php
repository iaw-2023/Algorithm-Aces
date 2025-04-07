<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [];

        // Categorías fijas
        $fixedCategories = ['Pelota', 'Remera', 'Pantalón', 'Zapatilla', 'Botín'];
        foreach ($fixedCategories as $name) {
            $categories[] = [
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
                'enable' => true,
            ];
        }

        // Categorías generadas
        $categoryAmount = 10;
        for ($i = 1; $i <= $categoryAmount; $i++) {
            $categories[] = [
                'name' => 'Category' . $i,
                'created_at' => now(),
                'updated_at' => now(),
                'enable' => boolval(random_int(0, 1)),
            ];
        }

        DB::table('categories')->insert($categories);
    }
}

