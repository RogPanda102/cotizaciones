@extends('layouts.app')

@section('content')
<h2>Lista de Dependencias</h2>

<a href="{{ route('dependencias.create') }}">Nueva Dependencia</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre Oficial</th>
        <th>Nombre Corto</th>
    </tr>

    @foreach($dependencias as $dependencia)
        <tr>
            <td>{{ $dependencia->id }}</td>
            <td>{{ $dependencia->nombre_oficial }}</td>
            <td>{{ $dependencia->nombre_corto }}</td>
        </tr>
    @endforeach
</table>
@endsection