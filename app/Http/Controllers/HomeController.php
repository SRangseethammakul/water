<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Store;
use App\Promotion;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $type_count = Type::count();
        $store_count  = Store::count();
        $promotion_count  = Promotion::count();
        $user_count = User::count();
        return view('backend.dashboard',[
            'type_count' => $type_count,
            'store_count' => $store_count,
            'promotion_count' => $promotion_count,
            'user_count' => $user_count
        ]);
    }
}
