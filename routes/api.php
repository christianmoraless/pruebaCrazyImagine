<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'user'], function () {
    Route::post('login',[App\Http\Controllers\api\v1\LoginController::class, 'login']);
    Route::post('register',[App\Http\Controllers\api\v1\LoginController::class, 'register']);
    Route::post('logout',[App\Http\Controllers\api\v1\LoginController::class, 'logout']);
});
Route::group(['prefix' => 'notes'], function () {
    Route::middleware('auth:api')->get('index',[App\Http\Controllers\NoteController::class,'index']);
    Route::middleware('auth:api')->post('store',[App\Http\Controllers\NoteController::class,'store']);
    Route::middleware('auth:api')->delete('delete/{id}',[App\Http\Controllers\NoteController::class,'destroy']);
    Route::middleware('auth:api')->get('archived',[App\Http\Controllers\NoteController::class,'archived']);
    Route::middleware('auth:api')->get('show/{id}',[App\Http\Controllers\NoteController::class,'show']);
    Route::middleware('auth:api')->put('update/{id}',[App\Http\Controllers\NoteController::class,'update']);
});
