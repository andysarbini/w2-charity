<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserProfileInformationController;
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

Route::get('/', function () {
    return view('front.welcome');
});

Route::get('/contact', function () {
    return view('front.contact');
});

Route::get('/about', function () {
    return view('front.about');
});

Route::get('/donation', function () {
    return view('front.donation.index');
});

Route::get('/donation/1', function () {
    return view('front.donation.show');
});

Route::get('/donation/1/create', function () {
    return view('front.donation.create');
});

Route::get('/donation/1/payment', function () {
    return view('front.donation.payment');
});

Route::get('/donation/1/payment-confirmation', function () {
    return view('front.donation.payment_confirmation');
});

Route::get('/donation/1/payment-confirmation', function () {
    return view('front.donation.payment_confirmation');
});


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// Route::group([
//     'middleware' => ['auth', 'role:admin']
// ], function() {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');


    
//     Route::group([
//         'middleware' => 'role:donatur'
//     ], function() {
//         Route::get('/dashboard', function () {
//             return view('dashboard');
//         })->name('dashboard');
//     });
// });

Route::group(['middleware' => ['role:admin,donatur']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/user/profile', [UserProfileInformationController::class, 'show'])->name('profile.show');
    Route::delete('/user/bank/{id}', [UserProfileInformationController::class, 'bankDestroy'])->name('profile.bank.destroy');

});

    Route::group([
        'middleware' => 'role:admin'
    ], function() {
        Route::resource('/category', CategoryController::class);
        
        Route::get('/campaign/data', [CampaignController::class, 'data'])->name('campaign.data');
        Route::get('/campaign/detail/{id}', [CampaignController::class, 'detail'])->name('campaign.detail');
        Route::resource('/campaignn', CampaignController::class)->except('create', 'edit');
        // Route::resource('/campaignn', CampaignController::class);

        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/setting/{setting}', [SettingController::class, 'update'])->name('setting.update');
        Route::delete('/setting/{setting}/bank/{id}', [SettingController::class, 'bankDestroy'])->name('setting.bank.destroy');
    });

    Route::group([
        'middleware' => 'role:donatur'
    ], function() {
        //
    });

    Route::get('/campaignn', function () {
        return view('front.campaign.index');
    });