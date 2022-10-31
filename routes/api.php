<?php

use App\Http\Controllers\Api\ActionLogController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);

Route::post('register',[AuthController::class,'register']);

Route::get('category',[AuthController::class,'categoryList'])->middleware('auth:sanctum');

// Post Api
Route::get('allpost',[PostController::class,'getAllPost']);
Route::post('post/detail',[PostController::class,'postDetail']);

// Category Api
Route::get('allCategory',[CategoryController::class,'getAllCategory']);
Route::post('category/search',[CategoryController::class,'categorySearch']);
Route::post('choose/category',[CategoryController::class,'categoryChoose']);
// Route::get('category',function(){
//      return response()->json('This is category');
// })->middleware('auth:sanctum');

// Action Log
Route::post('post/actionlog',[ActionLogController::class,'setActionLog']);
