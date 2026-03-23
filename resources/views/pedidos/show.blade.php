@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">

    <div class="col-md-8">

        <h2>Pedido #{{ $pedido->id }}</h2>

        <div class="card mb-3">

            <div class="card-body">

                <p>
                <strong>Dependencia:</strong>
                    {{ $pedido->dependencia->nombre }}
                </p>

                <p>
                    <strong>Estado:</strong>
                    <span class="badge bg-{{ $pedido->estado->badge() }}">
                        {{ $pedido->estado->label() }}
                    </span>
                </p>

                <p>
                    <strong>Fecha entrega:</strong>
                    {{ $pedido->fecha_entrega?->format('d/m/Y') ?? '—' }}
                </p>

            </div>

        </div>
    </div>

    <div class="col-md-4">

        <div class="card">

            <div class="card-header">
                Historial de estados
            </div>

            <div class="card-body">

                <table class="table table-sm table-striped">

                    <thead>
                        <tr>
                        <th>Estado</th>
                        <th>Fecha</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($pedido->historialEstados as $estado)

                            <tr>

                                <td>
                                    <span class="badge bg-{{ $estado->estado->badge() }}">
                                        {{ $estado->estado->label() }}
                                    </span>
                                </td>

                                <td>
                                    {{ $estado->created_at->format('d/m/Y') }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<div class="row mt-4">

    <div class="col-12">

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

</div>

@endsection