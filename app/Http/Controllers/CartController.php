<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use App\Cart; 
use App\Profile; 
use App\Order; 
use App\OrderSub; 
use Carbon\Carbon;
use App\User; 
use App\Events\SendNoti;
class CartController extends Controller
{
    //
    public function index() {
        $sumPrice = 0;
        $deliverry = 100;
        $discount = 0;
        $listCart = auth()->user()->products()->latest()->get();
        $profiles = Profile::where('user_id',auth()->user()->id)->get();
        foreach ($listCart as $p) {
            $sumPrice = $sumPrice + ($p->pivot->qty*$p->product_price);
        }
        if($sumPrice >= 500){
            $discount = 100;
        }
        $sumProduct = $sumPrice;
        $sumPrice = $sumPrice + $deliverry - $discount;
        $sumQty = Cart::where('user_id',auth()->user()->id)->sum('qty');
       return view('frontend.cart.cart',[
           'listCart' => $listCart,
           'sumPrice' => $sumPrice,
           'sumQty' => $sumQty,
           'deliverry' => $deliverry,
           'discount' => $discount,
           'sumProduct' => $sumProduct,
           'profiles' => $profiles
       ]);
    }

    public function store(Request $request, $product_id) {
        if(is_numeric($request->val) && $request->val > 0){
            $qty = auth()->user()->products()->where('product_id',$product_id)->first();
            if (isset($qty)) {
                auth()->user()->products()->syncWithoutDetaching([$product_id => ['qty' => $qty->pivot->qty+$request->val]]);
            } else {
                auth()->user()->products()->syncWithoutDetaching([$product_id => ['qty' => $request->val]]);
            }
            return back()->with('feedback','เพิ่มสินค้าลงในตะกร้าเรียบร้อย')->with('type', 'success');
        }
        return back()->with('feedback','เพิ่มข้อมูลที่เป็นตัวเลขเท่านั้น')->with('type', 'error');
    }

    public function delete($product_id) {
        auth()->user()->products()->detach($product_id);
        return back()->with('feedback','ลบสินค้าในตะกร้าเรียบร้อย');
    }

    public function confirm(Request $request) {
        $modifiedMutable =  Carbon::now()->add(7, 'day')->format('d-m-Y');
        $listCart = auth()->user()->products()->latest()->get();
        $sumPrice = 0;
        $Count = 0;
        $order = new Order();
        $order->user_id = auth()->user()->id; 
        $order->order_status = "รอการยืนยัน"; 
        $order->order_description = "รอการยืนยัน";
        $order->profile_id = $request->profile;
        if($order->save()){
            foreach ($listCart as $p) {
                $ordersub = new OrderSub();
                $ordersub->order_id = $order->id;
                $ordersub->product_id = $p->id;
                $ordersub->qty = $p->pivot->qty;
                $Count = $ordersub->qty + $Count;
                $ordersub->price = $p->product_price;
                $ordersub->total = ($p->pivot->qty*$p->product_price);
                $sumPrice = $ordersub->total + $sumPrice;
                $ordersub->save();
                auth()->user()->products()->detach($p->id);
            }
        }
        $deliverry = 100;
        $discount = 0;
        if($sumPrice >= 500){
            $discount = 100;
        }
        $sumPrice = $sumPrice + $deliverry - $discount;
        $order_sum = Order::find($order->id);


        $order_sum->sum_qty = $Count;
        $order_sum->sum_total = $sumPrice;
        $order_sum->order_delivery = Carbon::createFromFormat('d-m-Y', $modifiedMutable)->format('Y-m-d');
        $order_sum->save();

        $profile = Profile::find($request->profile);
        $message = "ชื่อลูกค้า : ".$profile->first_name." ".$profile->last_name."\n".
                    "หมายเลขโทรศัพท์ : ".$profile->profile_tel."\n".
                    "ที่อยู่ในการจัดส่ง : ".$profile->profile_address."\n".
                    "จำนวนที่สั่ง : ".$order_sum->sum_qty."\n".
                    "ราคา : ".$order_sum->sum_total."\n".
                    "จัดส่งภายใน : ".Carbon::createFromFormat('Y-m-d', $order_sum->order_delivery)->format('d-m-Y');

        $str = 'message='.$message;
        event(new SendNoti($str));
  
        return response()->json(['status' => 1, 'day' => $modifiedMutable]);

    
    }
    public function line_send(Order $order){
        // 
        $profile = Profile::find($order->profile_id);
        $token = env('LINE_TOKEN_GROUP');

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

    public function newConfirm(Request $request){
        $newFileName = null;
        $modifiedMutable =  Carbon::now()->add(7, 'day')->format('d-m-Y');
        $listCart = auth()->user()->products()->latest()->get();
        $sumPrice = 0;
        $Count = 0;
        $order = new Order();
        $order->user_id = auth()->user()->id; 
        $order->order_status = "รอการยืนยัน"; 
        $order->order_description = "รอการยืนยัน";
        $order->profile_id = $request->profileselect;
        $order->payment_status = $request->paymeny_status;
        if($request->hasFile('payment_img')){
            $newFileName    =   uniqid().'.'.$request->payment_img->extension();//gen name
            $image = $request->file('payment_img');
            $t = Storage::disk('do_spaces')->put('order_payments/'.$newFileName, file_get_contents($image));
            $order->img_payment = $newFileName;
        }
        if($order->save()){
            foreach ($listCart as $p) {
                $ordersub = new OrderSub();
                $ordersub->order_id = $order->id;
                $ordersub->product_id = $p->id;
                $ordersub->qty = $p->pivot->qty;
                $Count = $ordersub->qty + $Count;
                $ordersub->price = $p->product_price;
                $ordersub->total = ($p->pivot->qty*$p->product_price);
                $sumPrice = $ordersub->total + $sumPrice;
                $ordersub->save();
                auth()->user()->products()->detach($p->id);
            }
        }
        $deliverry = 100;
        $discount = 0;
        if($sumPrice >= 500){
            $discount = 100;
        }
        $sumPrice = $sumPrice + $deliverry - $discount;
        $order_sum = Order::find($order->id);

        $order_sum->sum_qty = $Count;
        $order_sum->sum_total = $sumPrice;
        $order_sum->order_delivery = Carbon::createFromFormat('d-m-Y', $modifiedMutable)->format('Y-m-d');

        if($order_sum->save()){
            $profile = Profile::find($request->profileselect);
            $message = "ชื่อลูกค้า : ".$profile->first_name." ".$profile->last_name."\n".
                        "หมายเลขโทรศัพท์ : ".$profile->profile_tel."\n".
                        "ที่อยู่ในการจัดส่ง : ".$profile->profile_address."\n".
                        "จำนวนที่สั่ง : ".$order_sum->sum_qty."\n".
                        "ราคา : ".$order_sum->sum_total."\n".
                        "จัดส่งภายใน : ".Carbon::createFromFormat('Y-m-d', $order_sum->order_delivery)->format('d-m-Y');
    
            $str = 'message='.$message;
            event(new SendNoti($str));
            return response()->json(['status' => 1, 'day' => $modifiedMutable]);
        }
        else{
            return response()->json(['status' => 0]);
        }
    }
}
