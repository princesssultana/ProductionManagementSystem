<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorylistController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DemandController;
use App\Http\Controllers\DemandDetailsController;
use App\Http\Controllers\FactorySettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PackagingMaterialsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function (){
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'home']);

Route::get('/about-us',[HomeController::class,'aboutUs']);



Route::get('/category-list', [CategoryController::class, 'list'])->name('category.list');
Route::get('/category-list/create', [CategoryController::class, 'createForm'])->name('category.create.form');
Route::post('/category-list/store', [CategoryController::class, 'storeCategory'])->name('category.store');
Route::get('/products',[ProductController::class,'list'])->name('products.list');
Route::get('/product/form', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/customer/list',[CustomerController::class,'index'])->name('customer.list');
Route::get('/customer/form',[CustomerController::class,'create'])->name('customer.create');
Route::post('/customer/store',[CustomerController::class,'store'])->name('customer.store');
Route::resource('demands', DemandController::class);






Route::get('/report-list', [ReportController::class, 'index'])->name('report.list');
Route::get('/report-create',[ReportController::class, 'create'])->name('report.create');



Route::get('/stock', [ReportController::class, 'index'])->name('stocks.index');






Route::get('/materials', [PackagingMaterialsController::class, 'index'])->name('materials.index');
Route::get('/materials/create', [PackagingMaterialsController::class, 'create'])->name('materials.create');

Route::get('/factory-settings', [FactorySettingsController::class, 'index'])->name('factory-settings.index');
Route::get('/factory-settings/create', [FactorySettingsController::class, 'create'])->name('factory-settings.create');



Route::get('/admin-users', [AdminUserController::class, 'index'])->name('admin-users.index');
Route::get('/admin-users/create', [AdminUserController::class, 'create'])->name('admin-users.create');

Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payments/search', [PaymentController::class, 'search'])->name('payments.search');



