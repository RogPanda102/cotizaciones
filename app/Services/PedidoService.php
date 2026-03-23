<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Enums\EstadoPedido;
use App\Models\PedidoServicio;
use App\Models\PedidoLicencia;
use Illuminate\Support\Facades\DB;

class PedidoService
{

    public function crearPedido(array $data): Pedido
    {
        return DB::transaction(function () use ($data) {

            // Crear cliente
            $cliente = Cliente::create([
                'departamento' => $data['departamento_cliente'],
                'contacto' => $data['contacto_cliente'] ?? null,
                'telefono' => $data['telefono_cliente'] ?? null,
                'email' => $data['email_cliente'] ?? null,
                'direccion' => $data['direccion_cliente'] ?? null,
            ]);

            // asignar cliente al pedido
            $data['cliente_id'] = $cliente->id;
        
            $data['estado'] = EstadoPedido::EN_PROCESO;

            $pedido = Pedido::create($data);

            $pedido->historialEstados()->create([
                'estado' => $pedido->estado
            ]);
            
            switch ($data['tipo']) {
                case 'servicio':
                    
                    $this->crearServicio($pedido, $data);
                    break;

                case 'licencia':
                    $this->crearLicencia($pedido, $data);
                    break;

                case 'mercadeo':
                    // no requiere nada extra
                    break;
            }

            return $pedido;
        });
    }

    private function crearServicio(Pedido $pedido, array $data): void
    {
        PedidoServicio::create([
            'pedido_id' => $pedido->id,
            'descripcion_servicio' => $data['descripcion_servicio'] ?? null,
            'fecha_inicio' => $data['servicio_fecha_inicio'] ?? null,
            'fecha_fin' => $data['servicio_fecha_fin'] ?? null,
        ]);
    }

    private function crearLicencia(Pedido $pedido, array $data): void
    {
        PedidoLicencia::create([
            'pedido_id' => $pedido->id,
            'nombre_licencia' => $data['nombre_licencia'] ?? null,
            'fecha_inicio' => $data['licencia_fecha_inicio'] ?? null,
            'fecha_fin' => $data['licencia_fecha_fin'] ?? null,
        ]);
    }

    public function actualizarPedido(Pedido $pedido, array $data): Pedido
    {
        $nuevoEstado = EstadoPedido::from($data['estado']);
        $estadoActual = $pedido->estado;

        if ($estadoActual->esFinal()) {
            throw new \Exception('El pedido ya está pagado y no puede modificarse.');
        }

        // Validar transición de estado
        if (!$estadoActual->puedeCambiarA($nuevoEstado) && $estadoActual !== $nuevoEstado) {
            throw new \Exception("No se puede cambiar el estado de {$estadoActual->label()} a {$nuevoEstado->label()}.");
        }

        // Regla de negocio
        if ($nuevoEstado->requiereFechaFacturacion() && empty($data['fecha_facturacion'])) {
            throw new \Exception('Debe indicar la fecha de facturación cuando el pedido está facturado.');
        }

        if (!$nuevoEstado->requiereFechaFacturacion()) {
            $data['fecha_facturacion'] = null;
        }

        $pedido->update($data);

        if ($estadoActual !== $nuevoEstado) {
            $pedido->historialEstados()->create([
                'estado' => $nuevoEstado
            ]);
        }

        return $pedido;
    }
}