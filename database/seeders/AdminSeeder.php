<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = UserRole::where('role', 'Admin')->first();

        if ($adminRole) {
            User::updateOrCreate(
                ['email' => 'admin@example.com'],
                [
                    'name' => 'Administrator',
                    'password' => Hash::make('password'),
                    'user_role_id' => $adminRole->id,
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
