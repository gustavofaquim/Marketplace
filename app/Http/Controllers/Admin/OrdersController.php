<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserOrder;

class OrdersController extends Controller
{
    private $order;

    public function __construct(UserOrder $order){
        $this->order = $order;
    }

    public function index(){
        //$orders = auth()->user()->store->orders()->paginate(15);

        if(!auth()->user()->store()->exists()){
            return redirect()->route('admin.stores.index')->with('msg', 'Você precisa ter uma loja primeiro');;
        }
        else if(!auth()->user()->store->orders()->exists()){
            return redirect()->route('admin.stores.index')->with('msg', 'Você ainda não tem nenhum pedido');;
        }
        
        $orders = auth()->user()->store->orders()->paginate(15);
        //dd($orders);
        
        return view('admin.orders.index', ['orders'=> $orders]);
    }
}
