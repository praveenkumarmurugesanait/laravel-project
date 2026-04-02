<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create some test users
        User::factory(10)->create();

        // Create an admin user directly with role column
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',   // <-- assign role here
        ]);

        // Call other seeders if needed
        $this->call(ProfileSeeder::class);
    }
}
