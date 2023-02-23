<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(AdController::class)->group(function () {
    Route::get('/', 'index')->name('ads.index');
});

// ROUTE TO ADMIN PANEL
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.index');
});

// ADMIN ROUTES
Route::prefix('admin')->name('admin')->group(function () {


    // ADMIN STREETS ROUTES

    // ADMIN DISTRICTS ROUTES

    // ADMIN SUGGESTED ADS ROUTES

    // ADMIN PUBLISHED ADS ROUTES
});
