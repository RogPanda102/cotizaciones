<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\RequisicionController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpresaController;
use App\Models\Cliente;

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
Route::post('/clientes', function (Request $request) {

    $cliente = Cliente::create([
        'departamento' => $request->departamento,
        'contacto' => $request->contacto,
        'telefono' => $request->telefono,
        'email' => $request->email,
        'direccion' => $request->direccion,
    ]);

    return response()->json($cliente);
});
Route::get('/clientes/buscar', function (Request $request) {
    $query = Cliente::query();

    if ($request->email) {
        $query->where('email', $request->email);
    }

    if ($request->telefono) {
        $query->orWhere('telefono', $request->telefono);
    }

    return response()->json($query->first());
});