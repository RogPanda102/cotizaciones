<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCotizacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $tipo = $this->input('tipo_cotizacion');

        $rules = [
            'empresa_id' => ['required', 'exists:empresas,id'],
            'tipo_cotizacion' => ['required', 'in:omg,dependencia_directa,cliente_externo'],
            'estado' => ['required', 'in:enviado,respaldo,no_cotiza'],

            'departamento_id' => ['nullable', 'exists:departamentos,id'],
            'dependencia_id' => ['nullable', 'exists:dependencias,id'],
            'analista_id' => ['nullable', 'exists:analistas,id'],

            'monto_total' => ['nullable', 'numeric'],
            'fecha_envio' => ['nullable', 'date'],
            'fecha_recepcion' => ['nullable', 'date'],

            'horario_de_entrega' => ['nullable', 'date_format:H:i'],
            'lugar_de_entrega' => ['nullable', 'string', 'max:255'],
        ];
        // OMG → todo obligatorio
        if ($tipo === 'omg') {
            $rules['analista_id'] = ['required', 'exists:analistas,id'];
            $rules['dias_credito'] = ['required', 'integer', 'min:0'];
            $rules['garantia'] = ['required', 'integer', 'min:0'];
            $rules['tipo_dias'] = ['required', 'in:naturales,habiles'];
        }

        // Dependencia directa → sin crédito/garantía/tipo_dias
        if ($tipo === 'dependencia_directa') {
            $rules['analista_id'] = ['required', 'exists:analistas,id'];
        }

        // Cliente externo → sin analista ni financieros
        if ($tipo === 'cliente_externo') {
            $rules['analista_id'] = ['nullable']; // explícito
        }

        return $rules;
    }
}
