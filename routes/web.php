
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

Route::get('/video/playlist/{playlist}', function ($playlist) {
    return \FFMpeg::dynamicHLSPlaylist()
        ->fromDisk('videos')
        ->open('out/' . $playlist)
        ->setKeyUrlResolver(function ($key) {
            return route('video.key', ['key' => $key]);
        })
        ->setMediaUrlResolver(function ($mediaFilename) {
            return \Storage::disk('videos')->url('out/' . $mediaFilename);
        })
        ->setPlaylistUrlResolver(function ($playlistFilename) {
            return route('video.playlist', ['playlist' => $playlistFilename]);
        });
})->name('video.playlist');

Route::get('/video/key/{key}', function ($key) {
    return \Storage::disk('videos')->download('out/' . $key);
})->name('video.key');



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'namespace' => 'App\Http\Controllers'
], function () {
    //ENDCOMMENT
    Route::get('/test1', 'HomeController@test1');
    Route::get('/alo', 'HomeController@alo');
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('cronmark', array('uses' => 'LearningPlayController@mark'));
    Route::get('cronimg', array('uses' => 'CronImgController@convertImg'));
    Route::get('cronmail', 'CronMailController@cronmail');
    Route::get('reset-email', 'CronMailController@reset');
    Route::match(['get', 'post'], '/{link}', array('uses' => 'HomeController@direction'))->where('link', '^((?!esystem)[0-9a-zA-Z\?\.\-/])*$');
});
