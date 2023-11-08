<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $authorRole = Role::create(['name' => 'author']);

        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'edit post']);
        Permission::create(['name' => 'delete post']);
        Permission::create(['name' => 'publish post']);
        Permission::create(['name' => 'unpublish post']);
        Permission::create(['name' => 'vote post']);

        $adminRole->givePermissionTo(Permission::all());
        $authorRole->givePermissionTo(['create post', 'edit post', 'delete post']);
        $userRole->givePermissionTo(['vote post']);
    }
}
