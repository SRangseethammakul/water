<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;

class BannerAPIController extends Controller
{
    //
    public function showbanner(){
        try{
            $data = [];
            $banners = Banner::where('is_publish',1)
                ->whereDate('banner_enddate', '>=', Carbon::today()->toDateString())
                ->whereDate('banner_startdate', '<=', Carbon::today()->toDateString())
                ->orderby('sort_order','asc')
                ->get();
            if($banners){
                foreach($banners as $key => $banner){
                    $url = Storage::disk('do_spaces')->temporaryUrl('banners/'.$banner->banner_image, now()->addMinutes(5));
                    $data[]   =   [
                        'img'   =>  $url
                    ]; 
                }
                return response()->json($data, 200); 
            }else{
                $data = "Promotion Not Found";
                return response()->json($data, 200); 
            }

        }catch(Exception $e){
            $reponse    =   [
                'status' => -1,
                'message'   =>  $e
            ];
            return response()->json($reponse, 400);
        }
    }
}
