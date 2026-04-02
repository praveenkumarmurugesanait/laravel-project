<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $editPosts = Permission::firstOrCreate(['name' => 'edit-posts']);
        $deletePosts = Permission::firstOrCreate(['name' => 'delete-posts']);

        $adminRole->givePermissionTo([$editPosts, $deletePosts]);

        $user = User::find(1);
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
