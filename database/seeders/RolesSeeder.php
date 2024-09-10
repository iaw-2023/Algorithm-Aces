<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\Administrator;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $superAdminRole = Role::create(['name' => 'super-admin']);

        $admin = Administrator::find(1);
        $admin->assignRole($adminRole);

        $superAdmin = Administrator::find(2);
        $superAdmin->assignRole($superAdminRole);
    }
}
