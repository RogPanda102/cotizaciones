<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Enums\TipoAlerta;

use function PHPUnit\Framework\returnArgument;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::all();
        $datos = $this->cargar_datos();
        return view('empresas.index', array_merge($datos, compact('empresas')));
    }

    private function cargar_datos()
    {
        $datos = array();
        $datos['nombre_pagina'] = '';
        $datos['tarea'] = 'Selecciona una empresa';

        $breadcrumb = array
        (
            array
            (
                'tarea' => 'Inicio',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);
        return $datos;
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
