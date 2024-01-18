<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PosController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseProductController;
use App\Http\Controllers\SettingsController;


// installation routes
Route::get('install', [InstallController::class, 'index'])->name('install');
Route::post('install/done', [InstallController::class, 'create'])->name('install.done');

// other routes 
Route::get('/', function () {
    return view('backend.home');
})->middleware('adminandsuperadmin')->name('home');

Auth::routes();

Route::get('/NoAuth', function () {
    return view('NoAuth');
});

// user routes here 
Route::get('/add-user', [UserController::class, 'addUser'])->name('add.user');
Route::post('/store-user', [UserController::class, 'storeUser'])->name('store.user');
Route::get('/all-users', [UserController::class, 'allUsers'])->name('all.users');
Route::get('/edit-user/{id}', [UserController::class, 'editUser']);
Route::post('/update-user/{id}', [UserController::class, 'updateUser']);
Route::get('/delete-user/{id}', [UserController::class, 'deleteUser']);
Route::get('/view-single-user/{id}', [UserController::class, 'viewSingleUser']);

// settings routes here 
Route::get('/show/settings', [SettingsController::class, 'index'])->name('show.settings');
Route::post('/update-settings/{id}', [SettingsController::class, 'updateSettings']);

// employee routes here 
Route::get('/add-employee', [EmployeeController::class, 'addEmployee'])->name('add.employee');
Route::post('/store-employee', [EmployeeController::class, 'storeEmployee'])->name('store.employee');
Route::get('/all-employee', [EmployeeController::class, 'index'])->name('all.employee');
Route::get('/edit-employee/{id}', [EmployeeController::class, 'editEmployee']);
Route::post('/update-employee/{id}', [EmployeeController::class, 'updateEmployee']);
Route::get('/delete-employee/{id}', [EmployeeController::class, 'deleteEmployee']);
Route::get('/view-single-employee/{id}', [EmployeeController::class, 'viewSingleEmployee']);

// salary routes here 
Route::get('/pay-salary', [SalaryController::class, 'paySalary'])->name('pay.salary');
Route::post('/store-salary', [SalaryController::class, 'storeSalary'])->name('store.salary');
Route::get('/paid-salary-info', [SalaryController::class, 'paidSalaryInfo'])->name('paid.salary.info');
Route::get('/delete-salary/{id}', [SalaryController::class, 'deleteSalary']);


// product routes here 
Route::get('/add-product', [ProductController::class, 'addProduct'])->name('add.product');
Route::post('/sore-product', [ProductController::class, 'storeProduct'])->name('store.product');
Route::get('/all-products', [ProductController::class, 'index'])->name('all.products');
Route::get('/edit-product/{id}', [ProductController::class, 'editProduct']);
Route::post('/update-product/{id}', [ProductController::class, 'updateProduct']);
Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct']);

// purchase product routes here
Route::get('/purchase-product-form', [PurchaseProductController::class, 'index'])->name('purchase.product.form');
Route::post('/add-cart-to-purchase', [PurchaseProductController::class, 'addCartToPurchase'])->name('add.cart.to.purchase');
Route::post('/cart-update-to-purchase/{rowId}', [PurchaseProductController::class, 'cartUpdateToPurchase'])->name('update.cart.to.purchase');
Route::get('/cart-remove-to-purchase/{rowId}', [PurchaseProductController::class, 'cartRemoveToPurchase'])->name('remove.cart.to.purchase');
Route::get('/generate-invoice-to-purchase', [PurchaseProductController::class, 'generateInvoiceToPurchase'])->name('generate.invoice.to.purchase');
Route::post('/final-invoice-for-purchase', [PurchaseProductController::class, 'finalInvoiceForPurchase'])->name('final.invoice.for.purchase');


// order routes
Route::get('/all-orders', [OrderController::class, 'allOrders'])->name('all.orders');
Route::get('/order-details/{orderId}', [OrderController::class, 'allOrderdetails']);

// income routes (order information from orders table which payment status is not due)
Route::get('/all-income', [OrderController::class, 'allIncome'])->name('all.income');

// expense routes 
Route::get('/expense', [ExpenseController::class, 'index'])->name('add.expense');
Route::post('/store-expense', [ExpenseController::class, 'storeExpense'])->name('store.expense');

// pos route here
Route::get('/pos', [PosController::class, 'index'])->name('pos');

// cart route here
Route::post('/add-cart', [CartController::class, 'index'])->name('add.cart');
Route::post('/cart-update/{rowId}', [CartController::class, 'cartUpdate'])->name('update.cart');
Route::get('/cart-remove/{rowId}', [CartController::class, 'cartRemove'])->name('remove.cart');
Route::post('/create-invoice', [CartController::class, 'createInvoice'])->name('create.invoice');
Route::post('/final-invoice', [CartController::class, 'finalInvoice'])->name('final.invoice');
