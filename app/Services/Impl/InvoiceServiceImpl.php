<?php

namespace App\Services\Impl;

use App\Services\InvoiceService;
use App\Models\Invoice;

class InvoiceServiceImpl implements InvoiceService
{
    public function show($id)
    {
        return Invoice::with(['person', 'company', 'branch'])->find($id);
    }

    public function create(array $data)
    {
        return Invoice::create($data);
    }

    public function update($id, array $data)
    {
        $Invoice = Invoice::find($id);
        if (!$Invoice) {
            return null;
        }

        $Invoice->update($data);
        return $Invoice;
    }

    public function delete($id)
    {
        $Invoice = Invoice::find($id);
        if (!$Invoice) {
            return false;
        }

        $Invoice->delete();
        return true;
    }
}
