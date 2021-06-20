<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Notifications\NewProductNotification;
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
      $products=Product::all();
      return response()->json(['products'=>$products]);
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
        $product->price=$request->price;
        $product->user_id=$request->userId;
        $product->description=$request->description;
        $product->category_id=$request->categoryId;
        $product->category_id=$request->userId;
        $product->save();
        $product->cover=$product->id.'.'.$request->photo->extension();
        $product->save();
        $request->photo->storeAs('products',$product->cover,'public');
        //$notifiedUsers=User::where('selectedCategories')->get();
        //$notifiedUsers->notify(new NewProductNotification($product));
        return redirect()->route('home'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
      $recommendedProducts=Product::where('category',$product->category)->take(10);
      return view('product.show',['product'=>$product,'similarProducts'=>$recommendedProducts]);
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
      $product->delete();
    }
    public function search(Request $request)
    {
      $category_id=$request->category;
      $searchQuery=$request->searchQuery;
      if($category_id=='all'){
        $products=Product::where('name','like',"${searchQuery}")->get();  
      }
      else{
        $products=Product::where([['category_id',$category_id],['name','like',"${searchQuery}"]])->get();  
      }
      $categoryName=Category::find($category_id)?? "all"; 
      return view('product.search',['products'=>$products,'searchQuery'=>$searchQuery,'categoryName'=>$categoryName]);
    }
    public function getAddToCart()
    {

    }
    public function postAddToCart()
    {
        
    }
}
