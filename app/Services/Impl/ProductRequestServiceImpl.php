<?php

namespace App\Services\Impl;

use App\Models\ProductRequest;
use App\Services\ProductRequestService;

class ProductRequestServiceImpl implements ProductRequestService
{
    public function all()
    {
        return ProductRequest::included()->filter()->get();
    }

    public function show($id)
    {
        return ProductRequest::with(['requestt', 'product', 'warehouse'])->find($id);
    }

    public function create(array $data)
    {
        return ProductRequest::create($data);
    }

    public function update($id, array $data)
    {
        $productRequest = ProductRequest::find($id);
        if (!$productRequest) {
            return null;
        }

        $productRequest->update($data);
        return $productRequest;
    }

    public function delete($id)
    {
        $productRequest = ProductRequest::find($id);
        if (!$productRequest) {
            return false;
        }

        return $productRequest->delete();
    }
}
