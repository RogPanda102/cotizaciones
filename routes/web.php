<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\RequisicionController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpresaController;

Route::get('/', function () {
    return redirect()->route('empresas.index');
});

Route::resource('dependencias', DependenciaController::class);
Route::resource('requisiciones', RequisicionController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('compras', CompraController::class);
Route::resource('proveedores', ProveedorController::class);
Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');
Route::get('/empresas/{empresa}/pedidos', [PedidoController::class, 'porEmpresa'])->name('empresas.pedidos');