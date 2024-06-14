<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\GeneralsController;
use App\Http\Controllers\AdminController;


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
Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');
Route::get('/password/reset', [PasswordResetController::class, 'showResetEmailForm'])->name('password.request');
Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');


//管理者
Route::get('/all_stores_list', [AdminController::class, 'allStoresList'])->name('all_stores_list');
Route::get('/product_list', [AdminController::class, 'productList'])->name('product_list');
Route::get('/own_store_inventory', [AdminController::class, 'ownStoreInventory'])->name('own_store_inventory');
Route::get('/arrival_Schedule', [AdminController::class, 'arrivalSchedule'])->name('arrival_schedule');
Route::get('/employee_list', [AdminController::class, 'employeeList'])->name('employee_list');

Route::delete('/products/{id}', [AdminController::class, 'productDelete'])->name('product.delete');
Route::delete('/employees/{id}', [AdminController::class, 'employeesDelete'])->name('employees.delete');




//社員
//在庫一覧
Route::get('/inventory', [DisplayController::class, 'index'])->name('inventory');
Route::get('/general_inventory', [GeneralsController::class, 'index'])->name('inventory.general');
Route::get('/inventory/search', [GeneralsController::class, 'inventorySearch'])->name('inventory.search');
Route::delete('/inventory/{id}', [GeneralsController::class, 'inventoryDelete'])->name('inventory.delete');


//入荷予定
Route::get('/arrival_list', [GeneralsController::class, 'arrivalList'])->name('arrival_list');
Route::get('/arrival_list/search', [GeneralsController::class, 'arrivalListSearch'])->name('arrival_list.search');
Route::delete('/arrival_list/{id}', [GeneralsController::class, 'iarrivalListDelete'])->name('arrival_list.delete');
Route::post('/arrival_list/store', [GeneralsController::class,'arrivalListStore'])->name('arrival_list.store');
Route::get('/arrival_list/{id}', [GeneralsController::class, 'arrivalListShow'])->name('arrival_list.show');
Route::get('/arrival_list/create', [GeneralsController::class, 'arrivalListCreate'])->name('arrival_list.create');
Route::get('/arrival_list/create', [GeneralsController::class, 'arrivalListCreate'])->name('arrival_list.create');
