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
        $role = UserRole::firstOrCreate(['role' => 'Admin']);
        $admin = User::whereHas('userRole', fn($q) => $q->where('role', 'Admin'))->first() 
                 ?? User::factory()->create(['user_role_id' => $role->id]);

        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_student_cannot_access_admin_dashboard()
    {
        $role = UserRole::firstOrCreate(['role' => 'Student']);
        $student = User::factory()->create([
            'user_role_id' => $role->id,
        ]);

        $response = $this->actingAs($student)->get('/admin/dashboard');
        $response->assertStatus(403);
    }
}
