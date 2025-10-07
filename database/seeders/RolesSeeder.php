<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// Import the User model if you intend to assign roles to users
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Create Permissions
        $permission_manage_employees = Permission::create(['name' => 'manage employees']);
        $permission_approve_leaves   = Permission::create(['name' => 'approve leaves']);

        // ---

        // 3. Create Roles and Assign Permissions

        // Admin Role: Gets all existing permissions
        Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());

        // HR Role: Gets specific permissions
        Role::create(['name' => 'hr'])->givePermissionTo([
            $permission_manage_employees,
            $permission_approve_leaves,
        ]);

        // Employee Role: No special permissions initially
        Role::create(['name' => 'employee']);

        // ---

        // 4. Assign a Role to a User (Example)
        // This is an example of assigning a role to the very first user (ID 1),
        // which you might use to quickly set up an admin account.

        // Find a user (e.g., the first user created)
        $user = User::where('email', 'admin@example.com')->first();

        if ($user) {
            // Assign the 'admin' role to that user
            $user->assignRole('admin');
        }

    }
}
