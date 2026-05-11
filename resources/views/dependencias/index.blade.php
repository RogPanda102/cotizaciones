@extends('layouts.app')

@section('content')

<a href="{{ route('dependencias.create') }}">Nueva Dependencia</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre Oficial</th>
        <th>Nombre Corto</th>
        <th>Acciones</th>
    </tr>

    @foreach($dependencias as $dependencia)
        <tr>
            <td>{{ $dependencia->id }}</td>
            <td>{{ $dependencia->nombre_oficial }}</td>
            <td>{{ $dependencia->nombre_corto }}</td>
            <td>
                <a href="{{ route('dependencias.edit', $dependencia) }}">Editar</a>
            </td>
        </tr>
    @endforeach
</table>
@endsection