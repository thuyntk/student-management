<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['auth', 'permission:list']], function() {
    Route::get('faculties', [FacultyController::class, 'index'])->name('faculties.index'); 
    Route::get('subjects', [SubjectController::class, 'index'])->name('subjects.index'); 
    Route::get('students', [StudentController::class, 'index'])->name('students.index'); 
});

Route::group(['middleware' => ['auth', 'permission:create|update|delete']], function() {
    Route::resource('faculties', FacultyController::class)->except('index'); 
    Route::resource('subjects', SubjectController::class)->except('index'); 
    Route::resource('students', StudentController::class)->except('index'); 
}); 

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
