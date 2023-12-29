<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;


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
Route::get('/pay-salary-done/{id}', [SalaryController::class, 'paySalaryDone'])->name('pay.salary.done');
Route::get('/show-all-salaries', [SalaryController::class, 'showAllSalaries'])->name('show.all.salaries');
