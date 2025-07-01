<?php

namespace App\Services;
use Illuminate\Http\Request;

interface BranchService
{
    public function getAll(Request $request);
    public function findById($id, Request $request);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
