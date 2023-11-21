<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public function order_list(){
        $order_list = Order::with('orderDetails')->get();
        return ResponseHelper::success(['orders' => $order_list],'Order List');
    }

    public function order_check($id,$type){
        if($type=="check"){
        $order=Order::find($id);
        $order->status="processing";
        $order->save();
        $order_detail=OrderDetails::where('order_id',$id)->first();
        $user=User::find($order->user_id);
        return ResponseHelper::success(['order'=>$order,'order_details'=>$order_detail,'user_info'=>$user],'successfully');
        }
        elseif($type=="confirm"){
            $order=Order::find($id);
            $order->status='confirmed';
            $order->save();
            return ResponseHelper::success($id,"the order is confirmed");
        }
        else {
            $order=Order::find($id);
            $order->status=$type;
            $order->save();
            return ResponseHelper::fail("the order_no ".$id." is ". $type);
        }
    }
}
