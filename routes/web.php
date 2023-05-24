<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallController;

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
