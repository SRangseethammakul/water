<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Promotion;
class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $store = Store::get();
        return view('backend.store.index',[
            'store' => $store
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
        $promotions = Promotion::get();
        return view('backend.store.add',[
            'promotions' => $promotions
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
        // dd($request->all());
        $new_store = new Store();
        $new_store->store_name = $request->store_name;
        $new_store->store_tel  = $request->store_tel;
        $new_store->store_contact  = $request->store_contact;
        $new_store->store_address = $request->store_address;
        $new_store->store_detail = $request->store_detail;
        $new_store->store_name = $request->store_status;
        $new_store->store_tax_contact = $request->store_tax_contact;
        $new_store->store_tax_name = $request->store_tax_name;
        $new_store->store_tax_id = $request->store_tax_id;
        $tmp = '';
        if($request->check_list){
            foreach($request->check_list as $key =>  $item){
                if($key == 0){
                    $tmp = $item;
                }
                else{
                    $tmp = $item.','.$tmp;
                }         
            }
        }
        $new_store->store_promotion = $tmp;
        $new_store->store_status = $request->store_status;
        $new_store->save();
        return redirect()->route('store.index')->with('feedback' ,'บันทึกข้อมูลเรียบร้อยแล้ว');
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
        try{
            $store = Store::where('id',$id)->first();
            $promotions = Promotion::get();
            $store_promotion = explode(",",$store->store_promotion);
            return view('backend.store.edit',[
                'store' => $store,
                'store_promotion' => $store_promotion,
                'promotions' => $promotions
            ]);

        }catch(Exception $e){

        }
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
        $store_edit = Store::find($id);
        $store_edit->store_name = $request->store_name;
        $store_edit->store_tel  = $request->store_tel;
        $store_edit->store_contact  = $request->store_contact;
        $store_edit->store_address = $request->store_address;
        $store_edit->store_detail = $request->store_detail;
        $store_edit->store_status = $request->store_status;
        $store_edit->store_tax_contact = $request->store_tax_contact;
        $store_edit->store_tax_name = $request->store_tax_name;
        $store_edit->store_tax_id = $request->store_tax_id;
        $tmp = '';
        if($request->check_list){
            foreach($request->check_list as $key =>  $item){
                if($key == 0){
                    $tmp = $item;
                }
                else{
                    $tmp = $item.','.$tmp;
                }         
            }
        }
        $store_edit->store_promotion = $tmp;
        $store_edit->store_status = $request->store_status;
        $store_edit->save();
        return redirect()->route('store.index')->with('feedback' ,'แก้ไขข้อมูลเรียบร้อยแล้ว');
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
