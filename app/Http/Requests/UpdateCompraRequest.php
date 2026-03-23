<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompraRequest extends FormRequest
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
        return [
            'proveedor' => 'required|string|max:255',
            'fecha' => 'required|date',
            'cantidad' => 'required|numeric|min:1',
            'unidad' => 'required|string|max:50',
            'descripcion' => 'required|string|max:1000',
            'monto' => 'required|numeric|min:0',
        ];
    }
}
