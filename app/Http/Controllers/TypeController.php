<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $type = Type::orderBy('id','asc')->get();
        return view('backend.type.index',[
            'type' => $type
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
        return view('backend.type.add');
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
        $new_type = new Type();
        $new_type->type_name = $request->type_name;
        $new_type->type_detail = $request->type_detail;
        $new_type->type_status = $request->type_status;
        $new_type->save();
        return redirect()->route('type.index')->with('feedback' ,'บันทึกข้อมูลเรียบร้อยแล้ว');
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
        $type = Type::find($id);
        return view('backend.type.edit')->with('type',$type);
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
        $type_edit = Type::find($id);
        $type_edit->type_name = $request->type_name;
        $type_edit->type_detail = $request->type_detail;
        $type_edit->type_status = $request->type_status;
        $type_edit->save();
        return redirect()->route('type.index')->with('feedback' ,'แก้ไขเรียบร้อยแล้ว');
        
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
