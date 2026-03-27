<div class="card">
    <div class="card-body">

        <h6 class="mb-3">Resumen financiero</h6>

        <div class="row mb-3">

            <div class="col-md-6">
                <p class="mb-2">
                    <strong>Monto aprobado:</strong><br>
                    ${{ number_format($pedido->monto_total_aprobado, 2) }}
                </p>
            </div>

            <div class="col-md-6">
                <p class="mb-2">
                    <strong>Total gastado:</strong><br>
                    ${{ number_format($pedido->costo_real, 2) }}
                </p>
            </div>

        </div>

        <hr>

        <h6 class="mb-3">Resultado</h6>

        @if($pedido->resultado_tipo === 'perdida')

            <span class="badge bg-danger">
                Pérdida: ${{ number_format($pedido->resultado, 2) }}
            </span>

        @elseif($pedido->resultado_tipo === 'ganancia')

            <span class="badge bg-success">
                Ganancia: ${{ number_format($pedido->resultado, 2) }}
            </span>

        @else

            <span class="badge bg-secondary">
                Equilibrio: ${{ number_format($pedido->resultado, 2) }}
            </span>

        @endif

    </div>
</div>