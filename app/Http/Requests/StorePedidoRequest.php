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
        $tipo = $this->input('tipo');
        $rules = [
            'requisicion_id' => 'required|exists:requisiciones,id',
            'dependencia_id' => 'required|exists:dependencias,id',
            'empresa_id' => 'required|exists:empresas,id',
            'cliente_id' => 'required|exists:clientes,id',
            'proveedor_id' => 'nullable|exists:proveedores,id',

            'monto_total_aprobado' => 'required|numeric|min:0',
            'fecha_adjudicacion' => 'required|date',
            'dias_entrega' => 'required|integer|min:1',
            'tipo_dias' => 'required|in:naturales,habiles',
            'dias_credito' => 'required|integer|min:0',

            'tipo' => 'required|in:servicio,licencia,mercadeo',

            //'telefono_cliente' => 'nullable|string|max:50',
            //'email_cliente' => 'nullable|email|max:255',
            //'direccion_cliente' => 'nullable|string|max:255',
        ];

        // Reglas dinámicas
        if ($tipo === 'licencia') {
            $rules = array_merge($rules, [
                'nombre_licencia' => 'required|string|max:255',
                'tipo_licencia' => 'nullable|string|max:100',
                'numero_usuarios' => 'nullable|integer|min:1',
                'costo_licencia' => 'required|numeric|min:0',
                'costo_renovacion' => 'nullable|numeric|min:0',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            ]);
        }

        if ($tipo === 'servicio') {
            $rules = array_merge($rules, [
                'descripcion_servicio' => 'required|string',
                'alcance' => 'nullable|string',
                'responsable' => 'nullable|string|max:255',
                'entregables' => 'nullable|string',
                'costo_servicio' => 'required|numeric|min:0',
                'observaciones' => 'nullable|string',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            ]);
        }

        return $rules;

    }
}
