<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizacion;
use App\Enums\EstadoCotizacion;
use App\Http\Requests\StoreCotizacionRequest;
use App\Http\Requests\UpdateCotizacionRequest;
use App\Services\CotizacionService;

class CotizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cotizaciones = Cotizacion::with([
            'empresa',
            'dependencia',
            'departamento',
            'analista',
            'pedido'
        ])->latest()->get();
        return view('cotizaciones.index', compact('cotizaciones'));
    }

    private function getFormData(): array
    {
        return [
            'empresas' => \App\Models\Empresa::all(),
            'dependencias' => \App\Models\Dependencia::all(),
            'departamentos' => \App\Models\Departamento::all(),
            'analistas' => \App\Models\Analista::all(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cotizaciones.create', $this->getFormData());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCotizacionRequest $request, CotizacionService $service)
    {
        $cotizacion = $service->crearCotizacion($request->validated());

        return redirect()
            ->route('cotizaciones.index', $cotizacion)
            ->with('success', 'Cotización creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cotizacion $cotizacion)
    {
        $cotizacion->load([
            'empresa',
            'dependencia',
            'departamento',
            'analista',
            'pedido'
        ]);
        return redirect()->route('cotizaciones.index');
    } 

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cotizacion $cotizacion)
    {
        return view('cotizaciones.edit', array_merge($this->getFormData(),['cotizacion' => $cotizacion]));
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCotizacionRequest $request, Cotizacion $cotizacion, CotizacionService $service)
    {
        $data = $request->validated();

        // Validar transición de estado
        if (isset($data['estado'])) {
            $estadoActual = EstadoCotizacion::from($cotizacion->estado);
            $nuevoEstado = EstadoCotizacion::from($data['estado']);

            if (!$estadoActual->puedeTransicionarA($nuevoEstado)) {
                return back()->withErrors([
                    'estado' => 'Transición de estado no permitida.'
                ]);
            }
        }
        $cotizacion = $service->actualizarCotizacion($cotizacion, $data);

        return redirect()
            ->route('cotizaciones.index', $cotizacion)
            ->with('success', 'Cotización actualizada correctamente');
    } 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cotizacion $cotizacion)
    {
        $cotizacion->delete();

        return redirect()
            ->route('cotizaciones.index')
            ->with('success', 'Cotización eliminada');
    } 
    
}
