<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;


use App\Type;
use App\StoreType;
use App\Store;
use App\Promotion;
use App\User;
use App\District;
use App\SubDistrict;
use App\ZipCode;
use App\Order;

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
            $stores = Store::where('store_status',1)->where('confirm',1);
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

    public function count_store_type()
    {
        $data = [];
        $types = StoreType::get();
        if($types){
            foreach($types as $key => $type){
                $store_count = Store::where('store_type_id',$type->id)->where('store_status',1)->count();
                $data[]   =   [
                    'name' => $type->store_type_name,
                    'count' => $store_count
                ]; 
            }
            return response()->json(['status' => 1,'data' => $data]);
        }else{
            return response()->json(['status' => 0]);
        }
        
    }

    // emstracking

    public function EmsTracking()
    {
        return view('backend.api.emstracking');
    }

    public function EmsTrackingConnect(Request $request)
    {
        $number_tracking = $request->search;

        // return response()->json(['status' => 1, 'data' => $number_tracking]);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://trackapi.thailandpost.co.th/post/api/v1/authenticate/token",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_HTTPHEADER => array(
            'Authorization: Token VkYiV4C?NPTSE1XmGOKiY5RPSsDSGBM:DwPKFWWiZ_XOZrD:Z3VSRzJJSsRIOUNJNyVNLLRMShXkIARpH$WOPTFLA~RaG7EhEzU2',
            "Content-Type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);

        curl_close($curl);

        $decode = json_decode($response);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://trackapi.thailandpost.co.th/post/api/v1/track",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\r\n   \"status\": \"all\",\r\n   \"language\": \"TH\",\r\n   \"barcode\": [\r\n       \"$number_tracking\"\r\n  ]\r\n}",
            // CURLOPT_POSTFIELDS => {"status": "all","language": "TH","barcode": "EF582568151TH"},
            CURLOPT_HTTPHEADER => array(
                "Authorization: Token ".$decode->token,
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        
        curl_close($curl);
        $decode = json_decode($response, true);
        $items = $decode['response']['items'][$number_tracking];
        if(!empty($items)){  
            $data = [];
            foreach($items as $key => $item){
                $data[] = [
                    'barcode'   =>  $item['barcode'],
                    'status_description'   =>  $item['status_description'],
                    'receiver_name'   =>  $item['receiver_name'],
                    'status_date'   =>  $item['status_date'],
                ];
            }
            return response()->json(['status' => 1,'data' => $data]);
        }
        return response()->json(['status' => 0]);
    }

    public function getOrderById()
    {
        $stores = Store::limit(10)->orderby('id','desc')->get();
        return response()->json(['status' => 1,'data' => $stores],200);
    }
}
