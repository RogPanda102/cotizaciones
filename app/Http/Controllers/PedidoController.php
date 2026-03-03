<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Requisicion;
use App\Models\Dependencia;
use App\Enums\EstadoPedido;
use Illuminate\Validation\Rules\Enum;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with(['compras', 'requisicion', 'dependencia'])->get();
        return view('pedidos.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $requisiciones = Requisicion::all();
        $dependencias = Dependencia::all();

        return view('pedidos.create', compact('requisiciones', 'dependencias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'requisicion_id' => 'required|exists:requisiciones,id',
            'dependencia_id' => 'required|exists:dependencias,id',
            'fecha_adjudicacion' => 'required|date',
            'fecha_entrega' => 'nullable|date',
            'fecha_facturacion' => 'nullable|date',
            'tipo_dias' => 'required|in:naturales,habiles',
            'dias_credito' => 'required|integer',
            'estado' => ['required', new Enum(EstadoPedido::class)],
        ]);

        Pedido::create($request->all());

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        $pedido->load('compras');

        return view('pedidos.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.edit', compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
        'estado' => ['required', new Enum(EstadoPedido::class)],
        'fecha_facturacion' => 'nullable|date',
        ]);

        $estadoEnum = EstadoPedido::from($validated['estado']);

        // 🔥 Regla de negocio elegante
        if ($estadoEnum === EstadoPedido::FACTURADO && empty($validated['fecha_facturacion'])) {
            return back()
                ->withErrors([
                    'fecha_facturacion' => 'Debe indicar la fecha de facturación cuando el pedido está facturado.'
                ])
                ->withInput();
        }

        if ($estadoEnum !== EstadoPedido::FACTURADO) {
            $validated['fecha_facturacion'] = null;
        }

        $pedido->update($validated);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido actualizado correctamente.');
        }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido eliminado correctamente.');
    }
}
