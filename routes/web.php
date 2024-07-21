<?php

use Illuminate\Support\Facades\Route;

// Captura todas las rutas
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
