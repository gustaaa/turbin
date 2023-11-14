<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\Input1Controller;
use App\Http\Controllers\Input2Controller;
use App\Http\Controllers\Input3Controller;
use App\Http\Controllers\ReportInput1Controller;
use App\Http\Controllers\ReportInput2Controller;
use App\Http\Controllers\ReportInput3Controller;
use App\Http\Controllers\ReportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard-A', [App\Http\Controllers\HomeController::class, 'rentangA']);
Route::get('/dashboard-B', [App\Http\Controllers\HomeController::class, 'rentangB']);

Route::resource('user', UserController::class);
Route::get('/laporan/user', [UserController::class, 'laporan']);
Route::post('import', [UserController::class, 'import'])->name('user.import');
Route::get('export', [UserController::class, 'export'])->name('user.export');
Route::get('demo', DemoController::class)->name('user.demo');
Route::resource('profile', ProfileController::class);
Route::group(['middleware' => 'auth'], function () {
    Route::get('password/{id}', [PasswordController::class, 'edit'])->name('edit.password');
    Route::post('password/{id}', [PasswordController::class, 'update'])->name('update.password');
});
Route::resource('input1', Input1Controller::class);
Route::resource('input2', Input2Controller::class);
Route::resource('input3', Input3Controller::class);

Route::resource('report1', ReportInput1Controller::class);
Route::get('/laporan/input1', [ReportInput1Controller::class, 'laporan']);
Route::resource('report2', ReportInput2Controller::class);
Route::get('/laporan/input2', [ReportInput2Controller::class, 'laporan']);
Route::resource('report3', ReportInput3Controller::class);
Route::get('/laporan/input3', [ReportInput3Controller::class, 'laporan']);
Route::resource('report', ReportController::class);
Route::get('/laporan/report-all', [ReportController::class, 'laporan']);

Route::get('export/input1', [ReportInput1Controller::class, 'export']);
Route::get('export/input2', [ReportInput2Controller::class, 'export']);
Route::get('export/input3', [ReportInput3Controller::class, 'export']);
Route::get('export/report-all', [ReportController::class, 'export']);
