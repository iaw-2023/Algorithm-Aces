<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $enableEntity = Permission::create(['name' => 'enable entity']);
        $createEntity = Permission::create(['name' => 'create entity']);
        $editEntity = Permission::create(['name' => 'edit entity']);
        $seeClients = Permission::create(['name' => 'see clients']);
//        $seeEntities = Permission::create(['name' => 'see entities']);
        $modifyStock = Permission::create(['name' => 'modify stock']);

        $superAdminRole = Role::findByName('super-admin');
        $adminRole = Role::findByName('admin');

        $superAdminRole->givePermissionTo($enableEntity);
        $superAdminRole->givePermissionTo($createEntity);
        $superAdminRole->givePermissionTo($editEntity);
        $superAdminRole->givePermissionTo($seeClients);

//        $adminRole->givePermissionTo($seeEntities);

        $adminRole->givePermissionTo($modifyStock);
    }
}
