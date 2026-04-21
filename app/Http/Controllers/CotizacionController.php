<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizacion;
use App\Enums\EstadoCotizacion;
use Illuminate\Validation\Rules\Enum;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cotizaciones = Cotizacion::all();
        return view('cotizaciones.index', compact('cotizaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cotizaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'folio_externo' => 'required|unique:cotizaciones,folio_externo',
            'descripcion' => 'required',
            'estado' => ['required', new Enum(EstadoCotizacion::class)],
        ]);

        Cotizacion::create($request->all());

        return redirect()->route('cotizaciones.index')
                         ->with('success', 'Cotización creada exitosamente.');
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
    public function update(Request $request, Cotizacion $cotizacion)
    {
        $request->validate([
            'folio_externo' => 'required|unique:cotizaciones,folio_externo,' . $cotizacion->id,
            'descripcion' => 'required',
            'estado' => ['required', new Enum(EstadoCotizacion::class)],
        ]);

        
        $cotizacion->update($request->only([
            'folio_externo',
            'descripcion',
            'estado',
        ]));

        return redirect()->route('cotizaciones.index')
                         ->with('success', 'Cotización actualizada exitosamente.');
    } 

    /**
     * Remove the specified resource from storage.
     */
    /* public function destroy(string $id)
    {
        //
    } */
    
}
