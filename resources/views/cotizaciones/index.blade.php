@extends('layouts.app')

@section('content')

<a href="{{ route('cotizaciones.create') }}">
    Nueva Cotización
</a>

<br><br>
<div x-data="{ openId: null }">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Empresa</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Monto</th>
                <th>Fecha envío</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach ($cotizaciones as $cotizacion)
            <tr class="align-middle">
                <td>{{ $cotizacion->folio_externo }}</td>
                <td>{{ $cotizacion->empresa?->nombre ?? '-' }}</td>
                <td>
                    <span class="badge bg-info">
                        {{ ucfirst(str_replace('_', ' ', $cotizacion->tipo_cotizacion)) }}
                    </span>
                </td>
                <td>
                    <span class="badge bg-{{ $cotizacion->estado->color() }}">
                        {{ $cotizacion->estado->label() }}
                    </span>
                </td>
                <td>
                    {{ $cotizacion->monto_total ? '$' . number_format($cotizacion->monto_total, 2) : '-' }}
                </td>
                <td>
                    {{ $cotizacion->fecha_envio?->format('d/m/Y') ?? '-' }}
                </td>
                <td class="d-flex gap-2">

                    <!-- BOTÓN VER -->
                    <button
                        @click="openId = openId === {{ $cotizacion->id }} ? null : {{ $cotizacion->id }}"
                        class="btn btn-sm btn-outline-primary"
                    >
                        <span x-text="openId === {{ $cotizacion->id }} ? 'Ocultar' : 'Ver'"></span>
                    </button>

                    <!-- BOTÓN EDITAR -->
                    <a href="{{ route('cotizaciones.edit', $cotizacion) }}"
                    class="btn btn-sm btn-outline-warning">
                        Editar
                    </a>

                </td>
            </tr>

            <!-- FILA EXPANDIBLE -->
            <tr x-show="openId === {{ $cotizacion->id }}" x-transition.opacity x-cloak>
                <td colspan="7">
                    <div class="p-3 bg-light rounded">

                    <div class="row">

                        <!-- Card: General -->
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-header fw-bold">
                                    Información general
                                </div>
                                <div class="card-body">
                                    <p><strong>Dependencia:</strong> {{ $cotizacion->dependencia?->nombre_oficial ?? '-' }}</p>
                                    <p><strong>Departamento:</strong> {{ $cotizacion->departamento?->nombre_departamento ?? '-' }}</p>
                                    <p><strong>Analista:</strong> {{ $cotizacion->analista?->nombre ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card: Fechas -->
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-header fw-bold">
                                    Fechas
                                </div>
                                <div class="card-body">
                                    <p><strong>Envío:</strong> {{ $cotizacion->fecha_envio?->format('d/m/Y') ?? '-' }}</p>
                                    <p><strong>Recepción:</strong> {{ $cotizacion->fecha_recepcion?->format('d/m/Y') ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Card: Financieros -->
                        @if($cotizacion->tipo_cotizacion === 'omg')
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-header fw-bold">
                                    Financieros
                                </div>
                                <div class="card-body">
                                    <p><strong>Monto:</strong> {{ $cotizacion->monto_total ? '$' . number_format($cotizacion->monto_total, 2) : '-' }}</p>
                                    <p><strong>Días crédito:</strong> {{ $cotizacion->dias_credito ?? '-' }}</p>
                                    <p><strong>Tipo días:</strong> {{ $cotizacion->tipo_dias ?? '-' }}</p>
                                    <p><strong>Garantía:</strong> {{ $cotizacion->garantia ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Card: Identificación -->
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm">
                                <div class="card-header fw-bold">
                                    Identificación
                                </div>
                                <div class="card-body">
                                    <p><strong>Folio externo:</strong> {{ $cotizacion->folio_externo ?? '-' }}</p>
                                    <p><strong>Número:</strong> {{ $cotizacion->numero_cotizacion ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection