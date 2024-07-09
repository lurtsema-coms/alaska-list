<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function (){

});

Route::view('/', 'page.welcome')->name('welcome');
Route::view('categories', 'page.categories')->name('categories');
Route::view('about-us', 'page.about-us')->name('about-us');
Route::view('advertise-with-us', 'page.advertise-with-us')->name('advertise-with-us');
Route::view('listing-page', 'page.listing-page')->name('listing-page');
Route::view('listing-page/item/1', 'page.listing-item')->name('listing-page-item');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::view('dashboard', 'page-backend.b-dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');

    // Routes for users with 'seller' role
    Route::middleware('role:seller')->group(function() {
        Route::view('admin-categories', 'page-backend.admin.b-categories')->name('admin-categories');
    });

    // Routes for users with 'approver' role
    Route::middleware('role:approver')->group(function() {
        Route::view('admin-categories', 'page-backend.admin.b-categories')->name('admin-categories');
    });

    // Routes for users with 'admin' role
    Route::middleware('role:admin')->group(function() {
        Route::view('admin-categories', 'page-backend.admin.b-categories')->name('admin-categories');
    });

});

require __DIR__.'/auth.php';
