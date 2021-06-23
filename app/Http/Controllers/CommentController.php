<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $product=Product::find($request->productId);
      $comments=$product->comments;
      foreach($comments as $comment){
        $comment->user=User::find($comment->user_id); 
      }
      $user=User::find($request->userId);
      return response()->json(['comments'=>$comments,'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $comment=new Comment;
      $comment->product_id=$request->productId;
      $comment->user_id=$request->userId;
      $comment->body=$request->body;
      $comment->save();
      $comment->user=User::find($request->userId);
      return response()->json(['comment'=>$comment]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $comment=Comment::find($request->commentId);
      $comment->body=$request->body;
      $comment->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $comment=Comment::find($request->commentId);
      $comment->delete();
    }
}
