<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requisicion;
use App\Enums\EstadoRequisicion;
use Illuminate\Validation\Rules\Enum;

class RequisicionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requisiciones = Requisicion::all();
        return view('requisiciones.index', compact('requisiciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('requisiciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'folio_externo' => 'required|unique:requisiciones,folio_externo',
            'descripcion' => 'required',
            'monto_estimado' => 'required|numeric',
            'estado' => ['required', new Enum(EstadoRequisicion::class)],
        ]);

        Requisicion::create($request->all());

        return redirect()->route('requisiciones.index')
                         ->with('success', 'Requisición creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    /* public function show(string $id)
    {
        //
    } */

    /**
     * Show the form for editing the specified resource.
     */
    /* public function edit(string $id)
    {
        //
    } */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requisicion $requisicion)
    {
        $request->validate([
            'folio_externo' => 'required|unique:requisiciones,folio_externo,',
            'descripcion' => 'required',
            'monto_estimado' => 'required|numeric',
            'estado' => ['required', new Enum(EstadoRequisicion::class)],
        ]);

        
        $requisicion->update($request->only([
            'folio_externo',
            'descripcion',
            'monto_estimado',
            'estado',
        ]));

        return redirect()->route('requisiciones.index')
                         ->with('success', 'Requisición actualizada exitosamente.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    /* public function destroy(string $id)
    {
        //
    } */
    
}
