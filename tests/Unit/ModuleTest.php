<?php

namespace Tests\Unit;

use App\Models\Module;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_module_slug_is_generated_correctly()
    {
        $moduleName = 'Introduction to Laravel';
        $slug = Str::slug($moduleName);

        $module = Module::create([
            'module' => $moduleName,
            'slug' => $slug,
            'is_available' => true,
        ]);

        $this->assertEquals($slug, $module->slug);
        $this->assertEquals('introduction-to-laravel', $module->slug);
    }

    public function test_module_can_have_teachers()
    {
        $module = Module::create([
            'module' => 'Unit Test Module',
            'slug' => 'unit-test-module',
            'is_available' => true,
        ]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $module->teachers());
    }

    public function test_module_can_have_enrollments()
    {
        $module = Module::create([
            'module' => 'Enrollment Test Module',
            'slug' => 'enrollment-test-module',
            'is_available' => true,
        ]);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $module->enrollments());
    }
}
