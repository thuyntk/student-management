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
Route::group(['middleware' => ['auth', 'permission:list']], function () {
    Route::get('personal', [DashboardController::class, 'index'])->name('personal');
    Route::get('faculties', [FacultyController::class, 'index'])->name('faculties.index');
    Route::get('subjects', [SubjectController::class, 'index'])->name('subjects.index');
});

Route::post('register-subject', [StudentController::class, 'regSubject'])->name('registerSubject');

Route::group(['middleware' => ['auth', 'permission:create|update|delete']], function () {
    Route::get('search', [StudentController::class, 'search'])->name('search');
    Route::resource('students', StudentController::class); 
    Route::resource('faculties', FacultyController::class)->except('index');
    Route::resource('subjects', SubjectController::class)->except('index');
    Route::get('send-mail', [StudentController::class, 'sendMail'])->name('send-mail');
    // Route::get('student/{id}/points', [StudentController::class, 'updatePoint'])->name('updatePoint');
    // Route::post('save-point/{id}', [StudentController::class, 'savePoint'])->name('savePoint');
    Route::get('/students/{id}/points', [StudentController::class, 'addPoint'])->name('students.addpoint.index');
    Route::post('/students/{id}/points', [StudentController::class, 'savePoint'])->name('students.savePoint');
    Route::post('mail/{id}', [SubjectController::class, 'mail'])->name('mail');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
