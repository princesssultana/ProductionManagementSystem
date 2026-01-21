<?php

use App\Http\Controllers\AdminnController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
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

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/',[HomeController::class,'home']);

Route::get('/about-us',[HomeController::class,'aboutUs']);

// Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/category-list', [CategoryController::class, 'list'])->name('category.list');
    Route::get('/category-list/create', [CategoryController::class, 'createForm'])->name('category.create.form');
    Route::post('/category-list/store', [CategoryController::class, 'storeCategory'])->name('category.store');
    Route::get('/products',[ProductController::class,'list'])->name('products.list');
    Route::get('/product/form', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    // Customer routes
    Route::get('/customer/list', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/view/{id}', [CustomerController::class, 'view'])->name('customer.view');
    Route::get('/customer/form', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/delete/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    // Demand/Production Order routes
    Route::resource('demands', DemandController::class);
    Route::get('/demands/{id}/materials', [DemandController::class, 'materials'])->name('demands.materials');
    
    // Materials routes
    Route::resource('materials', PackagingMaterialsController::class);
    
    // Stock routes
    Route::resource('stocks', StockController::class);
    
    // Admin routes
    Route::get('/admin', [AdminnController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('admin-users', AdminUserController::class);
    Route::put('/demands/{demand}', [DemandController::class, 'update'])->name('demands.update');
    
    // Reports
    Route::get('/reports/production', [ReportController::class, 'productionReport'])->name('reports.production');
    
    // Factory settings
    Route::resource('factories', FactorySettingsController::class);
    Route::get('/factory-settings', [FactorySettingsController::class, 'index'])->name('factory-settings.index');
    Route::get('/factory-settings/create', [FactorySettingsController::class, 'create'])->name('factory-settings.create');
    
    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/search', [PaymentController::class, 'search'])->name('payments.search');
});



