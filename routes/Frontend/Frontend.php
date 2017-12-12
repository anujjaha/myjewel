<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('/jewel-categories', 'FrontendController@jewelCategories')->name('jewel-categories');
Route::get('/jewel-products', 'FrontendController@jewelProducts')->name('jewel-products');
Route::get('/product-details/{id}', 'FrontendController@productDetails')->name('jewel-products-details');
Route::get('macros', 'FrontendController@macros')->name('macros');

/*
 * These frontend controllers require the user to be logged in
 * All route names are prefixed with 'frontend.'
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::get('cart', 'DashboardController@showCart')->name('show-cart');


        Route::post('add-product-to-cart', 'DashboardController@addProductToCart')->name('add-product-to-cart');
            
        Route::post('remove-product-from-cart', 'DashboardController@removeProductToCart')->name('remove-product-from-cart');

        /*
         * User Account Specific
         */
        Route::get('account', 'AccountController@index')->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', 'ProfileController@update')->name('profile.update');
    });
});
