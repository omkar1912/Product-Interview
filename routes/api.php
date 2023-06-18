<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserAuthenticated;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PasswordResetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[AuthController::class,'login']);

Route::middleware('auth-user')->group(function() {
    Route::post('register',[AuthController::class,'register'])->middleware(UserAuthenticated::class);

    Route::group(['middleware' => 'api','prefix' => 'password'
    ], function () {
        Route::post('create', [PasswordResetController::class,'create']);
        Route::get('find/{token}', [PasswordResetController::class,'find']);
        Route::post('reset', [PasswordResetController::class,'reset']);
    });
});

Route::group(['middleware' => 'auth:api','prefix' => 'categories'],function(){
    Route::get('/',[CategoryController::class,'index']);
});

Route::group(['middleware' => 'auth:api','prefix' => 'products'],function(){
    Route::get('/',[ProductController::class,'index']);
    Route::post('/',[ProductController::class,'store']);
    Route::post('/{id}',[ProductController::class,'update']);
    Route::get('/{id}',[ProductController::class,'show']);
    Route::delete('/{id}',[ProductController::class,'destroy']);

});

