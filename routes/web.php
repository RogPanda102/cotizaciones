<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DependenciaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dependencias/create', [DependenciaController::class, 'create']);
Route::post('/dependencias', [DependenciaController::class, 'store'])->name('dependencias.store');