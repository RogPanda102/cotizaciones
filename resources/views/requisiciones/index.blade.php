@extends('layouts.app')

@section('content')
<h2>Lista de Requisiciones</h2>

<a href="{{ route('requisiciones.create') }}">
    Nueva Requisición
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

    @foreach($requisiciones as $req)
        <tr>
            <td>{{ $req->folio_externo }}</td>
            <td>{{ $req->descripcion }}</td>
            <td>{{ $req->estado->label() }}</td>
            
        </tr>
    @endforeach
</table>
@endsection