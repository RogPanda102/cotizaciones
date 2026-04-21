@extends('layouts.app')

@section('content')
<h2>Lista de Cotizaciones</h2>

<a href="{{ route('cotizaciones.create') }}">
    Nueva Cotización
</a>

<br><br>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

<table border="1">
    <tr>
        <th>Folio</th>
        <th>Descripción</th>
        <th>Estado</th>
    </tr>

    @foreach($cotizaciones as $cot)
        <tr>
            <td>{{ $cot->folio_externo }}</td>
            <td>{{ $cot->descripcion }}</td>
            <td>{{ $cot->estado->label() }}</td>
            
        </tr>
    @endforeach
</table>
@endsection