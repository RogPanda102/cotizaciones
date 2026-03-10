<div class="card">
<div class="card-body">

<p>
<strong>Monto aprobado:</strong>
${{ number_format($pedido->monto_total_aprobado, 2) }}
</p>

<p>
<strong>Total gastado:</strong>
${{ number_format($pedido->totalGastado(), 2) }}
</p>

<p>
<strong>Resultado:</strong>

@if($pedido->tienePerdida())

<span class="text-danger">
${{ number_format($pedido->utilidad(), 2) }} (Pérdida)
</span>

@else

<span class="text-success">
${{ number_format($pedido->utilidad(), 2) }} (Ganancia)
</span>

@endif

</p>

</div>
</div>