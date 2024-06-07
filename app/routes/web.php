<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PasswordResetController;

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
Auth::routes();
Route::get('/', [DisplayController::class, 'index']);


//新規登録
Route::post('/register', [RegistrationController::class, 'register'])->name('register');
Route::post('/register/confirm', [RegistrationController::class, 'confirm'])->name('register.confirm');
Route::post('/register/complete', [RegistrationController::class, 'complete'])->name('register.complete');


//パスワードリセット
Route::get('/password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.request');
Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

//一覧
Route::get('/inventory', [DisplayController::class, 'index'])->name('inventory');
Route::get('/inventory/search', [DisplayController::class, 'search'])->name('inventory.search');
