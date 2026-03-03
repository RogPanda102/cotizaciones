<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Compra;
use App\Enums\EstadoPedido;
use Illuminate\Validation\Rules\Enum;

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
    public function store(Request $request)
    {
        $request->validate([
        'pedido_id' => 'required|exists:pedidos,id',
        'descripcion' => 'required|string',
        'monto' => 'required|numeric',
        'proveedor' => 'required|string',
        ]);

        $pedido = Pedido::findOrFail($request->pedido_id);

        // 🔒 Bloqueo si está pagado
        if ($pedido->estado === \App\Enums\EstadoPedido::PAGADO) {
            return back()->with('error', 'No se pueden agregar compras a un pedido pagado.');
        }

        Compra::create([
            'pedido_id' => $pedido->id,
            'descripcion' => $request->descripcion,
            'monto' => $request->monto,
            'proveedor' => $request->proveedor,
        ]);

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        $request->validate([
        'descripcion' => 'required|string',
        'monto' => 'required|numeric',
        'proveedor' => 'required|string',
        ]);

        // Bloqueo
        if ($compra->pedido->estado === \App\Enums\EstadoPedido::PAGADO) {
            return back()->with('error', 'No se pueden modificar compras de un pedido pagado.');
        }

        $compra->update($request->only([
            'descripcion',
            'monto',
            'proveedor'
        ]));

        return redirect()->route('pedidos.show', $compra->pedido_id)
            ->with('success', 'Compra actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        if ($compra->pedido->estado === \App\Enums\EstadoPedido::PAGADO) {
        return back()->with('error', 'No se pueden eliminar compras de un pedido pagado.');
        }

        $pedidoId = $compra->pedido_id;
        $compra->delete();

        return redirect()->route('pedidos.show', $pedidoId)
            ->with('success', 'Compra eliminada.');
    }
}
