<?php

/**
 * Frontend Controllers
 * All route names are prefixed with 'frontend.'.
 */
Route::get('/', 'FrontendController@index')->name('index');
Route::get('/jewel-categories', 'FrontendController@jewelCategories')->name('jewel-categories');
Route::get('/jewel-products', 'FrontendController@jewelProducts')->name('jewel-products');
Route::get('/jewel-products-by-category/{id}', 'FrontendController@jewelProductsByCategory')->name('jewel-products-by-category');
Route::get('/product-details/{id}', 'FrontendController@productDetails')->name('jewel-products-details');
Route::get('macros', 'FrontendController@macros')->name('macros');

Route::any('time-piece', 'FrontendController@timePiece')->name('time-piece');

Route::any('accessories', 'FrontendController@accessories')->name('accessories');

Route::any('gifts', 'FrontendController@gifts')->name('gifts');

Route::any('client-service', 'FrontendController@clientService')->name('client-service');

Route::any('corporate', 'FrontendController@corporate')->name('corporate');

Route::any('catelogs', 'FrontendController@catelogs')->name('catelogs');

Route::any('legal-terms', 'FrontendController@legalTerms')->name('legal-terms');

Route::any('help', 'FrontendController@helpDesk')->name('help-desk');

Route::any('contact-us', 'FrontendController@contactUs')->name('contact-us');

/*Route::any('gifts', 'DashboardController@createOrder')->name('create-order');

Route::any('client-service', 'DashboardController@createOrder')->name('create-order');

Route::any('corporate', 'DashboardController@createOrder')->name('create-order');

Route::any('catelogs', 'DashboardController@createOrder')->name('create-order');

Route::any('legal-terms', 'DashboardController@createOrder')->name('create-order');

Route::any('help', 'DashboardController@createOrder')->name('create-order');

Route::any('contact-us', 'DashboardController@createOrder')->name('create-order');*/

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

        Route::any('create-order', 'DashboardController@createOrder')->name('create-order');

        

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
