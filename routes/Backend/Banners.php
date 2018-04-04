<?php

Route::group([
    'namespace'  => 'Banner',
], function () {

    Route::get('banner/get', 'AdminBannerController@getTableData')->name('banner.get-list-data');
    /*
     * Admin Banner Controller
     */
    Route::resource('banner', 'AdminBannerController');

    Route::get('/', 'AdminBannerController@index')->name('banner.index');
});
