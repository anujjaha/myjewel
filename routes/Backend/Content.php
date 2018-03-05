<?php

Route::group([
    'namespace'  => 'Content',
], function () {

	Route::get('content/get', 'AdminContentController@getTableData')->name('content.get-list-data');
    
    /*
     * Admin Content Controller
     */
    Route::resource('content', 'AdminContentController');

    Route::get('content/', 'AdminContentController@index')->name('content.index');
});
