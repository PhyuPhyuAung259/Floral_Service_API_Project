<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    //
    public function checkout(Request $request){
       $order=new Order();
     // $order->user_id= auth()->user();
        $order->user_id=$request->user_id;
        $order->order_date=$request->order_date;
        $order->delivery_address=$request->delivery_address;
        $order->delivery_fees=$request->delivery_fees;
        $order->grand_total=$request->grand_total;
        $order->save();
        if($request->has('product')){
            $product=$request->product;
           
            foreach ($product as $order_details) {
                // Use a different variable name to avoid overwriting the outer $order_details
                $orderDetail = new OrderDetails();
                $orderDetail->product_id = $order_details['id']; // Access array elements using []
                $orderDetail->price = $order_details['price'];
                $orderDetail->quantity = $order_details['quantity'];
                $orderDetail->sub_amount = $order_details['sub_amount'];
                $orderDetail->order_id = $order->id;
                $orderDetail->save();
        
                // Corrected stock calculation
                $stock = Product::where('id', $order_details['id'])->first();
                $sub_stock = $stock->stock - $order_details['quantity'];
        
                // Update product stock
                $product = Product::find($order_details['id']);
                $product->stock = $sub_stock;
                $product->save();
                
            }
        }
         return ResponseHelper::success($order,'You have been ordered. Please wait for a while to confirm email.');   
    }
}
