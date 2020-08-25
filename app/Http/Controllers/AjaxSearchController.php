<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Store;
use App\Promotion;
use App\User;
use App\District;
use App\SubDistrict;
use App\ZipCode;

class AjaxSearchController extends Controller
{

    //
    public function index(Request $request)
    {
        try {
            return view('welcome');
        } catch (Exception $e) {
            
        }
    }
    public function show($id)
    {
        try {
            $store = Store::where('id',$id)->first();
            $store_promotion = explode(",",$store->store_promotion);
            $promotions = Promotion::with('product')->whereIn('id',  $store_promotion)->get();
            return view('contact_detail',[
                'store' => $store,
                'promotions' => $promotions
            ]);
        } catch (Exception $e) {
            
        }
    }
    public function generalSearch(Request $request)
    {
        try {
            $search   =   $request->search;
            $stores = Store::where('store_status',1);
            if($search){
                $stores = $stores->where(function ($query) use ($search)  {
                    $query->where('store_address', 'like', '%' . $search . '%')
                        ->orWhere('store_name', 'like', '%' . $search . '%')
                        ->orWhere('store_tax_id', 'like', '%' . $search . '%')
                        ->orWhere('store_contact', 'like', '%' . $search . '%')
                        ->orWhere('store_tel', 'like', '%' . $search . '%');
                });
            }
            $stores = $stores->get();
            return response()->json(['status' => 1, 'data' => $stores]);
        } catch (Exception $e) {
            return response()->json(['status' => 0]);
        }
    }

    public function getAmphuresByProvinceID($province_id)
    {
        $districts = District::where('province_id', $province_id)->get();
        return response()->json(['status' => 1, 'data' => $districts]);
    }

    public function getSubDistrictByDistrictID($district_code)
    {
        $subdistricts = SubDistrict::where('district_id', $district_code)->get();
        return response()->json(['status' => 1, 'data' => $subdistricts]);
    }

    public function getZipCodeBySubDistrictID($sub_district_code)
    {
        $zipcode = ZipCode::where('sub_district_id', $sub_district_code)->get();
        return response()->json(['status' => 1, 'data' => $zipcode]);
    }
}
