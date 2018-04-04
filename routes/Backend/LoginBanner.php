<?php

Route::group([
    'namespace'  => 'LoginBanner',
], function () {

    /*
     * Admin LoginBanner Controller
     */
    Route::resource('login-banners', 'AdminLoginBannerController');

    Route::get('/', 'AdminLoginBannerController@index')->name('login-banners.index');
    Route::get('/get', 'AdminLoginBannerController@getTableData')->name('login-banners.get-list-data');
});
