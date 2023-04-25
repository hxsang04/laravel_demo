<?php

namespace App\Http\Services;

use App\Models\Product;

class ProductService
{
    public function all(){
        return Product::all();
    }
    
    public function store($request)
    {
        $data = $request->validated();
        $image = $request->file('image');
        $nameImage = $image->hashName();
        $image->storeAs('public/uploads/product', $nameImage);
        $data['image'] = 'storage/uploads/product/'. $nameImage;
        
        return Product::create($data);
    }

    public function update($request, $product)
    {
        $data = $request->validated();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $nameImage = $image->hashName();
            $image->storeAs('public/uploads/product', $nameImage);
            $data['image'] = 'storage/uploads/product/'. $nameImage;
        }

        if($product->update($data)){
            return true;
        };
        
    }
}