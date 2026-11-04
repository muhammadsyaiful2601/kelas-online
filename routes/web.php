<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Landing Page (Public)
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/kelas/{slug}', [LandingController::class, 'show'])->name('landing.show');
Route::post('/kelas/{course}/daftar', [LandingController::class, 'storeEnrollment'])->name('landing.enroll');

// Redirect /dashboard ke admin dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('categories', CategoryController::class)->except(['show']);

        Route::resource('courses', CourseController::class);

        Route::get('/enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
        Route::get('/enrollments/{enrollment}', [EnrollmentController::class, 'show'])->name('enrollments.show');
        Route::put('/enrollments/{enrollment}', [EnrollmentController::class, 'update'])->name('enrollments.update');
    });
});

require __DIR__.'/auth.php';
