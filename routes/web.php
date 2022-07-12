
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

        // Ví
        Route::get('/vi-cua-toi', 'WalletController@index');

        // Nạp tiền
        Route::get('/nap-tien', 'RechargeController@index');
        Route::get('/init-recharge-method', 'RechargeController@initRechargeMethod');
        Route::post('/send-direct-transfer-recharge', 'RechargeController@sendDirectTransferRecharge');
    });
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('cronmark', array('uses' => 'LearningPlayController@mark'));
    Route::get('cronimg', array('uses' => 'CronImgController@convertImg'));
    Route::get('cronmail', 'CronMailController@cronmail');
    Route::get('reset-email', 'CronMailController@reset');
    Route::match(['get', 'post'], '/{link}', array('uses' => 'HomeController@direction'))->where('link', '^((?!esystem)[0-9a-zA-Z\?\.\-/])*$');
});
