<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentRole = UserRole::where('role', 'Student')->first();
        $oldStudentRole = UserRole::where('role', 'Old Student')->first();

        if (!$studentRole || !$oldStudentRole) {
            $this->command->error('Student roles not found. Please run UserRoleSeeder first.');
            return;
        }

        // Current Students
        $students = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@student.com',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
            ],
            [
                'name' => 'Emma Wilson',
                'email' => 'emma.wilson@student.com',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
            ],
            [
                'name' => 'James Brown',
                'email' => 'james.brown@student.com',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
            ],
            [
                'name' => 'Olivia Davis',
                'email' => 'olivia.davis@student.com',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
            ],
            [
                'name' => 'William Martinez',
                'email' => 'william.martinez@student.com',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
            ],
            [
                'name' => 'Sophia Garcia',
                'email' => 'sophia.garcia@student.com',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
            ],
            [
                'name' => 'Benjamin Lee',
                'email' => 'benjamin.lee@student.com',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
            ],
            [
                'name' => 'Ava Taylor',
                'email' => 'ava.taylor@student.com',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
            ],
            [
                'name' => 'Lucas Anderson',
                'email' => 'lucas.anderson@student.com',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
            ],
            [
                'name' => 'Mia Thomas',
                'email' => 'mia.thomas@student.com',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
            ],
        ];

        // Old Students (Alumni)
        $oldStudents = [
            [
                'name' => 'Robert Johnson',
                'email' => 'robert.johnson@alumni.com',
                'password' => Hash::make('password'),
                'role_id' => $oldStudentRole->id,
            ],
            [
                'name' => 'Jennifer White',
                'email' => 'jennifer.white@alumni.com',
                'password' => Hash::make('password'),
                'role_id' => $oldStudentRole->id,
            ],
            [
                'name' => 'Michael Harris',
                'email' => 'michael.harris@alumni.com',
                'password' => Hash::make('password'),
                'role_id' => $oldStudentRole->id,
            ],
        ];

        // Seed current students
        foreach ($students as $studentData) {
            User::updateOrCreate(
                ['email' => $studentData['email']],
                [
                    'name' => $studentData['name'],
                    'password' => $studentData['password'],
                    'user_role_id' => $studentData['role_id'],
                    'email_verified_at' => now(),
                ]
            );
        }

        // Seed old students
        foreach ($oldStudents as $oldStudentData) {
            User::updateOrCreate(
                ['email' => $oldStudentData['email']],
                [
                    'name' => $oldStudentData['name'],
                    'password' => $oldStudentData['password'],
                    'user_role_id' => $oldStudentData['role_id'],
                    'email_verified_at' => now(),
                ]
            );
        }

        $this->command->info('Students seeded successfully!');
        $this->command->info('Created ' . count($students) . ' current students and ' . count($oldStudents) . ' old students.');
    }
}
