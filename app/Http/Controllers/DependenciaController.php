<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dependencia;

class DependenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dependencias = Dependencia::all();
        $datos = $this->cargar_datos();
        return view('dependencias.index', array_merge($datos, compact('dependencias')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dependencias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_oficial' => 'required|string|max:255',
            'nombre_corto' => 'nullable|string|max:255',
        ]);

        Dependencia::create($request->all());

        return redirect()->route('dependencias.index')->with('success', 'Dependencia creada correctamente');
    }

    //ESTA FUNCION CONTROLA EL BREADCRUMB DEL PROGRAMA
    private function cargar_datos()
    {
        $datos = array();
        $datos['nombre_pagina'] = '';
        $datos['tarea'] = 'Lista de dependencias';

        $breadcrumb = array
        (
            array
            (
                'tarea' => 'Dependencias',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);
        return $datos;
    }
    //ESTA FUNCION CONTROLA EL BREADCRUMB DEL PROGRAMA
}
