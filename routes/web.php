<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\LandPlotController;
use App\Http\Controllers\RealtorController;
use App\Http\Controllers\ResidentialComplexController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
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
// INDEX PAGE
Route::controller(AdController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

// USER ROUTES
Route::prefix('users')->name('users.')->group(function () {
    Route::controller(UserController::class)->group(function () {
        // COMMON ROUTES
        Route::get('/signup', 'create')->name('create');
        Route::get('/login', 'login')->name('login');
        Route::get('/logout/users', 'logout')->name('logout');
        Route::post('/login/users/verification', 'verification')->name('verification');

        // USER ROUTES
        Route::post('/signup/users/store', 'storeUser')->name('storeUser');
        Route::get('/account/users', 'indexUser')->name('accountUser');

        // REALTOR ROUTES
        Route::post('/signup/realtors/store', 'storeRealtor')->name('storeRealtor');
        Route::get('/account/realtors', 'indexRealtor')->name('accountRealtor');

        // ADMIN ROUTES
        Route::get('/signup/admins', 'createAdmin')->name('createAdmin');
        Route::post('/signup/admins/store', 'storeAdmin')->name('storeAdmin');
        Route::get('/logout/admins', 'logoutAdmin')->name('logoutAdmin');
        Route::get('/account/admins', 'indexAdmin')->name('accountAdmin');
        Route::get('/index/admins', 'indexAdmin')->name('indexAdmin');
    });
});

// ADS ROUTES
Route::prefix('ads')->name('ads.')->group(function () {
    Route::controller(AdController::class)->group(function () {
        Route::get('/', 'index')->name('index');

        // CREATING ROUTES
        Route::get('/pre-create', 'pre_create')->name('pre-create');
    });
});

// FLATS ROUTES
Route::prefix('flats')->name('flats.')->group(function () {
    Route::controller(FlatController::class)->group(function () {

    });
});

// FLATS ROUTES
Route::prefix('flats')->name('flats.')->group(function () {
    Route::controller(FlatController::class)->group(function () {
        Route::get('/create', 'create')->name('create');
    });
});

// ROOMS ROUTES
Route::prefix('rooms')->name('rooms.')->group(function () {
    Route::controller(RoomController::class)->group(function () {
        Route::get('/create', 'create')->name('create');
    });
});

// HOUSES ROUTES
Route::prefix('houses')->name('houses.')->group(function () {
    Route::controller(HouseController::class)->group(function () {
        Route::get('/create', 'create')->name('create');
    });
});

// LAND PLOTS ROUTES
Route::prefix('landplots')->name('landplots.')->group(function () {
    Route::controller(LandPlotController::class)->group(function () {
        Route::get('/create', 'create')->name('create');
    });
});

// RESIDENTIAL COMPLEX ROUTES
Route::prefix('rcs')->name('rcs.')->group(function () {
    Route::controller(ResidentialComplexController::class)->group(function () {
        Route::get('/complex', 'index')->name('index');
    });
});
