<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('backend.home');
})->middleware('adminandsuperadmin')->name('home');

Auth::routes();

Route::get('/NoAuth', function () {
    return view('NoAuth');
});
