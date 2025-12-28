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

Route::get('/user/{id}', [AuthController::class, 'getById'])
    ->middleware('auth:sanctum')
    ->name('user.getById');

Route::get('/user', function(Request $request) {
return $request->user();
})->middleware('auth:sanctum',AdminMiddleWare::class);


// The primary ORM (Object-Relational Mapper) for Laravel is Eloquent. It provides an elegant, ActiveRecord implementation for interacting with your database using object-oriented PHP syntax instead of writing raw SQL queries. 



// Yes, Laravel uses Blade as its default templating engine, not "Blade3" (which isn't a specific version name, but rather the core templating system). Blade is built-in, offers simple syntax, compiles to plain PHP for speed, and uses .blade.php files, with starter kits like Breeze defaulting to a Blade stack for front-end views. 


// Blade is Laravel's simple, fast templating engine that lets you write cleaner HTML with PHP, using directives like @if, @foreach, and {{ $variable }} for dynamic content, while automatically protecting against security issues like XSS by escaping output and compiling to plain PHP for zero overhead. It allows layout inheritance (base layouts with child views) and reusable components, making web views organized and efficient. 