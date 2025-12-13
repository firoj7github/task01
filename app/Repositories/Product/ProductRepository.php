<?php

namespace App\Repositories\Product;

use App\Helpers\ImageHelper;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::orderBy('id', 'desc')->get();
    }

    public function store($request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $validated['image'] = ImageHelper::upload($request->file('image'),'products' );
        }

        return Product::create($validated);
    }

    public function edit($id)
    {
        return Product::findOrFail($id);
    }

    public function update($request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validated();

        if ($request->hasFile('image')) {

            if ($product->image) {
                ImageHelper::delete($product->image, 'products');
            }

            $validated['image'] = ImageHelper::upload($request->file('image'), 'products');
        }

        $product->update($validated);

        return $product;
    }

    public function delete($id)
    {

        $product = Product::findOrFail($id);

        if (!empty($product->image)) {
            ImageHelper::delete($product->image, 'products');
        }

        $product->delete();
    }
}
