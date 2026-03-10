<div class="card">
<div class="card-body">

<p>
<strong>Requisición:</strong>
{{ $pedido->requisicion->folio_externo }}
</p>

<p>
<strong>Dependencia:</strong>
{{ $pedido->dependencia->nombre }}
</p>

<p>
<strong>Estado:</strong>
{{ $pedido->estado->label() }}
</p>

<p>
<strong>Tipo de días:</strong>
{{ ucfirst($pedido->tipo_dias) }}
</p>

<p>
<strong>Días de entrega:</strong>
{{ $pedido->dias_entrega }}
</p>

<p>
<strong>Días de crédito:</strong>
{{ $pedido->dias_credito }}
</p>

</div>
</div>