<?php

namespace App\Http\Controllers;

use App\Enums\TipoAlerta;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Empresa;
use App\Models\Departamento;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        $datos = $this->cargar_datos();

        return view('proveedores.index', array_merge($datos, compact('proveedores')));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $datos = $this->cargar_datos2();

        return view('proveedores.create', array_merge(
            $datos,
            [
                'proveedores' => Proveedor::all(),
                'empresas' => Empresa::all(),
                'departamentos' => Departamento::all(),
            ]
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'empresa' => 'required|string|max:255',
            'nombre_contacto' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
        ]);

        Proveedor::create($request->all());
        mensaje('Proovedor Agregado',TipoAlerta::SUCCESS);
        return redirect()->route('proveedores.index');
        
    }

    //ESTA FUNCION CONTROLA EL BREADCRUMB DEL PROGRAMA
    private function cargar_datos()
    {
        $datos = array();
        $datos['nombre_pagina'] = '';
        $datos['tarea'] = 'Proveedores';

        $breadcrumb = array
        (
            array
            (
                'tarea' => 'Proveedores',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);
        return $datos;
    }
    //ESTA FUNCION CONTROLA EL BREADCRUMB DEL PROGRAMA
    //ESTA FUNCION CONTROLA EL BREADCRUMB DEL PROGRAMA
    private function cargar_datos2()
    {
        $datos = array();
        $datos['nombre_pagina'] = '';
        $datos['tarea'] = 'Nuevo Proveedor';

        $breadcrumb = array
        (
            array
            (
                'tarea' => 'Proveedores',
                'href' => route('proveedores.index')
            ),
                        array
            (
                'tarea' => 'Nuevo Proveedor',
                'href' => '#'
            )
        );
        $datos['breadcrumb'] = breadcrumb($datos['tarea'], $breadcrumb);
        return $datos;
    }
    //ESTA FUNCION CONTROLA EL BREADCRUMB DEL PROGRAMA
}
