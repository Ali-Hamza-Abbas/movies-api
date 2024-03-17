<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\MoviesControllerV1;

Route::group(['prefix' => 'v1'], function () {
    
    Route::middleware('session.auth')->group(function () {
        Route::group(['prefix' => 'movies'], function () {
            Route::post('/', [MoviesControllerV1::class, 'store']);
            Route::get('/{id}', [MoviesControllerV1::class, 'show']);
            Route::get('/', [MoviesControllerV1::class, 'index']);
        });
    });

});