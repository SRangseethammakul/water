<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Geography;
use App\Province;
use App\District;
use App\SubDistrict;
use App\ZipCode;
use App\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles =  Profile::where('user_id',auth()->user()->id)->get();
        return view('frontend.profile.index',[
            'profiles' => $profiles
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
        $provinces = Province::orderByRaw('convert (province_name using tis620) ASC') ->get();
        return view('frontend.profile.index',[
            'provinces' => $provinces
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
        $new_profile = new Profile();
        $new_profile->user_id = auth()->user()->id; 
        $new_profile->first_name = $request->profile_name;
        $new_profile->last_name = $request->profile_lastname;
        $new_profile->lineid  = $request->name;
        $new_profile->profile_tel  = $request->profile_tel;
        $new_profile->profile_tel_2 = $request->profile_tel_2;
        $new_profile->profile_address = $request->address_delivery;
        $new_profile->profile_province = $request->province;
        $new_profile->profile_amphure = $request->amphure;
        $new_profile->profile_sub_district = $request->sub_district;
        $new_profile->profile_zipcode = $request->zipcode;
        $new_profile->profile_lat = $request->profile_lat;
        $new_profile->profile_lng = $request->profile_lng;
        $new_profile->save();
        return redirect()->route('welcome')->with('feedback','สั่งซื้อสินค้าเรียบร้อยแล้ว')->with('feedback','เพิ่มที่อยู่สำเร็จ');
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
