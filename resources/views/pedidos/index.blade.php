@extends('layouts.app')

@section('content')
<h2>Lista de Pedidos</h2>

<a href="{{ route('pedidos.create') }}">Nuevo Pedido</a>

<br><br>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

<table class="table table-bordered">
    <tr>
        <th>Requisición</th>
        <th>Dependencia</th>
        <th>Monto Aprobado</th>
        <th>Total Gastado</th>
        <th>Resultado</th>
        <th>Estado</th>
        <th>Días Restantes</th>
        <th>F. Adjudicación</th>
        <th>F. Entrega</th>
        <th>F. Facturación</th>
        <th>Tipo Días</th>
        <th>Días Crédito</th>
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

            <td>
                ${{ number_format($pedido->totalGastado(), 2) }}
            </td>

            <td>
                @php
                    $utilidad = $pedido->utilidad();
                @endphp

                @if($utilidad > 0)
                    <span class="badge bg-success">
                        Ganancia (${{ number_format($utilidad, 2) }})
                    </span>

                @elseif($utilidad < 0)
                    <span class="badge bg-danger">
                        Pérdida (${{ number_format($utilidad, 2) }})
                    </span>

                @else
                    <span class="badge bg-secondary">
                        Equilibrado
                    </span>
                @endif
            </td>

            <td>{{ $pedido->estado->label() }}</td>
            <td>
                @if($pedido->estado === \App\Enums\EstadoPedido::PAGADO)

                    <span class="badge bg-primary">
                        Pagado el {{ $pedido->fecha_pago ? \Carbon\Carbon::parse($pedido->fecha_pago)->format('d/m/Y') : '' }}

                        @if($pedido->dias_retraso > 0)
                            <br>
                            {{ $pedido->dias_retraso }} días de retraso
                        @endif
                    </span>

                @else

                    {{ $pedido->dias_restantes }}

                @endif
            </td>
            <td>{{ $pedido->fecha_adjudicacion?->format('d/m/Y') }}</td>
            <td>{{ $pedido->fecha_entrega?->format('d/m/Y') }}</td>
            

            <td>
                @if($pedido->fecha_facturacion)
                    {{ \Carbon\Carbon::parse($pedido->fecha_facturacion)->format('d/m/Y') }}
                @else
                    <span style="color: gray; font-style: italic;">
                        Sin asignar
                    </span>
                @endif
            </td>

            <td>{{ ucfirst($pedido->tipo_dias) }}</td>
            <td>{{ $pedido->dias_credito }}</td>
            

            <td>
                <a href="{{ route('pedidos.edit', $pedido->id) }}">
                    Editar
                </a>
                <a href="{{ route('pedidos.show', $pedido->id) }}">
                    Ver compras
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