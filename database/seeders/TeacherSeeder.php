<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacherRole = UserRole::where('role', 'Teacher')->first();

        if (!$teacherRole) {
            $this->command->error('Teacher role not found. Please run UserRoleSeeder first.');
            return;
        }

        $teachers = [
            [
                'name' => 'Dr. Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Prof. Michael Chen',
                'email' => 'michael.chen@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Dr. Emily Rodriguez',
                'email' => 'emily.rodriguez@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Prof. David Williams',
                'email' => 'david.williams@example.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Dr. Lisa Anderson',
                'email' => 'lisa.anderson@example.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($teachers as $teacherData) {
            User::updateOrCreate(
                ['email' => $teacherData['email']],
                [
                    'name' => $teacherData['name'],
                    'password' => $teacherData['password'],
                    'user_role_id' => $teacherRole->id,
                    'email_verified_at' => now(),
                ]
            );
        }

        $this->command->info('Teachers seeded successfully!');
    }
}
