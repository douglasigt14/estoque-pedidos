<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->group(function () {
    Route::get('/', [ProdutoController::class, 'index']);
    Route::resource('produtos', ProdutoController::class);
});