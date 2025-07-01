<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_id' => 'sometimes|integer|exists:invoices,id',
            'product_id' => 'sometimes|integer|exists:products,id',
            'warehouse_id' => 'sometimes|integer|exists:warehouses,id',
            'iva' => 'sometimes|numeric',
            'quantity' => 'sometimes|numeric',
            'unit_cost' => 'sometimes|numeric',
        ];
    }
}
