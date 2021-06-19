<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use stdClass;

class UserController extends Controller
{
  public function cartItems(Request $request)
  {
    $user=User::find($request->userId);
    $cartItems=$user->cart->products;
    return response()->json(['cartItems'=>$cartItems]);
  }
  public function notifications(Request $request)
  {
    $user=User::find($request->userId);
    $notifications=$user->unreadNotifications;
    return response()->json(['notfications'=>$notifications]);
  }
  public function report(Request $request)
  {
   DB::table('reports')->insert(['user_id'=>$request->userId,'product_id'=>$request->productId,'reportText'=>$request->reportText]);
   return response()->json(['message'=>'report was succesfull']);
  }
  public function notificationForm(Request $request)
  {
    $selectedCategories=$request->selectedCategories;
    $user=User::find($request->userId);
    $user->categories=$selectedCategories;
  }
  public function unreadNotification(Request $request)
  {
   $user=User::find($request->userId);
   $user->notifications($request->notificationId)->markAsRead;
  }
  public function reports()
  {
    $reportedData=DB::table('reports')->latest();
    $reports=array();
    foreach ($reportedData as $data)
     {
      $report=new stdClass;
      $report->id=$data->id;
      $report->date=$data->created_at;  
      $report->product=Product::find($data->product_id);
      $report->user=User::find($data->user_id);
      array_push($reports,$report);
    }
    return view('reports',['reports'=>$reports]);  
  }
  public function removeReport($id)
  {
   DB::table('reports')->where('id',$id)->delete();
   return redirect()->back()->with(['reportMessage'=>'report removed successfully']);
  }
}
