<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendPostController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    // admin
    Route::get('/dashboard',[ProfileController::class,'adminProfile'])->name('dashboard');
    Route::post('profile/update',[ProfileController::class,'adminProfileUpdate'])->name('admin#profileupdate');
    Route::get('change/password/page',[ProfileController::class,'adminPasswordChangePage'])->name('admin#changepasswordpage');
    Route::post('change/password',[ProfileController::class,'adminPasswordChange'])->name('admin#changepassword');

    // admin List
    Route::get('admin/list',[ListController::class,'adminList'])->name('admin#list');
    Route::get('admin/list/delete/{id}',[ListController::class,'adminDelete'])->name('admin#delete');
    Route::post('admin/list/search',[ListController::class,'adminListSearch'])->name('admin#listsearch');

    // Category
    Route::get('category',[CategoryController::class,'adminCategory'])->name('admin#category');
    Route::post('category/create',[CategoryController::class,'categoryCreate'])->name('admin#categorycreate');
    Route::get('category/delete/{id}',[CategoryController::class,'adminCategoryDelete'])->name('admin#categorydelete');
    Route::post('category/list/search',[CategoryController::class,'categoryListSearch'])->name('admin#categorylistsearch');
    Route::get('category/edit/page/{id}',[CategoryController::class,'categoryEditPage'])->name('admin#categoryeditpage');
    Route::post('category/update/{id}',[CategoryController::class,'categoryUpdate'])->name('admin#categoryupdate');

    // Post
    Route::get('post',[PostController::class,'adminPost'])->name('admin#post');
    Route::post('post/create',[PostController::class,'postCreate'])->name('admin#postcreate');
    Route::get('post/delete/{id}',[PostController::class,'postDelete'])->name('admin#postdelete');
    Route::get('post/edit/page/{id}',[PostController::class,'postEditPage'])->name('admin#posteditpage');
    Route::post('post/update/{id}',[PostController::class,'postUpdate'])->name('admin#postupdate');

    // Trend Post
    Route::get('trend/post',[TrendPostController::class,'adminTrendPost'])->name('admin#trendpost');
    Route::get('trend/post/detail/{id}',[TrendPostController::class,'trendPostDetail'])->name('admin#trendpostedetail');

});
