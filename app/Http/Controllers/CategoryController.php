<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Models\LocationCategory;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'success', 'data' => CategoryRepository::getAll()], 200);
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = CategoryRepository::createCategory($request->validated());
        return response()->json(['status' => 'success', 'data' => $data], 200);
    }
}
