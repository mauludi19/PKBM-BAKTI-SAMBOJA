<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PpdbController;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\SubjectController;

use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;

/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'home'])
    ->name('home');

Route::get('/tutors', [PublicController::class, 'tutors'])
    ->name('tutors.index');

Route::get('/students', [PublicController::class, 'students'])
    ->name('students.index');

/*
|--------------------------------------------------------------------------
| PPDB
|--------------------------------------------------------------------------
*/

Route::get('/ppdb', [PpdbController::class, 'create'])
    ->name('ppdb.create');

Route::post('/ppdb', [PpdbController::class, 'store'])
    ->name('ppdb.store');

/*
|--------------------------------------------------------------------------
| DEFAULT DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->get('/dashboard', function () {
        return redirect()->route('home');
    })
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Package Management
        |--------------------------------------------------------------------------
        */

        Route::resource('packages', PackageController::class);

        /*
        |--------------------------------------------------------------------------
        | Academic Year Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'academic-years',
            AcademicYearController::class
        );

        /*
        |--------------------------------------------------------------------------
        | Subject Management
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'subjects',
            SubjectController::class
        );
    });

/*
|--------------------------------------------------------------------------
| TUTOR
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
| STUDENT
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {

        Route::get('/dashboard', [StudentDashboardController::class, 'index'])
            ->name('dashboard');
    });

require __DIR__.'/auth.php';