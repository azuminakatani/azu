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
Route::post('/login', [DisplayController::class, 'login'])->name('login');

//新規登録
Route::post('/register', [RegistrationController::class, 'register'])->name('register');
Route::post('/register/confirm', [RegistrationController::class, 'confirm'])->name('register.confirm');
Route::post('/register/complete', [RegistrationController::class, 'complete'])->name('register.complete');


//パスワードリセット
Route::post('/password/email', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/password/update', [PasswordResetController::class, 'reset'])->name('password.update');
Route::get('/password/reset', [PasswordResetController::class, 'showResetEmailForm'])->name('password.request');
Route::get('/password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');


Route::middleware('auth')->group(function () {

    Route::prefix('admin')->group(function () {
//管理者
//全店舗一覧
Route::get('/all_stores_list', [AdminController::class, 'allStoresList'])->name('all_stores_list');
Route::get('/all_stores_list/search', [AdminController::class, 'storeSearch'])->name('store.search');
// 各店舗在庫一覧
Route::get('/admin/stores/{store}/stocks', [AdminController::class, 'storeStocks'])->name('admin.stocks');


//商品一覧
Route::get('/product_list', [AdminController::class, 'productList'])->name('product_list');
Route::get('/products/search', [AdminController::class, 'productsSearch'])->name('products.search');
Route::get('/product/{id}/edit', [AdminController::class, 'productEdit'])->name('product.edit');
Route::put('/product/{id}/update', [AdminController::class, 'productUpdate'])->name('product.update');
Route::delete('/product/{id}', [AdminController::class, 'productDelete'])->name('product.delete');

//商品登録
Route::get('/products/register', [AdminController::class, 'showProductRegistrForm'])->name('products.register');
Route::post('/products/register', [AdminController::class, 'ProductRegistr'])->name('products.register.post');
Route::post('/products/register/confirmation', [AdminController::class, 'ProductRegistrConfirm'])->name('products.register.confirm');


//自店舗一覧
Route::get('/own_store_inventory', [AdminController::class, 'ownStoreInventory'])->name('own_store_inventory');
Route::get('/own_store_inventory/search', [AdminController::class, 'ownInventorySearch'])->name('own.inventory.search');
Route::delete('/own_store_inventory/{id}', [AdminController::class, 'ownInventoryDelete'])->name('own.inventory.delete');
Route::get('/own_store_inventory/items', [AdminController::class, 'infiniteScroll'])->name('own.inventory.infinite-scroll');


//入荷予定
Route::get('/arrival_Schedule', [AdminController::class, 'arrivalSchedule'])->name('arrival_schedule');
Route::get('/arrival_Schedule/create', [AdminController::class, 'arrivalScheduleCreate'])->name('arrival_schedule.create');
Route::get('/arrival_Schedule/search', [AdminController::class, 'searchArrivalSchedule'])->name('arrival_schedule.search');
//入荷確定
Route::get('/arrival_Schedule/{id}', [AdminController::class, 'confirmArrivalSchedule'])->name('arrival_schedule.confirm');
//入荷登録
Route::post('/arrival_Schedule/store', [AdminController::class, 'arrivalScheduleStore'])->name('arrival_schedule.store');
Route::post('/arrival_Schedule/complete', [AdminController::class, 'arrivalScheduleComplete'])->name('arrival_schedule.complete');



//一般社員一覧
Route::get('/employee_list', [AdminController::class, 'employeeList'])->name('employee_list');
Route::get('/employee_list/search', [AdminController::class, 'employeeSearch'])->name('employee_list.search');
Route::delete('/employees/{id}', [AdminController::class, 'employeesDelete'])->name('employees.delete');
Route::get('/employees/create', [AdminController::class, 'employeeCreate'])->name('employees.create');
Route::post('/employees/store', [AdminController::class, 'employeeStore'])->name('employees.store');
Route::post('/employees/complete', [AdminController::class, 'employeeComplete'])->name('employees.complete');
  
});

Route::prefix('employee')->group(function () {
//社員
//在庫一覧
Route::get('/inventory', [DisplayController::class, 'index'])->name('inventory');
Route::get('/general_inventory', [GeneralsController::class, 'index'])->name('inventory.general');
Route::get('/inventory/search', [GeneralsController::class, 'inventorySearch'])->name('inventory.search');
Route::delete('/inventory/{id}', [GeneralsController::class, 'inventoryDelete'])->name('inventory.delete');
Route::get('/inventory/infinite-scroll', [GeneralsController::class, 'infiniteScroll'])->name('inventory.infinite-scroll');


//入荷予定
Route::get('/arrival_list', [GeneralsController::class, 'arrivalList'])->name('arrival_list');
Route::get('/arrival_list/search', [GeneralsController::class, 'arrivalListSearch'])->name('arrival_list.search');
Route::delete('/arrival_list/{id}', [GeneralsController::class, 'iarrivalListDelete'])->name('arrival_list.delete');
Route::get('/arrival_list/create', [GeneralsController::class, 'arrivalListCreate'])->name('arrival_list.create');
//入荷確定
Route::get('/arrival_list/confirm/{id}', [GeneralsController::class, 'confirmArrival'])->name('arrival_confirm');


//入荷詳細
Route::get('/arrival_list/{id}', [GeneralsController::class, 'arrivalListShow'])->name('arrival_list.show');
Route::delete('/arrival_list/{id}', [GeneralsController::class, 'arrivalListDelete'])->name('arrival_delete');

// 入荷予定編集
Route::get('/arrival_list/{id}/edit', [GeneralsController::class, 'arrivalListEdit'])->name('arrival_edit');
Route::put('/arrival_list/{id}/update', [GeneralsController::class, 'arrivalListUpdate'])->name('arrival_update');

//入荷登録
Route::post('/arrival/store', [GeneralsController::class, 'arrivalListStore'])->name('arrival_list.store');
Route::post('/arrival/complete', [GeneralsController::class, 'arrivalListComplete'])->name('arrival_list.complete');
});

});
