<?php

Route::group([
    'namespace'  => 'Product',
], function () {

	Route::get('product/get', 'AdminProductController@getTableData')->name('product.get-list-data');
    
    /*
     * Admin Product Controller
     */
    Route::resource('product', 'AdminProductController');

    Route::post('product/bulk-upload', 'AdminProductController@bulkUpload')->name('product.bulk-upload');
	
    Route::get('/', 'AdminProductController@index')->name('product.index');
    
    Route::post('/delete-products', 'AdminProductController@deleteProducts')->name('product.ajax-delete-products');
    
});
