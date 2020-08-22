<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart; 
use App\Order; 
use App\OrderSub; 
use Carbon\Carbon;
class CartController extends Controller
{
    //
    public function index() {

        $listCart = auth()->user()->products()->latest()->get();
        $sumPrice = auth()->user()->products()->sum('products.product_price');
        $sumQty = Cart::where('user_id',auth()->user()->id)->sum('qty');
       return view('frontend.cart.cart',[
           'listCart' => $listCart,
           'sumPrice' => $sumPrice,
           'sumQty' => $sumQty,
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
        $order_sum = Order::find($order->id);

        $order_sum->sum_qty = $Count;
        $order_sum->sum_total = $sumPrice;
        $order_sum->save();
        $modifiedMutable =  Carbon::now()->add(7, 'day')->format('d-m-Y');
    
        return redirect()->route('welcome')->with('feedback','สั่งซื้อสินค้าเรียบร้อยแล้ว')->with('day',$modifiedMutable);
    
      }
}
