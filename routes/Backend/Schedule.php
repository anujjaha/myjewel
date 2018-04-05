<?php

Route::group([
    "namespace"  => "Schedule",
], function () {
    /*
     * Admin Schedule Controller
     */

    // Route for Ajax DataTable
    Route::get("schedule/get", "AdminScheduleController@getTableData")->name("schedule.get-list-data");

    Route::resource("schedule", "AdminScheduleController");
});