<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\LandPlotController;
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
        Route::get('/signup', 'create')->name('create');
        Route::get('/login/users', 'login')->name('login');
        Route::post('/login/verification', 'verification')->name('verification');
        Route::post('/signup/users/store', 'storeUser')->name('storeUser');
        Route::post('/signup/realtors/store', 'storeRealtor')->name('storeRealtor');
    });
});

// ADS ROUTES
Route::prefix('ads')->name('ads.')->group(function () {
    Route::controller(AdController::class)->group(function () {
        Route::get('/filtration', 'filtration')->name('filtration');
    });
});

// RESIDENTIAL COMPLEXES ROUTES
Route::prefix('complexes')->name('complexes.')->group(function () {
    Route::controller(ResidentialComplexController::class)->group(function () {
        Route::get('/complex', 'index')->name('index');
    });
});

// ONLY AUTH USERS
Route::middleware('auth')->group(function () {
    // USERS ROUTES
    Route::prefix('users')->name('users.')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('/logout/users', 'logout')->name('logout');

            // USERS ROUTES
            Route::get('/account/users', 'userAccount')->name('user.account');

            // REALTORS ROUTES
            Route::get('/account/realtors', 'realtorAccount')->name('realtor.account');
            Route::get('/account/realtors/edit/{realtor}', 'editRealtor')->name('realtor.edit');
            Route::post('/account/realtors/update/{realtor}', 'updateRealtor')->name('realtor.update');
        });
    });

    // ADS ROUTES
    Route::prefix('ads')->name('ads.')->group(function () {
        Route::controller(AdController::class)->group(function () {
            // ROUTE TO PRE-CREATE VIEW
            Route::get('/pre-create', 'preCreate')->name('preCreate');

            // UPDATE ADS ROUTES
            Route::get('/edit/{ad}', 'edit')->name('edit');
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

// MODERATORS AND ADMINS ROUTES
Route::prefix('admins')->name('admins.')->group(function () {
    Route::controller(\App\Http\Controllers\admins\UserController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login/verification', 'verification')->name('verification');
    });

    Route::middleware('role')->group(function () {
        Route::controller(\App\Http\Controllers\admins\UserController::class)->group(function () {
            // VERIFICATION AND INDEX ROUTES
            Route::get('/index', 'index')->name('index');
        });

        // ADMIN ROUTES
        Route::middleware('can:admin')->group(function () {
            Route::controller(\App\Http\Controllers\admins\UserController::class)->group(function () {
                // MODERATORS ROUTES
                Route::get('/moderators', 'moderatorIndex')->name('moderators.index');
                Route::get('/signup/moderators', 'create')->name('moderators.create');
                Route::post('/signup/moderators/store', 'store')->name('moderators.store');
                Route::get('/moderators/edit/{moderator}', 'edit')->name('moderators.edit');
                Route::post('/moderators/update/{moderator}', 'update')->name('moderators.update');
                Route::get('/moderator/delete', 'delete')->name('moderator.delete');
            });
        });

        // ADS ROUTES
        Route::prefix('ads')->name('ads.')->group(function () {
            Route::controller(\App\Http\Controllers\admins\AdController::class)->group(function () {
                // GET ADS BY STATUS
                Route::get('/onlySuggested', 'onlySuggested')->name('onlySuggested');
                Route::get('/onlyPublished', 'onlyPublished')->name('onlyPublished');
                Route::get('/onlyCancelled', 'onlyCancelled')->name('onlyCancelled');

                // SHOW ROUTE
                Route::get('/show/{ad}', 'show')->name('show');

                // STATUS ROUTES
                Route::get('/cancel', 'cancel')->name('cancel');
                Route::get('/confirm', 'confirm')->name('confirm');
                Route::get('/hide', 'hide')->name('hide');
            });
        });

        // COMPLEXES ROUTES
        Route::prefix('complexes')->name('complexes.')->group(function () {
            Route::controller(\App\Http\Controllers\admins\ResidentialComplexController::class)->group(function () {
                // GET COMPLEXES BY STATUS
                Route::get('/onlySuggested', 'onlySuggested')->name('onlySuggested');
                Route::get('/onlyPublished', 'onlyPublished')->name('onlyPublished');
                Route::get('/onlyHidden', 'onlyHidden')->name('onlyHidden');
                Route::get('/onlyCancelled', 'onlyCancelled')->name('onlyCancelled');

                // ROUTE TO HIDE METHOD
                Route::get('/hideShow/{complex}', 'hideShow')->name('hideShow');

                // SHOW ROUTE
                Route::get('/show/{complex}', 'show')->name('show');

                // STATUS CHANGING ROUTES
                Route::get('/cancel', 'cancel')->name('cancel');
                Route::get('/confirm', 'confirm')->name('confirm');
                Route::get('/hide', 'hide')->name('hide');
            });
        });

        // STREETS ROUTES
        Route::prefix('streets')->name('streets.')->group(function () {
            Route::controller(\App\Http\Controllers\admins\StreetController::class)->group(function() {
                Route::get('/index', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::get('/delete', 'delete')->name('delete');
            });
        });

        // DISTRICTS ROUTES
        Route::prefix('districts')->name('districts.')->group(function () {
            Route::controller(\App\Http\Controllers\admins\DistrictController::class)->group(function() {
                Route::get('/index', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::get('/delete', 'delete')->name('delete');
            });
        });
    });
});
