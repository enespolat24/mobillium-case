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

        Permission::create(['name' => 'create_post']);
        Permission::create(['name' => 'edit_post']);
        Permission::create(['name' => 'delete_post']);
        Permission::create(['name' => 'publish_post']);
        Permission::create(['name' => 'unpublish_post']);
        Permission::create(['name' => 'vote_post']);

        $adminRole->givePermissionTo(Permission::all());
        $moderatorRole->givePermissionTo(['publish_post', 'unpublish_post']);
        $authorRole->givePermissionTo(['create_post', 'edit_post', 'delete_post']);
        $readerRole->givePermissionTo(['vote_post']);
    }
}
