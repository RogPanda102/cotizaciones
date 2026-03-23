<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\EstadoPedido;

class StorePedidoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        $rules = [
            'requisicion_id' => 'required|exists:requisiciones,id',
            'dependencia_id' => 'required|exists:dependencias,id',
            'empresa_id' => 'required|exists:empresas,id',
            'cliente_id' => 'nullable|exists:clientes,id',
            'proveedor_id' => 'required|exists:proveedores,id',

            'monto_total_aprobado' => 'required|numeric|min:0',
            'fecha_adjudicacion' => 'required|date',
            'dias_entrega' => 'required|integer|min:1',
            'tipo_dias' => 'required|in:naturales,habiles',
            'dias_credito' => 'required|integer|min:0',

            'tipo' => 'required|in:servicio,licencia,mercadeo',

            'departamento_cliente' => 'required|string|max:255',
            'contacto_cliente' => 'nullable|string|max:255',
            'telefono_cliente' => 'nullable|string|max:50',
            'email_cliente' => 'nullable|email|max:255',
            'direccion_cliente' => 'nullable|string|max:255',
        ];

        // Reglas dinámicas
        if ($this->tipo === 'servicio') {
            $rules['descripcion_servicio'] = 'required|string';
            $rules['servicio_fecha_inicio'] = 'required|date';
            $rules['servicio_fecha_fin'] = 'required|date|after_or_equal:servicio_fecha_inicio';
        }

        if ($this->tipo === 'licencia') {
            $rules['nombre_licencia'] = 'required|string';
            $rules['licencia_fecha_inicio'] = 'required|date';
            $rules['licencia_fecha_fin'] = 'required|date|after_or_equal:licencia_fecha_inicio';
        }

        return $rules;

    }
}
