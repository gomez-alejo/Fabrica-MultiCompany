<?php

namespace App\Services\Impl;

use App\Models\InvoiceProduct;
use App\Services\InvoiceProductService;

class InvoiceServiceProductImpl implements InvoiceProductService
{
    public function all()
    {
        return InvoiceProduct::included()->filter()->get();
    }

    public function show($id)
    {
        return InvoiceProduct::with(['invoice', 'product', 'warehouse'])->find($id);
    }

    public function create(array $data)
    {
        return InvoiceProduct::create($data);
    }

    public function update($id, array $data)
    {
        $invoiceProduct = InvoiceProduct::find($id);
        if (!$invoiceProduct) {
            return null;
        }

        $invoiceProduct->update($data);
        return $invoiceProduct;
    }

    public function delete($id)
    {
        $invoiceProduct = InvoiceProduct::find($id);
        if (!$invoiceProduct) {
            return false;
        }

        return $invoiceProduct->delete();
    }
}

