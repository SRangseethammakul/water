<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Image;
use App\Events\SendNoti;
class BannerAPIController extends Controller
{
    //
    public function showbanner(){
        try{
            $data = [];
            $banners = Banner::where('is_publish',1)
                ->whereDate('banner_startdate', '<=', Carbon::today()->toDateString())
                ->whereDate('banner_enddate', '>', Carbon::today()->toDateString())
                ->orderby('sort_order','asc')
                ->get();
            
            if($banners){
                foreach($banners as $key => $banner){

                    // $this->line_send($banner);
                    $url = Storage::disk('do_spaces')->temporaryUrl('banners/'.$banner->banner_image, now()->addMinutes(15));
                    $imageThumbnail = $url;
                    $imageFullsize = $url;
                    $str = 'message=dd&imageThumbnail='.$imageThumbnail.'&imageFullsize='.$imageFullsize.'&stickerPackageId=2&stickerId=34';
                    event(new SendNoti($str));
                    $data[]   =   [
                        'img'   =>  $url
                    ];
                }
                return response()->json(['status' => 1, 'banners' => $data], 200); 
            }else{
                $data = "Promotion Not Found";
                return response()->json($data, 204); 
            }

        }catch(Exception $e){
            $reponse    =   [
                'status' => -1,
                'message'   =>  $e
            ];
            return response()->json($reponse, 400);
        }
    }

    public function line_send(Banner $banner){
        $token = env('LINE_TOKEN_PRIVATE');
        $message = "คนที่ทำการเพิ่มร้านค้า : ";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "message=".$message);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-type: application/x-www-form-urlencoded',
            'Authorization: Bearer '.$token,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }
}
