<?php

use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/news', [NewsController::class, 'index']);
Route::post('/news', [NewsController::class, 'store']);
Route::get('/news/{id}', [NewsController::class, 'show']);
Route::put('/news/{id}', [NewsController::class, 'update']);
Route::delete('/news/{id}', [NewsController::class, 'destroy']);
Route::get('/news/search/{title}', [NewsController::class, 'search']);
Route::get('/news/category/sport', [NewsController::class, 'sport']);
Route::get('/news/category/finance', [NewsController::class, 'finance']);
Route::get('/news/category/automotive', [NewsController::class, 'automotive']);