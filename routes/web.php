
<?php

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

Route::get('/clear', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('view:clear');
    echo '<pre>';
    var_dump(__LINE__);
    die();
    echo '</pre>';
});




Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers'
], function () {
    Route::prefix('tai-khoan')->namespace('Auth')->group(function () {
        Route::get('/', 'AccountController@account');
        Route::match(['GET', 'POST'], '/trang-ca-nhan', 'AccountController@profile');
        Route::get('/nhat-ky-dang-nhap', 'AccountController@loginLog');
        Route::get('/them-tai-khoan-ngan-hang', 'AccountController@addBankAccount');
        Route::post('/send-add-bank-account', 'AccountController@sendAddBankAccount');
        Route::get('/lich-su-giao-dich', 'AccountController@transactionHistory');
        Route::get('/lich-su-cuoc', 'AccountController@betHistory');

        Route::get('/wingo-bet-history ', 'AccountController@wingoBetHistory');
        Route::get('/plinko-bet-history ', 'AccountController@plinkoBetHistory');

        // Ví
        Route::get('/vi-cua-toi', 'WalletController@index');

        // Nạp tiền
        Route::get('/nap-tien', 'RechargeController@index');
        Route::get('/init-recharge-method', 'RechargeController@initRechargeMethod');
        Route::post('/send-recharge', 'RechargeController@sendRecharge');
        Route::get('/lich-su-nap-tien', 'RechargeController@rechargeHistory');
        
        // Rút tiền
        Route::get('/rut-tien', 'WithdrawController@index');
        Route::post('/send-withdraw-request', 'WithdrawController@sendWithdrawRequest');
        Route::get('/lich-su-rut-tien', 'WithdrawController@withdrawHistory');

        // Marketing
        Route::get('/marketing', 'MarketingController@index');
        Route::get('/marketing/lich-su-gioi-thieu', 'MarketingController@introductionHistory');
        Route::get('/marketing/huong-dan', 'MarketingController@guide');
        Route::get('/marketing/doi-cua-toi', 'MarketingController@myTeam');
        Route::get('/marketing/lich-su-nhan', 'MarketingController@receiptHistory');
    });
    Route::get('/', 'HomeController@index')->name('home');

    Route::post('callback-prince-pay', 'OnlinePaymentCallbackController@callbackPrincePay');
    Route::get('nap-tien-prince-pay', 'OnlinePaymentCallbackController@paymentSuccess');
    
    Route::match(['get', 'post'], '/{link}', array('uses' => 'HomeController@direction'))->where('link', '^((?!esystem)[0-9a-zA-Z\?\.\-/])*$');
});
