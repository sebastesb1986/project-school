<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::controller(CategoriesController::class)->group(function (){

    Route::get('categories','index');
    Route::get('category/{id}','edit');
    Route::get('category/quantity/{category_id}','quantity');
    Route::post('category/create', 'store');
    Route::put('category/update/{id}', 'update');
    Route::delete('category/{id}', 'delete');

});

Route::controller(ProductController::class)->group(function (){

    Route::get('products','index');
    Route::get('product/{id}','edit');
    Route::post('product/create', 'store');
    Route::put('product/update/{id}', 'update');
    Route::delete('product/{id}', 'delete');

});

Route::controller(UserController::class)->group(function (){

    Route::get('users','index');
    Route::get('user/{id}','edit');
    Route::post('user/create', 'store');

});
