<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Traits\ApiReturnFormatTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $repo;

    public function __construct(ProductRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    use ApiReturnFormatTrait;

    public function index()
    {
        $data = $this->repo->all();

        return $this->responseWithSuccess('Product fetched successfully', $data, 200);
    }

    public function store(StoreProductRequest $request)
    {
        $data = $this->repo->store($request);


        return $this->responseWithSuccess('Product created successfully', $data, 201);
    }

    public function edit($id)
    {
        $data = $this->repo->edit($id);

        if ($data->image) {
            $data->image_url = url('uploads/products/' . $data->image);
        } else {
            $data->image_url = null;
        }

        return $this->responseWithSuccess('Product fetched successfully', $data, 200);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $this->repo->update($request, $id);

        return $this->responseWithSuccess('Product updated successfully', $data, 200);
    }

    public function destroy($id)
    {
        $this->repo->delete($id);

        return $this->responseWithSuccess('Product deleted successfully', [], 200);
    }
}
