@extends('layouts.app')

@section('content')

<h2>Detalle del Pedido</h2>

<p><strong>Monto aprobado:</strong> ${{ $pedido->monto_total_aprobado }}</p>

<p><strong>Total gastado:</strong> ${{ $pedido->totalGastado() }}</p>

<p>
    <strong>Resultado:</strong>
    @if($pedido->tienePerdida())
        <span style="color:red;">
            ${{ $pedido->utilidad() }} (Pérdida)
        </span>
    @else
        <span style="color:green;">
            ${{ $pedido->utilidad() }} (Ganancia)
        </span>
    @endif
</p>

<hr>

<h3>Compras relacionadas</h3>

<table class="table table-bordered">
    <tr>
        <th>Fecha</th>
        <th>Monto</th>
        <th>Descripción</th>
    </tr>

    @foreach($pedido->compras as $compra)
        <tr>
            <td>{{ $compra->fecha?->format('d/m/Y') }}</td>
            <td>${{ $compra->monto }}</td>
            <td>{{ $compra->descripcion }}</td>
        </tr>
        <td>
        @if($pedido->estado !== \App\Enums\EstadoPedido::PAGADO)

            <a href="{{ route('compras.edit', $compra->id) }}">Editar</a>

            <form action="{{ route('compras.destroy', $compra->id) }}"
                method="POST"
                style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>

        @endif
        </td>
    @endforeach
</table>

<a href="{{ route('pedidos.index') }}">Volver</a>

@if($pedido->estado !== \App\Enums\EstadoPedido::PAGADO)

<hr>
<h4>Agregar Compra</h4>

<form action="{{ route('compras.store') }}" method="POST">
    @csrf

    <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">

    <div>
        <label>Descripción:</label>
        <input type="text" name="descripcion" required>
    </div>

    <div>
        <label>Monto:</label>
        <input type="number" step="0.01" name="monto" required>
    </div>

    <div>
        <label>Proveedor:</label>
        <input type="text" name="proveedor" required>
    </div>

    <button type="submit">Guardar Compra</button>
</form>

@endif
@endsection