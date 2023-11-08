<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $moderatorRole = Role::create(['name' => 'moderator']);
        $authorRole = Role::create(['name' => 'author']);
        $readerRole = Role::create(['name' => 'reader']);

        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'edit post']);
        Permission::create(['name' => 'delete post']);
        Permission::create(['name' => 'publish post']);
        Permission::create(['name' => 'unpublish post']);
        Permission::create(['name' => 'vote post']);

        $adminRole->givePermissionTo(Permission::all());
        $moderatorRole->givePermissionTo(['publish post', 'unpublish post']);
        $authorRole->givePermissionTo(['create post', 'edit post', 'delete post']);
        $readerRole->givePermissionTo(['vote post']);
    }
}
