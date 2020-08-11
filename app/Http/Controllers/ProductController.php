<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Type;
use Illuminate\Support\Facades\Storage;
use Image;

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
        $products = Product::with('type')->orderby('type_id','asc')->get();
        return view('backend.product.index',[
            'products' => $products
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
        $types = Type::get();
        return view('backend.product.add',[
            'types' => $types
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
        $new_product = new Product();
        $new_product->product_name = $request->product_name;
        $new_product->product_detail = $request->product_detail;
        $new_product->product_status = $request->product_status;
        $new_product->product_price = $request->product_price;
        $new_product->type_id = $request->product_type;
        if($request->hasFile('productimage')){
            $newFileName    =   uniqid().'.'.$request->productimage->extension();//gen name
            //upload file
            $request->productimage->storeAs('images/product',$newFileName,'public'); // upload file
            $new_product->product_image = $newFileName;
        }
        $new_product->save();
        return redirect()->route('product.index')->with('feedback' ,'บันทึกข้อมูลเรียบร้อยแล้ว');
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
        $types = Type::get();
        $product = Product::where('id',$id)->with('type')->first();
        return view('backend.product.edit',[
            'types' => $types,
            'product' => $product
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
        $product_edit = Product::find($id);
        $product_edit->product_name = $request->product_name;
        $product_edit->product_detail = $request->product_detail;
        $product_edit->product_status = $request->product_status;
        $product_edit->product_price = $request->product_price;
        $product_edit->type_id = $request->product_type;
        //ลบไฟล์เก่า แล้วอัพไฟล์ใหม่เข้าไป
        if($request->hasFile('productimage')){
            Storage::disk('public')->delete('images/product/'.$product_edit->product_image);
            $newFileName    =   uniqid().'.'.$request->productimage->extension();//gen name
            $request->productimage->storeAs('images/product',$newFileName,'public'); // upload file
            $product_edit->product_image = $newFileName;
        }
        $product_edit->save();
        return redirect()->route('product.index')->with('feedback' ,'แก้ไขข้อมูลเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $sub = Product::find($id);
        Storage::disk('public')->delete('images/product/'.$sub->product_image);
        $sub->delete();
        return redirect()->route('product.index')->with('feedback' ,'ลบข้อมูลเรียบร้อยแล้ว');
    }
}
