<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Module;
use App\Models\TeacherModule;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $search = $request->input('search');

        // Fetch Stats
        $stats = [
            'teachers' => User::whereHas('userRole', fn($q) => $q->where('role', 'Teacher'))->count(),
            'students' => User::whereHas('userRole', fn($q) => $q->where('role', 'Student'))->count(),
            'modules' => Module::count(),
        ];

        // Fetch Data with Filters
        $teachers = User::whereHas('userRole', fn($q) => $q->where('role', 'Teacher'))
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%")->orWhere('email', 'like', "%$search%"))
            ->paginate(10, ['*'], 'teachers_page');

        $students = User::whereHas('userRole', fn($q) => $q->whereIn('role', ['Student', 'Old Student']))
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%")->orWhere('email', 'like', "%$search%"))
            ->paginate(10, ['*'], 'students_page');

        $modules = Module::with(['teachers', 'enrollments'])
            ->when($search, fn($q) => $q->where('module', 'like', "%$search%"))
            ->paginate(10, ['*'], 'modules_page');

        $roles = UserRole::all();

        return view('admin.dashboard', compact('stats', 'teachers', 'students', 'modules', 'roles'));
    }

    // Teacher Management
    public function storeTeacher(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $teacherRole = UserRole::where('role', 'Teacher')->firstOrFail();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_role_id' => $teacherRole->id,
            'email_verified_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Teacher created successfully.');
    }

    public function destroyUser(User $user)
    {
        // Prevent deleting self or other admins if needed, but for now just basic delete
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    // Module Management
    public function storeModule(Request $request)
    {
        $request->validate([
            'module' => 'required|string|max:255|unique:modules',
        ]);

        Module::create([
            'module' => $request->module,
            'slug' => Str::slug($request->module),
            'is_available' => true,
        ]);

        return redirect()->back()->with('success', 'Module created successfully.');
    }

    public function toggleModule(Module $module)
    {
        $module->update(['is_available' => !$module->is_available]);
        return redirect()->back()->with('success', 'Module availability updated.');
    }

    public function assignTeacherToModule(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        // Check if user is actually a teacher
        $teacher = User::findOrFail($request->teacher_id);
        if ($teacher->userRole->role !== 'Teacher') {
            return redirect()->back()->with('error', 'Selected user is not a teacher.');
        }

        TeacherModule::firstOrCreate([
            'user_id' => $request->teacher_id, // assuming teacher_modules table has user_id and module_id
            'module_id' => $request->module_id,
        ]);

        return redirect()->back()->with('success', 'Teacher assigned to module.');
    }

    public function unassignTeacherFromModule(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        TeacherModule::where('user_id', $request->teacher_id)
            ->where('module_id', $request->module_id)
            ->delete();

        return redirect()->back()->with('success', 'Teacher unassigned from module.');
    }

    // Student Management
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:user_roles,id',
        ]);

        $user->update(['user_role_id' => $request->role_id]);
        return redirect()->back()->with('success', 'User role updated.');
    }

    public function removeStudentFromModule(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->back()->with('success', 'Student removed from module.');
    }
}
