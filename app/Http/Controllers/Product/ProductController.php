<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $repo;

    public function __construct(ProductRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return response()->json(['data' => $this->repo->all()]);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $this->repo->store($request);
        

        return response()->json([
            'message' => 'Product created successfully',
            'data'    => $data
        ], 201);
    }
    
    public function edit($id)
    {
        $data = $this->repo->edit($id);
        

        return response()->json([
            'message' => 'Product created successfully',
            'data'    => $data
        ], 201);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $this->repo->update($request, $id);
        

        return response()->json([
            'message' => 'Product updated successfully',
            'data'    => $data
        ], 201);
    }
}
