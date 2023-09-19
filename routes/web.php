<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
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

Route::get('/', [FrontController::class, 'index']);
Route::get('/contact', [FrontController::class, 'contact']);
Route::POST('/contact', [FrontController::class, 'storeContact']);
Route::get('/about', [FrontController::class, 'about']);
Route::get('/donation', [FrontController::class, 'donation']);
Route::get('/donation/{id}', [FrontController::class, 'donationDetail']);

Route::group(['middleware' => ['auth', 'role:admin,donatur']], function () {
    Route::get('/donation/{id}/create', [FrontController::class, 'donationCreate']);
    Route::post('/donation/{id}', [FrontController::class, 'storeDonation']);
    Route::get('/donation/{id}/payment/{order_number}', [FrontController::class, 'donationPayment']);
    Route::get('/donation/{id}/payment-confirmation/{order_number}', [FrontController::class, 'donationPaymentConfirmation']);
    Route::post('/donation/{id}/payment-confirmation/{order_number}', [FrontController::class, 'storeDonationPaymentConfirmation']);
});

Route::post('/subscriber', [FrontController::class, 'subscriberStore']);


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
        
        // Route::resource('/campaigns', CampaignController::class);
        
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/setting/{setting}', [SettingController::class, 'update'])->name('setting.update');
        Route::delete('/setting/{setting}/bank/{id}', [SettingController::class, 'bankDestroy'])->name('setting.bank.destroy');
    });
    
    Route::get('/campaigns/data', [CampaignController::class, 'data'])->name('campaigns.data');
    Route::get('/campaigns/detail/{id}', [CampaignController::class, 'detail'])->name('campaigns.detail');
    Route::resource('/campaigns', CampaignController::class);
    
    Route::group([
        'middleware' => 'role:donatur'
    ], function() {
        //
    });

    // Route::get('/campaigns', function () {
    //     return view('front.campaign.index');
    // });