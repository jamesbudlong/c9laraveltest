<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds for default Roles and Permissions
     *
     * @return void
     */
    public function run()
    {
        //Permissions - Dashboard
        Permission::create(['name' => 'view-dashboard']);

        //Permissions - User
        Permission::create(['name' => 'view-all-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'delete-user']);

        //Permissions - File Uploads
        Permission::create(['name' => 'view-all-file-upload']);
        Permission::create(['name' => 'create-file-upload']);
        Permission::create(['name' => 'update-file-upload']);
        Permission::create(['name' => 'delete-file-upload']);

        //Permissions - Roles
        Permission::create(['name' => 'view-all-role']);
        Permission::create(['name' => 'create-role']);
        Permission::create(['name' => 'update-role']);
        Permission::create(['name' => 'delete-role']);

        //Permissions - Permissions
        Permission::create(['name' => 'view-all-permission']);
        Permission::create(['name' => 'create-permission']);
        Permission::create(['name' => 'update-permission']);
        Permission::create(['name' => 'delete-permission']);

        //Roles
        $admin = Role::create(['name' => 'Admin']);
        $member = Role::create(['name' => 'Member']);

        $admin->givePermissionTo([
            'view-dashboard',
            'view-all-user',
            'create-user',
            'update-user',
            'delete-user',
            'view-all-file-upload',
            'create-file-upload',
            'update-file-upload',
            'delete-file-upload',
            'view-all-role',
            'create-role',
            'update-role',
            'delete-role',
            'view-all-permission',
            'create-permission',
            'update-permission',
            'delete-permission',
        ]);

        $member->givePermissionTo([
            'view-dashboard',
            'create-file-upload',
        ]);
    }
}
