<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        $product=new Product;
        $product->name=$request->name;
        $product->cost=$request->cost;
        $product->user_id=$request->userId;
        $product->description=$request->description;
        $product->save();
        $product->cover=$product->id.'.'.$request->photo->extension();
        $request->photo->saveAs('product',$product->cover,'public');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $similarProducts=Product::where('category',$product->category)->take(10);
        return view('product.show',['product'=>$product,'similarProducts'=>$similarProducts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $this->authorize('update',$product);
        return view('product.edit',['product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request)
    {
        $product=Product::findOrFail($request->id);
        $product->name=$request->name;
        if($request->has('photo')){
            Storage::delete('productCover/'.$product->cover);
            $product->cover=$product->id.'.'.$request->cover->extension();
            $request->cover->storeAs('productCover',$product->cover,'public');
        }
        $product->price=$request->price;
        $product->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function getAddToCart()
    {

    }
    public function postAddToCart()
    {
        
    }
}
