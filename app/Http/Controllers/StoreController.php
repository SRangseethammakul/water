<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\Promotion;
use App\StoreType;
use Illuminate\Support\Facades\Storage;
use Image;
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
        $store = Store::with('store_type')->get();
        return view('backend.store.index',[
            'store' => $store
        ]);
    }

    public function staff_index()
    {
        //
        $store = Store::with('store_type')->where('create_by_id',auth()->user()->id)->get();
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
        $promotions = Promotion::where('promotion_status',1);
        $store_types = StoreType::get();
        return view('backend.store.add',[
            'promotions' => $promotions,
            'store_types' => $store_types
        ]);
    }

    public function staff_create()
    {
        //
        $promotions = Promotion::where('promotion_status',1);
        $store_types = StoreType::get();
        return view('backend.store.staff_add',[
            'promotions' => $promotions,
            'store_types' => $store_types
        ]);
    }

    public function store_staff_add(Request $request)
    {
        //
        // dd($request->all());
        try{
            $check_tel = Store::where('store_tel',$request->store_tel)->get();
            if($check_tel->count() > 0){
                return redirect()->route('store.index')->with('unsuccess' ,'ไม่สามรถเพิ่มข้อมูลได้ เบอร์ช้ำ');
            }
            else{
                $new_store = new Store();
                $new_store->store_name = $request->store_name;
                $new_store->store_tel  = $request->store_tel;
                $new_store->store_type_id  = $request->store_type;
                $new_store->store_lineid  = $request->store_line;
                $new_store->store_contact  = $request->store_contact;
                $new_store->store_address = $request->store_address;
                $new_store->store_detail = $request->store_detail;
                $new_store->store_status = $request->store_status;
                $new_store->store_tax_contact = $request->store_tax_contact;
                $new_store->store_tax_name = $request->store_tax_name;
                $new_store->store_tax_id = $request->store_tax_id;
                $new_store->store_lat = $request->store_lat;
                $new_store->store_lng = $request->store_lng;
                $new_store->create_by = auth()->user()->name;
                $new_store->create_by_id = auth()->user()->id;
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
                if($request->hasFile('storeimage')){
                    $newFileName    =   uniqid().'.'.$request->storeimage->extension();//gen name
                    //upload file
                    $request->storeimage->storeAs('images/store',$newFileName,'public'); // upload file
                    $new_store->store_image = $newFileName;
                }
                if($request->hasFile('storeimageline')){
                    $newFileName    =   uniqid().'.'.$request->storeimageline->extension();//gen name
                    //upload file
                    $request->storeimageline->storeAs('images/store',$newFileName,'public'); // upload file
                    $new_store->store_lineid_image = $newFileName;
                }
                if($request->hasFile('storeimagetax')){
                    $newFileName    =   uniqid().'.'.$request->storeimagetax->extension();//gen name
                    //upload file
                    $request->storeimagetax->storeAs('images/store',$newFileName,'public'); // upload file
                    $new_store->store_tax_image = $newFileName;
                }
                $new_store->save();
                return redirect()->route('store.staff_index')->with('feedback' ,'บันทึกข้อมูลเรียบร้อยแล้ว');
            }
        }catch(Exception $e){
            return redirect()->route('store.staff_index')->with('unsuccess' ,'ไม่สามรถเพิ่มข้อมูลได้');
        }
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
        try{
            $check_tel = Store::where('store_tel',$request->store_tel)->get();
            if($check_tel->count() > 0){
                return redirect()->route('store.index')->with('unsuccess' ,'ไม่สามรถเพิ่มข้อมูลได้ เบอร์ช้ำ');
            }
            else{
                $new_store = new Store();
                $new_store->store_name = $request->store_name;
                $new_store->store_tel  = $request->store_tel;
                $new_store->store_type_id  = $request->store_type;
                $new_store->store_lineid  = $request->store_line;
                $new_store->store_contact  = $request->store_contact;
                $new_store->store_address = $request->store_address;
                $new_store->store_detail = $request->store_detail;
                $new_store->store_status = $request->store_status;
                $new_store->store_tax_contact = $request->store_tax_contact;
                $new_store->store_tax_name = $request->store_tax_name;
                $new_store->store_tax_id = $request->store_tax_id;
                $new_store->confirm = 1;
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
                if($request->hasFile('storeimage')){
                    $newFileName    =   uniqid().'.'.$request->storeimage->extension();//gen name
                    $imageStore = $request->file('storeimage');
                    $t = Storage::disk('do_spaces')->put('stores/'.$newFileName, file_get_contents($imageStore));
                    $new_store->store_image = $newFileName;
                }
                if($request->hasFile('storeimageline')){
                    $newFileName    =   uniqid().'.'.$request->storeimageline->extension();//gen name
                    $imageStoreLine = $request->file('storeimageline');
                    $t = Storage::disk('do_spaces')->put('stores/'.$newFileName, file_get_contents($imageStoreLine));
                    $new_store->store_lineid_image = $newFileName;
                }
                if($request->hasFile('storeimagetax')){
                    $newFileName    =   uniqid().'.'.$request->storeimagetax->extension();//gen name
                    $imageStoreTax = $request->file('storeimagetax');
                    $t = Storage::disk('do_spaces')->put('stores/'.$newFileName, file_get_contents($imageStoreTax));
                    $new_store->store_tax_image = $newFileName;
                }
                $new_store->save();
                return redirect()->route('store.index')->with('feedback' ,'บันทึกข้อมูลเรียบร้อยแล้ว');
            }
        }catch(Exception $e){
            return redirect()->route('store.index')->with('unsuccess' ,'ไม่สามรถเพิ่มข้อมูลได้');
        }
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
            $store = Store::where('id',$id)->with('store_type')->first();
            $promotions = Promotion::get();
            $store_types = StoreType::get();
            $store_promotion = explode(",",$store->store_promotion);
            return view('backend.store.edit',[
                'store' => $store,
                'store_promotion' => $store_promotion,
                'promotions' => $promotions,
                'store_types' => $store_types
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
        $store_edit->store_type_id  = $request->store_type;
        $store_edit->store_lineid  = $request->store_line;
        $store_edit->store_contact  = $request->store_contact;
        $store_edit->store_address = $request->store_address;
        $store_edit->store_detail = $request->store_detail;
        $store_edit->store_status = $request->store_status;
        $store_edit->store_tax_contact = $request->store_tax_contact;
        $store_edit->store_tax_name = $request->store_tax_name;
        $store_edit->store_tax_id = $request->store_tax_id;
        $store_edit->confirm = $request->confirm;
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


        if($request->hasFile('storeimage')){
            Storage::disk('do_spaces')->delete('stores/'.$store_edit->store_image); 
            $newFileName    =   uniqid().'.'.$request->storeimage->extension();//gen name
            $imageStore = $request->file('storeimage');
            $t = Storage::disk('do_spaces')->put('stores/'.$newFileName, file_get_contents($imageStore));
            $store_edit->store_image = $newFileName;
        }
        if($request->hasFile('storeimageline')){
            Storage::disk('do_spaces')->delete('stores/'.$store_edit->store_lineid_image);
            $newFileName    =   uniqid().'.'.$request->storeimageline->extension();//gen name
            $imageStoreLine = $request->file('storeimageline');
            $t = Storage::disk('do_spaces')->put('stores/'.$newFileName, file_get_contents($imageStoreLine));
            $store_edit->store_lineid_image = $newFileName;
        }
        if($request->hasFile('storeimagetax')){
            Storage::disk('do_spaces')->delete('stores/'.$store_edit->store_tax_image);
            $newFileName    =   uniqid().'.'.$request->storeimagetax->extension();//gen name
            $imageStoreTax = $request->file('storeimagetax');
            $t = Storage::disk('do_spaces')->put('stores/'.$newFileName, file_get_contents($imageStoreTax));
            $store_edit->store_tax_image = $newFileName;
        }
        $store_edit->save();
        return redirect()->route('store.index')->with('feedback' ,'แก้ไขข้อมูลเรียบร้อยแล้ว');
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
        $store = Store::find($id);
        if($store){
            Storage::disk('public')->delete('images/store/'.$store->store_image);
            $store->delete();
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }

    public function updatePublish(Request $request){
        $id = $request->id;
        $verify = $request->verify;
        $store = Store::find($id);
        if($store){
            $store->store_status = $verify;
            $store->save();
            return response()->json(['status' => 1]);
        }
        else{
            return response()->json(['status' => 0]);
        }
    }

    public function testAPI(Request $request){
        $stores = Store::where('store_status',1)->where('confirm',1)->orderby('id', 'desc')->get();
        $data_stores = [];
        foreach($stores as $store){
            $data_stores[] = [
                'img' =>  Storage::disk('do_spaces')->temporaryUrl('stores/'.$store->store_image, now()->addMinutes(5)),
                'line' =>  Storage::disk('do_spaces')->temporaryUrl('stores/'.$store->store_lineid_image, now()->addMinutes(5)),
                'tax' =>  Storage::disk('do_spaces')->temporaryUrl('stores/'.$store->store_tax_image, now()->addMinutes(5))
            ];
        }
        return response()->json(['status' => 1,'data' => $data_stores],200);
    }
}
