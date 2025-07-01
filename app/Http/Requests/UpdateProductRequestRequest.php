<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'request_id' => 'sometimes|exists:requests,id',
            'product_id' => 'sometimes|exists:products,id',
            'warehouse_id' => 'sometimes|exists:warehouses,id',
            'iva' => 'sometimes|numeric',
            'quantity' => 'sometimes|numeric',
            'unit_cost' => 'sometimes|numeric',
        ];
    }
}
