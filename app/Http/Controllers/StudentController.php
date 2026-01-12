<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        
        // Get current enrollments (not completed or failed? Requirement says "enrol on maximum of 4 current modules")
        // "Completed modules... show a PASS/FAIL history" implies current modules are 'enrolled' status.
        $currentEnrollments = $user->enrollments()
            ->where('status', 'enrolled')
            ->with('module')
            ->get();

        $canEnroll = $currentEnrollments->count() < 4;

        // Get available modules
        // Logic: Module is available AND not already enrolled/completed by user AND module has < 10 students
        // Also exclude modules that are "completed"? Requirement: "Students can see further modules to be enrolled on"
        
        $availableModules = [];
        
        if ($canEnroll) {
            $enrolledModuleIds = $user->enrollments()->pluck('module_id');
            
            $availableModules = Module::where('is_available', true)
                ->whereNotIn('id', $enrolledModuleIds)
                ->withCount('enrollments') // Count active enrollments? "Modules can have a maximum of 10 students attached."
                // "Once the maximum is reached students cannot enrol until existing students complete" 
                // This implies we count ALL enrollments or just ACTIVE ones? 
                // "until existing students complete and a space becomes available" -> implies ONLY ACTIVE counts towards limit.
                // However, usually history is kept. Let's assume limit is on CURRENTLY ENROLLED students.
                ->get()
                ->filter(function($module) {
                    // Check active enrollments count
                    $activeCount = $module->enrollments()->where('status', 'enrolled')->count();
                    return $activeCount < 10;
                });
        }

        return view('student.dashboard', compact('currentEnrollments', 'availableModules', 'canEnroll'));
    }

    public function history()
    {
        $user = Auth::user();
        if ($user->userRole->role === 'Old Student') {
             // Old Students ONLY see a list of completed modules
             $history = $user->enrollments()->with('module')->get();
        } else {
             // Students can see a history of completed modules
             $history = $user->enrollments()
                ->whereIn('status', ['pass', 'fail'])
                ->with('module')
                ->get();
        }

        return view('student.history', compact('history'));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
        ]);

        $user = Auth::user();

        // 1. Check max 4 current modules
        $currentCount = $user->enrollments()->where('status', 'enrolled')->count();
        if ($currentCount >= 4) {
            return redirect()->back()->with('error', 'You cannot enroll in more than 4 modules at once.');
        }

        // 2. Check module availability and max 10 students
        $module = Module::findOrFail($request->module_id);
        
        if (!$module->is_available) {
            return redirect()->back()->with('error', 'Module is not available.');
        }

        $moduleActiveCount = $module->enrollments()->where('status', 'enrolled')->count();
        if ($moduleActiveCount >= 10) {
             return redirect()->back()->with('error', 'Module is full.');
        }

        // 3. Check if already enrolled
        if ($user->enrollments()->where('module_id', $module->id)->exists()) {
             return redirect()->back()->with('error', 'You are already enrolled or have taken this module.');
        }

        // Enroll
        Enrollment::create([
            'user_id' => $user->id,
            'module_id' => $module->id,
            'status' => 'enrolled',
            'enrolled_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Enrolled successfully.');
    }
}
