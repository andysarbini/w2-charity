<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\FrontController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserProfileInformationController;

use App\Http\Controllers\{
    ContactController,
    DonationController,
    DonaturController,
    SubscriberController
};

use App\Http\Controllers\Front\ {
    AboutController,
    ContactController as FrontContactController,
    CampaignController as FrontCampaignController,
    DonationController as FrontDonationController,
    FrontController,
    PaymentController,
    SubscriberController as FrontSubscriberController
};
use App\Models\Donation;
use App\Models\Subscriber;
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
Route::get('/contact', [FrontContactController::class, 'index']);
Route::POST('/contact', [FrontContactController::class, 'store']);
Route::get('/about', [AboutController::class, 'about']);
Route::post('/subscriber', [FrontSubscriberController::class, 'store']);
Route::resource('/campaigns', FrontCampaignController::class)->only('index', 'create', 'edit');

Route::get('/donation', [FrontDonationController::class, 'index']);
Route::group(['middleware' => ['auth', 'role:admin,donatur'],
                'prefix' => '/donation/{id}'], function () {
    Route::get('/', [FrontDonationController::class, 'show']);
    Route::post('/', [FrontDonationController::class, 'store']);
    Route::get('/create', [FrontDonationController::class, 'create']);
    Route::get('/payment/{order_number}', [PaymentController::class, 'index']);
    Route::get('/payment-confirmation/{order_number}', [PaymentController::class, 'paymentConfirmation']);
    Route::post('/payment-confirmation/{order_number}', [PaymentController::class, 'store']);
});

Route::group(['middleware' => ['role:admin,donatur'],
                'prefix' => 'admin'
], function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/user/profile', [UserProfileInformationController::class, 'show'])->name('profile.show');
    Route::delete('/user/bank/{id}', [UserProfileInformationController::class, 'bankDestroy'])->name('profile.bank.destroy');

    Route::group([
        'middleware' => 'role:admin'
    ], function() {
        Route::resource('/category', CategoryController::class);
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::put('/setting/{setting}', [SettingController::class, 'update'])->name('setting.update');
        Route::delete('/setting/{setting}/bank/{id}', [SettingController::class, 'bankDestroy'])->name('setting.bank.destroy');
        // Route::resource('/campaigns', CampaignController::class);
    });
    
    Route::get('/campaigns/data', [CampaignController::class, 'data'])->name('campaigns.data');
    Route::resource('/campaigns', CampaignController::class); 
    Route::put('/campaign/{id}/update_status', [CampaignController::class, 'updateStatus'])->name('campaign.update_status');

    Route::get('/donation/data', [DonationController::class, 'data'])->name('donation.data');
    Route::resource('/donation', DonationController::class);

    Route::group([
        'middleware' => 'role:admin'
    ], function() {
        Route::get('/donatur/data', [DonaturController::class, 'data'])->name('donatur.data');
        Route::resource('/donatur', DonaturController::class);

        Route::get('/contact/data', [ContactController::class, 'data'])->name('contact.data');
        Route::resource('/contact', ContactController::class)->only('index', 'destroy');

        Route::get('/subscriber/data', [SubscriberController::class, 'data'])->name('subscriber.data');
        Route::resource('/subscriber', SubscriberController::class)->only('index', 'destroy');
    });
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

    // Route::get('/campaigns', function () {
    //     return view('front.campaign.index');
    // });