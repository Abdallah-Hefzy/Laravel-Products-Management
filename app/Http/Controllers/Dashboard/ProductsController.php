<?php

namespace App\Http\Controllers\Dashboard;

use App\Events\ProductChanged;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Scopes\ActiveScope;
use App\Models\User;
use App\Notifications\NewProductNotification;
use App\Services\ProductService;
use App\traits\media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    use media;

    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Product::with(['category', 'subcategory', 'brand']);
        
        if (auth()->user()->isAdmin()) {
            $products = $query->withoutGlobalScope(ActiveScope::class)->paginate(3);
        } else {
            $products = $query->paginate(3);
        }
        return view('backend.products.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(ProductService $service)
    {
        $product = new Product();
        return view('backend.products.create', array_merge(['product' => $product], $service->getFormData()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        $data = $request->except(['_token', 'image']);
        $data['user_id'] = Auth::id();
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadImage($request->image, 'dist/img/products/');
        }

        $product = Product::create($data);

        event(new ProductChanged($product,'created',Auth::user()));

        return redirect()->route('products.index')->with('success', 'Product Has Been Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category', 'subcategory', 'brand']);
        return view('backend.products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, ProductService $service)
    {

        return view('backend.products.edit', array_merge(
            ['product' => $product],
            $service->getFormData()
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
       
        $data = $request->except(['_token', '_method', 'image']);
        if ($request->hasFile('image')) {
            $this->deleteImage($product->image, 'dist/img/products/');

            $data['image'] = $this->uploadImage($request->image, 'dist/img/products/');
        }
        $product->update($data);
        event(new ProductChanged($product, 'updated',Auth::user()));
        return redirect()->route('products.index')->with('success', 'Product Has Been Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {

        $product->delete();
        event(new ProductChanged($product, 'deleted',Auth::user()));
        return redirect()->route('products.index')->with('success', 'Product Has Been Deleted Successfully!');
    }

    public function trash()
    {

        $this->authorize('trash', Product::class);
        $products = Product::onlyTrashed()->with(['category', 'subcategory', 'brand'])->get();
        return view('backend.products.trash', compact('products'));
    }
    public function restore(string $slug)
    {
        $product = Product::onlyTrashed()->where('slug', $slug)->firstOrFail();
        $this->authorize('restore', $product);
        $product->restore();
        event(new ProductChanged($product, 'restored',Auth::user()));

        return redirect()->route('products.index')->with('success', 'Product Restored successfully!');
    }

    public function forceDelete(string $slug)
    {

        $product = Product::onlyTrashed()->where('slug', $slug)->firstOrFail();
        $this->authorize('forceDelete', $product);
        $this->deleteImage($product->image, 'dist/img/products/');
        $product->forceDelete();

        return redirect()->route('products.index')->with('success', 'Product Deleted Forever!');
    }

    public function search(Request $request)
    {
        $this->authorize('search', Product::class);
        $search = $request->search;
        $products = Product::with(['category', 'subcategory', 'brand'])->search($search)->paginate(3);
        return view('backend.products.index', compact('products', 'search'));
    }
}
