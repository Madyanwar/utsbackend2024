<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return response();
});

Route::get('/news', [NewsController::class, 'index']);
Route::post('/news', [NewsController::class, 'store']);