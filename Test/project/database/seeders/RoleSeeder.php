<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'Admin']);
        $employeeRole = Role::create(['name' => 'Employee']);
        $customerRole = Role::create(['name' => 'Customer']);

        // Create permissions
        $permissions = [
            'manage employees',
            'manage products',
            'view customers',
            'manage customer credit',
            'make purchases',
            'view purchases'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());
        
        $employeeRole->givePermissionTo([
            'manage products',
            'view customers',
            'manage customer credit'
        ]);

        $customerRole->givePermissionTo([
            'make purchases',
            'view purchases'
        ]);
    }
}
