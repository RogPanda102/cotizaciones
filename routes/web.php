<?php

    use Illuminate\Support\Facades\Route;
    use Illuminate\Http\Request;
    use App\Http\Controllers\DependenciaController;
    use App\Http\Controllers\CotizacionController;
    use App\Http\Controllers\PedidoController;
    use App\Http\Controllers\CompraController;
    use App\Http\Controllers\ProveedorController;
    use App\Http\Controllers\EmpresaController;
    use App\Http\Controllers\AnalistaController;
    use App\Http\Controllers\DepartamentoController;

    Route::get('/', function () {
        return redirect()->route('empresas.index');
    });

    Route::resource('dependencias', DependenciaController::class);
    Route::resource('cotizaciones', CotizacionController::class);
    Route::resource('pedidos', PedidoController::class);
    Route::resource('compras', CompraController::class);
    Route::resource('proveedores', ProveedorController::class) ->parameters([
        'proveedores' => 'proveedor'
    ]);
    Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');
    Route::get('/empresas/{empresa}/pedidos', [PedidoController::class, 'porEmpresa'])->name('empresas.pedidos');
    Route::get('/departamentos/buscar', [DepartamentoController::class, 'buscar'])->name('departamentos.buscar');
    Route::post('/analistas', [AnalistaController::class, 'store'])->name('analistas.store');
    Route::post('/departamentos', [DepartamentoController::class, 'store'])->name('departamentos.store');
    Route::get('/cotizaciones/{cotizacion}/edit', [CotizacionController::class, 'edit'])->name('cotizaciones.edit');
    Route::put('/cotizaciones/{cotizacion}', [CotizacionController::class, 'update'])->name('cotizaciones.update');
