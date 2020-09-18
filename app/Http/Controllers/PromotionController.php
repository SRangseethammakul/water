<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Promotion;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $promotion = Promotion::with('product')->orderby('product_id','asc')->get();
        return view('backend.promotion.index',[
            'promotion' => $promotion
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $products = Product::get();
        return view('backend.promotion.add',[
            'products' => $products
        ]);
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
        $new_promotion = new Promotion();
        $new_promotion->promotion_name = $request->promotion_name;
        $new_promotion->promotion_detail = $request->promotion_detail;
        $new_promotion->promotion_status = $request->promotion_status;
        $new_promotion->promotion_price = $request->promotion_price;
        $new_promotion->product_id = $request->promotion_type;
        $new_promotion->save();
        if($request->hasFile('productimage')){
            $newFileName    =   uniqid().'.'.$request->productimage->extension();//gen name
            //upload file
            $request->productimage->storeAs('images',$newFileName,'public'); // upload file
            $new_product->product_image = $newFileName;
        }
        return redirect()->route('promotion.index')->with('feedback' ,'บันทึกข้อมูลเรียบร้อยแล้ว');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $products = Product::get();
        $promotion = Promotion::where('id',$id)->with('product')->first();
        return view('backend.promotion.edit',[
            'products' => $products,
            'promotion' => $promotion
        ]);
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
        $id = $request->id;
        $promotion_edit = Promotion::find($id);
        $promotion_edit->promotion_name = $request->promotion_name;
        $promotion_edit->promotion_detail = $request->promotion_detail;
        $promotion_edit->promotion_status = $request->promotion_status;
        $promotion_edit->promotion_price = $request->promotion_price;
        $promotion_edit->product_id = $request->promotion_type;
        $promotion_edit->save();
        return redirect()->route('promotion.index')->with('feedback' ,'แก้ไขข้อมูลเรียบร้อยแล้ว');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $type = Promotion::where('id', $id)->first();
        if($type){
            $type->delete();
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }
    public function updatePublish(Request $request){
        $id = $request->id;
        $verify = $request->verify;
        $model = Promotion::find($id);
        if($model){
            $model->promotion_status = $verify;
            $model->save();
            return response()->json(['status' => 1]);
        }
        else{
            return response()->json(['status' => 0]);
        }
    }
}
