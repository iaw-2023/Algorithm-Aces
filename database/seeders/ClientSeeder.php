<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'email' => 'client1@gmail.com',
            ],
            [
                'email' => 'client2@gmail.com',
            ],
            [
                'email' => 'client3@gmail.com',
            ],
        ];
        DB::table('clients')->insert($clients);
    }
}
