<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', 'AuthController@login');
    });

    Route::group([
        'middleware' => ['auth:api', 'scopes:admin']
    ], function () {
        Route::resource('cars', 'CarController')->except(['create', 'show', 'edit']);

        Route::resource('options', 'OptionController')->except(['create', 'show', 'edit']);

        Route::get('configurations/fetch-meta', 'ConfigurationController@fetchMeta');
        Route::resource('configurations', 'ConfigurationController')->except(['create', 'show', 'edit']);

        Route::get('configuration-options/fetch-meta', 'ConfigurationOptionController@fetchMeta');
        Route::resource('configuration-options', 'ConfigurationOptionController')->except(['create', 'show', 'edit']);

        Route::get('prices/fetch-meta', 'PriceController@fetchMeta');
        Route::resource('prices', 'PriceController')->except(['create', 'show', 'edit']);
    });
});
