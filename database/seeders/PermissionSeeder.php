<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit product']);

        Permission::create(['name' => 'edit category']);

        Permission::create(['name' => 'edit user']); 
        Permission::create(['name' => 'show user']);

        Permission::create(['name' => 'edit contact']);

        Permission::create(['name' => 'edit customer']);
        Permission::create(['name' => 'show customer']);

        Permission::create(['name' => 'show statistical']);

        Permission::create(['name' => 'edit payment_status']);
        // create roles and assign created permissions

        // this can be done as separate statements
       

        // or may be done by chaining
        $role = Role::create(['name' => 'editor']);

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(['edit category', 'edit product', 'show user', 'show customer', 'show statistical', 'edit payment_status']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
