<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserOrder;

class UserOrderController extends Controller
{
    public function index(){
        $userOrders = auth()->user()->orders()->orderBy('id','desc')->paginate(15);

        return view('user-orders', ['userOrders' => $userOrders]);
    }
}
