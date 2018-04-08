<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('settings', 'APISettingsController@index')->name('settings.index');
    Route::post('settings/create', 'APISettingsController@create')->name('settings.create');
    Route::post('settings/edit', 'APISettingsController@edit')->name('settings.edit');
    Route::post('settings/show', 'APISettingsController@show')->name('settings.show');
    Route::post('settings/delete', 'APISettingsController@delete')->name('settings.delete');

    // Get Privacy Policy
   // Route::get('settings/privacy-policy', 'APISettingsController@getPrivacyPolicy')->name('settings.privacy-policy');
    //Route::get('settings/terms-conditions', 'APISettingsController@getTermsConditions')->name('settings.terms-conditions');
});
?>