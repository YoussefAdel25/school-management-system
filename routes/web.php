<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Livewire\AddParent;
use App\Http\Controllers\Grades\GradesController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Teachers\TeacherController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// routes/web.php


Auth::routes();
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        // =============================================================Grades========================================
        Route::controller(GradesController::class)->prefix('grades')->group(function () {
            Route::get('/', 'index')->name('grades.index');
            Route::POST('/store', 'store')->name('grades.store');
            Route::PATCH('/update', 'update')->name('grades.update');
            Route::delete('/delete', 'destroy')->name('grades.destroy');
        });

        // =============================================================Classrooms========================================================
        Route::prefix('classrooms')->name('classrooms.')->controller(ClassroomController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::delete('/destroy', 'destroy')->name('destroy');
            Route::post('/filter', 'filter')->name('filter');
            Route::post('/deleteAll', 'deleteAll')->name('deleteAll');
        });
        Route::get('classes/{gradeId}',  [ClassroomController::class, 'getClassesByGrade']);

        //============================================================Sections====================================================================
        Route::prefix('sections')->name('sections.')->controller(SectionController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/store', 'store')->name('store');
            Route::patch('/update/{id}', 'update')->name('update');
            Route::delete('/destroy', 'destroy')->name('destroy');
        });


        // /=========================================================Teachers======================================================
        Route::prefix('teachers')->name('teachers.')->controller(TeacherController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::patch('/update','update')->name('update');
            Route::delete('/destroy', 'destroy')->name('destroy');
        });

            // Route::resource('teachers/', TeacherController::class);//


        //============================================================Parents=======================================================

        Route::get('/add-parent', AddParent::class)->name('addParent');
          Livewire::setUpdateRoute(function ($handle) {
               return Route::post('/livewire/update', $handle);
        });




    }
);
