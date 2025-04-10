<?php

use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Grades\GradesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
    function () { //.


        // Route::get('/',function(){
        //     return view('dashboard');
        // });
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


        // ========================================Grades========================================
        //    Route::resource('/grades', GradesController::class);
        Route::controller(GradesController::class)->prefix('grades')->group(function () {
            Route::get('/', 'index')->name('grades.index');
            Route::POST('/store', 'store')->name('grades.store');
            Route::PATCH('/update', 'update')->name('grades.update');
            Route::delete('/delete', 'destroy')->name('grades.destroy');
        });

        // =============================================Classrooms=======================================

        // Route::resource('/classrooms',ClassroomController::class);



        Route::controller(ClassroomController::class)->prefix('classrooms')->group(function () {
            Route::get('/', 'index')->name('classrooms.index');
            Route::post('/store', 'store')->name('classrooms.store');
            Route::patch('/update', 'update')->name('classrooms.update');
            Route::delete('/destroy', 'destroy')->name('classrooms.destroy');
        });
    }
);
