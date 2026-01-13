<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function dashboard(Request $request)
    {
        $search = $request->input('search');
        
        // Get modules assigned to this teacher
        $teacher = Auth::user();
        
        // Assuming relationship 'modules' exists on User via teacher_modules
        $modules = $teacher->teacherModules()
            ->when($search, fn($q) => $q->where('module', 'like', "%$search%"))
            ->withCount('enrollments')
            ->get();

        return view('teacher.dashboard', compact('modules'));
    }

    public function viewModule($moduleId, Request $request)
    {
        $module = Module::findOrFail($moduleId);
        
        // Verify teacher is assigned to this module
        if (!$module->teachers->contains(Auth::id())) {
            abort(403, 'Unauthorized access to this module.');
        }

        $search = $request->input('search');

        $enrollments = $module->enrollments()
            ->with('user')
            ->when($search, function($q) use ($search) {
                $q->whereHas('user', function($subQ) use ($search) {
                    $subQ->where('name', 'like', "%$search%")
                         ->orWhere('email', 'like', "%$search%");
                });
            })
            ->get();

        return view('teacher.module', compact('module', 'enrollments'));
    }

    public function gradeStudent(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'status' => 'required|in:pass,fail',
        ]);

        // Verify teacher is assigned to the module of this enrollment
        $module = $enrollment->module;
        if (!$module->teachers->contains(Auth::id())) {
            abort(403, 'Unauthorized action.');
        }

        $enrollment->update([
            'status' => $request->status,
            'completed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Student graded successfully.');
    }
}
