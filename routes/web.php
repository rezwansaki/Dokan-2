<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;
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
