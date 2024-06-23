<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->group(function () {
    Route::resource('produtos', ProdutoController::class);
});