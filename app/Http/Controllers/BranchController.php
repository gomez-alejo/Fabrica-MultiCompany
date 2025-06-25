<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BranchController extends Controller
{

    public function index(Request $request)
    {
        $filters = $request->only(['name', 'company_id']);
        $branches = Branch::include(['company'])
            ->filter($filters)
            ->paginate(10);

        $data = [
            'branches' => $branches,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function show(Request $request, $id)
    {
        $includes = $request->input('include', ['company']); // Incluye 'company' por defecto

        $branch = Branch::query()
            ->include($includes)
            ->find($id);

        if (!$branch) {
            return response()->json([
                'message' => 'Branch not found',
                'status' => 404
            ], 404);
        }

        return response()->json([
            'branch' => $branch,
            'status' => 200
        ], 200);
    }

}
