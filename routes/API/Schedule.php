<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('schedule', 'APIScheduleController@index')->name('schedule.index');
    Route::post('schedule/create', 'APIScheduleController@create')->name('schedule.create');
    Route::post('schedule/edit', 'APIScheduleController@edit')->name('schedule.edit');
    Route::post('schedule/show', 'APIScheduleController@show')->name('schedule.show');
    Route::post('schedule/delete', 'APIScheduleController@delete')->name('schedule.delete');
});
?>