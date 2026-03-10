@extends('layouts.app')

@section('content')

<h2>Pedido #{{ $pedido->id }}</h2>

<div class="mb-3">
    <strong>Dependencia:</strong> {{ $pedido->dependencia->nombre }}
</div>

<div class="mb-4">
    <strong>Estado:</strong> {{ $pedido->estado->label() }}
</div>

<div class="mb-4">

    <span class="badge bg-secondary">
        Estado: {{ $pedido->estado->label() }}
    </span>

    <span class="badge bg-info">
        Entrega: {{ $pedido->fecha_entrega?->format('d/m/Y') }}
    </span>

</div>


<ul class="nav nav-tabs" id="pedidoTabs" role="tablist">

<li class="nav-item">
<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#info">
Info general
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#finanzas">
Finanzas
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#plazos">
Plazos
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#compras">
Compras
</button>
</li>

<li class="nav-item">
<button class="nav-link" data-bs-toggle="tab" data-bs-target="#acciones">
Acciones
</button>
</li>

</ul>


<div class="tab-content mt-4">

<div class="tab-pane fade show active" id="info">
@include('pedidos.tabs.info-general')
</div>

<div class="tab-pane fade" id="finanzas">
@include('pedidos.tabs.finanzas')
</div>

<div class="tab-pane fade" id="plazos">
@include('pedidos.tabs.plazos')
</div>

<div class="tab-pane fade" id="compras">
@include('pedidos.tabs.compras')
</div>

<div class="tab-pane fade" id="acciones">
@include('pedidos.tabs.acciones')
</div>

</div>

</div>

@endsection