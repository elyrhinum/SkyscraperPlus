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
    Route::get('/', 'index')->name('ads.index');
});

// USERS ROUTES
Route::prefix('users')->name('users.')->group(function () {
    Route::controller(UserController::class)->group(function () {
        // SIGNUP ROUTE
        Route::get('/signup', 'create')->name('create');

        // LOGIN ROUTES
        Route::get('/login/users', 'login')->name('login');
        Route::get('/login/admins', 'loginAdminPanel')->name('loginAdminPanel');

        // VERIFICATION ROUTES
        Route::post('/login/users/verification', 'verification')->name('verification');
        Route::post('/login/admins/verification', 'verificationAdminPanel')->name('verificationAdminPanel');

        // STORE USERS ROUTE
        Route::post('/signup/users/store', 'storeUser')->name('storeUser');

        // STORE REALTORS ROUTE
        Route::post('/signup/realtors/store', 'storeRealtor')->name('storeRealtor');
    });
});

//// ADMIN ROUTES
Route::middleware('can:admin')->group(function () {
    Route::controller(UserController::class)->group(function () {
        // MODERATORS ROUTES
        Route::get('/moderators', 'moderatorsIndex')->name('moderators.index');
        Route::get('/signup/moderators', 'createModerator')->name('moderators.create');
        Route::post('/signup/moderators/store', 'storeModerator')->name('moderators.store');
        Route::get('/moderators/edit', 'editModerator')->name('moderators.edit');
        Route::post('/moderators/update', 'updateModerator')->name('moderators.update');
    });
});

// MODERATOR AND ADMIN ROUTES
Route::middleware('can:moderator')->group(function () {
    Route::controller(UserController::class)->group(function () {
        // TO INDEX ROUTE
        Route::get('/index/admins', 'indexAdminPanel')->name('admins.index');
    });

    // ADS ROUTES
    Route::prefix('ads')->name('ads.')->group(function () {
        Route::controller(AdController::class)->group(function () {
            Route::get('/ads/suggested', 'onlySuggested')->name('suggested');
            Route::get('/ads/published', 'onlyPublished')->name('published');
            Route::get('/ads/inactive', 'onlyInactive')->name('inactive');
        });
    });

    // COMPLEXES ROUTES
    Route::prefix('complexes')->name('complexes.')->group(function () {
        Route::controller(ResidentialComplexController::class)->group(function () {
            // GET COMPLEXES BY STATUS
            Route::get('/suggested', 'suggested')->name('suggested');
            Route::get('/published', 'published')->name('published');

            // SHOW ROUTE
            Route::get('/show/{complex}', 'showAdminPanel')->name('show');

            // STATUS ROUTES
            Route::get('/cancel', 'cancel')->name('cancel');
            Route::get('/confirm', 'confirm')->name('confirm');
        });
    });
});

// ONLY AUTH USERS
Route::middleware('auth')->group(function () {
    // USERS ROUTES
    Route::prefix('users')->name('users.')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/logout/users', 'logout')->name('logout');

            // USERS ROUTES
            Route::get('/account/users', 'accountUser')->name('user.account');

            // REALTORS ROUTES
            Route::get('/account/realtors', 'accountRealtor')->name('realtor.account');
            Route::get('/account/realtors/edit/{realtor}', 'editRealtor')->name('realtor.edit');
            Route::post('/account/realtors/update/{realtor}', 'updateRealtor')->name('realtor.update');
        });
    });

    // ADS ROUTES
    Route::prefix('ads')->name('ads.')->group(function () {
        Route::controller(AdController::class)->group(function () {
            // CREATING ROUTES
            Route::get('/pre-create', 'preCreate')->name('preCreate');
        });
    });

    // FLATS ROUTES
    Route::prefix('flats')->name('flats.')->group(function () {
        Route::controller(FlatController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
        });
    });

    // ROOMS ROUTES
    Route::prefix('rooms')->name('rooms.')->group(function () {
        Route::controller(RoomController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
        });
    });

    // HOUSES ROUTES
    Route::prefix('houses')->name('houses.')->group(function () {
        Route::controller(HouseController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
        });
    });

    // LAND PLOTS ROUTES
    Route::prefix('landplots')->name('landplots.')->group(function () {
        Route::controller(LandPlotController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
        });
    });

    // RESIDENTIAL COMPLEXES ROUTES
    Route::prefix('complexes')->name('complexes.')->group(function () {
        Route::controller(ResidentialComplexController::class)->group(function () {
            //STORE ROUTES
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');

            Route::post('/get-district', 'getDistrictByComplex')->name('get-district');
        });
    });
});

// RESIDENTIAL COMPLEX ROUTES
Route::prefix('rcs')->name('rcs.')->group(function () {
    Route::controller(ResidentialComplexController::class)->group(function () {
        Route::get('/complex', 'index')->name('index');
    });
});
