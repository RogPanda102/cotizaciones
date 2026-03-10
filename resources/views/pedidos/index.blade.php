@extends('layouts.app')

@section('content')
<h2>Lista de Pedidos</h2>

<a href="{{ route('pedidos.create') }}">Nuevo Pedido</a>

<br><br>


<table class="table table-bordered">
    <tr>
        <th>Requisición</th>
        <th>Dependencia</th>
        <th>Monto</th>
        <th>Estado</th>
        <th>Fecha Entrega</th>
        <th>Dias restantes</th>
        <th>Acciones</th>
    </tr>

    @foreach($pedidos as $pedido)
        @php
        $clase = '';
        if ($pedido->estado === \App\Enums\EstadoPedido::PAGADO) {
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


            <td>{{ $pedido->estado->label() }}</td>

            <td>{{ $pedido->fecha_entrega?->format('d/m/Y') }}</td>
            
            <td>{{ $pedido->dias_restantes }}</td>

            
            
            
            

            <td>
                <a href="{{ route('pedidos.show', $pedido->id) }}">
                    Ver detalles
                </a>

                <form action="{{ route('pedidos.destroy', $pedido->id) }}" 
                      method="POST" 
                      style="display:inline;"
                      onsubmit="return confirm('¿Seguro que deseas eliminar este pedido?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection