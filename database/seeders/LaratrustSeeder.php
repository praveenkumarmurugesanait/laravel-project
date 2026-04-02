<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laratrust\Models\Role;
use Laratrust\Models\Permission;
use App\Models\User;

class LaratrustSeeder extends Seeder
{
    public function run()
    {
        // Roles
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            ['display_name' => 'Administrator', 'description' => 'Full access']
        );

        $editorRole = Role::firstOrCreate(
            ['name' => 'editor'],
            ['display_name' => 'Editor', 'description' => 'Can edit content']
        );

        // Permissions
        $editPosts = Permission::firstOrCreate(
            ['name' => 'edit-posts'],
            ['display_name' => 'Edit Posts', 'description' => 'Permission to edit blog posts']
        );

        $deletePosts = Permission::firstOrCreate(
            ['name' => 'delete-posts'],
            ['display_name' => 'Delete Posts', 'description' => 'Permission to delete blog posts']
        );

        // Attach permissions safely
        $adminRole->permissions()->syncWithoutDetaching([$editPosts->id, $deletePosts->id]);
        $editorRole->permissions()->syncWithoutDetaching([$editPosts->id]);

        // Assign role to a user
        $user = User::find(1);
        if ($user) {
            $user->attachRole($adminRole);
        }
    }
}
