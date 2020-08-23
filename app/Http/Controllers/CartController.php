<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart; 
use App\Order; 
use App\OrderSub; 
use Carbon\Carbon;
use App\User; 
class CartController extends Controller
{
    //
    public function index() {
        $sumPrice = 0;
        $deliverry = 100;
        $discount = 0;
        $listCart = auth()->user()->products()->latest()->get();
        
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
           'sumProduct' => $sumProduct
       ]);
    }

    public function store($product_id) {


        $qty = auth()->user()->products()->where('product_id',$product_id)->first();
    
        if (isset($qty)) {
            auth()->user()->products()->syncWithoutDetaching([$product_id => ['qty' => $qty->pivot->qty+1]]);
        } else {
            auth()->user()->products()->syncWithoutDetaching([$product_id => ['qty' => 1]]);
        }
    
        return back()->with('feedback','เพิ่มสินค้าลงในตะกร้าเรียบร้อย');
    }

    public function delete($product_id) {
        auth()->user()->products()->detach($product_id);
        return back()->with('feedback','ลบสินค้าในตะกร้าเรียบร้อย');
    }

    public function confirm() {
        $modifiedMutable =  Carbon::now()->add(7, 'day')->format('d-m-Y');
        $listCart = auth()->user()->products()->latest()->get();
        $sumPrice = 0;
        $Count = 0;
        $order = new Order();
        $order->user_id = auth()->user()->id; 
        $order->order_status = "รอการยืนยัน"; 
        $order->order_description = "รอการยืนยัน"; 
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


        $this->line_send($order_sum);
  

        return redirect()->route('welcome')->with('feedback','สั่งซื้อสินค้าเรียบร้อยแล้ว')->with('day',$modifiedMutable);

    
    }
    public function line_send(Order $order){
        // ba5PZeTIypFtYj2LMoLflC0tkZklQnh905ULXMaYm2e
        //g4P4S28Br4NUSNE2sRsuI9zFlsAcVQHOu5oQ64mYeZe ส่วนตัว
        $user = User::find($order->user_id);
        $token = 'ba5PZeTIypFtYj2LMoLflC0tkZklQnh905ULXMaYm2e';
        $message = "ชื่อลูกค้า : ".$user->name."\n".
                    "จำนวนที่สั่ง : ".$order->sum_qty."\n".
                    "ราคา : ".$order->sum_total."\n".
                    "จัดส่งภายใน : ".Carbon::createFromFormat('Y-m-d', $order->order_delivery)->format('d-m-Y');
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
