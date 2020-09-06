<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Type;
use App\Banner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $category = Type::where('type_status',1)->get();
        $product = Product::where('product_status',1)->orderby('sort_order','asc')->get();
        $banners = Banner::where('is_publish',1)
        ->whereDate('banner_enddate', '>=', Carbon::today()->toDateString())
        ->whereDate('banner_startdate', '<=', Carbon::today()->toDateString())
        ->orderby('sort_order','asc')
        ->get();
        return view('frontend.product',[
            'category' => $category,
            'products' => $product,
            'banners' => $banners
        ]);
    }

    public function search_product(Request $request)
    {
        //
        $search   =   $request->search;
        $product = Product::where('product_status',1)->orderby('sort_order','asc');
        if($search){
            $product = $product->where('type_id', $search);
        }
        $product = $product->get();
        if($product){
            return response()->json(['status' => 1, 'data' => $product]);
        }
        else{
            return response()->json(['status' => 0]);
        }
        
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
    public function test()
    {
        //
        return view('frontend.test');
    }
}
