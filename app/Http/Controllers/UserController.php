<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserController extends Controller
{
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
  public function unreadNotification(Request $request)
  {
   $user=User::find($request->userId);
   $user->notifications($request->notificationId)->markAsRead;
  }
}
