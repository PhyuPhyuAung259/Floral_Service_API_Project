<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

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
        $product=Product::latest()->get();
        return ProductResource::collection($product);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name'=>'required',
            'product_detail'=>'required',
            'price'=>'required',
            'stock'=>'required',
            'event_id'=>'required',
            'category_id'=>'required',
            'images'=>'nullable|image|mimes:jpg,png,jpeg,svg'
        ]);
        $product=new Product();
        $product->name=$request->name;
        $product->product_detail=$request->product_detail;
        $product->price=$request->price;
        $product->stock=$request->stock;
        $product->event_id=$request->event_id;
        $product->category_id=$request->category_id;
        //$product->status=$request->status;
        $product->save();
        if($images=$request->images){
            foreach($images as $image){
                $product->addMedia($image)->toMediaCollection('images');
            }
        }

        return ResponseHelper::success($product,'Product is successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'product_detail'=>'required',
            'price'=>'required',
            'stock'=>'required',
            'event_id'=>'required',
            'category_id'=>'required',
            'images'=>'nullable|image|mimes:jpg,png,jpeg,svg'
        ]);
        $product=Product::find($id);
        $product->name=$request->name;
        $product->product_detail=$request->product_detail;
        $product->price=$request->price;
        $product->stock=$request->stock;
        $product->event_id=$request->event_id;
        $product->category_id=$request->category_id;
        //$product->status=$request->status;
        $product->save();
        if($images=$request->images){
            $product->clearMediaCollection('images');
            foreach($images as $image){
                $product->addMedia($image)->toMediaCollection('images');
            }
        }

        return ResponseHelper::success($product,'Product is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $product=Product::find($id);
      $product->delete();
      return ResponseHelper::success($product->id,"Successfully Deleted");
    }
}
