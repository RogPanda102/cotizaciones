<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Http\Requests\StoreCompraRequest;
use App\Http\Requests\UpdateCompraRequest;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request)
    {
        $pedido = Pedido::findOrFail($request->pedido_id);

        // 🔒 Bloqueo si está pagado
        if ($pedido->estado->esFinal()) {
            return back()->with('error', 'No se pueden agregar compras a un pedido pagado.');
        }

        Compra::create($request->validated());

        return redirect()->route('pedidos.show', $pedido->id)
            ->with('success', 'Compra registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
            $proveedores = Proveedor::all();

            return view('compras.edit', compact('compra', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompraRequest $request, Compra $compra)
    {

        // Bloqueo
        if ($compra->pedido->estado->esFinal()) {
            return back()->with('error', 'No se pueden modificar compras de un pedido pagado.');
        }

        $compra->update($request->validated());

        return redirect()->route('pedidos.show', $compra->pedido_id)
            ->with('success', 'Compra actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        if ($compra->pedido->estado->esFinal()) {
        return back()->with('error', 'No se pueden eliminar compras de un pedido pagado.');
        }

        $pedidoId = $compra->pedido_id;
        $compra->delete();

        return redirect()->route('pedidos.show', $pedidoId)
            ->with('success', 'Compra eliminada.');
    }
}
