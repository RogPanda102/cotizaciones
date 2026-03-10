<div class="card">
<div class="card-body">

<p>
<strong>Fecha adjudicación:</strong>
{{ $pedido->fecha_adjudicacion?->format('d/m/Y') }}
</p>

<p>
<strong>Fecha entrega:</strong>
{{ $pedido->fecha_entrega?->format('d/m/Y') }}
</p>

<p>
<strong>Fecha facturación:</strong>

@if($pedido->fecha_facturacion)
    {{ $pedido->fecha_facturacion->format('d/m/Y') }}
@else
    <span class="text-muted">Sin registrar</span>
@endif

</p>

<p>
<strong>Fecha pago:</strong>

@if($pedido->fecha_pago)
    {{ $pedido->fecha_pago->format('d/m/Y') }}
@else
    <span class="text-muted">No pagado</span>
@endif

</p>

<hr>

<p>
<strong>Días restantes:</strong>

@if($pedido->estado === \App\Enums\EstadoPedido::PAGADO)

    <span class="badge bg-primary">
        Pagado el {{ $pedido->fecha_pago?->format('d/m/Y') }}

        @if($pedido->dias_retraso > 0)
            <br>
            {{ $pedido->dias_retraso }} días de retraso
        @endif
    </span>

@else

    {{ $pedido->dias_restantes }}

@endif

</p>

</div>
</div>