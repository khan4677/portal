<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\MessageController;

Route::view('/', 'welcome')->name('welcome');

require __DIR__.'/auth.php';

// ---------------- Student Routes ----------------
Route::middleware(['auth','verified','role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/student/profile', [StudentDashboardController::class, 'profile'])->name('student.profile');
    Route::post('/student/profile', [StudentDashboardController::class, 'profileUpdate'])->name('student.profile.update');
    Route::post('/student/message', [StudentDashboardController::class, 'messageStore'])->name('student.message.store');

    // Submit assignment
    Route::post('/assignments/{assignment}/submit', [SubmissionController::class, 'store'])->name('submissions.store');

    // View **their own submissions**
    Route::get('/student/assignments/{assignment}/submissions', [SubmissionController::class, 'showStudentSubmissions'])->name('submissions.show');

    // View own results
    Route::get('/results/my', [ResultController::class, 'studentIndex'])->name('results.student');
});

// ---------------- Teacher Routes ----------------
Route::middleware(['auth','verified','role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');

    // Assignment CRUD
    Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/assignments/{assignment}/edit', [AssignmentController::class, 'edit'])->name('assignments.edit');
    Route::put('/assignments/{assignment}', [AssignmentController::class, 'update'])->name('assignments.update');
    Route::delete('/assignments/{assignment}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');

    // View **all submissions** for any assignment
    Route::get('/teacher/assignments/{assignment}/submissions', [SubmissionController::class, 'index'])->name('submissions.index');

    // Grade a submission
    Route::post('/submissions/{submission}/grade', [SubmissionController::class, 'grade'])->name('submissions.grade');

    // Teacher results
    Route::get('/results/create', [ResultController::class, 'create'])->name('results.create');
    Route::post('/results', [ResultController::class, 'store'])->name('results.store');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply');
});

// ---------------- Common Routes ----------------
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/{assignment}', [AssignmentController::class, 'show'])->name('assignments.show');
});
