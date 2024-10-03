<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\DeliveryResourceController;
use App\Http\Controllers\LorryResourceController;
use App\Http\Controllers\DriverResourceController;
use App\Http\Controllers\WorkmanResourceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Support\Facades\App;

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

Route::get('/', function(){
    return Redirect::to('/dashboard');
});


//dashboard routes
Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard', 'as' => 'admin.'], function () {
    //single action controllers
    Route::get('/', HomeController::class)->name('home');
    // Route::get('/', HomeController::class)->name('home');
    Route::post('/', [HomeController::class, 'monthComm'])->name('monthComm');
    // Route::get('/',function($yearMonth,$outlet){
    //     // $yearMonth = "2021-02";
    //     // $outlet = "KKIP";
    //     return Illuminate\Support\Facades\App::call('App\Http\Controllers\Admin\HomeController' , [
    //         'yearMonth' => $yearMonth,
    //         'outlet' => $outlet
    //     ]);
    // })->name('home');
    
    //link that return view, to get compoment from there
    Route::view('/buttons', 'admin.buttons')->name('buttons');
    Route::view('/cards', 'admin.cards')->name('cards');
    Route::view('/charts', 'admin.charts')->name('charts');
    Route::view('/forms', 'admin.forms')->name('forms');
    Route::view('/modals', 'admin.modals')->name('modals');
    Route::view('/tables', 'admin.tables')->name('tables');

    Route::resource('/deliverytrip', DeliveryResourceController::class);
    Route::resource('/lorry', LorryResourceController::class);
    // route::put('edit/{id}', [LorryResourceController::class, 'update'])->name('lorry.update');

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

Route::get('/',[DeliveryResourceController::class, 'driverMonthlyCommission']);
// Route::get('/', function($yearMonth,$outlet){
//     $yearMonth = "2021-02";
//     $outlet = "KK2";
//     return Illuminate\Support\Facades\App::call('App\Http\Controllers\DeliveryResourceController@driverMonthlyCommission' , [
//         'yearMonth' => $yearMonth,
//         'outlet' => $outlet
//     ]);
// });

route::get('/multidropdown',function(){
    $workmen = App\Models\Workman::select('name','slug')->orderBy('id','desc')->get(); 
    $drivers = App\Models\Driver::select('name','slug')->orderBy('id','desc')->get(); 
    return view('multidropdown', [
        'workmen' => $workmen,
        'drivers' => $drivers,
    ]);
});
route::get('/multidropdown4',function(){
    $workmen = App\Models\Workman::select('name','slug')->orderBy('id','desc')->get(); 
    $drivers = App\Models\Driver::select('name','slug')->orderBy('id','desc')->get(); 
    return view('multidropdown4', [
        'workmen' => $workmen,
        'drivers' => $drivers,
    ]);
});
route::get('/multidropdown2',function(){
    $workmenDropdown = App\Models\Workman::select('name','slug')->orderBy('id','desc')->get(); 
    return view('multidropdown2', [
        'workmenDropdown' => $workmenDropdown,
    ]);
});
route::get('/multidropdown3',function(){
    return view('multidropdown3');
});

route::get('/workmendropdown', [WorkmanResourceController::class, 'workmenDropdown']);
route::get('/z-index', function(){
    return view('zindex');
});

require __DIR__ . '/auth.php';
