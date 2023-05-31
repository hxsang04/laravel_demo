<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Services\ProductService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderByDesc('id')->get();

        return view('admin.product.view', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $image = $request->file('image');
        $nameImage = $image->hashName();
        $image->storeAs('public/uploads/product', $nameImage);
        $data['image'] = 'storage/uploads/product/'. $nameImage;
        
        $product = Product::create($data);
        return redirect()->route('product.show',$product->id);
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $nameImage = $image->hashName();
            $image->storeAs('public/uploads/product', $nameImage);
            $data['image'] = 'storage/uploads/product/'. $nameImage;
        }

        $product->update($data);
        return redirect()->route('product.show',$product->id);
        
            
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success','Successful delete!');
    }

    public function trash(){
        $products = Product::onlyTrashed()->get();
        return view('admin.product.trash', compact('products'));
    }

    public function restore($id){
        $product = Product::withTrashed()->findOrFail($id);
        if(!empty($product)){
            $product->restore();
            return back()->with('success', 'Successful restore!');
        }
        
    }

    public function remove($id){
        $product = Product::withTrashed()->findOrFail($id);
        if(!empty($product)){
            $product->forceDelete();
            return back()->with('success', 'Successful remove!');
        }
    }
}
