<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Web'], function () {
    Route::group(['prefix' => 'cars'], function () {
        Route::get('available', 'CarController@available');
    });
});
