@extends('layouts.app')

@section('content')

<a href="{{ route('proveedores.create') }}">Nuevo proveedor</a>

<table>
    <thead>
        <tr>
            <th>Empresa</th>
            <th>Nombre del Contacto</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->empresa }}</td>
                <td>{{ $proveedor->nombre_contacto }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->email }}</td>
                <td>
                    <a href="{{ route('proveedores.edit', $proveedor) }}">Editar</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection