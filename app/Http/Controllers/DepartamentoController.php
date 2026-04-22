<?php

namespace App\Http\Controllers;
use App\Models\Departamento;

use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function buscar(Request $request)
    {
        $email = $request->email ? trim(strtolower($request->email)) : null;
        $telefono = $request->telefono ? preg_replace('/\D/', '', $request->telefono) : null;

        $departamento = null;

        if ($email) {
            $departamento = Departamento::whereRaw('LOWER(email) = ?', [$email])->first();
        }

        if (!$departamento && $telefono) {
            $departamento = Departamento::whereRaw("REGEXP_REPLACE(telefono, '[^0-9]', '') = ?", [$telefono])->first();
        }

        return response()->json($departamento); // 👈 CLAVE
    }
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
        // 🔥 NORMALIZAR
        $email = $request->email ? trim(strtolower($request->email)) : null;
        $telefono = $request->telefono ? preg_replace('/\D/', '', $request->telefono) : null;

        // 🔍 BUSCAR DUPLICADO
        $departamentoExistente = null;

        if ($email) {
            $departamentoExistente = Departamento::whereRaw('LOWER(email) = ?', [$email])->first();
        }

        if (!$departamentoExistente && $telefono) {
            $departamentoExistente = Departamento::whereRaw("REGEXP_REPLACE(telefono, '[^0-9]', '') = ?", [$telefono])->first();
        }

        // 🚫 SI YA EXISTE → NO CREAR
        if ($departamentoExistente) {
            return response()->json([
                'existe' => true,
                'departamento' => $departamentoExistente
            ], 200);
        }

        // ✅ CREAR NUEVO
        $departamento = Departamento::create([
            'nombre_departamento' => $request->nombre_departamento,
            'responsable' => $request->responsable,
            'telefono' => $telefono,
            'email' => $email,
            'direccion' => $request->direccion,
        ]);

        return response()->json($departamento, 201);
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
