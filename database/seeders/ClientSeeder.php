<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [];
        $clientAmount = 10;

        for ($i = 1; $i <= $clientAmount; $i++) {
            $clients[] = [
                'email' => 'client' . $i . '@gmail.com',
                'password' => bcrypt('password'), // Cambiar 'password' por la contraseña deseada para todos los clientes
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('clients')->insert($clients);
    }
}
