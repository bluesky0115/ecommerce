<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use stdClass;

class UserController extends Controller
{
  public function __construct(){

    $this->middleware('auth');

  }

  public function navigation(Request $request)
  {
    $categories=Category::all();
    if($request->userId){
      $user=User::find($request->userId);
      $notifications=$user->unreadNotifications;
    }
    else{
      $user=null;
      $notifications=[];
    }
    return response()->json(['user'=>$user,'categories'=>$categories,'notifications'=>$notifications]);
  }

  public function notifications(Request $request)
  {
    $user=User::find($request->userId);
    $notifications=$user->notifications;
    return response()->json(['notifications'=>$notifications]);
  }

  public function report(Request $request)
  {
   DB::table('reports')->insert(['user_id'=>$request->userId,'product_id'=>$request->productId,'reportText'=>$request->reportText]);
   return response()->json(['message'=>'report was succesfull']);
  }

  public function readNotification(Request $request)
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
