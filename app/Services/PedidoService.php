<?php

namespace App\Services;

use App\Models\Pedido;
use App\Enums\EstadoPedido;

class PedidoService
{
    public function actualizarPedido(Pedido $pedido, array $data): Pedido
    {
        $nuevoEstado = EstadoPedido::from($data['estado']);
        $estadoActual = $pedido->estado;

        // Validar transición de estado
        if (!$estadoActual->puedeCambiarA($nuevoEstado) && $estadoActual !== $nuevoEstado) {
            throw new \Exception("No se puede cambiar el estado de {$estadoActual->label()} a {$nuevoEstado->label()}.");
        }

        // Regla de negocio
        if ($nuevoEstado === EstadoPedido::FACTURADO && empty($data['fecha_facturacion'])) {
            throw new \Exception('Debe indicar la fecha de facturación cuando el pedido está facturado.');
        }

        if ($nuevoEstado !== EstadoPedido::FACTURADO) {
            $data['fecha_facturacion'] = null;
        }

        $pedido->update($data);

        return $pedido;
    }
}