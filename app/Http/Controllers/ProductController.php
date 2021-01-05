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
        $products = Product::with('type')->orderby('sort_order','asc')->get();
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
        $newFileName = null;
        if($request->hasFile('productimage')){
            $newFileName    =   uniqid().'.'.$request->productimage->extension();//gen name
            // $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $image = $request->file('productimage');
            $t = Storage::disk('do_spaces')->put('products/'.$newFileName, file_get_contents($image), 'public');
            dd($t);
        }
        $new_product->product_image = $newFileName;
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
            Storage::disk('do_spaces')->delete('products/'.$product_edit->product_image);
            $newFileName    =   uniqid().'.'.$request->productimage->extension();//gen name
            $image = $request->file('productimage');
            $t = Storage::disk('do_spaces')->put('products/'.$newFileName, file_get_contents($image), 'public');
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
    public function destroy(Request $request)
    {
        $id = $request->id;
        $product_edit = Product::where('id',$id)->first();
        if($product_edit){
            Storage::disk('do_spaces')->delete('products/'.$product_edit->product_image);
            $product_edit->delete();
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function updateSequence(Request $request)
    {
        try {
            foreach ($request->sequence as $key => $val) {
                $product_edit = Product::find($key);
                $product_edit->sort_order = $val;
                $product_edit->save();
            }
            return response()->json(['status' => 1]);
        } catch (Exception $e) {
            return response()->json(['status' => 0]);
        }
    }
    public function updatePublish(Request $request){
        $id = $request->id;
        $verify = $request->verify;
        $model = Product::find($id);
        if($model){
            $model->product_status = $verify;
            $model->save();
            return response()->json(['status' => 1]);
        }
        else{
            return response()->json(['status' => 0]);
        }
    }
}
