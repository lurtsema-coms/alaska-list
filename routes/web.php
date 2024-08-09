<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

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

Route::view('/', 'page.welcome')->name('welcome');
// Route::view('categories', 'page.categories')->name('categories');
Route::view('about-us', 'page.about-us')->name('about-us');
Route::view('advertise-with-us', 'page.advertise-with-us')->name('advertise-with-us');
Route::view('listing-page', 'page.listing-page')->name('listing-page');
Route::view('listing-page/item/{id}', 'page.listing-item')->name('listing-page-item');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::view('dashboard', 'page-backend.b-dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');

    // Routes for users with 'seller' role
    Route::middleware('role:seller')->group(function() {
        Route::view('admin-categories', 'page-backend.admin.b-categories')->name('admin-categories');
        Route::view('seller-listing', 'page-backend.seller.b-listing')->name('seller-listing');
        Route::view('seller-listing/add-item', 'page-backend.seller.b-listing-add-item')->name('seller-listing-add');
        Route::view('seller-listing/edit-item/{id}', 'page-backend.seller.b-listing-edit-item')->name('seller-listing-edit');
    });

    // Routes for users with 'approver' role
    Route::middleware('role:approver')->group(function() {
        Route::view('admin-categories', 'page-backend.admin.b-categories')->name('admin-categories');
        Route::view('approver-listing', 'page-backend.approver.b-approve-listing')->name('approver-listing');
    });

    // Routes for users with 'admin' role
    Route::middleware('role:admin')->group(function() {
        Route::view('admin-categories', 'page-backend.admin.b-categories')->name('admin-categories');
        Route::view('admin-special-boost', 'page-backend.admin.b-special-boost')->name('admin-special-boost');
        Route::view('admin-user-control', 'page-backend.admin.b-user-control')->name('admin-user-control');
        Route::view('admin-advertising-plan', 'page-backend.admin.b-advertising-plan')->name('admin-advertising-plan');
    });

});

require __DIR__.'/auth.php';
