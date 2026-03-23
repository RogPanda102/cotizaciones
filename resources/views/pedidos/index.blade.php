@extends('layouts.app')

@section('content')
<h2>Pedidos - {{ $empresa->nombre }}</h2>
<a href="{{ route('empresas.index') }}">← Cambiar empresa</a>

<a href="{{ route('pedidos.create', ['empresa_id' => $empresa->id]) }}" class="btn btn-success">
    Crear Pedido
</a>

<div style="margin-bottom: 15px;">
    <strong>Total de pedidos:</strong> {{ $pedidos->total() }}
</div>

<br><br>

<form method="GET" style="margin-bottom: 15px;">
    <input 
        type="text" 
        name="search" 
        placeholder="Buscar..." 
        value="{{ request('search') }}"
    >
    <button type="submit">Buscar</button>
</form>
<table class="table table-bordered table-hover">
    <tr>
        <th>Requisición</th>
        <th>Dependencia</th>
        <th>Monto</th>
        <th>Estado</th>
        <th>Fecha Limite</th>
        <th>Dias restantes</th>
        <th>Acciones</th>
    </tr>

    @foreach($pedidos as $pedido)
        @php
        $clase = '';
        if ($pedido->estado->esFinal()) {
            $clase = 'table-success';
        } elseif (!is_null($pedido->dias_restantes)) {

            if ($pedido->dias_restantes < 0) {
                $clase = 'table-danger';
            } elseif ($pedido->dias_restantes <= 3) {
                $clase = 'table-warning';
            }
        }
        @endphp
        <tr class="{{ $clase }}">
            <td>{{ $pedido->requisicion->folio_externo }}</td>
            <td>{{ $pedido->dependencia->nombre }}</td>
            <td>${{ number_format($pedido->monto_total_aprobado, 2) }}</td>


            <td>
                <span class="badge bg-{{ $pedido->estado->badge() }}">
                    {{ $pedido->estado->label() }}
                </span>
            </td>

            <td>{{ $pedido->fecha_entrega?->format('d/m/Y') }}</td>
            
            <td>{{ $pedido->dias_restantes }}</td>

            
            
            
            

            <td>
                <a href="{{ route('pedidos.show', $pedido->id) }}">
                    Ver
                </a>

                <form action="{{ route('pedidos.destroy', $pedido->id) }}" 
                      method="POST" 
                      style="display:inline;"
                      onsubmit="return confirm('¿Seguro que deseas eliminar este pedido?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<div style="margin-top: 20px;">
    {{ $pedidos->links() }}
</div>
@endsection