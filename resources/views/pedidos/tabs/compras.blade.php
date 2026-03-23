<h4>Compras relacionadas</h4>

<table class="table table-bordered">

<tr>
<th>Fecha</th>
<th>Monto</th>
<th>Cantidad</th>
<th>Unidad</th>
<th>Proveedor</th>
<th>Descripción</th>
<th>Acciones</th>
</tr>

@foreach($pedido->compras as $compra)

<tr>

<td>{{ $compra->fecha?->format('d/m/Y') }}</td>

<td>${{ number_format($compra->monto, 2) }}</td>

<td>{{ $compra->cantidad }}</td>

<td>{{ $compra->unidad }}</td>

<td>{{ $compra->proveedor }}</td>

<td>{{ $compra->descripcion }}</td>

<td>

@if($pedido->estado->noEsFinal())

<a href="{{ route('compras.edit', $compra->id) }}">
Editar
</a>

<form action="{{ route('compras.destroy', $compra->id) }}"
method="POST"
style="display:inline;">
@csrf
@method('DELETE')

<button type="submit">
Eliminar
</button>

</form>

@endif

</td>

</tr>

@endforeach

</table>

<div class="mt-3 text-end">

<strong>
Total gastado:

${{ number_format($pedido->totalGastado(), 2) }}

</strong>

</div>

@if($pedido->estado->noEsFinal())

<hr>

<h5>Agregar compra</h5>

<form action="{{ route('compras.store') }}" method="POST">

@csrf

<input type="hidden" name="pedido_id" value="{{ $pedido->id }}">

<div>

<label>Fecha</label>
<input type="date" name="fecha" class="form-control" required>

</div>

<div>

<label>Cantidad</label>
<input type="number" name="cantidad" min="1" class="form-control" required>

</div>

<div>

<label>Unidad</label>
<input type="text" name="unidad" class="form-control" required>

</div>

<div class="mb-3">

<label>Descripción</label>

<input type="text" name="descripcion" class="form-control" required>

</div>

<div class="mb-3">

<label>Monto</label>

<input type="number" step="0.01" name="monto" class="form-control" required>

</div>

<div class="mb-3">

<label>Proveedor</label>

<input type="text" name="proveedor" class="form-control" required>

</div>

<button class="btn btn-primary">
Guardar compra
</button>

</form>

@endif