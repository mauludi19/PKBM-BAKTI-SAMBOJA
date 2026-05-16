<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'home'])->name('home');

Route::get('/tutors', [PublicController::class, 'tutors'])->name('tutors.index');

Route::get('/students', [PublicController::class, 'students'])->name('students.index');

/*
|--------------------------------------------------------------------------
| PPDB Routes
|--------------------------------------------------------------------------
*/

Route::get('/ppdb', [PpdbController::class, 'create'])->name('ppdb.create');
Route::post('/ppdb', [PpdbController::class, 'store'])->name('ppdb.store');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| Tutor Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:tutor'])
    ->prefix('tutor')
    ->name('tutor.')
    ->group(function () {
        Route::get('/dashboard', [TutorDashboardController::class, 'index'])
            ->name('dashboard');
    });

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');
    });

Route::get('/login', function () {
    return 'Halaman Login';
})->name('login');
