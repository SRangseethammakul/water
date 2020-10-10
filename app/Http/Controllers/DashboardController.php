<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;


use App\Type;
use App\Store;
use App\Promotion;
use App\User;
use App\Order; 

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //   CURLOPT_URL => "https://trackapi.thailandpost.co.th/post/api/v1/authenticate/token",
        //   CURLOPT_RETURNTRANSFER => true,
        //   CURLOPT_ENCODING => "",
        //   CURLOPT_MAXREDIRS => 10,
        //   CURLOPT_TIMEOUT => 0,
        //   CURLOPT_FOLLOWLOCATION => true,
        //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //   CURLOPT_CUSTOMREQUEST => "POST",
        //   CURLOPT_HTTPHEADER => array(
        //     'Authorization: Token VkYiV4C?NPTSE1XmGOKiY5RPSsDSGBM:DwPKFWWiZ_XOZrD:Z3VSRzJJSsRIOUNJNyVNLLRMShXkIARpH$WOPTFLA~RaG7EhEzU2',
        //     "Content-Type: application/json"
        //   ),
        // ));
        
        // $response = curl_exec($curl);
        
        // curl_close($curl);
        // $decode = json_decode($response);

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://trackapi.thailandpost.co.th/post/api/v1/track",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS =>"{\r\n   \"status\": \"all\",\r\n   \"language\": \"TH\",\r\n   \"barcode\": [\r\n       \"EF582568151TH\"\r\n  ]\r\n}",
        //     CURLOPT_HTTPHEADER => array(
        //         "Authorization: Token ".$decode->token,
        //         "Content-Type: application/json"
        //     ),
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);

        // $decode = json_decode($response);

        // dd($decode->response->item[0]);

        $client = new Client();
        $response = $client->get('https://covid19.th-stat.com/api/open/today');
        $res = json_decode($response->getBody()->getContents());

        $type_count = Type::count();
        $store_count  = Store::count();
        $promotion_count  = Promotion::count();
        $user_count = User::count();
        $order_count_wait = Order::where('order_status','รอการยืนยัน')->count();
        $order_count_wait_delivery = Order::where('order_status','รอการจัดส่ง')->count();

        $staff_store_count_wait  = Store::where('confirm',0)->where('create_by_id',auth()->user()->id)->count();
        $staff_store_count_con  = Store::where('confirm',1)->where('create_by_id',auth()->user()->id)->count();
        $staff_store_count_den  = Store::where('confirm',2)->where('create_by_id',auth()->user()->id)->count();

        return view('backend.dashboard',[
            'type_count' => $type_count,
            'store_count' => $store_count,
            'promotion_count' => $promotion_count,
            'user_count' => $user_count,
            'order_count_wait' => $order_count_wait,
            'order_count_wait_delivery' => $order_count_wait_delivery,
            'staff_store_count_wait' => $staff_store_count_wait,
            'staff_store_count_con' => $staff_store_count_con,
            'staff_store_count_den' => $staff_store_count_den,
            'covids' => $res
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
