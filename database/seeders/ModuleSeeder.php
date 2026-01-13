<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            ['module' => 'Web Application Technology', 'is_available' => true],
            ['module' => 'Object Oriented Programming', 'is_available' => true],
            ['module' => 'Developing Mobile Applications', 'is_available' => true],
            ['module' => 'Advanced Web Engineering', 'is_available' => true],
            ['module' => 'Database Management Systems', 'is_available' => true],
            ['module' => 'Software Engineering', 'is_available' => true],
            ['module' => 'Computer Networks', 'is_available' => true],
            ['module' => 'Artificial Intelligence', 'is_available' => true],
            ['module' => 'Data Structures & Algorithms', 'is_available' => true],
            ['module' => 'Cloud Computing', 'is_available' => true],
            ['module' => 'Cybersecurity Fundamentals', 'is_available' => false], // Archived module
            ['module' => 'Legacy Systems', 'is_available' => false], // Archived module
        ];

        foreach ($modules as $moduleData) {
            Module::updateOrCreate(
                ['module' => $moduleData['module']],
                [
                    'slug' => \Illuminate\Support\Str::slug($moduleData['module']),
                    'is_available' => $moduleData['is_available']
                ]
            );
        }

        $this->command->info('Modules seeded successfully!');
    }
}
