<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
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
        $promotion = Promotion::with('type')->orderby('type_id','asc')->get();
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
        $types = Type::get();
        return view('backend.promotion.add',[
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
        $new_promotion = new Promotion();
        $new_promotion->promotion_name = $request->promotion_name;
        $new_promotion->promotion_detail = $request->promotion_detail;
        $new_promotion->promotion_status = $request->promotion_status;
        $new_promotion->promotion_price = $request->promotion_price;
        $new_promotion->type_id = $request->promotion_type;
        $new_promotion->save();
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
        $types = Type::get();
        $promotion = Promotion::where('id',$id)->with('type')->first();
        return view('backend.promotion.edit',[
            'types' => $types,
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
        $promotion_edit->type_id = $request->promotion_type;
        $promotion_edit->save();
        return redirect()->route('promotion.index')->with('feedback' ,'แก้ไขข้อมูลเรียบร้อยแล้ว');


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
    }
}
