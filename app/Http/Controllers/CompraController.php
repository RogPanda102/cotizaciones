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

        // Bloqueo para edicion
        if (!$pedido->puedeEditarCompras()) {
        return back()->with('error', 'Las compras están bloqueadas para este pedido.');
        // o abort(403);
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
        $pedido = $compra->pedido;

        if (!$pedido->puedeEditarCompras()) {
            abort(403, 'Las compras están bloqueadas.');
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
        $pedido = $compra->pedido;

        if (!$pedido->puedeEditarCompras()) {
            abort(403, 'Las compras están bloqueadas.');
        }

        $pedidoId = $compra->pedido_id;
        $compra->delete();

        return redirect()->route('pedidos.show', $pedidoId)
            ->with('success', 'Compra eliminada.');
    }
}
