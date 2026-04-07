<?php

namespace App\Http\Controllers;
use App\Models\Cliente;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function buscar(Request $request)
    {
        $email = $request->email ? trim(strtolower($request->email)) : null;
        $telefono = $request->telefono ? preg_replace('/\D/', '', $request->telefono) : null;

        $cliente = null;

        if ($email) {
            $cliente = Cliente::whereRaw('LOWER(email) = ?', [$email])->first();
        }

        if (!$cliente && $telefono) {
            $cliente = Cliente::whereRaw("REGEXP_REPLACE(telefono, '[^0-9]', '') = ?", [$telefono])->first();
        }

        return response()->json($cliente); // 👈 CLAVE
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
        $clienteExistente = null;

        if ($email) {
            $clienteExistente = Cliente::whereRaw('LOWER(email) = ?', [$email])->first();
        }

        if (!$clienteExistente && $telefono) {
            $clienteExistente = Cliente::whereRaw("REGEXP_REPLACE(telefono, '[^0-9]', '') = ?", [$telefono])->first();
        }

        // 🚫 SI YA EXISTE → NO CREAR
        if ($clienteExistente) {
            return response()->json([
                'existe' => true,
                'cliente' => $clienteExistente
            ], 200);
        }

        // ✅ CREAR NUEVO
        $cliente = Cliente::create([
            'departamento' => $request->departamento,
            'contacto' => $request->contacto,
            'telefono' => $telefono,
            'email' => $email,
            'direccion' => $request->direccion,
        ]);

        return response()->json($cliente, 201);
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
