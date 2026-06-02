<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\PublicController;
use App\Http\Controllers\PpdbController;

/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TutorController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\PpdbController as AdminPpdbController;
use App\Http\Controllers\Admin\TutorSubjectController;

/*
|--------------------------------------------------------------------------
| Tutor Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use App\Http\Controllers\Tutor\GradeController as TutorGradeController;

/*
|--------------------------------------------------------------------------
| Student Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\GradeController as StudentGradeController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicController::class, 'home'])
    ->name('home');

Route::get('/about', [PublicController::class, 'about'])
    ->name('about');

Route::get('/packages', [PublicController::class, 'packages'])
    ->name('packages');

Route::get('/tutors', [PublicController::class, 'tutors'])
    ->name('tutors');

Route::get('/news', [PublicController::class, 'news'])
    ->name('news');

Route::get('/contact', [PublicController::class, 'contact'])
    ->name('contact');

/*
|--------------------------------------------------------------------------
| PPDB PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/ppdb', [PpdbController::class, 'create'])
    ->name('ppdb.create');

Route::post('/ppdb', [PpdbController::class, 'store'])
    ->name('ppdb.store');

/*
|--------------------------------------------------------------------------
| DASHBOARD BAWAAN BREEZE
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])
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

Route::middleware([
    'auth',
    'role:admin'
])
->prefix('admin')
->name('admin.')
->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [AdminDashboardController::class, 'index']
    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | User Management
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'users',
        UserController::class
    );

    Route::put(
        'users/{user}/reset-password',
        [UserController::class, 'resetPassword']
    )->name('users.reset-password');

    /*
    |--------------------------------------------------------------------------
    | Package Management
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'packages',
        PackageController::class
    );

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

    /*
    |--------------------------------------------------------------------------
    | Tutor Management
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'tutors',
        TutorController::class
    );

    /*
    |--------------------------------------------------------------------------
    | Student Management
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'students',
        StudentController::class
    );

    /*
    |--------------------------------------------------------------------------
    | PPDB Management
    |--------------------------------------------------------------------------
    */

    Route::get(
        'ppdb',
        [AdminPpdbController::class, 'index']
    )->name('ppdb.index');

    Route::get(
        'ppdb/{ppdb}',
        [AdminPpdbController::class, 'show']
    )->name('ppdb.show');

    Route::put(
        'ppdb/{ppdb}/approve',
        [AdminPpdbController::class, 'approve']
    )->name('ppdb.approve');

    Route::put(
        'ppdb/{ppdb}/reject',
        [AdminPpdbController::class, 'reject']
    )->name('ppdb.reject');

    Route::delete(
        'ppdb/{ppdb}',
        [AdminPpdbController::class, 'destroy']
    )->name('ppdb.destroy');

    /*
    |--------------------------------------------------------------------------
    | Tutor Subject Assignment
    |--------------------------------------------------------------------------
    */

    Route::get(
        'tutor-subjects',
        [TutorSubjectController::class, 'index']
    )->name('tutor-subjects.index');

    Route::get(
        'tutor-subjects/create',
        [TutorSubjectController::class, 'create']
    )->name('tutor-subjects.create');

    Route::post(
        'tutor-subjects',
        [TutorSubjectController::class, 'store']
    )->name('tutor-subjects.store');

    Route::delete(
        'tutor-subjects/{tutor}/{subject}',
        [TutorSubjectController::class, 'destroy']
    )->name('tutor-subjects.destroy');
});

/*
|--------------------------------------------------------------------------
| TUTOR
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:tutor'
])
->prefix('tutor')
->name('tutor.')
->group(function () {

    Route::get(
        '/dashboard',
        [TutorDashboardController::class, 'index']
    )->name('dashboard');

    Route::resource(
        'grades',
        TutorGradeController::class
    );
});

/*
|--------------------------------------------------------------------------
| STUDENT
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth',
    'role:student'
])
->prefix('student')
->name('student.')
->group(function () {

    Route::get(
        '/dashboard',
        [StudentDashboardController::class, 'index']
    )->name('dashboard');

    Route::get(
        '/grades',
        [StudentGradeController::class, 'index']
    )->name('grades.index');

    Route::get(
        '/grades/{grade}',
        [StudentGradeController::class, 'show']
    )->name('grades.show');
});

require __DIR__.'/auth.php';