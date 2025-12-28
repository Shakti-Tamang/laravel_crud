<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AdminMiddleWare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::apiResource('categories',CategoryController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/test', function() {
    return response()->json(['message' => 'API is working']);
});

Route::post('/test-post', function(Request $request) {
    return response()->json([
        'message' => 'POST received',
        'data' => $request->all()
    ]);
});

Route::post('/login',[AuthController::class,'login'])->name('login');

Route::get('/user', function(Request $request) {
return $request->user();
})->middleware('auth:sanctum',AdminMiddleWare::class);
