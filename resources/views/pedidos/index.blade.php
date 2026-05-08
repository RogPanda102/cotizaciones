@extends('layouts.app')

@section('content')

<a href="{{ route('empresas.index') }} ">← Cambiar empresa</a>

<a href="{{ route('pedidos.create', ['empresa_id' => $empresa->id]) }}" class="btn btn-success">
    Crear Pedido
</a>

<div style="margin-bottom: 15px;">
    <strong>Total de pedidos:</strong> {{ $pedidos->total() }}
</div>

<br><br>

<form method="GET" style="margin-bottom: 15px;">
    <input 
        type="text" 
        name="search" 
        placeholder="Buscar..." 
        value="{{ request('search') }}"
    >
    <button type="submit">Buscar</button>
</form>
<table class="table table-bordered table-hover">
    <tr>
        <th>Cotización</th>
        <th>Dependencia</th>
        <th>Monto</th>
        <th>Estado</th>
        <th>Fecha Limite</th>
        <th>Dias restantes</th>
        <th>Acciones</th>
    </tr>

    @foreach($pedidos as $pedido)
        @php
        $clase = '';
        if ($pedido->estado->esFinal()) {
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
            <td>{{ $pedido->cotizacion->folio_externo }}</td>
            <td>{{ $pedido->dependencia->nombre_oficial }}</td>
            <td>
                ${{ number_format($pedido->monto_total_aprobado, 2) }}
                @if($pedido->resultado_tipo === 'perdida')
                    <span title="Pérdida">🔴</span>
                @elseif($pedido->resultado_tipo === 'ganancia')
                    <span title="Ganancia">🟢</span>
                @else
                    <span title="Equilibrio">⚪</span>
                @endif
            </td>


            <td>
                <span class="badge bg-{{ $pedido->estado->badge() }}">
                    {{ $pedido->estado->label() }}
                </span>

                <br>

                <span class="badge bg-secondary">
                    {{ ucfirst($pedido->tipo) }}
                </span>
            </td>

            <td>{{ $pedido->fecha_entrega?->format('d/m/Y') }}</td>
            
            <td>{{ $pedido->dias_restantes_entrega }}</td>

            
            
            
            

            <td>
                <a href="{{ route('pedidos.show', $pedido->id) }}">
                    <button class="btn btn-sm btn-primary">
                        Ver
                    </button>
                </a>

                <form 
                    id="delete-form-{{ $pedido->id }}"
                    action="{{ route('pedidos.destroy', $pedido->id) }}" 
                    method="POST"
                    style="display: inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $pedido->id }})">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
<div style="margin-top: 20px;">
    {{ $pedidos->links() }}
</div>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: '¿Eliminar pedido?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('delete-form-' + id);
                if (form) {
                    form.submit();
                } else {
                    console.error('Form no encontrado');
                }
            }
        });
    }
</script>
@endsection