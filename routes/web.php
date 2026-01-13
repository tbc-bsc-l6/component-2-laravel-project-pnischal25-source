<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/splash', \App\Livewire\SplashPage::class)->name('splash');

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->userRole->role === 'Admin') return redirect()->route('admin.dashboard');
    if ($user->userRole->role === 'Teacher') return redirect()->route('teacher.dashboard');
    if ($user->userRole->role === 'Student') return redirect()->route('student.dashboard');
    if ($user->userRole->role === 'Old Student') return redirect()->route('student.history');
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/teachers', [\App\Http\Controllers\AdminController::class, 'storeTeacher'])->name('teachers.store');
    Route::delete('/users/{user}', [\App\Http\Controllers\AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::post('/modules', [\App\Http\Controllers\AdminController::class, 'storeModule'])->name('modules.store');
    Route::patch('/modules/{module}/toggle', [\App\Http\Controllers\AdminController::class, 'toggleModule'])->name('modules.toggle');
    Route::post('/modules/assign-teacher', [\App\Http\Controllers\AdminController::class, 'assignTeacherToModule'])->name('modules.assignTeacher');
    Route::delete('/modules/unassign-teacher', [\App\Http\Controllers\AdminController::class, 'unassignTeacherFromModule'])->name('modules.unassignTeacher');
    Route::patch('/users/{user}/role', [\App\Http\Controllers\AdminController::class, 'updateUserRole'])->name('users.updateRole');
    Route::delete('/enrollments/{enrollment}', [\App\Http\Controllers\AdminController::class, 'removeStudentFromModule'])->name('enrollments.destroy');
});

Route::middleware(['auth', 'role:Teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\TeacherController::class, 'dashboard'])->name('dashboard');
    Route::get('/modules/{module}', [\App\Http\Controllers\TeacherController::class, 'viewModule'])->name('modules.show');
    Route::patch('/enrollments/{enrollment}/grade', [\App\Http\Controllers\TeacherController::class, 'gradeStudent'])->name('enrollments.grade');
});

Route::middleware(['auth'])->prefix('student')->name('student.')->group(function () {
    // Both Student and Old Student can access history? No, Old Student ONLY sees history.
    // Dashboard logic in controller handles displaying correct view/data, or we separate routes.
    // Controller `dashboard` handles "Current" modules. `history` handles "Completed".
    // Old Student shouldn't access `dashboard` (enrollment)? 
    // Requirement "Old Students ONLY see a list of completed modules".
    
    // So separate route for history might be better access controlled.
    
    Route::get('/history', [\App\Http\Controllers\StudentController::class, 'history'])->name('history');

    Route::middleware('role:Student')->group(function() {
        Route::get('/dashboard', [\App\Http\Controllers\StudentController::class, 'dashboard'])->name('dashboard');
        Route::post('/enroll', [\App\Http\Controllers\StudentController::class, 'enroll'])->name('enroll');
    });
});

require __DIR__.'/auth.php';
