<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'sub_role' => 'club', // Example sub-role
        ]);

        // Operator
        User::create([
            'name' => 'Operator User',
            'email' => 'operator@example.com',
            'password' => Hash::make('password'),
            'role' => 'operator',
        ]);

        // Super Admin
        User::create([
            'name' => 'Super Admin User',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'sub_role' => 'nation', // Example sub-role
        ]);
        
        // Public User
        User::create([
             'name' => 'Public User',
             'email' => 'user@example.com',
             'password' => Hash::make('password'),
             'role' => 'user',
        ]);
    }
}
