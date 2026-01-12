<?php

namespace Tests\Feature;

use App\Models\Module;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true; // Seeds the database using DatabaseSeeder

    public function test_admin_dashboard_access()
    {
        $admin = User::whereHas('userRole', fn($q) => $q->where('role', 'Admin'))->first();
        if (!$admin) {
            // Fallback if seeder didn't create admin or strict logic differences
             $this->seed(); 
             $admin = User::whereHas('userRole', fn($q) => $q->where('role', 'Admin'))->first();
        }
        $this->assertNotNull($admin, 'Admin user not found after seeding');

        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_student_cannot_access_admin_dashboard()
    {
        // specific role seeder logic might be needed if no student exists
        // but let's assume one of the roles exists or create one temporary
        $role = UserRole::where('role', 'Student')->first();
        $student = User::create([
            'name' => 'Test Student Access',
            'email' => 'testaccess' . time() . '@student.com',
            'password' => Hash::make('password'),
            'user_role_id' => $role->id,
        ]);

        $response = $this->actingAs($student)->get('/admin/dashboard');
        $response->assertStatus(403);
        
        $student->delete();
    }
}
