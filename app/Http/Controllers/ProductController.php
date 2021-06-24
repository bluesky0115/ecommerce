<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ProductFormRequest;
use App\Models\Cart;
use App\Notifications\NewProductNotification;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

      $this->middleware('auth');
      
    }

    public function index()
    {
      $products=Product::all();
      foreach($products as $product){
        $product->totalComments=$product->comments->count();
      }
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
        $product->save();
        $product->cover=$product->id.'.'.$request->photo->extension();
        $product->save();
        $request->photo->storeAs('products',$product->cover,'public');
        $category=Category::find($request->categoryId);
        $notifiedUsers=$category->users;
        foreach($notifiedUsers as $user){
          $user->notify(new NewProductNotification($product));
        }
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
      $category=$product->category;
      $recommendedProducts=$category->products()->latest()->take(20)->get();
      return view('product.show',['product'=>$product,'recommendedProducts'=>$recommendedProducts]);
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
      // $category_id=$request->category;
      // $searchQuery=$request->searchQuery; 
      // if($category_id=='all'){
      //   $products=Product::where('name','like',"%${searchQuery}%")->get(); 
      // }
      // else{
      //   $products=Product::where([['category_id',$category_id],['name','like',"%${searchQuery}%"]])->get();  
      // }
      // $categoryName=Category::find($category_id)->name ?? 'product';
      // return view('product.search',['products'=>$products,'searchQuery'=>$searchQuery,'categoryName'=>$categoryName]);
      return redirect()->route('product.create');
    }
    public function addToCart(Request $request)
    {
      $user=User::find($request->userId);
      $product=Product::find($request->productId);
      $cart=$user->cart;
      if($cart){
        $cart->products()->attach($product);
      }
      else{
        $cart=new Cart;
        $cart->user=$user;
        $cart->products()->attach($product);
      }
    }
    public function removeFromCart(Request $request)
    {
      $user=User::find($request->userId);
      $product=Product::find($request->productId);
      $cart=$user->cart;
      $cart->detach($product);
    }
    public function data(Request $request)
    {
      $product=Product::find($request->productId);
      return response()->json(['product'=>$product]); 
    }
}
