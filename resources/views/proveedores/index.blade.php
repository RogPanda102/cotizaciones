@extends('layouts.app')

@section('content')
<h1>Proveedores</h1>

<a href="{{ route('proveedores.create') }}">Nuevo proveedor</a>

<table>
    <thead>
        <tr>
            <th>Empresa</th>
            <th>Nombre del Contacto</th>
            <th>Teléfono</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->empresa }}</td>
                <td>{{ $proveedor->nombre_contacto }}</td>
                <td>{{ $proveedor->telefono }}</td>
                <td>{{ $proveedor->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection