<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // ایجاد نقش‌ها
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // ایجاد مجوزها
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'edit articles']);
        // سایر مجوزها

        // اختصاص مجوزها به نقش‌ها
        $adminRole->givePermissionTo('manage users');
        $adminRole->givePermissionTo('edit articles');

        $userRole->givePermissionTo('edit articles');
    }
}