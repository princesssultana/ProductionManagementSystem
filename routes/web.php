<?php

use App\Http\Controllers\AdminnController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorylistController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DemandController;
use App\Http\Controllers\DemandDetailsController;
use App\Http\Controllers\FactorySettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PackagingMaterialController;
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

// Customer list page
Route::get('/customer/list', [CustomerController::class, 'index'])->name('customer.index');

// Customer view page
Route::get('/customer/view/{id}', [CustomerController::class, 'view'])->name('customer.view');

// Customer create page
Route::get('/customer/form', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');

// Customer edit page
Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');

// Customer delete
Route::delete('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

Route::resource('demands', DemandController::class);
Route::resource('materials', PackagingMaterialsController::class);
Route::resource('stocks', StockController::class);
Route::get('/admin', [AdminnController::class, 'dashboard'])
    ->name('admin.dashboard');
Route::put('/demands/{demand}', [DemandController::class, 'update'])->name('demands.update');
Route::get('/reports/production', [ReportController::class, 'productionReport'])
    ->name('reports.production');














Route::get('/factory-settings', [FactorySettingsController::class, 'index'])->name('factory-settings.index');
Route::get('/factory-settings/create', [FactorySettingsController::class, 'create'])->name('factory-settings.create');




Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
Route::get('/payments/search', [PaymentController::class, 'search'])->name('payments.search');



