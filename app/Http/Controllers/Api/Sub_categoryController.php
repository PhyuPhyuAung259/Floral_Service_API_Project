<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Sub_Category;
use Illuminate\Http\Request;

class Sub_categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sub_category=Sub_Category::all();
        return ResponseHelper::success($sub_category,'Sub_Category List');
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
        $request->validate([
            'name'=>'required',
        ]);
        $sub_category=new Sub_Category();
        $sub_category->name=$request->name;
        $sub_category->description=$request->description;
        $sub_category->save();
        return ResponseHelper::success($sub_category->id,'New sub_category is successfully created');
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
        //
        $sub_category=Sub_Category::find($id);
        $sub_category->name=$request->name;
        $sub_category->description=$request->description;
        $sub_category->save();
        return ResponseHelper::success($sub_category->name,'This sub_category is successfully updated');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $sub_category=Sub_Category::find($id);
        $sub_category->delete();
        return ResponseHelper::success($sub_category->id,'This sub_category is successfully deleted');

    }
}
