<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Store;
use App\Promotion;
use App\StoreType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Image;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $store = Store::with('store_type')->where('create_by_id',auth()->user()->id);
        if($request->status){
            $store = $store->where('confirm',$request->status);
        }
        $store = $store->get();
        return view('staff.store.index',[
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
        return view('staff.store.add',[
            'promotions' => $promotions,
            'store_types' => $store_types
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
        try{
            $check_tel = Store::where('store_tel',$request->store_tel)->get();
            if($check_tel->count() > 0){
                return redirect()->route('store.staff_index')->with('unsuccess' ,'ไม่สามรถเพิ่มข้อมูลได้ เบอร์ช้ำ');
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
                $new_store->store_tax_contact = $request->store_tax_contact;
                $new_store->store_tax_name = $request->store_tax_name;
                $new_store->store_tax_id = $request->store_tax_id;
                $new_store->store_lat = $request->store_lat;
                $new_store->store_lng = $request->store_lng;
                $new_store->create_by = auth()->user()->name;
                $new_store->create_by_id = auth()->user()->id;
                $new_store->confirm = 0;
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
                    $t = Storage::disk('do_spaces')->put('stores/'.$newFileName, file_get_contents($imageStore), 'public');
                    $new_store->store_image = $newFileName;
                }
                if($request->hasFile('storeimageline')){
                    $newFileName    =   uniqid().'.'.$request->storeimageline->extension();//gen name
                    $imageStoreLine = $request->file('storeimageline');
                    $t = Storage::disk('do_spaces')->put('stores/'.$newFileName, file_get_contents($imageStoreLine), 'public');
                    $new_store->store_lineid_image = $newFileName;
                }
                if($request->hasFile('storeimagetax')){
                    $newFileName    =   uniqid().'.'.$request->storeimagetax->extension();//gen name
                    $imageStoreTax = $request->file('storeimagetax');
                    $t = Storage::disk('do_spaces')->put('stores/'.$newFileName, file_get_contents($imageStoreTax), 'public');
                    $new_store->store_tax_image = $newFileName;
                }
                $new_store->save();
                $this->line_send($new_store);
                return redirect()->route('store.staff_index')->with('feedback' ,'บันทึกข้อมูลเรียบร้อยแล้ว');
            }
        }catch(Exception $e){
            return redirect()->route('store.staff_index')->with('unsuccess' ,'ไม่สามรถเพิ่มข้อมูลได้');
        }
    }

    public function line_send(Store $store){
        $token = env('LINE_TOKEN_GROUP');
        $message = "คนที่ทำการเพิ่มร้านค้า : ".auth()->user()->name."\n".
                    "ชื่อร้านค้า : ".$store->store_name."\n".
                    "เบอร์โทรร้านค้า : ".$store->store_tel."\n";
        $imageFile  = Storage::disk('do_spaces')->get('stores/'.$store->storeimage);
        $imageFile = new \CURLFILE($imageFile);
        $message_data = array(
            'message' => $message,
            'imageFile' => $imageFile,
            'stickerPackageId' => 2,
            'stickerId' => 34
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $message_data);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-type: application/x-www-form-urlencoded',
        'Authorization: Bearer '.$token,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
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
