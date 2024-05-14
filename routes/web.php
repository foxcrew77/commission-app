<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\DeliveryResourceController;
use App\Http\Controllers\LorryResourceController;
use App\Http\Controllers\DriverResourceController;
use App\Http\Controllers\WorkmanResourceController;
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

Route::view('/', 'welcome');


//dashboard routes
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard', 'as' => 'admin.'], function () {
    //single action controllers
    Route::get('/', HomeController::class)->name('home');
    
    //link that return view, to get compoment from there
    Route::view('/buttons', 'admin.buttons')->name('buttons');
    Route::view('/cards', 'admin.cards')->name('cards');
    Route::view('/charts', 'admin.charts')->name('charts');
    Route::view('/forms', 'admin.forms')->name('forms');
    Route::view('/modals', 'admin.modals')->name('modals');
    Route::view('/tables', 'admin.tables')->name('tables');

    route::resource('/deliverytrip', DeliveryResourceController::class);
    route::resource('/lorry', LorryResourceController::class);
    // route::resource('/lorry/{id}', [LorryResourceController::class, 'show']);
    route::resource('/driver', DriverResourceController::class);
    route::resource('/workman', WorkmanResourceController::class);

    Route::group(['prefix' => 'pages', 'as' => 'page.'], function () {
        Route::view('/404-page', 'admin.pages.404')->name('404');
        Route::view('/blank-page', 'admin.pages.blank')->name('blank');
        Route::view('/create-account-page', 'admin.pages.create-account')->name('create-account');
        Route::view('/forgot-password-page', 'admin.pages.forgot-password')->name('forgot-password');
        Route::view('/login-page', 'admin.pages.login')->name('login');
    });
});
route::get('/multidropdown',function(){
    return view('multidropdown');
});

route::get('/workmendropdown', [WorkmanResourceController::class, 'workmenDropdown']);
route::get('/z-index', function(){
    return view('zindex');
});

require __DIR__ . '/auth.php';
