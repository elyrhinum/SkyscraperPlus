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

// INDEX PAGE AND PAGE WITH DOCUMENTS
Route::controller(AdController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/documents', 'documents')->name('documents.index');
});

// ROUTES FOR NON-AUTH USERS
Route::prefix('users')->name('users.')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/signup', 'create')->name('create');
        Route::get('/login', 'login')->name('login');
        Route::post('/login/verification', 'verification')->name('verification');
        Route::post('/signup/users/store', 'storeUser')->name('storeUser');
        Route::post('/signup/realtors/store', 'storeRealtor')->name('storeRealtor');

        Route::get('/realtors', 'realtorsIndex')->name('realtors.index');
        Route::get('/users/ads/{user}', 'usersAds')->name('ads');
    });
});

// ADS ROUTES
Route::prefix('ads')->name('ads.')->group(function () {
    Route::controller(AdController::class)->group(function () {
        // FILTRATION ROUTE
        Route::get('/filtration', 'filtration')->name('filtration');

        // ROUTE TO GET ADS BY CATEGORIES
        Route::get('/catalog/{object_type}/{contract_id_1}/{contract_id_2?}', 'catalog')->name('catalog');

        // BOOKMARKS ROUTES
        Route::post('/bookmark', 'bookmark')->name('bookmark');
        Route::post('/unbookmark', 'unbookmark')->name('unbookmark');

        // SHOW ROUTE
        Route::get('/show/{ad}', 'show')->name('show');

        // SALE ROUTE
        Route::get('/sale', 'sale')->name('sale');

        // RENT ROUTE
        Route::get('/rent', 'rent')->name('rent');
    });
});

// RESIDENTIAL COMPLEXES ROUTES
Route::prefix('complexes')->name('complexes.')->group(function () {
    Route::controller(ResidentialComplexController::class)->group(function () {
        // INDEX PAGE
        Route::get('/complex', 'index')->name('index');

        // SHOW ROUTE
        Route::get('/show/{complex}', 'show')->name('show');

        // ROUTE TO GET OBJECTS BY COMPLEX
        Route::get('/flatsInResidentialComplex/{complex}', 'flatsInResidentialComplex')->name('flatsInResidentialComplex');
        Route::get('/roomsInResidentialComplex/{complex}', 'roomsInResidentialComplex')->name('roomsInResidentialComplex');
    });
});

// ROUTES FOR AUTH USERS
Route::middleware('auth')->group(function () {
    Route::prefix('users')->name('users.')->group(function () {
        Route::controller(UserController::class)->group(function () {
            // LOGOUT ROUTE
            Route::get('/logout', 'logout')->name('logout');

            // USERS ROUTES
            Route::get('/account', 'account')->name('account');
            Route::get('/account/edit/{user}', 'edit')->name('edit');
            Route::post('/account/update/{user}', 'update')->name('update');

            // ROUTES TO GET ADS BY STATUS
            Route::get('/ads/suggested', 'onlySuggestedAds')->name('onlySuggestedAds');
            Route::get('/ads/published', 'onlyPublishedAds')->name('onlyPublishedAds');
            Route::get('/ads/cancelled', 'onlyCancelledAds')->name('onlyCancelledAds');

            // ROUTE TO GET BOOKMARKS
            Route::get('/bookmarks', 'bookmarks')->name('bookmarks');

            // ROUTE TO EDIT ADS
            Route::get('/ads/edit/{ad}', 'edit')->name('edit');
        });
    });

    // ADS ROUTES
    Route::prefix('ads')->name('ads.')->group(function () {
        Route::controller(AdController::class)->group(function () {
            // PRE-CREATE PAGE
            Route::get('/pre-create', 'preCreate')->name('preCreate');

            // EDIT ROUTE
            Route::get('/edit/{ad}', 'edit')->name('edit');

            // ROUTE TO DELETE IMAGE
            Route::post('/deleteImg', 'deleteImg')->name('deleteImg');

            //ROUTE TO DELETE AD
            Route::get('/delete/{ad}', 'delete')->name('delete');
        });
    });

    // FLATS ROUTES
    Route::prefix('flats')->name('flats.')->group(function () {
        Route::controller(FlatController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::post('/update/{ad}', 'update')->name('update');
        });
    });

    // ROOMS ROUTES
    Route::prefix('rooms')->name('rooms.')->group(function () {
        Route::controller(RoomController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::post('/update/{ad}', 'update')->name('update');
        });
    });

    // HOUSES ROUTES
    Route::prefix('houses')->name('houses.')->group(function () {
        Route::controller(HouseController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::post('/update/{ad}', 'update')->name('update');
        });
    });

    // LAND PLOTS ROUTES
    Route::prefix('landplots')->name('landplots.')->group(function () {
        Route::controller(LandPlotController::class)->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::post('/update/{ad}', 'update')->name('update');
        });
    });

    // RESIDENTIAL COMPLEXES ROUTES
    Route::prefix('complexes')->name('complexes.')->group(function () {
        Route::controller(ResidentialComplexController::class)->group(function () {
            // CREATE AND STORE ROUTES
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');

            Route::post('/get-district', 'getDistrictByComplex')->name('get-district');
        });
    });
});

// MODERATORS AND ADMINS ROUTES
Route::prefix('admins')->name('admins.')->group(function () {
    Route::controller(\App\Http\Controllers\admins\UserController::class)->group(function () {
        // LOGIN AND VERIFICATION ROUTES
        Route::get('/login', 'login')->name('login');
        Route::post('/login/verification', 'verification')->name('verification');
    });

    Route::middleware('role')->group(function () {
        Route::controller(\App\Http\Controllers\admins\UserController::class)->group(function () {
            // INDEX PAGE
            Route::get('/index', 'index')->name('index');

            // UPDATE ROUTES
            Route::get('/edit/{user}', 'editUser')->name('user.edit');
            Route::post('/update/{user}', 'updateUser')->name('user.update');
        });

        // ADMINS ROUTE
        Route::middleware('can:admin')->group(function () {
            // MODERATORS ROUTES
            Route::controller(\App\Http\Controllers\admins\UserController::class)->group(function () {
                Route::get('/moderators', 'moderatorIndex')->name('moderators.index');
                Route::get('/signup/moderators', 'create')->name('moderators.create');
                Route::post('/signup/moderators/store', 'store')->name('moderators.store');
                Route::get('/moderators/edit/{moderator}', 'edit')->name('moderators.edit');
                Route::post('/moderators/update/{moderator}', 'update')->name('moderators.update');
                Route::get('/moderator/delete', 'delete')->name('moderator.delete');
            });

            // DOCUMENTS ROUTES
            Route::controller(\App\Http\Controllers\admins\DocumentController::class)->group(function () {
                Route::get('/documents', 'index')->name('documents.index');
                Route::post('/documents/store', 'store')->name('documents.store');
                Route::post('/documents/update', 'update')->name('documents.update');
                Route::get('/documents/delete', 'delete')->name('documents.delete');
            });
        });

        // ADS ROUTES
        Route::prefix('ads')->name('ads.')->group(function () {
            Route::controller(\App\Http\Controllers\admins\AdController::class)->group(function () {
                // ROUTE TO GET ADS BY STATUS
                Route::get('/onlySuggested', 'onlySuggested')->name('onlySuggested');
                Route::get('/onlyPublished', 'onlyPublished')->name('onlyPublished');
                Route::get('/onlyCancelled', 'onlyCancelled')->name('onlyCancelled');

                // ROUTE TO CHANGE STATUS
                Route::get('/cancel', 'cancel')->name('cancel');
                Route::get('/publish', 'publish')->name('publish');
                Route::get('/hide', 'hide')->name('hide');
            });
        });

        // RESIDENTIAL COMPLEXES ROUTES
        Route::prefix('complexes')->name('complexes.')->group(function () {
            Route::controller(\App\Http\Controllers\admins\ResidentialComplexController::class)->group(function () {
                // ROUTE TO GET BY STATUS
                Route::get('/onlySuggested', 'onlySuggested')->name('onlySuggested');
                Route::get('/onlyPublished', 'onlyPublished')->name('onlyPublished');
                Route::get('/onlyHidden', 'onlyHidden')->name('onlyHidden');
                Route::get('/onlyCancelled', 'onlyCancelled')->name('onlyCancelled');

                // CREATE AND STORE ROUTES
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');

                // SHOW ROUTE
                Route::get('/show/{complex}', 'show')->name('show');

                // ROUTE TO CHANGE STATUS
                Route::get('/cancel', 'cancel')->name('cancel');
                Route::get('/publish', 'publish')->name('publish');
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
