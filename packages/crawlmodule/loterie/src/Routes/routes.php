<?php
Route::group(['prefix'=>'crawlsxmb','middleware' => 'web','namespace'=>'crawlmodule\loterie\Controllers'],function(){
    Route::get('/do-crawl','SxmbController@doCrawl');
});