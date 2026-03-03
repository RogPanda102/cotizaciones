<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\RequisicionController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CompraController;

Route::get('/', function () {
    return redirect()->route('pedidos.index');
});

Route::resource('dependencias', DependenciaController::class);
Route::resource('requisiciones', RequisicionController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('compras', CompraController::class);