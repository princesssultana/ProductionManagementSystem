<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorylistController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DemandDetailsController;
use App\Http\Controllers\FactorySettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PackagingMaterialsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function (){
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'home']);

Route::get('/about-us',[HomeController::class,'aboutUs']);



Route::get('/category-list', [CategoryController::class, 'list'])->name('category.list');
Route::get('/category-list/create-form', [CategoryController::class, 'createform'])->name('category.create.form');

Route::get('/report-list', [ReportController::class, 'index'])->name('report.list');
Route::get('/report-create',[ReportController::class, 'create'])->name('report.create');


Route::get('/medicine-list', [MedicineController::class, 'index'])->name('medicine.list');
Route::get('/medicine-create',[MedicineController::class, 'create'])->name('medicine.create');
Route::get('/medicine-expired',[MedicineController::class, 'expired'])->name('medicine.expired');

Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');


Route::get('/materials', [PackagingMaterialsController::class, 'index'])->name('materials.index');
Route::get('/materials/create', [PackagingMaterialsController::class, 'create'])->name('materials.create');

Route::get('/factory-settings', [FactorySettingsController::class, 'index'])->name('factory-settings.index');
Route::get('/factory-settings/create', [FactorySettingsController::class, 'create'])->name('factory-settings.create');

Route::get('/demands', [DemandDetailsController::class, 'index'])->name('demands.index');
Route::get('/demands/create', [DemandDetailsController::class, 'create'])->name('demands.create');

Route::get('/admin-users', [AdminUserController::class, 'index'])->name('admin-users.index');
Route::get('/admin-users/create', [AdminUserController::class, 'create'])->name('admin-users.create');

Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payments/search', [PaymentController::class, 'search'])->name('payments.search');

Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');