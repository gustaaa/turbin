<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
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

Route::resource('user', UserController::class);
Route::post('import', [UserController::class, 'import'])->name('user.import');
Route::get('export', [UserController::class, 'export'])->name('user.export');
Route::get('demo', DemoController::class)->name('user.demo');
Route::resource('profile', ProfileController::class);
Route::group(['middleware' => 'auth'], function () {
    Route::get('password/{id}', [PasswordController::class, 'edit'])->name('edit.password');
    Route::post('password/{id}', [PasswordController::class, 'update'])->name('update.password');
});
