<?php

namespace App\Http\Controllers\Apis\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Services\ProductService;
use App\traits\ApiTrait;
use App\traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    use ApiTrait, media;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'subcategory', 'brand'])->paginate(15);

        return $this->data(compact('products'));
    }

    public function create(ProductService $service)
    {

        return $this->data($service->getFormData());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        $request->merge([
            'slug' => Str::slug($request->name)
        ]);
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->image, 'dist/img/products/');
        }
        Product::create($data);
        return $this->successMessage('products Created Successfully!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(string $slug, ProductService $service)
    {

        $product = Product::where('slug', $slug)->first();
        $relations = $service->getFormData();

        if ($product && $relations) {
            return $this->data(array_merge(['product' => $product], ['relations' => $relations]));
        } else {
            return $this->errorMessage([], 'this products is not found');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $request->merge([
                'slug' => Str::slug($request->name)
            ]);

            $data = $request->except(['_method', 'image']);

            if ($request->hasFile('image')) {

                $this->deleteImage($product->image, 'dist/img/products/');

                $data['image'] = $this->uploadImage($request->image, 'dist/img/products/');
            }
            $product->update($data);
            return $this->successMessage('Product Update Successfully!');
        } else {
            return $this->errorMessage([], 'this products is not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $product->delete();

            return $this->successMessage('Product Deleted Successfully!');
        } else {
            return $this->errorMessage([], 'this products is not found');
        }
    }

    public function trash()
    {

        $products = Product::onlyTrashed()->with(['category', 'subcategory', 'brand'])->get();
        return $this->data(compact('products'));
    }

    public function restore(string $slug)
    {

        $product = Product::onlyTrashed()->where('slug', $slug)->first();
        if ($product) {
            $product->restore();
            return $this->successMessage('Product Restored Successfully');
        } else {
            return $this->errorMessage([], 'this products is not found');
        }
    }
    public function forceDelete(string $slug)
    {

        $product = Product::onlyTrashed()->where('slug', $slug)->first();
        if ($product) {
            $this->deleteImage($product->image, 'dist/img/products/');
            $product->forceDelete();
            return $this->successMessage('Product Deleted Forever !');
        } else {
            return $this->errorMessage([], 'this products is not found');
        }
    }

}
