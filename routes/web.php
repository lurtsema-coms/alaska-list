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

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
