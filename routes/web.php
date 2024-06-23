<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->group(function () {
    Route::get('/', function () {
        return 'Versão Estoque 1.0.0';
    });
    Route::resource('produtos', ProdutoController::class);
});