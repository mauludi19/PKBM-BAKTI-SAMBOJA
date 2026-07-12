<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| PUBLIC CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\PublicController;
use App\Http\Controllers\PpdbController;

/*
|--------------------------------------------------------------------------
| ADMIN CONTROLLERS
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
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\PageController as AdminPageController;

/*
|--------------------------------------------------------------------------
| TUTOR CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Tutor\DashboardController as TutorDashboardController;
use App\Http\Controllers\Tutor\GradeController as TutorGradeController;

/*
|--------------------------------------------------------------------------
| STUDENT CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\GradeController as StudentGradeController;


/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
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

Route::get('/ppdb/create', [PpdbController::class, 'create'])
    ->name('ppdb.create');

Route::post('/ppdb', [PpdbController::class, 'store'])
    ->name('ppdb.store');

Route::get('/ppdb/success', [PpdbController::class, 'success'])
    ->name('ppdb.success');


/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT BASED ON ROLE
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {

    $user = Auth::user();

    return match ($user->role) {

        'admin' => redirect()
            ->route('admin.dashboard'),

        'tutor' => redirect()
            ->route('tutor.dashboard'),

        'student' => redirect()
            ->route('student.dashboard'),

        default => redirect()
            ->route('home'),
    };
})->middleware('auth')->name('dashboard');


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
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        Route::get(
            '/dashboard',
            [AdminDashboardController::class, 'index']
        )->name('dashboard');


        Route::resource('users', UserController::class);

        Route::resource('packages', PackageController::class);

        Route::resource('academic-years', AcademicYearController::class);

        Route::resource('subjects', SubjectController::class);

        Route::resource('tutors', TutorController::class);

        Route::resource('students', StudentController::class);

        Route::resource('news', AdminNewsController::class);

        Route::resource('pages', AdminPageController::class);



        /*
        |--------------------------------------------------------------------------
        | PPDB ADMIN
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/ppdb',
            [AdminPpdbController::class, 'index']
        )->name('ppdb.index');


        Route::get(
            '/ppdb/{ppdb}',
            [AdminPpdbController::class, 'show']
        )->name('ppdb.show');


        Route::put(
            '/ppdb/{ppdb}/approve',
            [AdminPpdbController::class, 'approve']
        )->name('ppdb.approve');


        Route::put(
            '/ppdb/{ppdb}/reject',
            [AdminPpdbController::class, 'reject']
        )->name('ppdb.reject');


        Route::delete(
            '/ppdb/{ppdb}',
            [AdminPpdbController::class, 'destroy']
        )->name('ppdb.destroy');



        /*
        |--------------------------------------------------------------------------
        | TUTOR SUBJECT
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/tutor-subjects',
            [TutorSubjectController::class, 'index']
        )->name('tutor-subjects.index');


        Route::get(
            '/tutor-subjects/create',
            [TutorSubjectController::class, 'create']
        )->name('tutor-subjects.create');


        Route::post(
            '/tutor-subjects',
            [TutorSubjectController::class, 'store']
        )->name('tutor-subjects.store');


        Route::delete(
            '/tutor-subjects/{tutor}/{subject}',
            [TutorSubjectController::class, 'destroy']
        )->name('tutor-subjects.destroy');
    });



/*
|--------------------------------------------------------------------------
| TUTOR AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:tutor'])
    ->prefix('tutor')
    ->name('tutor.')
    ->group(function () {


        Route::get(
            '/dashboard',
            [TutorDashboardController::class, 'index']
        )->name('dashboard');


        Route::resource('grades', TutorGradeController::class);
    });



/*
|--------------------------------------------------------------------------
| STUDENT AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:student'])
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



/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';
