<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order; 
use App\OrderSub;
use App\User; 
use Carbon\Carbon;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::with('ordersubs')->orderBy('created_at', 'desc')->get();
        return view('backend.order.index',[
            'orders' => $orders
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
        $order = Order::find($id);
        $order_subs = OrderSub::with('product')->where('order_id',$id)->get();
        $user = User::find($order->user_id);
        return view('backend.order.edit',[
            'user' => $user,
            'order' => $order,
            'order_subs' => $order_subs
        ]);

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
        $id = $request->id;
        $order_edit = Order::find($id);
        $order_edit->order_status = $request->order_status;
        $order_edit->order_description = $request->order_description;
        $order_edit->order_delivery = Carbon::createFromFormat('d/m/Y', $request->order_delivery)->format('Y-m-d');
        $order_edit->save();
        return redirect()->route('order.index')->with('feedback' ,'แก้ไขเรียบร้อยแล้ว');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        $order = Order::where('id',$id)->first();
        if($order){
            $order->delete();
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['status' => 0]);
        }
    }
}
